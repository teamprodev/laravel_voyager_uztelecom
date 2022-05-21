<?php


namespace App\Services;


use App\Events\Notify;
use App\Models\Branch;
use App\Models\Notification;
use App\Models\Permission;
use App\Models\PermissionRole;
use App\Models\Position;
use App\Models\Resource;
use App\Models\SignedDocs;
use App\Models\StatusExtented;
use App\Models\User;
use App\Models\Warehouse;
use DateTime;
use GuzzleHttp\Client;
use Illuminate\Support\Carbon;
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
        $branch = Branch::where('id', $application->branch_initiator_id)->first();
        $signedDocs = $application->signedDocs()->get();
        $file_basis = json_decode($application->file_basis);
        $file_tech_spec = json_decode($application->file_tech_spec);
        $other_files = json_decode($application->other_files);
        $same_role_user_ids = User::where('role_id', auth()->user()->role_id)->get()->pluck('id')->toArray();
        $performers_company = Permission::with('roles')->where('key', 'Company_Performer')->first()->roles;
        $performers_branch = Permission::with('roles')->where('key', 'Branch_Performer')->first()->roles;
        $user = auth()->user();
        $access_comment = Position::find($user->position_id);
        $subjects = Subject::all();
        $purchases = Purchase::all();
        $branch_name = Branch::find($application->user->branch_id, 'name');
        $branch = Branch::all()->pluck('name', 'id');
        return view('site.applications.show', compact('branch','access_comment','performers_company','performers_branch','file_basis','file_tech_spec','other_files','user','application','branch','signedDocs', 'same_role_user_ids','access','subjects','purchases','branch_name'));

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
        $performer_file = json_decode($application->performer_file);
        $company_signer = PermissionRole::where('permission_id',166)->select('role_id')->get();
        $branch_signer = PermissionRole::where('permission_id',167)->select('role_id')->get();
        return view('site.applications.edit', [
            'application' => $application,
            'purchase' => Purchase::all()->pluck('name','id'),
            'subject' => Subject::all()->pluck('name','id'),
            'branch' => Branch::all()->pluck('name', 'id'),
            'users' => User::where('role_id', 5)->get(),
            'status_extented' => StatusExtented::all()->pluck('name','name'),
            'countries' => $countries,
            'products' => $select,
            'warehouse' => Warehouse::where('application_id',$application->id)->first(),
            'performer_file' => $performer_file,
            'user' => auth()->user(),
            'company_signers' => Roles::find($company_signer)->pluck('display_name','id'),
            'branch_signers' => Roles::find($branch_signer)->pluck('display_name','id'),
        ]);
    }
    public function update($application,$request)
    {
        $data = $request->validated();
        if(isset($data['draft']))
            if($data['draft'] == 1)
                $data['status'] = 'draft';
        if(isset($data['performer_leader_user_id']))
        {
            $data['performer_leader_comment_date'] = Carbon::now()->toDateTimeString();
        }
        if(isset($data['performer_comment']))
        {
            $data['performer_comment_date'] = Carbon::now()->toDateTimeString();
        }
        if(isset($data['resource_id']))
        {
            if($data['resource_id'] == "[object Object]")
            {
                $data['resource_id'] = null;
            }else{
                $explode = explode(',',$data['resource_id']);
                $id = [];
                for ($i = 0; $i < count($explode); $i++)
                {
                    $all = Resource::where('name','like',"%{$explode[$i]}%")->first();
                    $id[] = $all->id;
                    $data['resource_id'] = json_encode($id);
                }
            }

        }

        if (isset($data['performer_role_id']))
        {
            $mytime = Carbon::now();
            $data['performer_received_date'] = $mytime->toDateTimeString();
            $data['status'] = 'distributed';
//            $data['performer_head_of_dep_user_id'] = auth()->user()->id;
        }
        if ($application->is_more_than_limit != 1)
            $roles = PermissionRole::where('permission_id',168)->pluck('role_id')->toArray();
        else
            $roles = PermissionRole::where('permission_id',165)->pluck('role_id')->toArray();

        if (isset($data['signers']))
        {
            $array = array_merge($roles,$data['signers']);
            $data['signers'] = json_encode($array);
            foreach ($array as $signers)
            {
                $signer = SignedDocs::where('application_id',$application->id)->where('role_id',$signers)->first();
                if($signer == null)
                {
                    $docs = new SignedDocs();
                    $docs->role_id = $signers;
                    $docs->application_id = $application->id;
                    $docs->table_name = "applications";
                    $docs->save();
                }else{
                    $signer->comment = null;
                    $signer->status = null;
                    $signer->pkcs = null;
                    $signer->text = null;
                    $signer->data = null;
                }

            }
            $signers = json_decode($application->signers);
            $signedDocs = SignedDocs::where('application_id',$application->id)->pluck('role_id')->toArray();
            $not_signer = array_diff($signedDocs,$signers);
            foreach($not_signer as $delete)
            {
                SignedDocs::where('application_id',$application->id)->where('role_id',$delete)->delete();
            }
            $this->sendNotifications($array, $application,null);
        }
        $result = $application->update($data);
        if ($result)
            return back();

        return redirect()->back()->with('danger', trans('site.application_failed'));
    }
    public function sendNotifications($array, $application, $message)
    {
        if($array != null)
        {
            $user_ids = User::query()->whereIn('role_id', $array)->pluck('id')->toArray();
            foreach ($user_ids as $user_id) {
                $notification = Notification::query()->firstOrCreate(['user_id' => $user_id, 'application_id' => $application->id,'message' => $message]);
                if ($notification->wasRecentlyCreated) {
//                    $diff = now()->diffInMinutes($application->created_at);
//                    $data = [
//                        'id' => $application->id,
//                        'time' => $diff == 0 ? 'recently' : $diff
//                    ];

//                    broadcast(new Notify(json_encode($data, $assoc = true), $user->id))->toOthers();     // notification
                }
            }

            Http::post('ws.smarts.uz/api/send-notification', [
                'user_ids' => $user_ids,
                'project' => 'uztelecom',
                'data' => ['id' => $application->id, 'time' => 'recently']
            ]);
        }

    }
}
