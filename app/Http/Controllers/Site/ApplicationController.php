<?php

namespace App\Http\Controllers\Site;

use App\Http\Requests\ApplicationRequest;
use App\Jobs\CreateApplicationJob;
use App\Jobs\UpdateApplicationJob;
use App\Models\Application;
use App\Models\Task;
use App\Models\User;
use App\Structures\ApplicationData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class ApplicationController extends Controller
{
    public function __construct(){
//        $this->middleware('auth');
    }
    public function index(Request $request){
        $user_role = auth()->user()->role_id;
        switch ($user_role) {
            // APPLICATION CREATOR
            case 1: {
                $applications = Application::where('user_id', auth()->id())->get();
            } break;
            //Budget planning
            case 4: {
                // Get all workers id of his department as array
//                $user_list = User::where('department_id', $user->department_id)->pluck('id')->toArray();
//                return $query->whereIn('user_id', $user_list);
                // todo: more than price 250 mln HEad Office Can controller
                // todo: Planner see only appplications of its department
                //
                $applications = Application::whereIn('status', [0, 1, -1])->get();

            } break;
            default: {
                $applications = Application::all();

            } break;

        }
        return view('site.applications.index', compact('applications'));
    }
    public function indexAjax(Request $request){
        $applications = Application::all();
        if (isset($request->orderBy)) {
            if ($request->orderBy == 'all') {
                $tasks = Application::select('tasks.id', 'tasks.name', 'tasks.address', 'tasks.start_date', 'tasks.budget', 'tasks.category_id', 'tasks.status', 'tasks.oplata', 'tasks.coordinates', 'users.name as user_name', 'users.id as userid', 'categories.name as category_name', 'categories.ico as icon')
                    ->get();
            }

        }
        return view('site.applications.index', compact('applications'));
    }
    public function show(Application $application){
        return view('site.applications.show', compact('application'));
    }
    public function edit(Application $application){
        return view('site.applications.edit', compact('application'));

    }
    public function update(Application $application, ApplicationRequest $request){
        try {
            $this->dispatchNow(new UpdateApplicationJob($request));
            return redirect()->route('site.applications.index')->with('success', trans('site.application_success'));
        } catch (\Exception $e) {
            return redirect()->back()->with('danger', trans('site.application_failed'));
        }
//        return view('site.applications.update', compact($application));
    }
    public function create(){
        $user = auth()->user();
        return view('site.applications.create', compact('user'));
    }
    public function store(ApplicationRequest $request){
        try {
            $this->dispatchNow(new CreateApplicationJob($request));
            return redirect()->route('site.profile.profile')->with('message', trans('site.application_success'));
        } catch (\Exception $e) {
            return redirect()->back()->with('message', trans('site.application_failed'));
        }
    }

    public function getAll(){
        $applications = Application::all();
        return response()->json($applications);
    }
    public function form(Application $application , Request $request){
        return route('site.applications.form', compact($application));
    }
    public function vote(Application $application){

    }
    public function cancel(Application $application){

    }
}
