<?php


namespace App\Services;


use App\Events\Notify;
use App\Jobs\CreateApplicationJob;
use App\Models\Branch;
use App\Models\Notification;
use App\Models\PermissionRole;
use App\Models\Resource;
use App\Models\SignedDocs;
use App\Models\StatusExtented;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;
use App\Models\Country;
use App\Models\Purchase;
use App\Models\Roles;
use App\Models\Subject;
use Illuminate\Support\Facades\Http;

class ApplicationService
{
    public function show($application)
    {
        if (PHP_SAPI === 'cli')
            return dd($application);
        $access = SignedDocs::where('role_id', auth()->user()->role_id)->where('user_id', null)->where('application_id', $application->id)->first();
        $branch = Branch::where('id', $application->filial_initiator_id)->first();
        $signedDocs = $application->signedDocs()->get();

        $same_role_user_ids = User::where('role_id', auth()->user()->role_id)->get()->pluck('id')->toArray();
        Cache::put('application_id',$application->id);
//        $granted[] = json_decode($application->roles_need_sign, true);
//        $granted[] = 5;
//        $b1 = in_array(auth()->user()->role_id, $granted);
//        if(!$b1)
//            return redirect()->route('eimzo.back')->with('danger', 'Permission denied!');
        $user = auth()->user();
        return view('site.applications.show', compact('user','application','branch','signedDocs', 'same_role_user_ids','access'));

    }
    public function edit($application)
    {
        $countries = ['0' => 'Select country'];
        $countries[] = Country::get()->pluck('country_name','country_alpha3_code')->toArray();
        $products = Resource::get();
        $select = [];
        for($i=0;$i<count($products);$i++)
        {
            $select[] = $products[$i]->name;
        }
        $company_signer = PermissionRole::where('permission_id',166)->select('role_id')->get();
        $branch_signer = PermissionRole::where('permission_id',167)->select('role_id')->get();
        return view('site.applications.edit', [
            'application' => $application,
            'purchase' => Purchase::all()->pluck('name','id'),
            'subject' => Subject::all()->pluck('name','id'),
            'branch' => Branch::all()->pluck('name', 'id'),
            'users' => User::where('role_id', 5)->get(),
            'status_extented' => StatusExtented::all(),
            'countries' => $countries,
            'products' => $select,
            'company_signers' => Roles::find($company_signer)->pluck('display_name','id'),
            'branch_signers' => Roles::find($branch_signer)->pluck('display_name','id'),
        ]);
    }

    public function sendNotifications($array, $application)
    {

        $user_ids = User::query()->whereIn('role_id', $array)->pluck('id')->toArray();
        foreach ($user_ids as $user_id) {
            $notification = Notification::query()->firstOrCreate(['user_id' => $user_id, 'application_id' => $application->id]);
            if ($notification->wasRecentlyCreated) {
//                $diff = now()->diffInMinutes($application->created_at);
//                $data = [
//                    'id' => $application->id,
//                    'time' => $diff == 0 ? 'recently' : $diff
//                ];

//                broadcast(new Notify(json_encode($data, $assoc = true), $user->id))->toOthers();     // notification
            }
        }

        Http::post('ws.smarts.uz/api/send-notification', [
            'user_ids' => $user_ids,
            'project' => 'user',
            'data' => ['id' => $application->id, 'time' => 'recently']
        ]);
    }
}
