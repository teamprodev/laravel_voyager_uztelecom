<?php

namespace App\Services;

use App\Enums\ApplicationMagicNumber;
use App\Enums\ApplicationStatusEnum;
use App\Enums\PermissionEnum;
use App\Models\Application;
use App\Models\ApplicationSigners;
use App\Models\Branch;
use App\Models\StatusExtented;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class BranchService
{
    /**
     * filial id si cache dan olinadi va shunga tegishli bo'lgan
     * Role lar chiqib keladi.
     **/
    public function getData($id)
    {
        $query = DB::table('roles')->whereRaw('json_contains(branch_id, \'["'.$id.'"]\')')->get();
        return Datatables::of($query)
            ->editColumn('branch_id', function ($query) {
                $all = json_decode($query->branch_id);
                $branch = $all ? Branch::find($all)->pluck('name')->toArray(): [];
                return $branch;
            })
            ->addColumn('action', function($row){
                $data['edit'] = "/admin/roles/{$row->id}/edit";
                $data['destroy'] =route("voyager.roles.destroy",$row->id);
                return json_encode(['link' => $data]);
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    /**
     * Zayavkalarni filialiga qarab chiqarish
     *
     * users tablitsadagi select_branch_id columni value sini olib
     * shu branch_id ga tegishli bolgan zayavkalarni ciqarb beradi
     **/
    public function ajax_branch($id)
    {
        $data = Application::where('branch_id', $id)->where('name', '!=', 'null')->get();
        return Datatables::of($data)
            ->editColumn('is_more_than_limit', function ($query) {
                return $query->is_more_than_limit == ApplicationMagicNumber::one ? __('Компанию') : __('Филиал');
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
                return $query->planned_price ? number_format($query->planned_price, ApplicationMagicNumber::zero, '', ' ') : '';
            })
            ->editColumn('delivery_date', function ($query) {
                return $query->updated_at ? with(new Carbon($query->delivery_date))->format('d.m.Y') : '';
            })
            ->editColumn('created_at', function ($data) {
                return $data->created_at ? with(new Carbon($data->created_at))->format('d.m.Y') : '';
            })
            ->editColumn('updated_at', function ($data) {
                return $data->updated_at ? with(new Carbon($data->updated_at))->format('d.m.Y') : '';
            })
            ->addColumn('planned_price_curr', function ($query) {
                $planned_price = $query->planned_price ? number_format($query->planned_price, ApplicationMagicNumber::zero, '', ' ') : '';
                return "{$planned_price}  {$query->currency}";
            })
            ->editColumn('status', function ($query) {
                $status = $query->status;
                $color = setting("color.{$status}");
                if ($query->performer_status !== null) {
                    $a = StatusExtented::find($query->performer_status);
                    $status = $a->name;
                    $color = $a->color;
                }
                return json_encode(['backgroundColor' => $color, 'app' => $this->translateStatus($status), 'color' => $color ? 'white' : 'black']);
            })
            ->addIndexColumn()
            ->addColumn('action', function($row){

                if(auth()->user()->id === $row->user_id || auth()->user()->hasPermission(PermissionEnum::Warehouse) || $row->performer_role_id === auth()->user()->role_id)
                {
                    $data['edit'] = route('site.applications.edit', $row->id);
                }

                $data['show'] = route('site.applications.show', $row->id);

                if($row->user_id == auth()->user()->id)
                {
                    $data['destroy'] = route('site.applications.destroy', $row->id);
                }

                if(($row->user_id === auth()->user()->id && $row->status === ApplicationStatusEnum::Canceled) || ($row->user_id === auth()->user()->id && $row->status === ApplicationStatusEnum::Refused)||($row->user_id === auth()->user()->id && $row->status === ApplicationStatusEnum::Rejected))
                {
                    $data['clone'] = route('site.applications.clone', $row->id);
                }
                return json_encode(['link' => $data]);
            })
            ->rawColumns(['action','status'])
            ->make(true);
    }
}
