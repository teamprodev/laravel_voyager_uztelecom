<?php

namespace App\Http\Controllers\Site;

use App\Http\Requests\ApplicationRequest;
use App\Http\Requests\VoteApplicationRequest;
use App\Jobs\CreateApplicationJob;
use App\Jobs\UpdateApplicationJob;
use App\Jobs\VoteJob;
use App\Models\Application;
use App\Models\Branch;
use App\Models\Country;
use App\Models\Roles;
use App\Models\User;
use App\Structures\ApplicationData;
use Illuminate\Support\Carbon;
use App\Models\SignedDocs;
use Exception;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Teamprodev\Eimzo\Services\EimzoService;
use Yajra\DataTables\DataTables;

class ApplicationController extends Controller
{
//    private EimzoService $eimzoService;
    public function __construct(){
        $this->middleware('auth');
//        $this->eimzoService = new EimzoService();

    }
    public function index(Request $request)
    {
        return view('site.applications.index');
    }

    public function getdata(Request $request)
    {
        $data = Application::query();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $edit = route('site.applications.edit', $row->id);
                $show = route('site.applications.show', $row->id);
                return "<a href='{$edit}' class='edit btn btn-success btn-sm'>Edit</a> <a href='{$show}' class='show btn btn-warning btn-sm'>Show</a>";
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function SignedDocs()
    {
        $data = SignedDocs::query();
        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('status', '@if($status == 0) Rejected @elseif($status == 1) Accepted @endif')
            ->editColumn('user_id', " @php echo auth()->user()->name @endphp ")
            ->make(true);
    }
    public function show(Application $application)
    {
        $branch = Branch::where('id', $application->filial_initiator_id)->first();
        $signedDocs = $application->signedDocs()->get();

        // $same_role_user_ids = User::where('role_id', auth()->user()->role_id)->get()->pluck('id')->toArray();
        // $b1 = in_array(auth()->user()->role_id, json_decode($application->roles_need_sign, true));
        // if(!$b1)
        //     return redirect()->route('eimzo.back')->with('danger', 'Permission denied!');
        return view('site.applications.show', compact('application','branch','signedDocs'));
    }

    public function edit(Application $application)
    {
        $branchAll = Branch::skip(1)->take(Branch::count() - 1)->get();
        $countriesAll = Country::skip(1)->take(Country::count() - 1)->get();    
        $branch = Branch::where('id', $application->filial_initiator_id)->first();
        $countries = Country::where('id', $application->country_produced_id)->first();
        return view('site.applications.edit', compact('application','branch','countries','branchAll','countriesAll'));
    }
    public function update(Application $application, ApplicationRequest $request){
        $data = $request->validated();
        $result = $application->update($data);
        if ($result)
            return redirect()->route('site.applications.index')->with('success', trans('site.application_success'));

        return redirect()->back()->with('danger', trans('site.application_failed'));
    }
    public function uploadImage(Request $request, Application $application)
    {
        $file_basis = json_decode($application->file_basis);
        $file_tech_spec = json_decode($application->file_tech_spec);
        $other_files = json_decode($application->other_files);
        if ($request->hasFile('file_basis')) {
            $files = $request->file('file_basis');
            $name = Storage::put('public/uploads', $files);
            $name = str_replace('public/','', $name);
            $file_basis[] = $name;
        }
        if ($request->hasFile('file_tech_spec')) {
            $files = $request->file('file_tech_spec');
            $name = Storage::put('public/uploads', $files);
            $name = str_replace('public/','', $name);
            $file_tech_spec[] = $name;
        }
        if ($request->hasFile('other_files')) {
            $files = $request->file('other_files');
            $name = Storage::put('public/uploads', $files);
            $name = str_replace('public/','', $name);
            $other_files[] = $name;
        }

        $application->file_basis = json_encode($file_basis);
        $application->file_tech_spec = json_encode($file_tech_spec);
        $application->other_files = json_encode($other_files);
        $application->update();
    }
    public function create()
    {
        $branch = Branch::all();
        $countries = ['0' => 'Select country'];
        $countries[] = Country::get()->pluck('country_name','country_alpha3_code')->toArray();

        $user = auth()->user();
        $roles = Roles::all()->where('is_signer',!null)->pluck('display_name', 'id')->toArray();
        return view('site.applications.create', compact('user','branch','countries', 'roles'));
    }
    public function store(ApplicationRequest $request)
    {
            try{
                $this->dispatchNow(new CreateApplicationJob($request));
                return redirect()->route('site.applications.index')->with('success', trans('site.application_success'));
            } catch(Exception $exception){
                dd($exception);
                return redirect()->back()->with('danger', trans('site.application_failed'));
            }

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
            $this->dispatchNow(new VoteJob($application, $request));
            return redirect()->route('site.applications.index')->with('success', 'Voted!');
        } catch (Exception $exception){
            dd($exception);
            return redirect()->route('site.applications.index')->with('danger', 'Something went wrong!');

        }
    }

}
