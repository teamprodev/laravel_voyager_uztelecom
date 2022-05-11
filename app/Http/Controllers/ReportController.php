<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\Branch;
use App\Models\Subject;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Yajra\DataTables\DataTables;

class ReportController extends Controller
{
    public function request(Request $request)
    {
        Cache::put('date',$request->date);
        Cache::put('date_2',$request->date_2);
        return redirect()->back();
    }
    public function index($id)
    {
        if($id == 1)
            return view('site.report.1');
        if($id == 2)
            return view('site.report.2');
        if($id == 22)
            return view('site.report.2_2');
    }
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
            $start_date = Carbon::parse("{$date}-01-01")
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
}
