<?php

namespace App\Http\Controllers\Site;

use App\DataTables\DraftDataTable;
use Illuminate\Support\Facades\Schema;
use App\Http\Requests\ApplicationRequest;
use App\Http\Requests\VoteApplicationRequest;
use App\Jobs\CreateApplicationJob;
use App\Jobs\UpdateApplicationJob;
use App\Jobs\VoteJob;
use App\Models\Application;
use App\Models\Branch;
use App\Models\Country;
use App\Models\Draft;
use App\Models\Notification;
use App\Models\PermissionRole;
use App\Models\Purchase;
use App\Models\Resource;
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

    public function show_status($status)
    {
        Cache::put('status', $status);
        return view('site.applications.status');
    }

    public function status_table()
    {
        $data = Application::where('status', Cache::get('status'))->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('user_id', function($docs) {
                return $docs->user ? $docs->user->name:"";
            })
            ->editColumn('role_id', function($docs) {
                return $docs->role ? $docs->role->display_name:"";
            })
            ->editColumn('created_at', function ($data) {
                return $data->created_at ? with(new Carbon($data->created_at))->format('m/d/Y') : '';
            })
            ->editColumn('updated_at', function ($data) {
                return $data->updated_at ? with(new Carbon($data->updated_at))->format('Y/m/d') : '';
            })
            ->addColumn('action', function($row){
                $edit = route('site.applications.edit', $row->id);
                $show = route('site.applications.show', $row->id);
                $destroy = route('site.applications.destroy', $row->id);
                $app_edit = __('lang.edit');
                $app_show= __('lang.show');;
                $app_clone= __('lang.clone');;
                $app_delete= __('lang.delete');;
                if($row->status == 'accepted' || $row->status =='refused')
                {
                    $clone = route('site.applications.clone', $row->id);
                }else{
                    $clone = '#';
                }
                return "<div class='row'>
                        <a href='{$edit}' class='m-1 col edit btn btn-success btn-sm'> $app_edit </a>
                        <a href='{$show}' class='m-1 col show btn btn-warning btn-sm'> $app_show </a>
                        <a href='{$clone}' class='m-1 col show btn btn-primary btn-sm'> $app_clone </a>
                        <a href='{$destroy}' class='m-1 col show btn btn-danger btn-sm'> $app_delete </a></div>";
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Application::query()
                ->where('draft', null)
                ->orWhere('draft','==', 0)
                ->latest('id')
                ->get();
            $user = auth()->user();

        if($user->role_id == 7)
            {
            $query = Application::query()->where('status', "accepted");
        }
        elseif ($user->hasPermission('Company_Signer') || $user->hasPermission('Add_Company_Signer')||$user->hasPermission('Branch_Signer') || $user->hasPermission('Add_Branch_Signer'))
            {
            $query = Application::query()->where('signers','like',"%{$user->role_id}%")->orWhere('performer_role_id', $user->role->id);
        }
        elseif ($user->hasPermission('Company_Performer') || $user->hasPermission('Branch_Performer'))
            {
                $query = $query->where('performer_role_id', $user->role->id);
            }
            elseif($user->hasPermission('Company_Leader'))
            {
                $query = $query->where('status','agreed');
            }
            elseif($user->hasPermission('Branch_Leader'))
            {
                $query = $query->where('status', 'accepted');
            }

            else {
                $query = $query->where('user_id',$user->id);
            }

            return Datatables::of($query)
                ->editColumn('created_at', function ($query) {
                    return $query->created_at ? with(new Carbon($query->created_at))->format('m/d/Y') : '';
                })
                ->editColumn('updated_at', function ($query) {
                    return $query->updated_at ? with(new Carbon($query->updated_at))->format('Y/m/d') : '';;
                })
                ->editColumn('status', function ($query){
                    $status_new = __('lang.status_new');
                    $status_in_process = __('lang.status_in_process');
                    $status_accepted = __('lang.status_accepted');
                    $status_refused = __('lang.status_refused');
                    $status_agreed = __('lang.status_agreed');
                    $status_rejected = __('lang.status_rejected');
                    $status_distributed = __('lang.status_distributed');
                    $status_cancelled = __('lang.status_cancelled');
                    $status_performed = __('lang.performed');
                    if($query->status === 'new'){
                        return $status_new;
                    }elseif($query->status === 'in_process'){
                        return $status_in_process;
                    }elseif($query->status === 'accepted'){
                        return $status_accepted;
                    }elseif($query->status === 'refused'){
                        return $status_refused;
                    }elseif($query->status === 'agreed'){
                        return $status_agreed;
                    }elseif($query->status === 'rejected'){
                        return $status_rejected;
                    }elseif($query->status === 'distributed'){
                        return $status_distributed;
                    }elseif($query->status === 'canceled'){
                        return $status_cancelled;
                    }elseif($query->status === 'performed'){
                        return $status_performed;
                    }else{
                        return $query->status;
                    }
                })
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $edit_e = route('site.applications.edit', $row->id);
                    $clone_e = route('site.applications.clone', $row->id);
                    $show_e = route('site.applications.show', $row->id);
                    $destroy_e = route('site.applications.destroy', $row->id);
                    $app_edit = __('lang.edit');
                    $app_show= __('lang.show');;
                    $app_clone= __('lang.clone');;
                    $app_delete= __('lang.delete');;

                    if($row->user_id == auth()->user()->id||auth()->user()->hasPermission('Branch_Performer')||auth()->user()->hasPermission('Company_Performer')||auth()->user()->hasPermission('Plan_Budget')||auth()->user()->hasPermission('Plan_Business')||auth()->user()->hasPermission('Number_Change'))
                    {
                        $edit = "<a href='{$edit_e}' class='m-1 col edit btn btn-success btn-sm'>$app_edit</a>";
                    }else{
                        $edit = "";
                    }
                    $show = "<a href='{$show_e}' class='m-1 col show btn btn-warning btn-sm'>$app_show</a>";
                    if($row->user_id == auth()->user()->id)
                    {
                        $destroy = "<a href='{$destroy_e}' class='m-1 col show btn btn-danger btn-sm'>$app_delete</a>";
                    }else{
                        $destroy = "";
                    }
                    if($row->user_id == auth()->user()->id && $row->status == 'cancelled' || $row->user_id == auth()->user()->id && $row->status == 'refused')
                    {
                        $clone = "<a href='{$clone_e}' class='m-1 col show btn btn-primary btn-sm'>$app_clone</a>";
                    }else{
                        $clone = "";
                    }

                    return "<div class='row'>
                        {$edit}
                        {$show}
                        {$clone}
                        {$destroy}
                        </div>";
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('site.applications.index');
    }

    public function clone($id){
        $clone = Application::find($id);
        $application = $clone->replicate();
        $application->signers = null;
        $application->status = null;
        $application->save();
        return redirect()->back();
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
        $data = SignedDocs::where('application_id',Cache::get('application_id'))->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('user_id', function($docs) {
                return $docs->user ? $docs->user->name:"";
            })
            ->editColumn('role_id', function($docs) {
                return $docs->role ? $docs->role->display_name:"";
            })
            ->editColumn('status', function ($status){
                $status_agreed = __('lang.status_agreed');
                $status_refused = __('lang.status_refused');
                $status_not_signed = __('lang.status_not_signed');
                if($status == "1"){
                    return $status_agreed;
                }elseif($status == "0"){
                    return $status_refused;
                }else{
                    return $status_not_signed;
                }
            })
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
        $latest = Application::latest('id')->first();
        $application = new Application();
        $application->user_id = auth()->user()->id;
        $application->save();
        $data = Application::query()->latest('id')->first();
        return redirect()->route('site.applications.edit',$data->id)->with('Alert','adasdas');
    }

    public function edit(Application $application)
    {
        return $this->service->edit($application);
    }

    public function update(Application $application, ApplicationRequest $request)
    {
        $data = $request->validated();
        if(isset($data['performer_leader_user_id']))
        {
            $data['performer_leader_date'] = Carbon::now()->toDateTimeString();
        }
        if(isset($data['resource_id']) && $data['resource_id'] != "[object Object]")
        {
            $explode = explode(',',$data['resource_id']);
            $id = [];
            for ($i = 0; $i < count($explode); $i++)
            {
                $all = Resource::where('name','like',"%{$explode[$i]}%")->first();
                $id[] = $all->id;
                $data['resource_id'] = json_encode($id);
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
        if ($result)
            return redirect()->route('site.applications.index')->with('success', trans('site.application_success'));

        return redirect()->back()->with('danger', trans('site.application_failed'));
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

    public function show_draft(Request $request)
    {
        if ($request->ajax()) {
            $user = auth()->user();
            $data = Application::query()
                ->where('user_id', $user->id)
                ->where('draft', !null)
                ->latest('id')
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('created_at', function ($data) {
                    return $data->created_at ? with(new Carbon($data->created_at))->format('m/d/Y') : '';
                })
                ->editColumn('updated_at', function ($data) {
                    return $data->updated_at ? with(new Carbon($data->updated_at))->format('Y/m/d') : '';;
                })
                ->addColumn('action', function($row){
                    $edit = route('site.applications.edit', $row->id);
                    $show = route('site.applications.show', $row->id);
                    $destroy = route('site.applications.destroy', $row->id);
                    $app_edit = __('lang.edit');
                    $app_show = __('lang.show');;
                    $app_clone = __('lang.clone');;
                    $app_delete = __('lang.delete');;
                    if($row->status == 'accepted' || $row->status =='refused')
                    {
                        $clone = route('site.applications.clone', $row->id);
                    }else{
                        $clone = '#';
                    }

                    return "<div class='row'>
                        <a href='{$edit}' class='m-1 col edit btn btn-success btn-sm'>$app_edit</a>
                        <a href='{$show}' class='m-1 col show btn btn-warning btn-sm'>$app_show</a>
                        <a href='{$clone}' class='m-1 col show btn btn-primary btn-sm'>$app_clone</a>
                        <a href='{$destroy}' class='m-1 col show btn btn-danger btn-sm'>$app_delete</a></div>";
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('site.applications.draft');
    }

    /**
     * soft delete post
     *
     * @return void
     */
    public function destroy($application)
    {
        Application::find($application)->delete();

        return redirect()->back();
    }

    /**
     * restore specific post
     *
     * @return void
     */
    public function restore($id)
    {
//        Application::withTrashed()->find($id)->restore();
//
//        return redirect()->back();
    }

    /**
     * restore all post
     *
     * @return response()
     */
    public function restoreAll()
    {
//        Application::onlyTrashed()->restore();
//
//        return redirect()->back();
    }
}
