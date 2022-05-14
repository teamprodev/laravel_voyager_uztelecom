<?php


namespace App\Services;


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
use Yajra\DataTables\DataTables;

class ReportService
{
    public function report_1()
    {
        $query = Branch::query();
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
        $query = Branch::query();
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
        $query = Branch::query();
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
        $query = Branch::query();
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
}
