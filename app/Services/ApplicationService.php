<?php


namespace App\Services;


use App\Jobs\CreateApplicationJob;
use App\Models\Branch;
use App\Models\SignedDocs;
use App\Models\User;
use Illuminate\Support\Facades\Cache;

class ApplicationService
{
    public function show($application)
    {
        if (PHP_SAPI === 'cli')
            return dd($application);
        $access = SignedDocs::where('role_id', auth()->user()->role_id)->where('user_id', !null)->where('application_id', $application->id)->first();
        $branch = Branch::where('id', $application->filial_initiator_id)->first();
        $signedDocs = $application->signedDocs()->get();

        $same_role_user_ids = User::where('role_id', auth()->user()->role_id)->get()->pluck('id')->toArray();
        Cache::put('application_id',$application->id);
//        $granted[] = json_decode($application->roles_need_sign, true);
//        $granted[] = 5;
//        $b1 = in_array(auth()->user()->role_id, $granted);
//        if(!$b1)
//            return redirect()->route('eimzo.back')->with('danger', 'Permission denied!');
        return view('site.applications.show', compact('application','branch','signedDocs', 'same_role_user_ids','access'));

    }

}
