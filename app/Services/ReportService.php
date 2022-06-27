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
        if(auth()->user()->hasPermission('ЦУЗ'))
        {

            $query = Application::query();
        }else{
            $query = Application::where('branch_initiator_id',auth()->user()->branch_id)->get();
        }
        return Datatables::of($query)
            ->addColumn('name', function($application)
            {
                return $application->name ? $application->name:'';
            })
            ->editColumn('branch_initiator_id', function($application)
            {
                return $application->branch ? $application->branch->name:"";
            })
            ->editColumn('performer_leader_user_id', function($application)
            {
                return $application->performer_leader_user_id ? $application->performer_leader->name:"";
            })
            ->editColumn('performer_user_id', function($application)
            {
                return $application->performer_user_id ? $application->performer->name:"";
            })
            ->editColumn('department_initiator_id', function($application)
            {
                return $application->department_initiator_id ? $application->department->name:"";
            })
            ->addColumn('phone', function($application)
            {
                return $application->user->phone ? $application->user->phone:"Not Phone Number";
            })
            ->editColumn('user_id', function($application)
            {
                return $application->user->name;
            })
            ->editColumn('type_of_purchase_id', function($application)
            {
                return $application->type_of_purchase_id ? $application->purchase->name:'';
            })
            ->editColumn('subject', function($application)
            {
                return $application->subject ? $application->subjects->name:'';
            })
            ->editColumn('with_nds', function($application)
            {
                return $application->with_nds ?'Да':'Нет';
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
            ->editColumn('resource_id', function($application)
            {
                if($application->resource_id != null)
                {
                    foreach (json_decode($application->resource_id) as $product)
                    {
                        $all[] = Resource::find($product)->name;
                    }
                    return $all;
                }

            })
            ->addColumn('tovar_1', function($branch)
            {
                $date = Cache::get('date_3_month');
                $start_date = Carbon::parse("{$date}-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-31")
                    ->toDateTimeString();
                $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where('branch_initiator_id', $branch->id)->where('subject',1)->where('with_nds','=',null)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })
            ->rawColumns(['status'])
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

    public function report_6()
    {
        if(auth()->user()->hasPermission('ЦУЗ'))
        {

            $query = Application::query();
        }else{
            $query = Application::where('branch_initiator_id',auth()->user()->branch_id)->get();
        }
        return Datatables::of($query)
            ->addColumn('name', function($branch){
                $applications = Branch::where('id', $branch->branch_initiator_id)->get()->pluck('name');
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
            })->make(true);

    }

    public function report_7(){
        if(auth()->user()->hasPermission('ЦУЗ'))
        {

            $query = Application::query();
        }else{
            $query = Application::where('branch_initiator_id',auth()->user()->branch_id)->get();
        }
        return Datatables::of($query)
            ->addColumn('name', function($branch){
                $applications = Branch::where('id', $branch->branch_initiator_id)->get()->pluck('name');
                $json = json_encode($applications,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
                return trim($json, '[], "');
            })
            ->addColumn('type_of_purchase', function($branch){
                $applications = Purchase::where('id', $branch->type_of_purchase_id)->get()->pluck('name');
                $json = json_encode($applications,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
                return trim($json, '[], "');
            })

            ->make(true);
    }
    public function report_8(){
        if(auth()->user()->hasPermission('ЦУЗ'))
        {

            $query = Application::query();
        }else{
            $query = Application::where('branch_initiator_id',auth()->user()->branch_id)->get();
        }
        return Datatables::of($query)
            ->addColumn('initiator', function($branch){
                $applications = User::where('id', $branch->user_id)->get()->pluck('name');
                $json = json_encode($applications,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
                return trim($json, '[], "');
            })
            ->editColumn('created_at', function ($query) {
                return $query->created_at ? with(new Carbon($query->created_at))->format('d-m-Y') : '';
            })
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

    public function report_9()
    {
        if(auth()->user()->hasPermission('ЦУЗ'))
        {
            $query = Branch::query();
        }
        else{
            $query = Branch::where('id',auth()->user()->branch_id)->get();
        }

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
        $this->a = $a;
        $this->operator = $operator;
        $this->b = $b;
        $status = StatusExtented::query();
        return Datatables::of($status)
            ->addColumn('january', function($status){
                $date = Cache::get('date_10');
                $start_date = Carbon::parse("{$date}-01-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-01-31")
                    ->toDateTimeString();
                $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where($this->a,$this->operator,$this->b)->where('status', $status->name)->get();
                return count($applications);
            })
            ->addColumn('february', function($status){
                $date = Cache::get('date_10');
                $start_date = Carbon::parse("{$date}-02-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-02-31")
                    ->toDateTimeString();
                $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where($this->a,$this->operator,$this->b)->where('status', $status->name)->get();
                return count($applications);
            })
            ->addColumn('march', function($status){
                $date = Cache::get('date_10');
                $start_date = Carbon::parse("{$date}-03-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-03-31")
                    ->toDateTimeString();
                $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where($this->a,$this->operator,$this->b)->where('status', $status->name)->get();
                return count($applications);
            })
            ->addColumn('april', function($status){
                $date = Cache::get('date_10');
                $start_date = Carbon::parse("{$date}-04-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-04-31")
                    ->toDateTimeString();
                $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where($this->a,$this->operator,$this->b)->where('status', $status->name)->get();
                return count($applications);
            })
            ->addColumn('may', function($status){
                $date = Cache::get('date_10');
                $start_date = Carbon::parse("{$date}-05-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-05-31")
                    ->toDateTimeString();
                $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where($this->a,$this->operator,$this->b)->where('status', $status->name)->get();
                return count($applications);
            })
            ->addColumn('june', function($status){
                $date = Cache::get('date_10');
                $start_date = Carbon::parse("{$date}-06-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-06-31")
                    ->toDateTimeString();
                $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where($this->a,$this->operator,$this->b)->where('status', $status->name)->get();
                return count($applications);
            })
            ->addColumn('july', function($status){
                $date = Cache::get('date_10');
                $start_date = Carbon::parse("{$date}-07-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-07-31")
                    ->toDateTimeString();
                $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where($this->a,$this->operator,$this->b)->where('status', $status->name)->get();
                return count($applications);
            })
            ->addColumn('august', function($status){
                $date = Cache::get('date_10');
                $start_date = Carbon::parse("{$date}-08-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-08-31")
                    ->toDateTimeString();
                $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where($this->a,$this->operator,$this->b)->where('status', $status->name)->get();
                return count($applications);
            })
            ->addColumn('september', function($status){
                $date = Cache::get('date_10');
                $start_date = Carbon::parse("{$date}-09-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-09-31")
                    ->toDateTimeString();
                $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where($this->a,$this->operator,$this->b)->where('status', $status->name)->get();
                return count($applications);
            })
            ->addColumn('october', function($status){
                $date = Cache::get('date_10');
                $start_date = Carbon::parse("{$date}-10-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-10-31")
                    ->toDateTimeString();
                $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where($this->a,$this->operator,$this->b)->where('status', $status->name)->get();
                return count($applications);
            })
            ->addColumn('november', function($status){
                $date = Cache::get('date_10');
                $start_date = Carbon::parse("{$date}-11-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-11-31")
                    ->toDateTimeString();
                $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where($this->a,$this->operator,$this->b)->where('status', $status->name)->get();
                return count($applications);
            })
            ->addColumn('december', function($status){
                $date = Cache::get('date_10');
                $start_date = Carbon::parse("{$date}-12-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-12-31")
                    ->toDateTimeString();
                $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where($this->a,$this->operator,$this->b)->where('status', $status->name)->get();
                return count($applications);
            })
            ->addColumn('all', function($status){
                $date = Cache::get('date_10');
                $start_date = Carbon::parse("{$date}-12-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-12-31")
                    ->toDateTimeString();
                $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where($this->a,$this->operator,$this->b)->where('status', $status->name)->get();
                return count($applications);
            })
            ->make(true);
    }
}

