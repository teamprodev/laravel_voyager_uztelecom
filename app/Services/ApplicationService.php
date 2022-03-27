<?php


namespace App\Services;


use App\Jobs\CreateApplicationJob;
use App\Models\Branch;
use App\Models\SignedDocs;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use App\Models\Country;
use App\Models\Purchase;
use App\Models\Roles;
use App\Models\Subject;

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
    public function edit($application)
    {
        $branch = Branch::all();
        $countries = ['0' => 'Select country'];
        $countries[] = Country::get()->pluck('country_name','country_alpha3_code')->toArray();
        $branchAll = Branch::skip(1)->take(Branch::count() - 1)->get();
        $countriesAll = Country::skip(1)->take(Country::count() - 1)->get();
        $purchase = Purchase::all()->pluck('name','id');
        $subject = Subject::all()->pluck('name','id');
        $roles = Roles::all()->where('is_signer',!null)->pluck('display_name', 'id')->toArray();
        return view('site.applications.edit', compact('application','purchase','subject','branch','countries','roles','branchAll','countriesAll'));

    }
}
