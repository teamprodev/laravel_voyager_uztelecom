<?php

namespace App\Http\Controllers\Site;

use App\Http\Requests\ApplicationRequest;
use App\Models\Application;
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
        return "Store";
    }
}
