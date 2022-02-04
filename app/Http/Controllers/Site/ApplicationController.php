<?php

namespace App\Http\Controllers\Site;

use App\Http\Requests\ApplicationRequest;
use App\Jobs\CreateApplicationJob;
use App\Models\Application;
use App\Structures\ApplicationData;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function index(Request $request){
        $applications = Application::all();
        return view('site.applications.index', compact('applications'));
    }
    public function show(Application $application){
        return view('site.applications.show', compact($application));
    }
    public function edit(Application $application){
        return view('site.applications.edit', compact($application));

    }
    public function update(Application $application, ApplicationRequest $request){
        return view('site.applications.update', compact($application));
    }
    public function create(){
        return view('site.applications.create');
    }
    public function store(ApplicationRequest $request){
        try {
            $this->dispatchNow(new CreateApplicationJob(ApplicationData::fill($request->all()), $request));
            return redirect()->route('site.applications.index')->with('success', trans('site.application_success'));
        } catch (\Exception $e) {
            return redirect()->back()->with('danger', trans('site.application_failed'));
        }
    }
}
