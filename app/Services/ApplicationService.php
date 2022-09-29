<?php


namespace App\Services;


use App\Events\Notify;
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
use Yajra\DataTables\DataTables;

class ApplicationService
{
    /*
     * Permissionlarga qarab Applicationlar chiqishi
     */
    const Permission_Company_Performer = 170;
    const Permission_Add_Branch_Signer = 167;
    const Permission_Branch_Signer = 168;
    const Permission_Company_Signer = 165;
    const Permission_Branch_Performer = 172;


    public function index($request,$user)
    {
        $filial = PermissionRole::where('permission_id', self::Permission_Add_Branch_Signer)->pluck('role_id')->toArray();
        $company = PermissionRole::where('permission_id', self::Permission_Add_Branch_Signer)->pluck('role_id')->toArray();
        foreach ($filial as $b) {
            $a = PermissionRole::where('permission_id', self::Permission_Branch_Signer)->where('role_id', $b)->pluck('role_id')->toArray();
            PermissionRole::where('permission_id', self::Permission_Branch_Signer)->where('role_id', $a)->delete();
        }
        foreach ($company as $b) {
            $a = PermissionRole::where('permission_id', self::Permission_Company_Signer)->where('role_id', $b)->pluck('role_id')->toArray();
            PermissionRole::where('permission_id', self::Permission_Company_Signer)->where('role_id', $a)->delete();
        }
        if ($request->ajax()) {


            if ($user->hasPermission('Purchasing_Management_Center')) {
                $a = 'branch_initiator_id';
                $b = [9, 13];
            }elseif($user->hasPermission('Company_Leader') | $user->hasPermission('Branch_Leader')){
                $a = 'branch_initiator_id';
                $b = [$user->branch_id];
            } else {
                $a = 'department_initiator_id';
                $b = [$user->department_id];
            }

            switch (true){
                case $user->hasPermission('Add_Company_Signer') && $user->hasPermission('Add_Branch_Signer') :
                    $query = Application::where('draft', '!=', 1)->whereIn($a, $b)->orWhere('signers', 'like', "%{$user->role_id}%")->where('draft', '!=', 1)->orWhere('performer_role_id', $user->role->id)->where('draft', '!=', 1)->orWhere('user_id', auth()->user()->id)->where('draft', '!=', 1)->get();
                    break;
                case $user->hasPermission('Warehouse') :
                    $status_0 = ApplicationData::Status_Accepted;
                    $status_1 = 'товар';
                    $query = Application::where('draft', '!=', 1)->whereIn($a, $b)->where('status', 'like', "%{$status_0}%")->OrwhereIn($a, $b)->where('status', 'like', "%{$status_1}%")->orWhere('user_id', auth()->user()->id)->get();
                    break;
                case $user->hasPermission('Company_Leader') && $user->hasPermission('Branch_Leader') :
                    $query = Application::whereIn($a, $b)->where('draft', '!=', 1)->orWhere('user_id', auth()->user()->id)->where('draft', '!=', 1)->get();
                    break;
                case $user->role_id === 7 :
                    $query = Application::whereIn($a, $b)->where('draft', '!=', 1)->get();
                    break;
                case $user->hasPermission('Company_Signer') || $user->hasPermission('Add_Company_Signer') || $user->hasPermission('Branch_Signer') || $user->hasPermission('Add_Branch_Signer'):
                    $query = Application::where('draft', '!=', 1)
                        ->where('signers', 'like', "%{$user->role_id}%")
                        ->orWhere('performer_role_id', $user->role->id)
                        ->where('draft', '!=', 1)
                        ->orWhere('user_id', auth()->user()->id)
                        ->where('draft', '!=', 1)->get();
                    break;
                case $user->hasPermission('Company_Leader') :
                    $query = Application::whereIn($a, $b)->where('draft', '!=', 1)->where('status', ApplicationData::Status_Agreed)->orWhere('status', ApplicationData::Status_Distributed)->whereIn($a, $b)->where('draft', '!=', 1)->orWhere('user_id', auth()->user()->id)->where('draft', '!=', 1)->get();
                    break;
                case $user->hasPermission('Branch_Leader') :
                    $query = Application::whereIn($a, $b)->where('draft', '!=', 1)->where('is_more_than_limit', 0)->where('show_leader', 1)->orWhere('is_more_than_limit', 0)->whereIn($a, $b)->where('status', ApplicationData::Status_New)->orWhere('is_more_than_limit', 0)->where('draft', '!=', 1)->whereIn($a, $b)->where('status', ApplicationData::Status_Distributed)->orWhere('user_id', auth()->user()->id)->where('draft', '!=', 1)->get();
                    break;
                case $user->hasPermission('Company_Performer') || $user->hasPermission('Branch_Performer') :
                    $query = Application::where('performer_role_id', auth()->user()->role_id)->orWhere('user_id', auth()->user()->id)->where('draft', '!=', 1)->get();
                    break;
                default :  $query = Application::whereIn($a, $b)->where('draft', '!=', 1)->get();;
                    break;
            }

            return Datatables::of($query)
                ->editColumn('is_more_than_limit', function ($query) {
                    return $query->is_more_than_limit == 1 ? __('Компанию') : __('Филиал');
                })
                ->editColumn('created_at', function ($query) {
                    return $query->created_at ? with(new Carbon($query->created_at))->format('d.m.Y') : '';
                })
                ->editColumn('branch_initiator_id', function ($query) {
                    return $query->branch->name;
                })
                ->editColumn('planned_price', function ($query) {
                    return $query->planned_price ? number_format($query->planned_price, 0, '', ' ') : '';
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
                ->addColumn('planned_price_curr', function ($query) {
                    $planned_price = $query->planned_price ? number_format($query->planned_price, 0, '', ' ') : '';
                    return "{$planned_price}  {$query->currency}";
                })
                ->editColumn('status', function ($query) {
                    /*
                     *  Voyager admin paneldan status ranglarini olish va chiqarish
                     */
                    $status = $query->status;
                    $status_new = __('Новая');
                    $status_in_process = __('На рассмотрении');
                    $status_refused = __('Отказана');
                    $status_agreed = __('Согласована');
                    $status_rejected = __('Отклонена');
                    $status_distributed = __('Распределен');
                    $status_cancelled = __('Отменен');
                    $status_overdue = __('просрочен');
                    switch($status)
                    {
                        case $query->performer_status !== null:
                            $a = StatusExtented::find($query->performer_status)->first();
                            return $this->status($a->name);
                        case ApplicationData::Status_New:
                            $status = setting('color.new');
                            $color = $status ? 'white' : 'black';
                            return "<div style='background-color: {$status};color: {$color};' class='text-center m-1 col edit btn-sm'>{$status_new}</div>";
                        case ApplicationData::Status_In_Process:
                            $status = setting('color.in_process');
                            $color = $status ? 'white' : 'black';
                            return "<div style='background-color: {$status};color: {$color};' class='text-center m-1 col edit btn-sm'>{$status_in_process}</div>";
                        case ApplicationData::Status_Overdue:
                            $status = setting('color.overdue');
                            $color = $status ? 'white' : 'black';
                            return "<div style='background-color: {$status};color: {$color};' class='text-center m-1 col edit btn-sm'>{$status_overdue}</div>";
                        case ApplicationData::Status_Order_Delivered:
                            $status = setting('color.delivered');
                            $color = $status ? 'white' : 'black';
                            return "<div style='background-color: {$status};color: {$color};' class='text-center m-1 col edit btn-sm'>товар доставлен</div>";
                        case ApplicationData::Status_Order_Arrived:
                            $status = setting('color.arrived');
                            $color = $status ? 'white' : 'black';
                            return "<div style='background-color: {$status};color: {$color};' class='text-center m-1 col edit btn-sm'>товар прибыл</div>";
                        case ApplicationData::Status_Refused:
                            $status = setting('color.rejected');
                            $color = $status ? 'white' : 'black';
                            return "<div style='background-color: {$status};color: {$color};' class='text-center m-1 col edit btn-sm'>{$status_refused}</div>";
                        case ApplicationData::Status_Agreed:
                            $status = setting('color.agreed');
                            $color = $status ? 'white' : 'black';
                            return "<div style='background-color: {$status};color: {$color};' class='text-center m-1 col edit btn-sm'>{$status_agreed}</div>";
                        case ApplicationData::Status_Rejected:
                            $status = setting('color.rejected');
                            $color = $status ? 'white' : 'black';
                            return "<div style='background-color: {$status};color: {$color};' class='text-center m-1 col edit btn-sm'>{$status_rejected}</div>";
                        case ApplicationData::Status_Distributed:
                            $status = setting('color.distributed');
                            $color = $status ? 'white' : 'black';
                            return "<div style='background-color: {$status};color: {$color};' class='text-center m-1 col edit btn-sm'>{$status_distributed}</div>";
                        case ApplicationData::Status_Canceled:
                            $status = setting('color.rejected');
                            $color = $status ? 'white' : 'black';
                            return "<div style='background-color: {$status};color: {$color};' class='text-center m-1 col edit btn-sm'>{$status_cancelled}</div>";
                        default:
                            return $query;
                    }
                })
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $edit_e = route('site.applications.edit', $row->id);
                    $clone_e = route('site.applications.clone', $row->id);
                    $show_e = route('site.applications.show', $row->id);
                    $destroy_e = route('site.applications.destroy', $row->id);
                    $app_edit = __('Изменить');
                    $app_show = __('Показать');
                    $app_clone = __('Копировать');
                    $app_delete = __('Удалить');
                    $app_delete_confirm = __("Вы действительно хотите удалить заявку под номером $row->id?");

                    if (auth()->user()->id === $row->user_id || auth()->user()->hasPermission('Warehouse') || $row->performer_role_id === auth()->user()->role_id) {
                        $bgcolor = setting('color.edit');
                        $color = $bgcolor ? 'white' : 'black';
                        $edit = "<a href='{$edit_e}' class='m-1 col edit btn btn-outline-danger editbtn'>$app_edit</a>";
                    } else {
                        $edit = "";
                    }
                    $bgcolor = setting('color.show');
                    $color = $bgcolor ? 'white' : 'black';
                    $show = "<a href='{$show_e}' class='m-1 col show btn btn-outline-danger showbtn'>$app_show</a>";
                    if ($row->user_id === auth()->user()->id && $row->show_director !== 2 && $row->show_leader !== 2 && $row->status !== ApplicationData::Status_Refused) {
                        $bgcolor = setting('color.delete');
                        $color = $bgcolor ? 'white' : 'black';
                        $destroy = "<a href='{$destroy_e}' class='m-1 col show btn btn-outline-danger deletebtn' onclick='return confirm(`$app_delete_confirm`)'>$app_delete</a>";
                    } else {
                        $destroy = "";
                    }
                    if (($row->user_id === auth()->user()->id && $row->status === ApplicationData::Status_Canceled) || ($row->user_id === auth()->user()->id && $row->status === ApplicationData::Status_Refused) || ($row->user_id === auth()->user()->id && $row->status === ApplicationData::Status_Rejected)) {
                        $clone = "<a href='{$clone_e}' class='m-1 col show btn btn-primary btn-sm'>$app_clone</a>";
                    } else {
                        $clone = "";
                    }

                    return "<div class='row'>
                        {$edit}
                        {$show}
                        {$clone}
                        {$destroy}
                        </div>";
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
        return view('site.applications.index');
    }

    /*
     * User tanlagan statusdagi Applicationlarni chiqarish
     */
    public function status_table($user)
    {
        if ($user->hasPermission('Purchasing_Management_Center')) {
                $a = 'branch_initiator_id';
                $b = [9, 13];
            } else {
                $a = 'branch_initiator_id';
                $b = [$user->branch_id];

                $c = 'department_initiator_id';
                $d = [$user->department_id];
            }
        $status = setting('admin.show_status');
        $data = Application::whereIn($a, $b)->where('status', $status)->where('name', '!=', null)->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('user_id', function ($docs) {
                return $docs->user_id ? $docs->user->name : "";
            })
            ->editColumn('created_at', function ($data) {
                return $data->created_at ? with(new Carbon($data->created_at))->format('d.m.Y') : '';
            })
            ->editColumn('updated_at', function ($data) {
                return $data->updated_at ? with(new Carbon($data->updated_at))->format('d.m.Y') : '';
            })
            ->editColumn('status', function ($query) {
                /*
                 *  Voyager admin paneldan status ranglarini olish va chiqarish
                 */
                $status = $query->status;
                $status_new = __('Новая');
                $status_in_process = __('На рассмотрении');
                $status_refused = __('Отказана');
                $status_agreed = __('Согласована');
                $status_rejected = __('Отклонена');
                $status_distributed = __('Распределен');
                $status_cancelled = __('Отменен');
                $status_overdue = __('просрочен');
                switch($status)
                {
                    case $query->performer_status !== null:
                        $a = StatusExtented::find($query->performer_status)->first();
                        return $this->status($a->name);
                    case ApplicationData::Status_New:
                        $status = setting('color.new');
                        $color = $status ? 'white' : 'black';
                        return "<div style='background-color: {$status};color: {$color};' class='text-center m-1 col edit btn-sm'>{$status_new}</div>";
                        break;
                    case ApplicationData::Status_In_Process:
                        $status = setting('color.in_process');
                        $color = $status ? 'white' : 'black';
                        return "<div style='background-color: {$status};color: {$color};' class='text-center m-1 col edit btn-sm'>{$status_in_process}</div>";
                    case ApplicationData::Status_Overdue:
                        $status = setting('color.overdue');
                        $color = $status ? 'white' : 'black';
                        return "<div style='background-color: {$status};color: {$color};' class='text-center m-1 col edit btn-sm'>{$status_overdue}</div>";
                    case ApplicationData::Status_Refused:
                        $status = setting('color.rejected');
                        $color = $status ? 'white' : 'black';
                        return "<div style='background-color: {$status};color: {$color};' class='text-center m-1 col edit btn-sm'>{$status_refused}</div>";
                    case ApplicationData::Status_Agreed:
                        $status = setting('color.agreed');
                        $color = $status ? 'white' : 'black';
                        return "<div style='background-color: {$status};color: {$color};' class='text-center m-1 col edit btn-sm'>{$status_agreed}</div>";
                    case ApplicationData::Status_Rejected:
                        $status = setting('color.rejected');
                        $color = $status ? 'white' : 'black';
                        return "<div style='background-color: {$status};color: {$color};' class='text-center m-1 col edit btn-sm'>{$status_rejected}</div>";
                    case ApplicationData::Status_Distributed:
                        $status = setting('color.distributed');
                        $color = $status ? 'white' : 'black';
                        return "<div style='background-color: {$status};color: {$color};' class='text-center m-1 col edit btn-sm'>{$status_distributed}</div>";
                    case ApplicationData::Status_Canceled:
                        $status = setting('color.rejected');
                        $color = $status ? 'white' : 'black';
                        return "<div style='background-color: {$status};color: {$color};' class='text-center m-1 col edit btn-sm'>{$status_cancelled}</div>";
                    default:
                        return $query;
                }
            })
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $edit_e = route('site.applications.edit', $row->id);
                $clone_e = route('site.applications.clone', $row->id);
                $show_e = route('site.applications.show', $row->id);
                $destroy_e = route('site.applications.destroy', $row->id);
                $app_edit = __('Изменить');
                $app_show = __('Показать');;
                $app_clone = __('Копировать');;
                $app_delete = __('Удалить');;

                if (auth()->user()->id == $row->user_id || auth()->user()->hasPermission('Warehouse') || $row->performer_role_id == auth()->user()->role_id) {
                    $bgcolor = setting('color.edit');
                    $color = $bgcolor ? 'white' : 'black';
                    $edit = "<a style='background-color: {$bgcolor};color: {$color}' href='{$edit_e}' class='m-1 col edit btn btn-sm'>$app_edit</a>";
                } else {
                    $edit = "";
                }
                $bgcolor = setting('color.show');
                $color = $bgcolor ? 'white' : 'black';
                $show = "<a style='background-color: {$bgcolor};color: {$color}' href='{$show_e}' class='m-1 col show btn btn-sm'>$app_show</a>";
                if ($row->user_id == auth()->user()->id) {
                    $bgcolor = setting('color.delete');
                    $color = $bgcolor ? 'white' : 'black';
                    $destroy = "<a style='background-color: {$bgcolor};color: {$color}' href='{$destroy_e}' class='m-1 col show btn btn-sm'>$app_delete</a>";
                } else {
                    $destroy = "";
                }
                if (($row->user_id === auth()->user()->id && $row->status === ApplicationData::Status_Canceled) || ($row->user_id === auth()->user()->id && $row->status === ApplicationData::Status_Refused) || ($row->user_id === auth()->user()->id && $row->status === ApplicationData::Status_Rejected)) {
                    $clone = "<a href='{$clone_e}' class='m-1 col show btn btn-primary btn-sm'>$app_clone</a>";
                } else {
                    $clone = "";
                }

                return "<div class='row'>
                        {$edit}
                        {$show}
                        {$clone}
                        {$destroy}
                        </div>";
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }

    /*
     * User tanlagan Performer_Statusga qarab Applicationlar show bo'lishi
     * */
    public function performer_status($user)
    {
        if ($user->hasPermission('Purchasing_Management_Center')) {
            $a = 'branch_initiator_id';
            $b = [9, 13];
        } else {
            $a = 'branch_initiator_id';
            $b = [$user->branch_id];
        }
        $status = Cache::get('performer_status_get');
        $data = Application::WhereIn('branch_initiator_id',[$user->branch_id])->where('status_extended_id', $status)->where('name', '!=', null)->OrWhereIn($a,$b)->where('status', $status)->where('name', '!=', null)->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('user_id', function ($docs) {
                return $docs->user ? $docs->user->name : "";
            })
            ->editColumn('role_id', function ($docs) {
                return $docs->role ? $docs->role->display_name : "";
            })
            ->editColumn('created_at', function ($data) {
                return $data->created_at ? with(new Carbon($data->created_at))->format('d.m.Y') : '';
            })
            ->editColumn('updated_at', function ($data) {
                return $data->updated_at ? with(new Carbon($data->updated_at))->format('d.m.Y') : '';
            })
            ->editColumn('status', function ($query) {
                /*
                 *  Voyager admin paneldan status ranglarini olish va chiqarish
                 */
                $status = $query->status;
                $status_new = __('Новая');
                $status_in_process = __('На рассмотрении');
                $status_refused = __('Отказана');
                $status_agreed = __('Согласована');
                $status_rejected = __('Отклонена');
                $status_distributed = __('Распределен');
                $status_cancelled = __('Отменен');
                $status_overdue = __('просрочен');
                switch($status)
                {
                    case $query->performer_status !== null:
                        $a = StatusExtented::find($query->performer_status)->first();
                        return $this->status($a->name);
                    case ApplicationData::Status_New:
                        $status = setting('color.new');
                        $color = $status ? 'white' : 'black';
                        return "<div style='background-color: {$status};color: {$color};' class='text-center m-1 col edit btn-sm'>{$status_new}</div>";
                        break;
                    case ApplicationData::Status_In_Process:
                        $status = setting('color.in_process');
                        $color = $status ? 'white' : 'black';
                        return "<div style='background-color: {$status};color: {$color};' class='text-center m-1 col edit btn-sm'>{$status_in_process}</div>";
                    case ApplicationData::Status_Overdue:
                        $status = setting('color.overdue');
                        $color = $status ? 'white' : 'black';
                        return "<div style='background-color: {$status};color: {$color};' class='text-center m-1 col edit btn-sm'>{$status_overdue}</div>";
                    case ApplicationData::Status_Refused:
                        $status = setting('color.rejected');
                        $color = $status ? 'white' : 'black';
                        return "<div style='background-color: {$status};color: {$color};' class='text-center m-1 col edit btn-sm'>{$status_refused}</div>";
                    case ApplicationData::Status_Agreed:
                        $status = setting('color.agreed');
                        $color = $status ? 'white' : 'black';
                        return "<div style='background-color: {$status};color: {$color};' class='text-center m-1 col edit btn-sm'>{$status_agreed}</div>";
                    case ApplicationData::Status_Rejected:
                        $status = setting('color.rejected');
                        $color = $status ? 'white' : 'black';
                        return "<div style='background-color: {$status};color: {$color};' class='text-center m-1 col edit btn-sm'>{$status_rejected}</div>";
                    case ApplicationData::Status_Distributed:
                        $status = setting('color.distributed');
                        $color = $status ? 'white' : 'black';
                        return "<div style='background-color: {$status};color: {$color};' class='text-center m-1 col edit btn-sm'>{$status_distributed}</div>";
                    case ApplicationData::Status_Canceled:
                        $status = setting('color.rejected');
                        $color = $status ? 'white' : 'black';
                        return "<div style='background-color: {$status};color: {$color};' class='text-center m-1 col edit btn-sm'>{$status_cancelled}</div>";
                    default:
                        return $query;
                }
            })
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $edit_e = route('site.applications.edit', $row->id);
                $clone_e = route('site.applications.clone', $row->id);
                $show_e = route('site.applications.show', $row->id);
                $destroy_e = route('site.applications.destroy', $row->id);
                $app_edit = __('Изменить');
                $app_show = __('Показать');;
                $app_clone = __('Копировать');;
                $app_delete = __('Удалить');;

                if (auth()->user()->id === $row->user_id || auth()->user()->hasPermission('Warehouse') || $row->performer_role_id === auth()->user()->role_id) {
                    $bgcolor = setting('color.edit');
                    $color = $bgcolor ? 'white' : 'black';
                    $edit = "<a style='background-color: {$bgcolor};color: {$color}' href='{$edit_e}' class='m-1 col edit btn btn-sm'>$app_edit</a>";
                } else {
                    $edit = "";
                }
                $bgcolor = setting('color.show');
                $color = $bgcolor ? 'white' : 'black';
                $show = "<a style='background-color: {$bgcolor};color: {$color}' href='{$show_e}' class='m-1 col show btn btn-sm'>$app_show</a>";
                if ($row->user_id === auth()->user()->id) {
                    $bgcolor = setting('color.delete');
                    $color = $bgcolor ? 'white' : 'black';
                    $destroy = "<a style='background-color: {$bgcolor};color: {$color}' href='{$destroy_e}' class='m-1 col show btn btn-sm'>$app_delete</a>";
                } else {
                    $destroy = "";
                }
                if (($row->user_id === auth()->user()->id && $row->status === ApplicationData::Status_Canceled) || ($row->user_id === auth()->user()->id && $row->status === ApplicationData::Status_Refused) || ($row->user_id === auth()->user()->id && $row->status === ApplicationData::Status_Rejected)) {
                    $clone = "<a href='{$clone_e}' class='m-1 col show btn btn-primary btn-sm'>$app_clone</a>";
                } else {
                    $clone = "";
                }

                return "<div class='row'>
                        {$edit}
                        {$show}
                        {$clone}
                        {$destroy}
                        </div>";
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }

    /*
     * Application Clone(Nusxalash)
     */
    public function clone($id)
    {
        $clone = Application::findOrFail($id);
        $application = $clone->replicate();
        $application->signers = null;
        $application->status = ApplicationData::Status_New;
        $application->save();
        return redirect()->back();
    }

    public function SignedDocs($data)
    {
        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('user_id', function ($docs) {
                return $docs->user ? $docs->user->name : "";
            })
            ->editColumn('role_id', function ($docs) {
                return $docs->role ? $docs->role->display_name : "";
            })
            ->editColumn('updated_at', function ($query) {
                return $query->updated_at ? with(new Carbon($query->updated_at))->format('d.m.Y') : '';;
            })
            ->editColumn('status', function ($status) {
                $status_agreed = __('Согласована');
                $status_rejected = __('Отклонена');
                $status_not_signed = __('Не подписан');

                match ($status->status) {
                    1 => $status_signer = $status_agreed,
                    0 => $status_signer = $status_rejected,
                    default => $status_signer = $status_not_signed,
                };
                return $status_signer;
            })
            ->make(true);
    }

    /*
     * Application Create
     */
    public function create($user)
    {
        $application = new Application();
        $application->user_id = $user->id;
        $application->branch_initiator_id = $user->branch_id;
        $application->branch_id = $user->branch_id;
        $application->department_initiator_id = $user->department_id;
        $application->status = ApplicationData::Status_New;
        $application->save();
        return redirect()->route('site.applications.edit', $application->id);
    }

    /*
     * Draft(Chernovik) Applicationlarni chiqazish
     */
    public function show_draft($request)
    {
        if ($request->ajax()) {
            $user = auth()->user();

            $data = Application::where('user_id', $user->id)
                ->whereDraft("1");

            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('created_at', function ($data) {
                    return $data->created_at ? with(new Carbon($data->created_at))->format('d.m.Y') : '';
                })
                ->editColumn('updated_at', function ($data) {
                    return $data->updated_at ? with(new Carbon($data->updated_at))->format('d.m.Y') : '';
                })
                ->addColumn('action', function ($row) {
                    $edit = route('site.applications.edit', $row->id);
                    $show = route('site.applications.show', $row->id);
                    $destroy = route('site.applications.destroy', $row->id);
                    $app_edit = __('Изменить');
                    $app_show = __('Показать');;
                    $app_clone = __('Копировать');;
                    $app_delete = __('Удалить');;
                    if ($row->status === ApplicationData::Status_Accepted || $row->status === ApplicationData::Status_Refused) {
                        $clone = route('site.applications.clone', $row->id);
                    } else {
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

    /*
     * Image upload
     */
    public function uploadImage($request, $application)
    {
        $file_basis = json_decode($application->file_basis);
        $file_tech_spec = json_decode($application->file_tech_spec);
        $other_files = json_decode($application->other_files);
        $performer_file = json_decode($application->performer_file);
        if ($request->hasFile('file_basis')) {
            $fileName = time() . '_' . $request->file_basis->getClientOriginalName();
            $filePath = $request->file('file_basis')
                ->move(public_path("storage/uploads/"), $fileName);

            $file_basis[] = $fileName;
        }
        if ($request->hasFile('file_tech_spec')) {
            $fileName = time() . '_' . $request->file_tech_spec->getClientOriginalName();
            $filePath = $request->file('file_tech_spec')
                ->move(public_path("storage/uploads/"), $fileName);

            $file_tech_spec[] = $fileName;
        }
        if ($request->hasFile('other_files')) {
            $fileName = time() . '_' . $request->other_files->getClientOriginalName();
            $filePath = $request->file('other_files')
                ->move(public_path("storage/uploads/"), $fileName);

            $other_files[] = $fileName;
        }
        if ($request->hasFile('performer_file')) {
            $fileName = time() . '_' . $request->performer_file->getClientOriginalName();
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

    public function show($application, $user)
    {

        $access = SignedDocs::where('role_id', auth()->user()->role_id)->where('status', null)->where('application_id', $application->id)->first();
        $check = SignedDocs::where('role_id', auth()->user()->role_id)->where('application_id', $application->id)->first();
        $branch = Branch::where('id', $application->branch_initiator_id)->first();
        $signedDocs = $application->signedDocs()->get();
        $file_basis = json_decode($application->file_basis);
        $file_tech_spec = json_decode($application->file_tech_spec);
        $other_files = json_decode($application->other_files);
        $performer_file = json_decode($application->performer_file);
        $same_role_user_ids = User::where('role_id', auth()->user()->role_id)->get()->pluck('id')->toArray();

        /*
         * @var id
         * @var application branch_initiator_id bo'yicha role larni oladi
         *
         * foreach da shu role lardan
         * Permissionni Company_Performer va Branch_Performer bo'lganlarini ovotti
         */

        $id = DB::table('roles')->whereRaw('json_contains(branch_id, \'["' . $application->branch_initiator_id . '"]\')')->pluck('id')->toArray();

        foreach ($id as $role) {
            $role_company[] = PermissionRole::where('role_id', $role)->where('permission_id', self::Permission_Company_Performer)->get()->pluck('role_id');

            $role_company = array_diff($role_company, ['[]']);

            $branch = PermissionRole::where('role_id', $role)->where('permission_id', self::Permission_Branch_Performer)->get()->pluck('role_id');

            $role_branch[] = $branch;
            $role_branch = array_diff($role_branch, ['[]']);
        }
        $performers_company = $id ? Roles::find($role_company)->pluck('display_name', 'id') : [];
        $performers_branch = $id ? Roles::find($role_branch)->pluck('display_name', 'id') : [];
        $access_comment = Position::find($user->position_id);
        $subjects = Subject::all();
        $purchases = Purchase::all();
        $branch_name = Branch::find($application->user->branch_id, 'name');
        $branch = Branch::all()->pluck('name', 'id');

        $perms['CompanyLeader'] = $application->user_id !== $user->id && $user->hasPermission('Company_Leader') && $application->show_leader === 1;
        $perms['BranchLeader'] = $application->user_id !== $user->id && $user->hasPermission('Branch_Leader') && $application->show_leader === 1;
        $perms['PerformerComment'] = $application->performer_role_id === $user->role_id && $user->leader === 0;
        $perms['NumberChange'] = $user->hasPermission('Number_Change') && !$user->hasPermission('Plan_Budget') && !$user->hasPermission('Plan_Business');
        $perms['Plan'] = ($check && $user->hasPermission('Plan_Budget')) || ($user->hasPermission('Plan_Business') && $check);
        $perms['PerformerLeader'] = $application->performer_role_id === $user->role_id && $user->leader === 1;
        $perms['Signers'] = ($access && $user->hasPermission('Company_Signer'||'Add_Company_Signer'||'Branch_Signer'||'Add_Branch_Signer'||'Company_Performer'||'Branch_Performer')) || ($access && $user->role_id === 7 && $application->show_director === 1);
        $status = $application->status;
        $status_new = __('Новая');
        $status_in_process = __('На рассмотрении');
        $status_refused = __('Отказана');
        $status_agreed = __('Согласована');
        $status_rejected = __('Отклонена');
        $status_distributed = __('Распределен');
        $status_cancelled = __('Отменен');
        $status_overdue = __('просрочен');
        switch($status)
        {
            case $application->performer_status !== null:
                $a = StatusExtented::find($application->performer_status)->first();
                $perms['application_status'] = $this->status_1($a->name);
                break;
            case ApplicationData::Status_New:
                $status = setting('color.new');
                $color = $status ? 'white' : 'black';
                $perms['application_status'] = "<div style='background-color: {$status};color: {$color};' class='btn btn-sm'>{$status_new}</div>";
                break;
            case ApplicationData::Status_In_Process:
                $status = setting('color.in_process');
                $color = $status ? 'white' : 'black';
                $perms['application_status'] = "<div style='background-color: {$status};color: {$color};' class='btn btn-sm'>{$status_in_process}</div>";
                break;
            case ApplicationData::Status_Overdue:
                $status = setting('color.overdue');
                $color = $status ? 'white' : 'black';
                $perms['application_status'] = "<div style='background-color: {$status};color: {$color};' class='btn btn-sm'>{$status_overdue}</div>";
                break;
            case ApplicationData::Status_Order_Delivered:
                $status = setting('color.delivered');
                $color = $status ? 'white' : 'black';
                $perms['application_status'] = "<div style='background-color: {$status};color: {$color};' class='btn btn-sm'>товар доставлен</div>";
                break;
            case ApplicationData::Status_Order_Arrived:
                $status = setting('color.arrived');
                $color = $status ? 'white' : 'black';
                $perms['application_status'] = "<div style='background-color: {$status};color: {$color};' class='btn btn-sm'>товар прибыл</div>";
                break;
            case ApplicationData::Status_Refused:
                $status = setting('color.rejected');
                $color = $status ? 'white' : 'black';
                $perms['application_status'] = "<div style='background-color: {$status};color: {$color};' class='btn btn-sm'>{$status_refused}</div>";
                break;
            case ApplicationData::Status_Agreed:
                $status = setting('color.agreed');
                $color = $status ? 'white' : 'black';
                $perms['application_status'] = "<div style='background-color: {$status};color: {$color};' class='btn btn-sm'>{$status_agreed}</div>";
                break;
            case ApplicationData::Status_Rejected:
                $status = setting('color.rejected');
                $color = $status ? 'white' : 'black';
                $perms['application_status'] = "<div style='background-color: {$status};color: {$color};' class='btn btn-sm'>{$status_rejected}</div>";
                break;
            case ApplicationData::Status_Distributed:
                $status = setting('color.distributed');
                $color = $status ? 'white' : 'black';
                $perms['application_status'] = "<div style='background-color: {$status};color: {$color};' class='btn btn-sm'>{$status_distributed}</div>";
                break;
            case ApplicationData::Status_Canceled:
                $status = setting('color.rejected');
                $color = $status ? 'white' : 'black';
                $perms['application_status'] = "<div style='background-color: {$status};color: {$color};' class='btn btn-sm'>{$status_cancelled}</div>";
                break;
            default:
                $perms['application_status'] = $application->status;
        }
        return view('site.applications.show', compact('performer_file', 'branch','perms', 'access_comment', 'performers_company', 'performers_branch', 'file_basis', 'file_tech_spec', 'other_files', 'user', 'application', 'branch', 'signedDocs', 'same_role_user_ids', 'access', 'subjects', 'purchases', 'branch_name', 'check'));

    }

    public function edit($application)
    {
        $status_extented = StatusExtented::all()->pluck('name', 'id')->toArray();
        if (auth()->user()->id !== $application->user_id && !auth()->user()->hasPermission('Warehouse') && !auth()->user()->hasPermission('Company_Performer') && !auth()->user()->hasPermission('Branch_Performer')) {
            return redirect()->route('site.applications.index');
        }
        $countries = ['0' => 'Select country'];
        $countries[] = Country::get()->pluck('country_name', 'country_alpha3_code')->toArray();
        $select = Resource::pluck('name', 'id');
        $performer_file = json_decode($application->performer_file);
        $branch_signer = json_decode($application->branch->add_signers);
        $addsigner = Branch::find(9);
        $company_signer = json_decode($addsigner->add_signers);
        return view('site.applications.edit', [
            'application' => $application,
            'purchase' => Purchase::all()->pluck('name', 'id'),
            'subject' => Subject::all()->pluck('name', 'id'),
            'branch' => Branch::all()->pluck('name', 'id'),
            'users' => User::where('role_id', 5)->get(),
            'status_extented' => $status_extented,
            'countries' => $countries,
            'products' => $select,
            'warehouse' => Warehouse::where('application_id', $application->id)->first(),
            'performer_file' => $performer_file,
            'user' => auth()->user(),
            'company_signers' => $company_signer ? Roles::find($company_signer)->sortBy('index')->pluck('display_name', 'id')->toArray() : null,
            'branch_signers' => $branch_signer ? Roles::find($branch_signer)->sortBy('index')->pluck('display_name', 'id')->toArray() : null,
        ]);
    }

    public function update($application, $request)
    {
        $user = auth()->user();
        $now = Carbon::now();
        $data = $request->validated();
//        if (auth()->id() == $application->user_id && $application->status == ApplicationData::Status_Refused || auth()->id() == $application->user_id && $application->status == ApplicationData::Status_Rejected) {
//            $data['status'] = ApplicationData::Status_New;
//            $signedDocs = SignedDocs::where('application_id', $application->id)->get();
//            foreach ($signedDocs as $doc) {
//
//                $doc->status = null;
//                $doc->save();
//            }
//        }
        $roles = ($application->branch_signers->signers);
        if (isset($data['signers'])) {
            $array = $roles ? array_merge(json_decode($roles), $data['signers']) : $data['signers'];
            $data['signers'] = json_encode($array);
            foreach ($array as $signers) {
                $signer = SignedDocs::where('application_id', $application->id)->where('role_id', $signers)->first();
                $docs = new SignedDocs();
                $docs->role_id = $signers;
                $docs->role_index = Roles::find($signers)->index === null ? 1 : (Roles::find($signers)->index);
                $docs->application_id = $application->id;
                $docs->table_name = "applications";
                $signer === null ? $docs->save() : [];
            }
            if ($application->signers !== null) {
                $signers = json_decode($data['signers']);
                $signedDocs = SignedDocs::where('application_id', $application->id)->pluck('role_id')->toArray();
                $not_signer = array_diff($signedDocs, $signers);
                foreach ($not_signer as $delete) {
                    SignedDocs::where('application_id', $application->id)->where('role_id', $delete)->delete();
                }
            }
            $message = "{$application->id} " . "{$application->name} " . setting('admin.application_created');
            $this->sendNotifications($array, $application, $message);
        }elseif ($application->signers === null) {
            $data['signers'] = $roles;
            $array = json_decode($roles);
            foreach ($array as $signers) {
                $signer = SignedDocs::where('application_id', $application->id)->where('role_id', $signers)->first();
                $docs = new SignedDocs();
                $docs->role_id = $signers;
                $docs->role_index = Roles::find($signers)->index;
                $docs->application_id = $application->id;
                $docs->table_name = "applications";
                $signer === null ? $docs->save() : [];
            }
            $message = "{$application->id} " . "{$application->name} " . setting('admin.application_created');
            $this->sendNotifications($array, $application, $message);
        }
        if (isset($data['draft'])) {
            if ($data['draft'] === 1)
                $data['status'] = ApplicationData::Status_Draft;
        }
        if (isset($data['performer_status'])) {
            $application->performer_user_id = $user->id;
            $application->status = $data['performer_status'];
        }
        if (isset($data['performer_leader_comment'])) {
            $data['performer_leader_comment_date'] = $now->toDateTimeString();
            $data['performer_leader_user_id'] = $user->id;
        }
        if (isset($data['performer_comment'])) {
            $data['performer_comment_date'] = $now->toDateTimeString();
            $data['performer_user_id'] = $user->id;
        }
        if (isset($data['resource_id'])) {
            if ($data['resource_id'] === "[object Object]") {
                $data['resource_id'] = null;
            } else {
                $explode = explode(',', $data['resource_id']);
                $data['resource_id'] = json_encode($explode);
//                $application->status = ApplicationData::Status_New;
            }
        }

        if (isset($data['performer_role_id'])) {
            $data['performer_received_date'] = $now->toDateTimeString();
            $data['status'] = ApplicationData::Status_Distributed;
            $data['show_leader'] = 2;
            $data['branch_leader_user_id'] = $user->id;
        }

        $result = $application->update($data);
        if ($result)
            return redirect()->route('site.applications.show',$application->id);

        return redirect()->back()->with('danger', trans('site.application_failed'));
    }

    public function is_more_than_limit($application, $request)
    {
        $application->is_more_than_limit = $request->is_more_than_limit;
        $application->signers = null;
        $application->status = 'new';
        if ($request->is_more_than_limit == 1) {
            $application->branch_initiator_id = 9;
        }else{
            $application->branch_initiator_id = auth()->user()->branch_id;
        }
        $application->branch_id = auth()->user()->branch_id;
        SignedDocs::where('application_id', $application->id)->delete();
        $application->save();
    }

    public function sendNotifications($array, $application, $message)
    {
        if ($array !== null) {
            if (is_resource(@fsockopen(env('LARAVEL_WEBSOCKETS_HOST', '127.0.0.1'), env('LARAVEL_WEBSOCKETS_PORT', 6001)))) {
                $websocket = true;
            } else {
                $websocket = false;
            }
            $user_ids = User::query()->whereIn('role_id', $array)->where('branch_id',$application->branch_initiator_id)->pluck('id')->toArray();
            foreach ($user_ids as $user_id) {
                $notification = Notification::query()->firstOrCreate(['user_id' => $user_id, 'application_id' => $application->id, 'message' => $message]);
                if ($notification->wasRecentlyCreated) {
                    $diff = now()->diffInMinutes($application->created_at);
                    $data = [
                        'id' => $application->id,
                        'time' => $diff === 0 ? 'recently' : $diff
                    ];
                    if ($websocket) {
                        broadcast(new Notify(json_encode($data, $assoc = true), $user_id))->toOthers();     // notification
                    }
                }
            }
        }

    }

    public function StatusChangeToPerformerStatus(){
        $applications = Application::all();
        foreach ($applications as $application) {
            $application = Application::where('performer_status', '!=', null)->update(['status'=> DB::raw("performer_status") ]);
        }
    }
    public function to_sign_data($user)
    {
        $signedDocs = SignedDocs::where('role_id',$user->role_id)->where('status',null)->pluck('application_id')->toArray();
        $data = Application::find($signedDocs);
        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('user_id', function ($docs) {
                return $docs->user_id ? $docs->user->name : "";
            })
            ->editColumn('created_at', function ($data) {
                return $data->created_at ? with(new Carbon($data->created_at))->format('d.m.Y') : '';
            })
            ->editColumn('updated_at', function ($data) {
                return $data->updated_at ? with(new Carbon($data->updated_at))->format('d.m.Y') : '';
            })
            ->editColumn('status', function ($query) {
                /*
                 *  Voyager admin paneldan status ranglarini olish va chiqarish
                 */
                $status = $query->status;
                $status_new = __('Новая');
                $status_in_process = __('На рассмотрении');
                $status_refused = __('Отказана');
                $status_agreed = __('Согласована');
                $status_rejected = __('Отклонена');
                $status_distributed = __('Распределен');
                $status_cancelled = __('Отменен');
                $status_overdue = __('просрочен');
                switch($status)
                {
                    case $query->performer_status !== null:
                        $a = StatusExtented::find($query->performer_status)->first();
                        return $this->status($a->name);
                    case ApplicationData::Status_New:
                        $status = setting('color.new');
                        $color = $status ? 'white' : 'black';
                        return "<div style='background-color: {$status};color: {$color};' class='text-center m-1 col edit btn-sm'>{$status_new}</div>";
                        break;
                    case ApplicationData::Status_In_Process:
                        $status = setting('color.in_process');
                        $color = $status ? 'white' : 'black';
                        return "<div style='background-color: {$status};color: {$color};' class='text-center m-1 col edit btn-sm'>{$status_in_process}</div>";
                    case ApplicationData::Status_Overdue:
                        $status = setting('color.overdue');
                        $color = $status ? 'white' : 'black';
                        return "<div style='background-color: {$status};color: {$color};' class='text-center m-1 col edit btn-sm'>{$status_overdue}</div>";
                    case ApplicationData::Status_Refused:
                        $status = setting('color.rejected');
                        $color = $status ? 'white' : 'black';
                        return "<div style='background-color: {$status};color: {$color};' class='text-center m-1 col edit btn-sm'>{$status_refused}</div>";
                    case ApplicationData::Status_Agreed:
                        $status = setting('color.agreed');
                        $color = $status ? 'white' : 'black';
                        return "<div style='background-color: {$status};color: {$color};' class='text-center m-1 col edit btn-sm'>{$status_agreed}</div>";
                    case ApplicationData::Status_Rejected:
                        $status = setting('color.rejected');
                        $color = $status ? 'white' : 'black';
                        return "<div style='background-color: {$status};color: {$color};' class='text-center m-1 col edit btn-sm'>{$status_rejected}</div>";
                    case ApplicationData::Status_Distributed:
                        $status = setting('color.distributed');
                        $color = $status ? 'white' : 'black';
                        return "<div style='background-color: {$status};color: {$color};' class='text-center m-1 col edit btn-sm'>{$status_distributed}</div>";
                    case ApplicationData::Status_Canceled:
                        $status = setting('color.rejected');
                        $color = $status ? 'white' : 'black';
                        return "<div style='background-color: {$status};color: {$color};' class='text-center m-1 col edit btn-sm'>{$status_cancelled}</div>";
                    default:
                        return $query;
                }
            })
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $edit_e = route('site.applications.edit', $row->id);
                $clone_e = route('site.applications.clone', $row->id);
                $show_e = route('site.applications.show', $row->id);
                $destroy_e = route('site.applications.destroy', $row->id);
                $app_edit = __('Изменить');
                $app_show = __('Показать');;
                $app_clone = __('Копировать');;
                $app_delete = __('Удалить');;

                if (auth()->user()->id == $row->user_id || auth()->user()->hasPermission('Warehouse') || $row->performer_role_id == auth()->user()->role_id) {
                    $bgcolor = setting('color.edit');
                    $color = $bgcolor ? 'white' : 'black';
                    $edit = "<a style='background-color: {$bgcolor};color: {$color}' href='{$edit_e}' class='m-1 col edit btn btn-sm'>$app_edit</a>";
                } else {
                    $edit = "";
                }
                $bgcolor = setting('color.show');
                $color = $bgcolor ? 'white' : 'black';
                $show = "<a style='background-color: {$bgcolor};color: {$color}' href='{$show_e}' class='m-1 col show btn btn-sm'>$app_show</a>";
                if ($row->user_id == auth()->user()->id) {
                    $bgcolor = setting('color.delete');
                    $color = $bgcolor ? 'white' : 'black';
                    $destroy = "<a style='background-color: {$bgcolor};color: {$color}' href='{$destroy_e}' class='m-1 col show btn btn-sm'>$app_delete</a>";
                } else {
                    $destroy = "";
                }
                if (($row->user_id === auth()->user()->id && $row->status === ApplicationData::Status_Canceled) || ($row->user_id === auth()->user()->id && $row->status === ApplicationData::Status_Refused) || ($row->user_id === auth()->user()->id && $row->status === ApplicationData::Status_Rejected)) {
                    $clone = "<a href='{$clone_e}' class='m-1 col show btn btn-primary btn-sm'>$app_clone</a>";
                } else {
                    $clone = "";
                }

                return "<div class='row'>
                        {$edit}
                        {$show}
                        {$clone}
                        {$destroy}
                        </div>";
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }
    public function status(string $status)
    {
        $status_accepted = __('Принята');

        $status_performed = __('Товар доставлен');

        switch($status)
        {
            case 'Принята':
                $status = setting('color.accepted');
                $color = $status ? 'white' : 'black';
                return "<div style='background-color: {$status};color: {$color};' class='text-center m-1 col edit btn-sm'>{$status_accepted}</div>";
            case 'Выполнено частично':
                $status = setting('color.partially');
                $color = $status ? 'white' : 'black';
                return "<div style='background-color: {$status};color: {$color};' class='text-center m-1 col edit btn-sm'>Выполнено частично</div>";
            case 'Выполнено в полном объёме':
                $status = setting('color.total_volume');
                $color = $status ? 'white' : 'black';
                return "<div style='background-color: {$status};color: {$color};' class='text-center m-1 col edit btn-sm'>Выполнено в полном объёме</div>";
            case 'Заявка аннулирована по заданию руководства':
                $status = setting('color.nulled_by_management');
                $color = $status ? 'white' : 'black';
                return "<div style='background-color: {$status};color: {$color};' class='text-center m-1 col edit btn-sm'>Заявка аннулирована по заданию руководства</div>";
            case 'Договор аннулирован по инициативе Узбектелеком':
                $status = setting('color.nulled_by_management');
                $color = $status ? 'white' : 'black';
                return "<div style='background-color: {$status};color: {$color};' class='text-center m-1 col edit btn-sm'>Договор аннулирован по инициативе Узбектелеком</div>";
            case 'заявка передана в Узтелеком':
                $status = setting('color.nulled_by_management');
                $color = $status ? 'white' : 'black';
                return "<div style='background-color: {$status};color: {$color};' class='text-center m-1 col edit btn-sm'>заявка передана в Узтелеком</div>";
            case 'товар доставлен':
                $status = setting('color.delivered');
                $color = $status ? 'white' : 'black';
                return "<div class='row'>
                            <div style='background-color: {$status};color: {$color};' class='text-center m-1 col edit btn-sm'>{$status_performed}</div>
                            </div>";
        }
    }
    public function status_1(string $status)
    {
        $status_accepted = __('Принята');

        $status_performed = __('Товар доставлен');

        switch($status)
        {
            case 'Принята':
                $status = setting('color.accepted');
                $color = $status ? 'white' : 'black';
                return "<div style='background-color: {$status};color: {$color};' class='btn btn-sm'>{$status_accepted}</div>";
            case 'Выполнено частично':
                $status = setting('color.partially');
                $color = $status ? 'white' : 'black';
                return "<div style='background-color: {$status};color: {$color};' class='btn btn-sm'>Выполнено частично</div>";
            case 'Выполнено в полном объёме':
                $status = setting('color.total_volume');
                $color = $status ? 'white' : 'black';
                return "<div style='background-color: {$status};color: {$color};' class='btn btn-sm'>Выполнено в полном объёме</div>";
            case 'Заявка аннулирована по заданию руководства':
                $status = setting('color.nulled_by_management');
                $color = $status ? 'white' : 'black';
                return "<div style='background-color: {$status};color: {$color};' class='btn btn-sm'>Заявка аннулирована по заданию руководства</div>";
            case 'Договор аннулирован по инициативе Узбектелеком':
                $status = setting('color.nulled_by_management');
                $color = $status ? 'white' : 'black';
                return "<div style='background-color: {$status};color: {$color};' class='btn btn-sm'>Договор аннулирован по инициативе Узбектелеком</div>";
            case 'заявка передана в Узтелеком':
                $status = setting('color.nulled_by_management');
                $color = $status ? 'white' : 'black';
                return "<div style='background-color: {$status};color: {$color};' class='btn btn-sm'>заявка передана в Узтелеком</div>";
            case 'товар доставлен':
                $status = setting('color.delivered');
                $color = $status ? 'white' : 'black';
                return "<div class='row'>
                            <div style='background-color: {$status};color: {$color};' class='btn btn-sm'>{$status_performed}</div>
                            </div>";
        }
    }
}
