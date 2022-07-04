<?php


namespace App\Services;


use App\Models\Application;
use App\Models\Branch;
use App\Models\Notification;
use App\Models\PermissionRole;
use App\Models\Position;
use App\Models\Resource;
use App\Models\SignedDocs;
use App\Models\StatusExtented;
use App\Models\User;
use App\Models\Warehouse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use App\Models\Country;
use App\Models\Purchase;
use App\Models\Roles;
use App\Models\Subject;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Yajra\DataTables\DataTables;

class ApplicationService
{
    public function index($request)
    {
        $filial = PermissionRole::where('permission_id',167)->pluck('role_id')->toArray();
        $company = PermissionRole::where('permission_id',167)->pluck('role_id')->toArray();
        foreach ($filial as $b)
        {
            $a = PermissionRole::where('permission_id',168)->where('role_id',$b)->pluck('role_id')->toArray();
            PermissionRole::where('permission_id',168)->where('role_id',$a)->delete();
        }
        foreach ($company as $b)
        {
            $a = PermissionRole::where('permission_id',165)->where('role_id',$b)->pluck('role_id')->toArray();
            PermissionRole::where('permission_id',165)->where('role_id',$a)->delete();
        }
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
                $b = [9,13];
            }else{
                $a = 'branch_initiator_id';
                $b = [$user->branch_id];

                $c = 'department_initiator_id';
                $d = [$user->department_id];
            }

            if($user->hasPermission('Add_Company_Signer') && $user->hasPermission('Add_Branch_Signer'))
            {

                $query = Application::query()
                    ->where('draft','!=',1)->whereIn($a,$b)->orWhere('signers','like',"%{$user->role_id}%")->orWhere('performer_role_id', $user->role->id)->where('draft','!=',1)->orWhere('user_id',auth()->user()->id)->where('draft','!=',1)->get();
            }
            elseif($user->hasPermission('Warehouse'))
            {
                $status_0 = 'Принята';
                $status_1 = 'товар';
                $query = Application::query()->where('draft','!=',1)->whereIn($a,$b)->where('status','like',"%{$status_0}%")->OrwhereIn($a,$b)->where('status','like',"%{$status_1}%")->orWhere('user_id',auth()->user()->id)->get();
            }
            elseif($user->hasPermission('Company_Leader') && $user->hasPermission('Branch_Leader'))
            {
                $query = Application::query()->whereIn($a,$b)->where('draft','!=',1)->orWhere('user_id',auth()->user()->id)->where('draft','!=',1)->get();
            }
            elseif($user->role_id == 7)
            {
                $query = Application::query()->whereIn($a,$b)->where('draft','!=',1)->where('signers','LIKE','%7%')->get();
            }
            elseif ($user->hasPermission('Company_Signer') || $user->hasPermission('Add_Company_Signer')||$user->hasPermission('Branch_Signer') || $user->hasPermission('Add_Branch_Signer'))
            {
                $query = Application::query()
                    ->where('draft','!=',1)
                    ->where('signers','like',"%{$user->role_id}%")
                    ->orWhere('performer_role_id', $user->role->id)
                    ->where('draft','!=',1)
                    ->orWhere('user_id',auth()->user()->id)
                    ->where('draft','!=',1)->get();
            }
            elseif($user->hasPermission('Company_Leader'))
            {
                $query =  Application::query()->whereIn($a,$b)->where('draft','!=',1)->where('status','agreed')->orWhere('status','distributed')->whereIn($a,$b)->where('draft','!=',1)->orWhere('user_id',auth()->user()->id)->where('draft','!=',1)->get();
            }
            elseif($user->hasPermission('Branch_Leader'))
            {
                $query = Application::query()->whereIn($a,$b)->where('draft','!=',1)->where('is_more_than_limit', 0)->where('show_leader',1)->orWhere('is_more_than_limit', 0)->whereIn($a,$b)->where('status', 'new')->orWhere('is_more_than_limit', 0)->where('draft','!=',1)->whereIn($a,$b)->where('status', 'distributed')->orWhere('user_id',auth()->user()->id)->where('draft','!=',1)->get();
            }
            elseif($user->hasPermission('Company_Performer')||$user->hasPermission('Branch_Performer'))
            {
                $query = Application::query()->where('performer_role_id',auth()->user()->role_id)->orWhere('user_id',auth()->user()->id)->where('draft','!=',1)->get();
            }
            else {
                $query = Application::query()->whereIn($a,$b)->where('draft','!=',1)->get();
            }

            return Datatables::of($query)
                ->editColumn('created_at', function ($query) {
                    return $query->created_at ? with(new Carbon($query->created_at))->format('d.m.Y') : '';
                })
                ->editColumn('branch_initiator_id', function ($query) {
                    return $query->branch->name;
                })
                ->editColumn('planned_price', function ($query) {
                    return $query->planned_price ? number_format($query->planned_price , 0 , '' , ' '): '' ;
                })
                ->editColumn('updated_at', function ($query) {
                    return $query->updated_at ? with(new Carbon($query->updated_at))->format('d.m.Y') : '';
                })
                ->editColumn('date', function ($query) {
                    return $query->date ? with(new Carbon($query->date))->format('d.m.Y') : '';
                })
                ->editColumn('delivery_date', function ($query) {
                    return $query->updated_at ? with(new Carbon($query->delivery_date))->format('d.m.Y') : '';
                })
                ->editColumn('status', function ($query){
                    $query = $query->status;
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
                    if($query === 'new'){
                        $status = setting('color.new');
                        $color = $status ? 'white':'black';
                        return "<input style='background-color: {$status};color: {$color};' value='{$status_new}' type='button' class='text-center m-1 col edit btn-sm' disabled>";
                    }elseif($query === 'in_process'){
                        $status = setting('color.in_process');
                        $color = $status ? 'white':'black';
                        return "<input style='background-color: {$status};color: {$color};' value='{$status_in_process}' type='button' class='text-center m-1 col edit btn-sm' disabled>";
                    }elseif($query === 'overdue'||$query === 'Overdue'){
                        $status = setting('color.overdue');
                        $color = $status ? 'white':'black';
                        return "<input style='background-color: {$status};color: {$color};' value='{$status_overdue}' type='button' class='text-center m-1 col edit btn-sm' disabled>";
                    }elseif($query === 'Принята'){
                        $status = setting('color.accepted');
                        $color = $status ? 'white':'black';
                        return "<input style='background-color: {$status};color: {$color};' value='{$status_accepted}' type='button' class='text-center m-1 col edit btn-sm' disabled>";
                    }elseif($query === 'refused'){
                        $status = setting('color.rejected');
                        $color = $status ? 'white':'black';
                        return "<input style='background-color: {$status};color: {$color};' value='{$status_refused}' type='button' class='text-center m-1 col edit btn-sm' disabled>";
                    }elseif($query === 'agreed'){
                        $status = setting('color.agreed');
                        $color = $status ? 'white':'black';
                        return "<input style='background-color: {$status};color: {$color};' value='{$status_agreed}' type='button' class='text-center m-1 col edit btn-sm' disabled>";
                    }elseif($query === 'rejected'){
                        $status = setting('color.rejected');
                        $color = $status ? 'white':'black';
                        return "<input style='background-color: {$status};color: {$color};' value='{$status_rejected}' type='button' class='text-center m-1 col edit btn-sm' disabled>";
                    }elseif($query === 'distributed'){
                        $status = setting('color.distributed');
                        $color = $status ? 'white':'black';
                        return "<input style='background-color: {$status};color: {$color};' value='{$status_distributed}' type='button' class='text-center m-1 col edit btn-sm' disabled>";
                    }elseif($query === 'canceled'){
                        $status = setting('color.rejected');
                        $color = $status ? 'white':'black';
                        return "<input style='background-color: {$status};color: {$color};' value='{$status_cancelled}' type='button' class='text-center m-1 col edit btn-sm' disabled>";
                    }elseif($query === 'Выполнено частично'){
                        $status = setting('color.partially');
                        $color = $status ? 'white':'black';
                        return "<input style='background-color: {$status};color: {$color};' value='Выполнено частично' type='button' class='text-center m-1 col edit btn-sm' disabled>";
                    }elseif($query === 'Выполнено в полном объёме'){
                        $status = setting('color.total_volume');
                        $color = $status ? 'white':'black';
                        return "<input style='background-color: {$status};color: {$color};' value='Выполнено в полном объёме' type='button' class='text-center m-1 col edit btn-sm' disabled>";
                    }elseif($query === 'Заявка аннулирована по заданию руководства'){
                        $status = setting('color.nulled_by_management');
                        $color = $status ? 'white':'black';
                        return "<input style='background-color: {$status};color: {$color};' value='Заявка аннулирована по заданию руководства' type='button' class='text-center m-1 col edit btn-sm' disabled>";
                    }elseif($query === 'Договор аннулирован по инициативе Узбектелеком'){
                        $status = setting('color.nulled_by_management');
                        $color = $status ? 'white':'black';
                        return "<input style='background-color: {$status};color: {$color};' value='Договор аннулирован по инициативе Узбектелеком' type='button' class='text-center m-1 col edit btn-sm' disabled>";
                    }elseif($query === 'заявка передана в Узтелеком'){
                        $status = setting('color.nulled_by_management');
                        $color = $status ? 'white':'black';
                        return "<input style='background-color: {$status};color: {$color};' value='заявка передана в Узтелеком' type='button' class='text-center m-1 col edit btn-sm' disabled>";
                    }elseif($query === 'товар доставлен'){
                        $status = setting('color.delivered');
                        $color = $status ? 'white':'black';
                        return "<div class='row'>
                        <input style='background-color: {$status};color: {$color};' type='text' type='button' value='{$status_performed}' class='text-center display wrap edit btn-sm' disabled>
                        </div>";
                    }else{
                        return $query;
                    }
                })
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $edit_e = route('site.applications.edit', $row->id);
                    $clone_e = route('site.applications.clone', $row->id);
                    $show_e = route('site.applications.show', $row->id);
                    $destroy_e = route('site.applications.destroy', $row->id);
                    $app_edit = __('Изменить');
                    $app_show= __('Показать');
                    $app_clone= __('Копировать');
                    $app_delete= __('Удалить');

                    if(auth()->user()->id == $row->user_id||auth()->user()->hasPermission('Warehouse')||$row->performer_role_id==auth()->user()->role_id)
                    {
                        $bgcolor = setting('color.edit');
                        $color = $bgcolor ? 'white':'black';
                        $edit = "<a href='{$edit_e}' class='m-1 col edit btn btn-outline-danger editbtn'>$app_edit</a>";
                    }else{
                        $edit = "";
                    }
                    $bgcolor = setting('color.show');
                    $color = $bgcolor ? 'white':'black';
                    $show = "<a href='{$show_e}' class='m-1 col show btn btn-outline-danger showbtn'>$app_show</a>";
                    if($row->user_id == auth()->user()->id)
                    {
                        $bgcolor = setting('color.delete');
                        $color = $bgcolor ? 'white':'black';
                        $destroy = "<a href='{$destroy_e}' class='m-1 col show btn btn-outline-danger deletebtn'>$app_delete</a>";
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
    public function performer_color($query)
    {
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
        if($query === 'new'){
            $status = setting('color.new');
            $color = $status ? 'white':'black';
            return "<input style='background-color: {$status};color: {$color};' value='{$status_new}' type='button' class='text-center m-1 col edit btn-sm' disabled>";
        }elseif($query === 'in_process'){
            $status = setting('color.in_process');
            $color = $status ? 'white':'black';
            return "<input style='background-color: {$status};color: {$color};' value='{$status_in_process}' type='button' class='text-center m-1 col edit btn-sm' disabled>";
        }elseif($query === 'overdue'||$query === 'Overdue'){
            $status = setting('color.overdue');
            $color = $status ? 'white':'black';
            return "<input style='background-color: {$status};color: {$color};' value='{$status_overdue}' type='button' class='text-center m-1 col edit btn-sm' disabled>";
        }elseif($query === 'Принята'){
            $status = setting('color.accepted');
            $color = $status ? 'white':'black';
            return "<input style='background-color: {$status};color: {$color};' value='{$status_accepted}' type='button' class='text-center m-1 col edit btn-sm' disabled>";
        }elseif($query === 'refused'){
            $status = setting('color.rejected');
            $color = $status ? 'white':'black';
            return "<input style='background-color: {$status};color: {$color};' value='{$status_refused}' type='button' class='text-center m-1 col edit btn-sm' disabled>";
        }elseif($query === 'agreed'){
            $status = setting('color.agreed');
            $color = $status ? 'white':'black';
            return "<input style='background-color: {$status};color: {$color};' value='{$status_agreed}' type='button' class='text-center m-1 col edit btn-sm' disabled>";
        }elseif($query === 'rejected'){
            $status = setting('color.rejected');
            $color = $status ? 'white':'black';
            return "<input style='background-color: {$status};color: {$color};' value='{$status_rejected}' type='button' class='text-center m-1 col edit btn-sm' disabled>";
        }elseif($query === 'distributed'){
            $status = setting('color.distributed');
            $color = $status ? 'white':'black';
            return "<input style='background-color: {$status};color: {$color};' value='{$status_distributed}' type='button' class='text-center m-1 col edit btn-sm' disabled>";
        }elseif($query === 'canceled'){
            $status = setting('color.rejected');
            $color = $status ? 'white':'black';
            return "<input style='background-color: {$status};color: {$color};' value='{$status_cancelled}' type='button' class='text-center m-1 col edit btn-sm' disabled>";
        }elseif($query === 'товар доставлен'){
            $status = setting('color.delivered');
            $color = $status ? 'white':'black';
            return "<div class='row'>
                        <input style='background-color: {$status};color: {$color};' type='text' type='button' value='{$status_performed}' class='text-center display wrap edit btn-sm' disabled>
                        </div>";
        }else{
            return $query;
        }
    }
    public function status_table()
    {
        if(auth()->user()->hasPermission('ЦУЗ'))
        {
            $a = 'branch_initiator_id';
            $b = [9,13];
        }else{
            $a = 'branch_initiator_id';
            $b = [auth()->user()->branch_id];
        }
        $data = Application::whereIn($a,$b)->where('status', Cache::get('status'))->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('user_id', function($docs) {
                return $docs->user ? $docs->user->name:"";
            })
            ->editColumn('role_id', function($docs) {
                return $docs->role ? $docs->role->display_name:"";
            })
            ->editColumn('created_at', function ($data) {
                return $data->created_at ? with(new Carbon($data->created_at))->format('d.m.Y') : '';
            })
            ->editColumn('updated_at', function ($data) {
                return $data->updated_at ? with(new Carbon($data->updated_at))->format('d.m.Y') : '';
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
                    $status = setting('color.new');
                    $color = $status ? 'white':'black';
                    return "<input style='background-color: {$status};color: {$color};' value='{$status_new}' type='button' class='text-center m-1 col edit btn-sm' disabled>";
                }elseif($query->status === 'in_process'){
                    $status = setting('color.in_process');
                    $color = $status ? 'white':'black';
                    return "<input style='background-color: {$status};color: {$color};' value='{$status_in_process}' type='button' class='text-center m-1 col edit btn-sm' disabled>";
                }elseif($query->status === 'overdue'||$query->status === 'Overdue'){
                    $status = setting('color.overdue');
                    $color = $status ? 'white':'black';
                    return "<input style='background-color: {$status};color: {$color};' value='{$status_overdue}' type='button' class='text-center m-1 col edit btn-sm' disabled>";
                }elseif($query->status === 'Принята'){
                    $status = setting('color.accepted');
                    $color = $status ? 'white':'black';
                    return "<input style='background-color: {$status};color: {$color};' value='{$status_accepted}' type='button' class='text-center m-1 col edit btn-sm' disabled>";
                }elseif($query->status === 'refused'){
                    $status = setting('color.rejected');
                    $color = $status ? 'white':'black';
                    return "<input style='background-color: {$status};color: {$color};' value='{$status_refused}' type='button' class='text-center m-1 col edit btn-sm' disabled>";
                }elseif($query->status === 'agreed'){
                    $status = setting('color.agreed');
                    $color = $status ? 'white':'black';
                    return "<input style='background-color: {$status};color: {$color};' value='{$status_agreed}' type='button' class='text-center m-1 col edit btn-sm' disabled>";
                }elseif($query->status === 'rejected'){
                    $status = setting('color.rejected');
                    $color = $status ? 'white':'black';
                    return "<input style='background-color: {$status};color: {$color};' value='{$status_rejected}' type='button' class='text-center m-1 col edit btn-sm' disabled>";
                }elseif($query->status === 'distributed'){
                    $status = setting('color.distributed');
                    $color = $status ? 'white':'black';
                    return "<input style='background-color: {$status};color: {$color};' value='{$status_distributed}' type='button' class='text-center m-1 col edit btn-sm' disabled>";
                }elseif($query->status === 'canceled'){
                    $status = setting('color.rejected');
                    $color = $status ? 'white':'black';
                    return "<input style='background-color: {$status};color: {$color};' value='{$status_cancelled}' type='button' class='text-center m-1 col edit btn-sm' disabled>";
                }elseif($query->status === 'товар доставлен'){
                    $status = setting('color.delivered');
                    $color = $status ? 'white':'black';
                    return "<div class='row'>
                        <input style='background-color: {$status};color: {$color};' type='text' type='button' value='{$status_performed}' class='text-center display wrap edit btn-sm' disabled>
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

                if(auth()->user()->id == $row->user_id||auth()->user()->hasPermission('Warehouse')||$row->performer_role_id==auth()->user()->role_id)
                {
                    $bgcolor = setting('color.edit');
                    $color = $bgcolor ? 'white':'black';
                    $edit = "<a style='background-color: {$bgcolor};color: {$color}' href='{$edit_e}' class='m-1 col edit btn btn-sm'>$app_edit</a>";
                }else{
                    $edit = "";
                }
                $bgcolor = setting('color.show');
                $color = $bgcolor ? 'white':'black';
                $show = "<a style='background-color: {$bgcolor};color: {$color}' href='{$show_e}' class='m-1 col show btn btn-sm'>$app_show</a>";
                if($row->user_id == auth()->user()->id)
                {
                    $bgcolor = setting('color.delete');
                    $color = $bgcolor ? 'white':'black';
                    $destroy = "<a style='background-color: {$bgcolor};color: {$color}' href='{$destroy_e}' class='m-1 col show btn btn-sm'>$app_delete</a>";
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
    public function performer_status()
    {
        if(auth()->user()->hasPermission('ЦУЗ'))
        {
            $a = 'branch_initiator_id';
            $b = [9,13];
        }else{
            $a = 'branch_initiator_id';
            $b = [auth()->user()->branch_id];
        }
        $status = Cache::get('performer_status_get');
        $data = Application::whereIn($a,$b)->where('status', 'LIKE',"%{$status}%")->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('user_id', function($docs) {
                return $docs->user ? $docs->user->name:"";
            })
            ->editColumn('role_id', function($docs) {
                return $docs->role ? $docs->role->display_name:"";
            })
            ->editColumn('created_at', function ($data) {
                return $data->created_at ? with(new Carbon($data->created_at))->format('d.m.Y') : '';
            })
            ->editColumn('updated_at', function ($data) {
                return $data->updated_at ? with(new Carbon($data->updated_at))->format('d.m.Y') : '';
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
                    $status = setting('color.new');
                    $color = $status ? 'white':'black';
                    return "<input style='background-color: {$status};color: {$color};' value='{$status_new}' type='button' class='text-center m-1 col edit btn-sm' disabled>";
                }elseif($query->status === 'in_process'){
                    $status = setting('color.in_process');
                    $color = $status ? 'white':'black';
                    return "<input style='background-color: {$status};color: {$color};' value='{$status_in_process}' type='button' class='text-center m-1 col edit btn-sm' disabled>";
                }elseif($query->status === 'overdue'||$query->status === 'Overdue'){
                    $status = setting('color.overdue');
                    $color = $status ? 'white':'black';
                    return "<input style='background-color: {$status};color: {$color};' value='{$status_overdue}' type='button' class='text-center m-1 col edit btn-sm' disabled>";
                }elseif($query->status === 'Принята'){
                    $status = setting('color.accepted');
                    $color = $status ? 'white':'black';
                    return "<input style='background-color: {$status};color: {$color};' value='{$status_accepted}' type='button' class='text-center m-1 col edit btn-sm' disabled>";
                }elseif($query->status === 'refused'){
                    $status = setting('color.rejected');
                    $color = $status ? 'white':'black';
                    return "<input style='background-color: {$status};color: {$color};' value='{$status_refused}' type='button' class='text-center m-1 col edit btn-sm' disabled>";
                }elseif($query->status === 'agreed'){
                    $status = setting('color.agreed');
                    $color = $status ? 'white':'black';
                    return "<input style='background-color: {$status};color: {$color};' value='{$status_agreed}' type='button' class='text-center m-1 col edit btn-sm' disabled>";
                }elseif($query->status === 'rejected'){
                    $status = setting('color.rejected');
                    $color = $status ? 'white':'black';
                    return "<input style='background-color: {$status};color: {$color};' value='{$status_rejected}' type='button' class='text-center m-1 col edit btn-sm' disabled>";
                }elseif($query->status === 'distributed'){
                    $status = setting('color.distributed');
                    $color = $status ? 'white':'black';
                    return "<input style='background-color: {$status};color: {$color};' value='{$status_distributed}' type='button' class='text-center m-1 col edit btn-sm' disabled>";
                }elseif($query->status === 'canceled'){
                    $status = setting('color.rejected');
                    $color = $status ? 'white':'black';
                    return "<input style='background-color: {$status};color: {$color};' value='{$status_cancelled}' type='button' class='text-center m-1 col edit btn-sm' disabled>";
                }elseif($query->status === 'товар доставлен'){
                    $status = setting('color.delivered');
                    $color = $status ? 'white':'black';
                    return "<div class='row'>
                        <input style='background-color: {$status};color: {$color};' type='text' type='button' value='{$status_performed}' class='text-center display wrap edit btn-sm' disabled>
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

                if(auth()->user()->id == $row->user_id||auth()->user()->hasPermission('Warehouse')||$row->performer_role_id==auth()->user()->role_id)
                {
                    $bgcolor = setting('color.edit');
                    $color = $bgcolor ? 'white':'black';
                    $edit = "<a style='background-color: {$bgcolor};color: {$color}' href='{$edit_e}' class='m-1 col edit btn btn-sm'>$app_edit</a>";
                }else{
                    $edit = "";
                }
                $bgcolor = setting('color.show');
                $color = $bgcolor ? 'white':'black';
                $show = "<a style='background-color: {$bgcolor};color: {$color}' href='{$show_e}' class='m-1 col show btn btn-sm'>$app_show</a>";
                if($row->user_id == auth()->user()->id)
                {
                    $bgcolor = setting('color.delete');
                    $color = $bgcolor ? 'white':'black';
                    $destroy = "<a style='background-color: {$bgcolor};color: {$color}' href='{$destroy_e}' class='m-1 col show btn btn-sm'>$app_delete</a>";
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
                return $query->updated_at ? with(new Carbon($query->updated_at))->format('d.m.Y') : '';;
            })
            ->editColumn('status', function ($status){
                $status_agreed = __('Согласована');
                $status_rejected = __('Отклонена');
                $status_not_signed = __('Не подписан');
                if($status->status == "1"){
                    return $status_agreed;
                }elseif($status->status == "0"){
                    return $status_rejected;
                }else{
                    return $status_not_signed;
                }
            })
            ->make(true);
    }
    public function create()
    {
        $user = auth()->user();
        $application = new Application();
        $application->user_id = $user->id;
        $application->branch_initiator_id = $user->branch_id;
        $application->department_initiator_id = $user->department_id;
        $application->status = Application::NEW;
        $application->save();
        return redirect()->route('site.applications.edit',$application->id);
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
                    return $data->created_at ? with(new Carbon($data->created_at))->format('d.m.Y') : '';
                })
                ->editColumn('updated_at', function ($data) {
                    return $data->updated_at ? with(new Carbon($data->updated_at))->format('d.m.Y') : '';
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
        $access = SignedDocs::where('role_id', auth()->user()->role_id)->where('status', null)->where('application_id', $application->id)->first();
        $branch = Branch::where('id', $application->branch_initiator_id)->first();
        $signedDocs = $application->signedDocs()->get();
        $file_basis = json_decode($application->file_basis);
        $file_tech_spec = json_decode($application->file_tech_spec);
        $other_files = json_decode($application->other_files);
        $performer_file = json_decode($application->performer_file);
        $same_role_user_ids = User::where('role_id', auth()->user()->role_id)->get()->pluck('id')->toArray();
        $id = DB::table('roles')->whereRaw('json_contains(branch_id, \'["'.$application->branch_initiator_id.'"]\')')->pluck('id')->toArray();
        foreach ($id as $role)
        {
            $company = PermissionRole::where('role_id',$role)->where('permission_id',170)->get()->pluck('role_id');
            $role_company[] = $company;
            $role_company = array_diff($role_company,['[]']);

            $branch = PermissionRole::where('role_id',$role)->where('permission_id',172)->get()->pluck('role_id');
            $role_branch[] = $branch;
            $role_branch = array_diff($role_branch,['[]']);
        }
        $performers_company = $id ? Roles::find($role_company)->pluck('display_name','id'):[];
        $performers_branch = $id ? Roles::find($role_branch)->pluck('display_name','id'):[];
        $user = auth()->user();
        $access_comment = Position::find($user->position_id);
        $subjects = Subject::all();
        $purchases = Purchase::all();
        $branch_name = Branch::find($application->user->branch_id, 'name');
        $branch = Branch::all()->pluck('name', 'id');
        return view('site.applications.show', compact('performer_file','branch','access_comment','performers_company','performers_branch','file_basis','file_tech_spec','other_files','user','application','branch','signedDocs', 'same_role_user_ids','access','subjects','purchases','branch_name'));

    }
    public function edit($application)
    {
        $status_extented = StatusExtented::all()->pluck('name','name')->toArray();
        if(auth()->user()->id != $application->user_id && !auth()->user()->hasPermission('Warehouse') && !auth()->user()->hasPermission('Company_Performer') && !auth()->user()->hasPermission('Branch_Performer'))
        {
            return redirect()->route('site.applications.index');
        }
        $countries = ['0' => 'Select country'];
        $countries[] = Country::get()->pluck('country_name','country_alpha3_code')->toArray();
        $products = Resource::get();
        $select = [];
        for($i=0;$i<count($products);$i++)
        {
            $select[] = $products[$i]->name;
        }
        $performer_file = json_decode($application->performer_file);
        $branch_signer = json_decode($application->branch->add_signers);
        $addsigner = Branch::find(9);
        $company_signer = json_decode($addsigner->add_signers);
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
            'company_signers' => $company_signer ? Roles::find($company_signer)->sortBy('index')->pluck('display_name','id')->toArray(): null,
            'branch_signers' => $branch_signer ? Roles::find($branch_signer)->sortBy('index')->pluck('display_name','id')->toArray(): null,
        ]);
    }
    public function update($application,$request)
    {
        $user = auth()->user();
        $now = Carbon::now();
        $data = $request->validated();
        if(auth()->id() == $application->user_id && $application->status == 'refused'||auth()->id() == $application->user_id && $application->status == 'rejected')
        {
            $data['status'] = Application::NEW;
            $signedDocs = SignedDocs::where('application_id',$application->id)->get();
            foreach($signedDocs as $doc)
            {

                $doc->status = null;
                $doc->save();
            }
        }
        if(isset($data['draft']))
        {
            if($data['draft'] == 1)
                $data['status'] = Application::DRAFT;
        }
        if(isset($data['performer_status']))
        {
            $application->performer_user_id = $user->id;
            $application->status = $data['performer_status'];
        }
        if(isset($data['performer_leader_comment']))
        {
            $data['performer_leader_comment_date'] = $now->toDateTimeString();
            $data['performer_leader_user_id'] = $user->id;
        }
        if(isset($data['performer_comment']))
        {
            $data['performer_comment_date'] = $now->toDateTimeString();
            $data['performer_user_id'] = $user->id;
        }
        if(isset($data['resource_id']))
        {
            $data['resource_id'] == "[object Object]" ? $data['resource_id'] = null:[];
            $explode = explode(',',$data['resource_id']);
            $id = [];
            for ($i = 0; $i < count($explode); $i++)
            {
                $all = Resource::where('name','like',"%{$explode[$i]}%")->first();
                $id[] = $all->id;
                $data['resource_id'] = json_encode($id);
            }
            $application->status = Application::NEW;
        }

        if (isset($data['performer_role_id']))
        {
            $data['performer_received_date'] = $now->toDateTimeString();
            $data['status'] = 'distributed';
            $data['show_leader'] = 2;
            $data['branch_leader_user_id'] = $user->id;
        }
        $roles = ($application->branch->signers);
        if (isset($data['signers']))
        {
            $array = $roles ? array_merge(json_decode($roles),$data['signers']): $data['signers'];
            $data['signers'] = json_encode($array);
            foreach ($array as $signers)
            {
                $signer = SignedDocs::where('application_id',$application->id)->where('role_id',$signers)->first();
                $docs = new SignedDocs();
                $docs->role_id = $signers;
                $docs->application_id = $application->id;
                $docs->table_name = "applications";
                $signer == null ? $docs->save():[];
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
            $application->status = Application::NEW;
            $message = "{$application->id} "."{$application->name} ".setting('admin.application_created');
            $this->sendNotifications($array, $application,$message);
        }elseif($application->signers == null)
        {
            $data['signers'] = $roles;
            $array = json_decode($roles);
            foreach ($array as $signers)
            {
                $signer = SignedDocs::where('application_id',$application->id)->where('role_id',$signers)->first();
                $docs = new SignedDocs();
                $docs->role_id = $signers;
                $docs->application_id = $application->id;
                $docs->table_name = "applications";
                $signer == null ? $docs->save():[];
            }
            $message = "{$application->id} "."{$application->name} ".setting('admin.application_created');
            $this->sendNotifications($array, $application,$message);
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
//                if ($notification->wasRecentlyCreated) {
//                    $diff = now()->diffInMinutes($application->created_at);
//                    $data = [
//                        'id' => $application->id,
//                        'time' => $diff == 0 ? 'recently' : $diff
//                    ];

//                    broadcast(new Notify(json_encode($data, $assoc = true), $user->id))->toOthers();     // notification
//                }
            }

            Http::post('ws.smarts.uz/api/send-notification', [
                'user_ids' => $user_ids,
                'project' => 'uztelecom',
                'data' => ['id' => $application->id, 'time' => 'recently']
            ]);
        }

    }
}
