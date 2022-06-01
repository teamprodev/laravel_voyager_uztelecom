<?php


namespace App\Services;


use App\Events\Notify;
use App\Models\Application;
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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Models\Country;
use App\Models\Purchase;
use App\Models\Roles;
use App\Models\Subject;
use Illuminate\Support\Facades\Http;
use Yajra\DataTables\DataTables;

class ApplicationService
{
    public function index($request)
    {
        if ($request->ajax()) {
            $query = Application::query()
                ->where('draft', '!=',null)
                ->orWhere('draft','!=', 0)
                ->latest('id')
                ->get();
            $user = auth()->user();

            if($user->hasPermission('ЦУЗ'))
            {
                $a = 'branch_initiator_id';
                $operator = '!=';
                $b = null;
            }else{
                $a = 'branch_initiator_id';
                $operator = '=';
                $b = $user->branch_id;
            }
            if($user->hasPermission('Add_Company_Signer') && $user->hasPermission('Add_Branch_Signer'))
            {

                $query = Application::query()
                    ->where('draft','!=',1)->where($a,$operator,$b)->where('signers','like',"%{$user->role_id}%")->orWhere('performer_role_id', $user->role->id)->where('draft','!=',1)->orWhere('user_id',auth()->user()->id)->where('draft','!=',1)->get();
            }
            elseif($user->hasPermission('Warehouse'))
            {
                $status = 'товар доставлен';
                $query = Application::query()->where('draft','!=',1)->where('status','like',"%{$status}%")->orWhere('user_id',auth()->user()->id)->get();
            }
            elseif($user->hasPermission('Company_Leader') && $user->hasPermission('Branch_Leader'))
            {
                $query = Application::query()->where('draft','!=',1)->orWhere('user_id',auth()->user()->id)->where('draft','!=',1)->get();
            }
            elseif($user->role_id == 7)
            {
                $query = Application::query()->where($a,$operator,$b)->where('draft','!=',1)->where('status','new')->orWhere('draft','!=',1)->where('status','accepted')->get();
            }
            elseif ($user->hasPermission('Company_Signer') || $user->hasPermission('Add_Company_Signer')||$user->hasPermission('Branch_Signer') || $user->hasPermission('Add_Branch_Signer'))
            {
                $query = Application::query()
                    ->where('draft','!=',1)
                    ->where($a,$operator,$b)
                    ->where('signers','like',"%{$user->role_id}%")
                    ->orWhere('performer_role_id', $user->role->id)
                    ->where('draft','!=',1)
                    ->orWhere('user_id',auth()->user()->id)
                    ->where('draft','!=',1)->get();
            }
            elseif ($user->hasPermission('Company_Performer') || $user->hasPermission('Branch_Performer'))
            {
                $query = Application::query()->where('draft','!=',1)->where('performer_role_id', $user->role->id)->orWhere('user_id',auth()->user()->id)->where('draft','!=',1)->get();
            }
            elseif($user->hasPermission('Company_Leader'))
            {
                $query =  Application::query()->where('draft','!=',1)->where('status','agreed')->orWhere('status','distributed')->where('draft','!=',1)->orWhere('user_id',auth()->user()->id)->where('draft','!=',1)->get();
            }
            elseif($user->hasPermission('Branch_Leader'))
            {
                $query = Application::query()->where('draft','!=',1)->where('is_more_than_limit', 0)->where('status', 'accepted')->orWhere('is_more_than_limit', 0)->where('draft','!=',1)->where('status', 'distributed')->orWhere('user_id',auth()->user()->id)->where('draft','!=',1)->get();
            }

            else {
                $query = Application::query()->where('draft','!=',1)->get();
            }

            return Datatables::of($query)
                ->editColumn('created_at', function ($query) {
                    return $query->created_at ? with(new Carbon($query->created_at))->format('d/m/Y') : '';
                })
                ->editColumn('updated_at', function ($query) {
                    return $query->updated_at ? with(new Carbon($query->updated_at))->format('d/m/Y') : '';
                })
                ->editColumn('date', function ($query) {
                    return $query->updated_at ? with(new Carbon($query->date))->format('d/m/Y') : '';
                })
                ->editColumn('delivery_date', function ($query) {
                    return $query->updated_at ? with(new Carbon($query->delivery_date))->format('d/m/Y') : '';
                })
                ->editColumn('status', function ($query){
                    $status_new = __('Новая');
                    $status_in_process = __('На рассмотрении');
                    $status_accepted = __('Принята');
                    $status_refused = __('Отказана');
                    $status_agreed = __('Согласована');
                    $status_rejected = __('Отклонена');
                    $status_distributed = __('Распределен');
                    $status_cancelled = __('Отменен');
                    $status_performed = __('Товар доставлен');
                    $status_overdue = ('просрочен');
                    if($query->status === 'new'){
                        return $status_new;
                    }elseif($query->status === 'in_process'){
                        return $status_in_process;
                    }elseif($query->status === 'overdue'||$query->status === 'Overdue'){
                        return "<input value='{$status_overdue}' type='button' class='text-center m-1 col edit bg-danger btn-sm' disabled>";
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
                    }elseif($query->status === 'товар доставлен'){
                        return "<div class='row'>
                        <input type='text' type='button' value='{$status_performed}' class='text-center display wrap edit bg-success btn-sm' disabled>
                        </div>";
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
                    $app_edit = __('Изменить');
                    $app_show= __('Показать');;
                    $app_clone= __('Копировать');;
                    $app_delete= __('Удалить');;

                    if(auth()->user()->hasPermission('Warehouse')||auth()->user()->hasPermission('Company_Performer')||auth()->user()->hasPermission('Branch_Performer'))
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
                    if($row->user_id == auth()->user()->id && $row->status == 'cancelled' || $row->user_id == auth()->user()->id && $row->status == 'refused'||$row->user_id == auth()->user()->id && $row->status == 'rejected')
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
                ->rawColumns(['action','status'])
                ->make(true);
        }
        return view('site.applications.index');
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
            ->editColumn('status', function ($query){
                $status_new = __('Новая');
                $status_in_process = __('На рассмотрении');
                $status_accepted = __('Принята');
                $status_refused = __('Отказана');
                $status_agreed = __('Согласована');
                $status_rejected = __('Отклонена');
                $status_distributed = __('Распределен');
                $status_cancelled = __('Отменен');
                $status_performed = __('Товар доставлен');
                $status_overdue = ('просрочен');

                if($query->status === 'new'){
                    return $status_new;
                }elseif($query->status === 'in_process'){
                    return $status_in_process;
                }elseif($query->status === 'Overdue'){
                    return "<input value='{$status_overdue}' type='button' class='text-center m-1 col edit bg-danger btn-sm' disabled>";
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
                }elseif($query->status === 'товар доставлен') {
                    return "<div class='row'>
                        <input type='text' type='button' value='{$status_performed}' class='text-center m-1 col edit bg-success btn-sm' disabled>
                        </div>";
                }else{
                    return $query->status;
                }
            })
            ->addColumn('action', function($row){
                $edit_e = route('site.applications.edit', $row->id);
                $clone_e = route('site.applications.clone', $row->id);
                $show_e = route('site.applications.show', $row->id);
                $destroy_e = route('site.applications.destroy', $row->id);
                $app_edit = __('Изменить');
                $app_show= __('Показать');;
                $app_clone= __('Копировать');;
                $app_delete= __('Удалить');;

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
            ->rawColumns(['action','status'])
            ->make(true);
    }
    public function clone($id)
    {
        $clone = Application::find($id);
        $application = $clone->replicate();
        $application->signers = null;
        $application->status = null;
        $application->save();
        return redirect()->back();
    }
    public function SignedDocs($application)
    {
        $data = SignedDocs::where('application_id',$application)->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('user_id', function($docs) {
                return $docs->user ? $docs->user->name:"";
            })
            ->editColumn('role_id', function($docs) {
                return $docs->role ? $docs->role->display_name:"";
            })
            ->editColumn('updated_at', function ($query) {
                return $query->updated_at ? with(new Carbon($query->updated_at))->format('Y/m/d') : '';;
            })
            ->editColumn('status', function ($status){
                $status_agreed = __('Согласована');
                $status_rejected = __('Отклонена');
                $status_not_signed = __('Не подписан');
                if($status->status == "1"){
                    return $status_agreed;
                }elseif($status->status == "0"){
                    return $status_refused;
                }else{
                    return $status_not_signed;
                }
            })
            ->make(true);
    }
    public function create()
    {
        $latest = Application::latest('id')->first();
        $application = new Application();
        $application->user_id = auth()->user()->id;
        $application->status = Application::NEW;
        $application->save();
        $data = Application::query()->latest('id')->first();
        return redirect()->route('site.applications.edit',$data->id);
    }
    public function show_draft($request)
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
                    $app_edit = __('Изменить');
                    $app_show= __('Показать');;
                    $app_clone= __('Копировать');;
                    $app_delete= __('Удалить');;
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
    public function uploadImage($request,$application)
    {
        $file_basis = json_decode($application->file_basis);
        $file_tech_spec = json_decode($application->file_tech_spec);
        $other_files = json_decode($application->other_files);
        $performer_file = json_decode($application->performer_file);
        if ($request->hasFile('file_basis')) {
            $fileName = time() . '_' .$request->file_basis->getClientOriginalName();
            $filePath = $request->file('file_basis')
                ->move(public_path("storage/uploads/"), $fileName);

            $file_basis[] = $fileName;
        }
        if ($request->hasFile('file_tech_spec')) {
            $fileName = time() . '_' .$request->file_tech_spec->getClientOriginalName();
            $filePath = $request->file('file_tech_spec')
                ->move(public_path("storage/uploads/"), $fileName);

            $file_tech_spec[] = $fileName;
        }
        if ($request->hasFile('other_files')) {
            $fileName = time() . '_' .$request->other_files->getClientOriginalName();
            $filePath = $request->file('other_files')
                ->move(public_path("storage/uploads/"), $fileName);

            $other_files[] = $fileName;
        }
        if ($request->hasFile('performer_file')) {
            $fileName = time() . '_' .$request->performer_file->getClientOriginalName();
            $filePath = $request->file('performer_file')
                ->move(public_path("storage/uploads/"), $fileName);

            $performer_file[] = $fileName;
        }

        $application->file_basis = json_encode($file_basis);
        $application->performer_file = json_encode($performer_file);
        $application->file_tech_spec = json_encode($file_tech_spec);
        $application->other_files = json_encode($other_files);
        $application->update();
    }
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
        $status_extented = StatusExtented::all()->pluck('name','name')->toArray();
        if($application->status != 'draft' && $application->status != 'new' && $application->status != 'distributed' && in_array($application->status,$status_extented) == false)
            return redirect()->route('site.applications.index');
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
            'status_extented' => $status_extented,
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
        {
            if($data['draft'] == 1)
                $data['status'] = 'draft';
        }
        if($application->performer_status != null)
        {
            $application->performer_user_id = auth()->user()->id;
            $application->status = $data['performer_status'];
        }
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
                $application->status = 'new';
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
            if($application->signers != null)
            {
                $signers = json_decode($application->signers);
                $signedDocs = SignedDocs::where('application_id',$application->id)->pluck('role_id')->toArray();
                $not_signer = array_diff($signedDocs,$signers);
                foreach($not_signer as $delete)
                {
                    SignedDocs::where('application_id',$application->id)->where('role_id',$delete)->delete();
                }
            }
            $application->status = 'new';
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
