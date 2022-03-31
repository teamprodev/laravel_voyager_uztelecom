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
use App\Models\Notification;
use App\Models\PermissionRole;
use App\Models\Purchase;
use App\Models\Roles;
use App\Models\Subject;
use App\Models\User;
use App\Services\ApplicationService;
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
    /**
     * @var ApplicationService
     */
    private ApplicationService $service;

    public function __construct(ApplicationService $service){
        $this->middleware('auth');
        $this->service = $service;
//        $this->eimzoService = new EimzoService();

    }
    public function index(Request $request)
    {
        return view('site.applications.index');
    }

    public function getdata(Request $request)
    {
        $query = Application::query();
        $user = auth()->user();

        if ($user->hasPermission('Company_Performer') || $user->hasPermission('Branch_Performer'))
        {
            $query = $query->where('performer_user_id', $user->id);
        }
        elseif($user->hasPermission('Company_Leader'))
        {
            $query = $query->where('status', 'agreed');
        }
        elseif($user->hasPermission('Branch_Leader'))
        {
            $query = $query->where('status', 'accepted');
        }
        elseif($user->role_id == 7)
        {
            $query = Application::query()->where('status', "accepted")->where('signers','like',"%{$user->role_id}%");
        }
        elseif ($user->hasPermission('Company_Signer') || $user->hasPermission('Add_Company_Signer')||$user->hasPermission('Branch_Signer') || $user->hasPermission('Add_Branch_Signer'))
        {
            $query = Application::query()->where('signers','like',"%{$user->role_id}%");
        }
        else {
            $query = $query->where('user_id',$user->id);
        }

        return Datatables::of($query)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $edit = route('site.applications.edit', $row->id);
                $show = route('site.applications.show', $row->id);
                return "<a href='{$edit}' class='edit btn btn-success btn-sm'>Edit</a> <a href='{$show}' class='show btn btn-warning btn-sm'>Show</a>";
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function show(Application $application, $view = false)
    {
        if ($view == true) {
            Notification::query()
                ->where('application_id', $application->id)
                ->where('user_id', auth()->id())
                ->increment('is_read');
        }
        return $this->service->show($application);
    }
    public function SignedDocs()
    {
        $data = SignedDocs::where('application_id',Cache::get('application_id'))->where('user_id', '!=',null)->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('status', '@if($status == 0) Rejected @elseif($status == 1) Accepted @elseif($status == null)  @endif')
            ->make(true);
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
        $application = new Application();
        $application->user_id = auth()->user()->id;
        $application->save();
        $data = Application::query()->latest('id')->first();
        return redirect()->route('site.applications.edit',$data->id);
    }
    public function edit(Application $application)
    {
        return $this->service->edit($application);
    }
    public function update(Application $application, ApplicationRequest $request){
        $data = $request->validated();
        if (isset($data['performer_user_id']))
        {
            $mytime = Carbon::now();
            $data['performer_received_date'] = $mytime->toDateTimeString();
            $data['status'] = 'distributed';
            $data['performer_head_of_dep_user_id'] = auth()->user()->id;
        }
        if(isset($data['currency']))
        {
            if ( $data['currency'] == 'USD' && $data['planned_price'] >= 25000)
            {
                $data['is_more_than_limit'] = 1;
            }else
                $data['is_more_than_limit'] = 0;
        }
        if ($application->is_more_than_limit != 1)
            $roles = PermissionRole::where('permission_id',168)->pluck('role_id')->toArray();
        else
            $roles = PermissionRole::where('permission_id',165)->pluck('role_id')->toArray();

        if (isset($data['signers']))
        {
            $array = array_merge($roles,$data['signers']);
            $data['signers'] = json_encode($array);
            for($i = 0; $i < count($array);$i++)
            {
                $docs = new SignedDocs();
                $docs->role_id = $array[$i];
                $docs->application_id = $application->id;
                $docs->table_name = "applications";
                $docs->save();
            }
            $this->service->sendNotifications($array, $application);
        }

        $result = $application->update($data);
        if ($application->signers == null)
            return redirect()->route('site.applications.signers', $application->id);
        if ($result)
            return redirect()->route('site.applications.index')->with('success', trans('site.application_success'));

        return redirect()->back()->with('danger', trans('site.application_failed'));
    }
    public function signers(Application $application)
    {
        $company_signer = PermissionRole::where('permission_id',166)->select('role_id')->get();
        $branch_signer = PermissionRole::where('permission_id',167)->select('role_id')->get();
        return view('site.applications.signers', [
            'application' => $application,
            'company_signers' => Roles::find($company_signer)->pluck('display_name','id'),
            'branch_signers' => Roles::find($branch_signer)->pluck('display_name','id'),
        ]);
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
