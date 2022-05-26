<?php


namespace App\Services;
use function PHPUnit\Framework\returnSelf;

use App\Events\Notify;
use App\Http\Controllers\ReportController;
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
use DateTime;
use GuzzleHttp\Client;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use App\Models\Country;
use App\Models\Purchase;
use App\Models\Roles;
use App\Models\Subject;
use Illuminate\Support\Facades\Http;
use Psy\Util\Json;
use Yajra\DataTables\DataTables;

class ReportService
{
    public function report_1()
    {
        if(auth()->user()->hasPermission('ЦУЗ'))
        {
            $query = Branch::query();
        }
        else{
            $query = Branch::where('id',auth()->user()->branch_id)->get();
        }
        return Datatables::of($query)
            ->addColumn('count', function($branch){
                $applications = Application::where('branch_initiator_id', $branch->id)->get();
                return count($applications);
            })
            ->addColumn('tovar', function($branch){
                $applications = Application::where('branch_initiator_id', $branch->id)->where('subject',1)->get();
                return count($applications);
            })
            ->addColumn('rabota', function($branch){
                $applications = Application::where('branch_initiator_id', $branch->id)->where('subject',2)->get();
                return count($applications);
            })
            ->addColumn('usluga', function($branch){
                $applications = Application::where('branch_initiator_id', $branch->id)->where('subject',3)->get();
                return count($applications);
            })
            ->addColumn('summa', function($branch){
                $applications = Application::where('branch_initiator_id', $branch->id)->where('with_nds', '=',null)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('nds', function($branch){
                $applications = Application::where('branch_initiator_id', $branch->id)->where('with_nds', '!=',null)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })
            ->make(true);
    }
    public function report_2()
    {
        if(auth()->user()->hasPermission('ЦУЗ'))
        {
            $query = Branch::query();
        }
        else{
            $query = Branch::where('id',auth()->user()->branch_id)->get();
        }
        return Datatables::of($query)
            ->addColumn('tovar_1', function($branch){
                $date = Cache::get('date');
                $start_date = \Carbon\Carbon::parse("{$date}-01-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-03-31")
                    ->toDateTimeString();
                $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where('branch_initiator_id', $branch->id)->where('subject',1)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('rabota_1', function($branch){
                $date = Cache::get('date');
                $start_date = Carbon::parse("{$date}-01-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-03-31")
                    ->toDateTimeString();
                $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where('branch_initiator_id', $branch->id)->where('subject',2)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('usluga_1', function($branch){
                $date = Cache::get('date');
                $start_date = Carbon::parse("{$date}-01-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-03-31")
                    ->toDateTimeString();
                $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where('branch_initiator_id', $branch->id)->where('subject',3)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('tovar_2', function($branch){
                $date = Cache::get('date');
                $start_date = Carbon::parse("{$date}-04-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-06-31")
                    ->toDateTimeString();
                $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where('branch_initiator_id', $branch->id)->where('subject',1)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('rabota_2', function($branch){
                $date = Cache::get('date');
                $start_date = Carbon::parse("{$date}-04-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-06-31")
                    ->toDateTimeString();
                $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where('branch_initiator_id', $branch->id)->where('subject',2)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('usluga_2', function($branch){
                $date = Cache::get('date');
                $start_date = Carbon::parse("{$date}-04-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-06-31")
                    ->toDateTimeString();
                $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where('branch_initiator_id', $branch->id)->where('subject',3)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('tovar_3', function($branch){
                $date = Cache::get('date');
                $start_date = Carbon::parse("{$date}-07-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-09-31")
                    ->toDateTimeString();
                $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where('branch_initiator_id', $branch->id)->where('subject',1)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('rabota_3', function($branch){
                $date = Cache::get('date');
                $start_date = Carbon::parse("{$date}-07-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-09-31")
                    ->toDateTimeString();
                $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where('branch_initiator_id', $branch->id)->where('subject',2)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('usluga_3', function($branch){
                $date = Cache::get('date');
                $start_date = Carbon::parse("{$date}-07-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-09-31")
                    ->toDateTimeString();
                $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where('branch_initiator_id', $branch->id)->where('subject',3)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('tovar_4', function($branch){
                $date = Cache::get('date');
                $start_date = Carbon::parse("{$date}-10-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-12-31")
                    ->toDateTimeString();
                $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where('branch_initiator_id', $branch->id)->where('subject',1)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('rabota_4', function($branch){
                $date = Cache::get('date');
                $start_date = Carbon::parse("{$date}-10-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-12-31")
                    ->toDateTimeString();
                $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where('branch_initiator_id', $branch->id)->where('subject',2)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('usluga_4', function($branch){
                $date = Cache::get('date');
                $start_date = Carbon::parse("{$date}-10-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-12-31")
                    ->toDateTimeString();
                $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where('branch_initiator_id', $branch->id)->where('subject',3)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })
            ->make(true);
    }
    public function report_2_2()
    {
        if(auth()->user()->hasPermission('ЦУЗ'))
        {
            $query = Branch::query();
        }
        else{
            $query = Branch::where('id',auth()->user()->branch_id)->get();
        }
        return Datatables::of($query)
            ->addColumn('tovar_1', function($branch){
                $date = Cache::get('date_2');
                $start_date = Carbon::parse("{$date}-01-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-03-31")
                    ->toDateTimeString();
                $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where('branch_initiator_id', $branch->id)->where('subject',1)->where('with_nds','=',null)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('tovar_1_nds', function($branch){
                $date = Cache::get('date_2');
                $start_date = Carbon::parse("{$date}-01-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-03-31")
                    ->toDateTimeString();
                $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where('branch_initiator_id', $branch->id)->where('subject',1)->where('with_nds','!=',null)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })

            ->addColumn('rabota_1', function($branch){
                $date = Cache::get('date_2');
                $start_date = Carbon::parse("{$date}-01-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-03-31")
                    ->toDateTimeString();
                $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where('branch_initiator_id', $branch->id)->where('subject',2)->where('with_nds','=',null)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('rabota_1_nds', function($branch){
                $date = Cache::get('date_2');
                $start_date = Carbon::parse("{$date}-01-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-03-31")
                    ->toDateTimeString();
                $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where('branch_initiator_id', $branch->id)->where('subject',2)->where('with_nds','!=',null)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('usluga_1', function($branch){
                $date = Cache::get('date_2');
                $start_date = Carbon::parse("{$date}-01-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-03-31")
                    ->toDateTimeString();
                $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where('branch_initiator_id', $branch->id)->where('subject',3)->where('with_nds','=',null)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('usluga_1_nds', function($branch){
                $date = Cache::get('date_2');
                $start_date = Carbon::parse("{$date}-01-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-03-31")
                    ->toDateTimeString();
                $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where('branch_initiator_id', $branch->id)->where('subject',3)->where('with_nds','!=',null)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('tovar_2', function($branch){
                $date = Cache::get('date_2');
                $start_date = Carbon::parse("{$date}-04-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-06-31")
                    ->toDateTimeString();
                $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where('branch_initiator_id', $branch->id)->where('subject',1)->where('with_nds','=',null)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('tovar_2_nds', function($branch){
                $date = Cache::get('date_2');
                $start_date = Carbon::parse("{$date}-04-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-06-31")
                    ->toDateTimeString();
                $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where('branch_initiator_id', $branch->id)->where('subject',1)->where('with_nds','!=',null)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('rabota_2', function($branch){
                $date = Cache::get('date_2');
                $start_date = Carbon::parse("{$date}-04-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-06-31")
                    ->toDateTimeString();
                $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where('branch_initiator_id', $branch->id)->where('subject',2)->where('with_nds','=',null)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('rabota_2_nds', function($branch){
                $date = Cache::get('date_2');
                $start_date = Carbon::parse("{$date}-04-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-06-31")
                    ->toDateTimeString();
                $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where('branch_initiator_id', $branch->id)->where('subject',2)->where('with_nds','!=',null)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('usluga_2', function($branch){
                $date = Cache::get('date_2');
                $start_date = Carbon::parse("{$date}-04-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-06-31")
                    ->toDateTimeString();
                $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where('branch_initiator_id', $branch->id)->where('subject',3)->where('with_nds','=',null)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('usluga_2_nds', function($branch){
                $date = Cache::get('date_2');
                $start_date = Carbon::parse("{$date}-04-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-06-31")
                    ->toDateTimeString();
                $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where('branch_initiator_id', $branch->id)->where('subject',3)->where('with_nds','!=',null)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('tovar_3', function($branch){
                $date = Cache::get('date_2');
                $start_date = Carbon::parse("{$date}-07-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-09-31")
                    ->toDateTimeString();
                $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where('branch_initiator_id', $branch->id)->where('subject',1)->where('with_nds','=',null)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('tovar_3_nds', function($branch){
                $date = Cache::get('date_2');
                $start_date = Carbon::parse("{$date}-07-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-09-31")
                    ->toDateTimeString();
                $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where('branch_initiator_id', $branch->id)->where('subject',1)->where('with_nds','!=',null)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('rabota_3', function($branch){
                $date = Cache::get('date_2');
                $start_date = Carbon::parse("{$date}-07-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-09-31")
                    ->toDateTimeString();
                $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where('branch_initiator_id', $branch->id)->where('subject',2)->where('with_nds','=',null)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('rabota_3_nds', function($branch){
                $date = Cache::get('date_2');
                $start_date = Carbon::parse("{$date}-07-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-09-31")
                    ->toDateTimeString();
                $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where('branch_initiator_id', $branch->id)->where('subject',2)->where('with_nds','!=',null)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('usluga_3', function($branch){
                $date = Cache::get('date_2');
                $start_date = Carbon::parse("{$date}-07-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-09-31")
                    ->toDateTimeString();
                $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where('branch_initiator_id', $branch->id)->where('subject',3)->where('with_nds','=',null)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('usluga_3_nds', function($branch){
                $date = Cache::get('date_2');
                $start_date = Carbon::parse("{$date}-07-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-09-31")
                    ->toDateTimeString();
                $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where('branch_initiator_id', $branch->id)->where('subject',3)->where('with_nds','!=',null)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('tovar_4', function($branch){
                $date = Cache::get('date_2');
                $start_date = Carbon::parse("{$date}-10-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-12-31")
                    ->toDateTimeString();
                $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where('branch_initiator_id', $branch->id)->where('subject',1)->where('with_nds','=',null)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('tovar_4_nds', function($branch){
                $date = Cache::get('date_2');
                $start_date = Carbon::parse("{$date}-10-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-12-31")
                    ->toDateTimeString();
                $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where('branch_initiator_id', $branch->id)->where('subject',1)->where('with_nds','!=',null)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('rabota_4', function($branch){
                $date = Cache::get('date_2');
                $start_date = Carbon::parse("{$date}-10-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-12-31")
                    ->toDateTimeString();
                $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where('branch_initiator_id', $branch->id)->where('subject',2)->where('with_nds','!=',null)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('rabota_4_nds', function($branch){
                $date = Cache::get('date_2');
                $start_date = Carbon::parse("{$date}-10-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-12-31")
                    ->toDateTimeString();
                $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where('branch_initiator_id', $branch->id)->where('subject',2)->where('with_nds','!=',null)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('usluga_4', function($branch){
                $date = Cache::get('date_2');
                $start_date = Carbon::parse("{$date}-10-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-12-31")
                    ->toDateTimeString();
                $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where('branch_initiator_id', $branch->id)->where('subject',3)->where('with_nds','=',null)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('usluga_4_nds', function($branch){
                $date = Cache::get('date_2');
                $start_date = Carbon::parse("{$date}-10-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-12-31")
                    ->toDateTimeString();
                $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where('branch_initiator_id', $branch->id)->where('subject',3)->where('with_nds','!=',null)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })
            ->make(true);
    }
    public function report_3()
    {
        if(auth()->user()->hasPermission('ЦУЗ'))
        {
            $query = Branch::query();
        }
        else{
            $query = Branch::where('id',auth()->user()->branch_id)->get();
        }
        return Datatables::of($query)
            ->addColumn('tovar_1', function($branch){
                $date = Cache::get('date_3_month');
                $start_date = Carbon::parse("{$date}-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-31")
                    ->toDateTimeString();
                $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where('branch_initiator_id', $branch->id)->where('subject',1)->where('with_nds','=',null)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('tovar_1_nds', function($branch){
                $date = Cache::get('date_3_month');
                $start_date = Carbon::parse("{$date}-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-31")
                    ->toDateTimeString();
                $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where('branch_initiator_id', $branch->id)->where('subject',1)->where('with_nds','!=',null)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })

            ->addColumn('rabota_1', function($branch){
                $date = Cache::get('date_3_month');
                $start_date = Carbon::parse("{$date}-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-31")
                    ->toDateTimeString();
                $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where('branch_initiator_id', $branch->id)->where('subject',2)->where('with_nds','=',null)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('rabota_1_nds', function($branch){
                $date = Cache::get('date_3_month');
                $start_date = Carbon::parse("{$date}-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-31")
                    ->toDateTimeString();
                $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where('branch_initiator_id', $branch->id)->where('subject',2)->where('with_nds','!=',null)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('usluga_1', function($branch){
                $date = Cache::get('date_3_month');
                $start_date = Carbon::parse("{$date}-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-31")
                    ->toDateTimeString();
                $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where('branch_initiator_id', $branch->id)->where('subject',3)->where('with_nds','=',null)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('usluga_1_nds', function($branch){
                $date = Cache::get('date_3_month');
                $start_date = Carbon::parse("{$date}-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-31")
                    ->toDateTimeString();
                $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where('branch_initiator_id', $branch->id)->where('subject',3)->where('with_nds','!=',null)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })
            ->make(true);
    }

    public function report_4()
    {
        $query = Application::query();
        return Datatables::of($query)
            ->addColumn('type_of_purchase', function($branch){
                $applications = Purchase::where('id', $branch->type_of_purchase_id)->get()->pluck('name');
                $json = json_encode($applications,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
                return trim($json, '[], "');
            })
            ->addColumn('tovar_1', function($branch){
                $date = Cache::get('date_3_month');
                $start_date = Carbon::parse("{$date}-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-31")
                    ->toDateTimeString();
                $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where('branch_initiator_id', $branch->id)->where('subject',1)->where('with_nds','=',null)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })
            ->make(true);
    }

    public function report_5()
    {
        if(auth()->user()->hasPermission('ЦУЗ'))
        {
            $query = Branch::query();
        }
        else{
            $query = Branch::where('id',auth()->user()->branch_id)->get();
        }
        return Datatables::of($query)
            ->addColumn('count', function($branch){
                $date = Cache::get('date_5');
                $start_date = \Carbon\Carbon::parse("{$date}-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-31")
                    ->toDateTimeString();
                $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where('branch_initiator_id', $branch->id)->where('currency','!=','USD')->get();
                return count($applications);
            })
            ->addColumn('summa', function($branch){
                $date = Cache::get('date_5');
                $start_date = \Carbon\Carbon::parse("{$date}-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-31")
                    ->toDateTimeString();
                $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where('branch_initiator_id', $branch->id)->where('currency','!=','USD')->pluck('contract_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('count_1', function($branch){
                $date = Cache::get('date_5');
                $start_date = \Carbon\Carbon::parse("{$date}-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-31")
                    ->toDateTimeString();
                $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where('branch_initiator_id', $branch->id)->where('currency','!=','USD')->where('subject',1)->get();
                return count($applications);
            })
            ->addColumn('summa_1', function($branch){
                $date = Cache::get('date_5');
                $start_date = \Carbon\Carbon::parse("{$date}-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-31")
                    ->toDateTimeString();
                $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where('branch_initiator_id', $branch->id)->where('currency','!=','USD')->where('subject',1)->pluck('contract_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('count_2', function($branch){
                $date = Cache::get('date_5');
                $start_date = \Carbon\Carbon::parse("{$date}-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-31")
                    ->toDateTimeString();
                $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where('branch_initiator_id', $branch->id)->where('currency','!=','USD')->where('subject',2)->get();
                return count($applications);
            })
            ->addColumn('summa_2', function($branch){
                $date = Cache::get('date_5');
                $start_date = \Carbon\Carbon::parse("{$date}-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-31")
                    ->toDateTimeString();
                $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where('branch_initiator_id', $branch->id)->where('currency','!=','USD')->where('subject',2)->pluck('contract_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('count_3', function($branch){
                $date = Cache::get('date_5');
                $start_date = \Carbon\Carbon::parse("{$date}-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-31")
                    ->toDateTimeString();
                $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where('branch_initiator_id', $branch->id)->where('currency','!=','USD')->where('subject',3)->get();
                return count($applications);
            })
            ->addColumn('summa_3', function($branch){
                $date = Cache::get('date_5');
                $start_date = \Carbon\Carbon::parse("{$date}-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-31")
                    ->toDateTimeString();
                $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where('branch_initiator_id', $branch->id)->where('currency','!=','USD')->where('subject',3)->pluck('contract_price')->toArray();
                return array_sum($applications);
            })
            ->make(true);
    }

    public function report_6(){
        $query = Application::query();
        return Datatables::of($query)
            ->addColumn('name', function($branch){
                $applications = Branch::where('id', $branch->branch_initiator_id)->get()->pluck('name');
                $json = json_encode($applications,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
                return trim($json, '[], "');
            })
            ->make(true);

    }

    public function report_7(){
        $query = Application::query();
        return Datatables::of($query)
            ->addColumn('name', function($branch){
                $applications = Branch::where('id', $branch->branch_initiator_id)->get()->pluck('name');
                $json = json_encode($applications,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
                return trim($json, '[], "');
            })
            ->make(true);
    }
    public function report_8(){
        $query = Application::query();
        return Datatables::of($query)
            ->addColumn('filial', function($branch){
                $applications = Branch::where('id', $branch->branch_initiator_id)->get()->pluck('name');
                $json = json_encode($applications,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
                return trim($json, '[], "');
            })
            ->addColumn('type_of_purchase', function($branch){
                $applications = Purchase::where('id', $branch->type_of_purchase_id)->get()->pluck('name');
                $json = json_encode($applications,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
                return trim($json, '[], "');
            })
            ->addColumn('product', function($application){
                $product = json_decode($application->resource_id,true);
                $names = collect($product);
                $ucnames = $names->map(function($item, $key) {
                    return Resource::find($item)->name;
                });
                return json_decode($ucnames);
            })
            ->editColumn('performer_user_id', function($application){
                return $application->performer_user_id ?$application->performer->name:'';
            })
            ->make(true);
    }

    public function report_9(){
        $query = Branch::query();

        return Datatables::of($query)
            ->addColumn('supplier_inn', function($branch){
                return Application::where('branch_initiator_id', $branch->id)->get()->pluck('supplier_inn')->toArray();
            })
            ->addColumn('contract_count', function($branch){
                $applications = Application::where('branch_initiator_id', $branch->id)->where('contract_price','!=', null)->get();
                return count($applications);
            })
            ->addColumn('contract_sum', function($branch){
                $applications = Application::where('branch_initiator_id', $branch->id)->pluck('contract_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('eshop_count', function($branch){
                $applications = Application::where('branch_initiator_id', $branch->id)->where('type_of_purchase_id', 3)->get();
                return count($applications);
            })
            ->addColumn('eshop_sum', function($branch){
                $applications = Application::where('branch_initiator_id', $branch->id)->where('type_of_purchase_id', 3)->pluck('contract_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('nat_eshop_count', function($branch){
                $applications = Application::where('branch_initiator_id', $branch->id)->where('type_of_purchase_id', 7)->get();
                return count($applications);
            })
            ->addColumn('nat_eshop_sum', function($branch){
                $applications = Application::where('branch_initiator_id', $branch->id)->where('type_of_purchase_id', 7)->pluck('contract_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('auction_count', function($branch){
                $applications = Application::where('branch_initiator_id', $branch->id)->where('type_of_purchase_id', 4)->get();
                return count($applications);
            })
            ->addColumn('auction_sum', function($branch){
                $applications = Application::where('branch_initiator_id', $branch->id)->where('type_of_purchase_id', 4)->pluck('contract_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('coop_portal_count', function($branch){
                $applications = Application::where('branch_initiator_id', $branch->id)->where('type_of_purchase_id', 5)->get();
                return count($applications);
            })
            ->addColumn('coop_portal_sum', function($branch){
                $applications = Application::where('branch_initiator_id', $branch->id)->where('type_of_purchase_id', 5)->pluck('contract_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('tender_platform_count', function($branch){
                $applications = Application::where('branch_initiator_id', $branch->id)->where('type_of_purchase_id', 10)->get();
                return count($applications);
            })
            ->addColumn('tender_platform_sum', function($branch){
                $applications = Application::where('branch_initiator_id', $branch->id)->where('type_of_purchase_id', 10)->pluck('contract_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('exchange_count', function($branch){
                $applications = Application::where('branch_initiator_id', $branch->id)->where('type_of_purchase_id', 11)->get();
                return count($applications);
            })
            ->addColumn('exchange_sum', function($branch){
                $applications = Application::where('branch_initiator_id', $branch->id)->where('type_of_purchase_id', 11)->pluck('contract_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('konkurs_count', function($branch){
                $applications = Application::where('branch_initiator_id', $branch->id)->where('type_of_purchase_id', 6)->get();
                return count($applications);
            })
            ->addColumn('konkurs_sum', function($branch){
                $applications = Application::where('branch_initiator_id', $branch->id)->where('type_of_purchase_id', 6)->pluck('contract_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('tender_count', function($branch){
                $applications = Application::where('branch_initiator_id', $branch->id)->where('type_of_purchase_id', 1)->get();
                return count($applications);
            })
            ->addColumn('tender_sum', function($branch){
                $applications = Application::where('branch_initiator_id', $branch->id)->where('type_of_purchase_id', 1)->pluck('contract_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('otbor_count', function($branch){
                $applications = Application::where('branch_initiator_id', $branch->id)->where('type_of_purchase_id', 2)->get();
                return count($applications);
            })
            ->addColumn('otbor_sum', function($branch){
                $applications = Application::where('branch_initiator_id', $branch->id)->where('type_of_purchase_id', 2)->pluck('contract_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('sole_supplier_count', function($branch){
                $applications = Application::where('branch_initiator_id', $branch->id)->where('type_of_purchase_id', 14)->get();
                return count($applications);
            })
            ->addColumn('sole_supplier_sum', function($branch){
                $applications = Application::where('branch_initiator_id', $branch->id)->where('type_of_purchase_id', 14)->pluck('contract_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('direct_count', function($branch){
                $applications = Application::where('branch_initiator_id', $branch->id)->where('type_of_purchase_id', 16)->get();
                return count($applications);
            })
            ->addColumn('direct_sum', function($branch){
                $applications = Application::where('branch_initiator_id', $branch->id)->where('type_of_purchase_id', 16)->pluck('contract_price')->toArray();
                return array_sum($applications);
            })
            ->make(true);
    }

    public function report_10()
    {
        $status = StatusExtented::query();
        return Datatables::of($status)
            ->addColumn('january', function($status){
                $date = Cache::get('date_10');
                $start_date = Carbon::parse("{$date}-01-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-01-31")
                    ->toDateTimeString();
                $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where('status', $status->name)->get();
                return count($applications);
            })
            ->addColumn('february', function($status){
                $date = Cache::get('date_10');
                $start_date = Carbon::parse("{$date}-02-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-02-31")
                    ->toDateTimeString();
                $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where('status', $status->name)->get();
                return count($applications);
            })
            ->addColumn('march', function($status){
                $date = Cache::get('date_10');
                $start_date = Carbon::parse("{$date}-03-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-03-31")
                    ->toDateTimeString();
                $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where('status', $status->name)->get();
                return count($applications);
            })
            ->addColumn('april', function($status){
                $date = Cache::get('date_10');
                $start_date = Carbon::parse("{$date}-04-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-04-31")
                    ->toDateTimeString();
                $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where('status', $status->name)->get();
                return count($applications);
            })
            ->addColumn('may', function($status){
                $date = Cache::get('date_10');
                $start_date = Carbon::parse("{$date}-05-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-05-31")
                    ->toDateTimeString();
                $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where('status', $status->name)->get();
                return count($applications);
            })
            ->addColumn('june', function($status){
                $date = Cache::get('date_10');
                $start_date = Carbon::parse("{$date}-06-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-06-31")
                    ->toDateTimeString();
                $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where('status', $status->name)->get();
                return count($applications);
            })
            ->addColumn('july', function($status){
                $date = Cache::get('date_10');
                $start_date = Carbon::parse("{$date}-07-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-07-31")
                    ->toDateTimeString();
                $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where('status', $status->name)->get();
                return count($applications);
            })
            ->addColumn('august', function($status){
                $date = Cache::get('date_10');
                $start_date = Carbon::parse("{$date}-08-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-08-31")
                    ->toDateTimeString();
                $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where('status', $status->name)->get();
                return count($applications);
            })
            ->addColumn('september', function($status){
                $date = Cache::get('date_10');
                $start_date = Carbon::parse("{$date}-09-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-09-31")
                    ->toDateTimeString();
                $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where('status', $status->name)->get();
                return count($applications);
            })
            ->addColumn('october', function($status){
                $date = Cache::get('date_10');
                $start_date = Carbon::parse("{$date}-10-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-10-31")
                    ->toDateTimeString();
                $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where('status', $status->name)->get();
                return count($applications);
            })
            ->addColumn('november', function($status){
                $date = Cache::get('date_10');
                $start_date = Carbon::parse("{$date}-11-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-11-31")
                    ->toDateTimeString();
                $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where('status', $status->name)->get();
                return count($applications);
            })
            ->addColumn('december', function($status){
                $date = Cache::get('date_10');
                $start_date = Carbon::parse("{$date}-12-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-12-31")
                    ->toDateTimeString();
                $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where('status', $status->name)->get();
                return count($applications);
            })
            ->addColumn('all', function($status){
                $date = Cache::get('date_10');
                $start_date = Carbon::parse("{$date}-12-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-12-31")
                    ->toDateTimeString();
                $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where('status', $status->name)->get();
                return count($applications);
            })
            ->make(true);
    }
//    public function report_9()
//    {
//        $query = Application::query();
//        return Datatables::of($query)
//            ->addColumn('name', function($branch){
//                $applications = Branch::where('id', $branch->branch_initiator_id)->get()->pluck('name');
//                $json = json_encode($applications,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
//                return trim($json, '[], "');
//            })
//            ->addColumn('shartnomalar', function($application){
//                $applications = type_of_purchase::where('id', $applications->type_of_purchase_id)-where('type_of_purchase_id', 1,2,3,4,5,6,7,8,9,10)->get();
//                return count($applications)
//            })
//            ->addColumn('tender', function($application){
//                $applications = type_of_purchase::where('id', $applications->type_of_purchase_id)-where('type_of_purchase_id', 1)->get();
//                return count($applications)
//            })
//            ->addColumn('Otbor', function($application){
//                $applications = type_of_purchase::where('id', $applications->type_of_purchase_id)-where('type_of_purchase_id', 2)->get();
//                return count($applications)
//            })
//            ->addColumn('Eshop', function($application){
//                $applications = type_of_purchase::where('id', $applications->type_of_purchase_id)-where('type_of_purchase_id', 3)->get();
//                return count($applications)
//            })
//            ->addColumn('Elektron_auksiyon', function($application){
//                $applications = type_of_purchase::where('id', $applications->type_of_purchase_id)-where('type_of_purchase_id', 4)->get();
//                return count($applications)
//            })
//            ->addColumn('кооперационный_портал', function($application){
//                $applications = type_of_purchase::where('id', $applications->type_of_purchase_id)-where('type_of_purchase_id', 5)->get();
//                return count($applications)
//            })
//            ->addColumn('Konkrus', function($application){
//                $applications = type_of_purchase::where('id', $applications->type_of_purchase_id)-where('type_of_purchase_id', 6)->get();
//                return count($applications)
//            })
//            ->addColumn('электронный_магазин(E-Shop)', function($application){
//                $applications = type_of_purchase::where('id', $applications->type_of_purchase_id)-where('type_of_purchase_id', 7)->get();
//                return count($applications)
//            })
//            ->addColumn('тендер', function($application){
//                $applications = type_of_purchase::where('id', $applications->type_of_purchase_id)-where('type_of_purchase_id', 8)->get();
//                return count($applications)
//            })
//            ->addColumn('госзакупок_в_сфере_строительства', function($application){
//                $applications = type_of_purchase::where('id', $applications->type_of_purchase_id)-where('type_of_purchase_id', 9)->get();
//                return count($applications)
//            })
//            ->addColumn('через_электронные_биржевые_торги_на_специальных_торговых_площадках', function($application){
//                $applications = type_of_purchase::where('id', $applications->type_of_purchase_id)-where('type_of_purchase_id', 10)->get();
//                return count($applications)
//            })
//            ->make(true);
//
//
//    }
}

