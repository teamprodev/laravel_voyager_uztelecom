<?php

namespace App\Http\Controllers\Site;

use App\Http\Requests\ApplicationRequest;
use App\Http\Requests\VoteApplicationRequest;
use App\Jobs\CreateApplicationJob;
use App\Jobs\UpdateApplicationJob;
use App\Jobs\VoteJob;
use App\Models\Application;
use App\Models\User;
use App\Structures\ApplicationData;
use Exception;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class ApplicationController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $applications = Application::steps()->get();
        return view('site.applications.index', compact('applications'));
    }
    public function getdata(Request $request)
    {
        if ($request->ajax()) {
            $data = Application::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = ' <a href="'. route("site.applications.edit", $row->id ) .'">
                    <button type="button" class="inline-block px-6 py-2.5 bg-blue-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-600 hover:shadow-lg focus:bg-blue-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-700 active:shadow-lg transition duration-150 ease-in-out">Edit</button>
                </a>
                <a href="'. route(  "site.applications.show", $row->id ) .'">
                    <button type="button" class="inline-block px-6 py-2.5 bg-yellow-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-yellow-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-yellow-800 active:shadow-lg transition duration-150 ease-in-out">Show</button>
                </a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);

        }
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
    public function store(ApplicationRequest $request)
    {
        $application = $request->validated();
        $result = Application::create($application);
        if(!$result)
            return redirect()->back()->with('message', trans('site.application_failed'));
        return redirect('/ru/site/profile')->with('message', trans('site.application_success'));
    }

    public function getAll(){
        $applications = Application::all();
        return response()->json($applications);
    }
    public function form(Application $application , Request $request){
        return route('site.applications.form', compact($application));
    }
    public function vote(Application $application, VoteApplicationRequest $request){
        try{
            if(Gate::allow)
            $this->dispatchNow(new VoteJob($application, $request));
            return redirect()->route('site.applications.index')->with('success', 'Voted!');
        } catch (Exception $exception){
            dd($exception);
            return redirect()->route('site.applications.index')->with('danger', 'Something went wrong!');

        }
    }

}
