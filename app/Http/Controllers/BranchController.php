<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Branch;
use App\Models\PermissionRole;
use App\Models\Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class BranchController extends Controller
{
    public function edit($id)
    {
        Cache::put('id',$id);
        return view('vendor.voyager.branches.signers-add');
    }
    public function getData()
    {
        $id = Cache::get('id');
        $query = DB::table('roles')->whereRaw('json_contains(branch_id, \'["'.$id.'"]\')')->get();
        return Datatables::of($query)
            ->editColumn('branch_id', function ($query) {
                $all = json_decode($query->branch_id);
                $branch = $all ? Branch::find($all)->pluck('name')->toArray(): [];
                return $branch;
            })
            ->addColumn('action', function($row){
                $edit_e = "/admin/roles/{$row->id}/edit";
                $destroy_e = route("voyager.roles.destroy",$row->id);
                $app_edit = __('Изменить');
                $app_delete= __('Посмотреть');;
                $bgcolor = setting('color.edit');
                $color = $bgcolor ? 'white':'black';
                $edit = "<a style='background-color: {$bgcolor};color: {$color}' href='{$edit_e}' class='m-1 col edit btn btn-sm'>$app_edit</a>";
                $bgcolor = setting('color.delete');
                $color = $bgcolor ? 'white':'black';
                $destroy = "<a style='background-color: {$bgcolor};color: {$color}' href='{$destroy_e}' class='m-1 col show btn btn-sm'>$app_delete</a>";
                return "<div class='row'>
                        {$edit}
                        {$destroy}
                        </div>";
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function putCache(Request $request)
    {
        Cache::put(auth()->user()->id,$request->branch_id);
        return redirect()->back();
    }
    public function ajax_branch()
    {
        $id = Cache::get(auth()->user()->id);
        $data = Application::where('branch_initiator_id', $id)->where('name', '!=', 'null')->get();
        return Datatables::of($data)
            ->editColumn('is_more_than_limit', function ($query) {
                return $query->is_more_than_limit == 1 ? __('Компанию') : __('Филиал');
            })
            ->editColumn('branch_initiator_id', function ($query) {
                return $query->branch->name;
            })
            ->addIndexColumn()
            ->editColumn('user_id', function($docs) {
                return $docs->user ? $docs->user->name:"";
            })
            ->editColumn('role_id', function($docs) {
                return $docs->role ? $docs->role->display_name:"";
            })
            ->editColumn('planned_price', function ($query) {
                return $query->planned_price ? number_format($query->planned_price, 0, '', ' ') : '';
            })
            ->editColumn('created_at', function ($data) {
                return $data->created_at ? with(new Carbon($data->created_at))->format('d.m.Y') : '';
            })
            ->editColumn('updated_at', function ($data) {
                return $data->updated_at ? with(new Carbon($data->updated_at))->format('d.m.Y') : '';
            })
            ->addColumn('planned_price_curr', function ($query) {
                $planned_price = $query->planned_price ? number_format($query->planned_price, 0, '', ' ') : '';
                return "{$planned_price}  {$query->currency}";
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
    public function view()
    {
        if(auth()->user()->hasPermission('select_branch'))
        {
            $branch = Branch::pluck('name','id')->toArray();
            return view('vendor.voyager.branches.view',compact('branch'));
        }else{
            return "<h1 style='text-align: center;color:red;'>Вам недоступно</h1>";
        }

    }
    public function update(Branch $id,Request $req)
    {
        $id->add_signers = $req->add_signers ? json_encode($req->add_signers): null;
        $id->signers = $req->signers ? json_encode($req->signers): null;
        $id->update();
        return redirect('/admin/branches/');
    }
}
