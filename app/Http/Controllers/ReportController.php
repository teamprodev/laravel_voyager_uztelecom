<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\Branch;
use App\Models\Subject;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;

class ReportController extends Controller
{
    public function index($id)
    {
        if($id == 1)
            return view('site.report.1');
        if($id == 2)
            return view('site.report.2');
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
            $start_date = Carbon::parse('2022-01-01')
                             ->toDateTimeString();

            $end_date = Carbon::parse('2022-03-31')
                             ->toDateTimeString();
            $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where('branch_initiator_id', $branch->id)->where('subject',1)->pluck('planned_price')->toArray();
            return array_sum($applications);
        })
        ->addColumn('rabota_1', function($branch){
            $start_date = Carbon::parse('2022-01-01')
                             ->toDateTimeString();

            $end_date = Carbon::parse('2022-03-31')
                             ->toDateTimeString();
            $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where('branch_initiator_id', $branch->id)->where('subject',2)->pluck('planned_price')->toArray();
            return array_sum($applications);
        })
        ->addColumn('usluga_1', function($branch){
            $start_date = Carbon::parse('2022-01-01')
                             ->toDateTimeString();

            $end_date = Carbon::parse('2022-03-31')
                             ->toDateTimeString();
            $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where('branch_initiator_id', $branch->id)->where('subject',3)->pluck('planned_price')->toArray();
            return array_sum($applications);
        })
        ->addColumn('tovar_2', function($branch){
            $start_date = Carbon::parse('2022-04-01')
                             ->toDateTimeString();

            $end_date = Carbon::parse('2022-06-31')
                             ->toDateTimeString();
            $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where('branch_initiator_id', $branch->id)->where('subject',1)->pluck('planned_price')->toArray();
            return array_sum($applications);
        })
        ->addColumn('rabota_2', function($branch){
            $start_date = Carbon::parse('2022-04-01')
                             ->toDateTimeString();

            $end_date = Carbon::parse('2022-06-31')
                             ->toDateTimeString();
            $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where('branch_initiator_id', $branch->id)->where('subject',2)->pluck('planned_price')->toArray();
            return array_sum($applications);
        })
        ->addColumn('usluga_2', function($branch){
            $start_date = Carbon::parse('2022-04-01')
                             ->toDateTimeString();

            $end_date = Carbon::parse('2022-06-31')
                             ->toDateTimeString();
            $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where('branch_initiator_id', $branch->id)->where('subject',3)->pluck('planned_price')->toArray();
            return array_sum($applications);
        })
        ->addColumn('tovar_3', function($branch){
            $start_date = Carbon::parse('2022-07-01')
                             ->toDateTimeString();

            $end_date = Carbon::parse('2022-09-31')
                             ->toDateTimeString();
            $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where('branch_initiator_id', $branch->id)->where('subject',1)->pluck('planned_price')->toArray();
            return array_sum($applications);
        })
        ->addColumn('rabota_3', function($branch){
            $start_date = Carbon::parse('2022-07-01')
                             ->toDateTimeString();

            $end_date = Carbon::parse('2022-09-31')
                             ->toDateTimeString();
            $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where('branch_initiator_id', $branch->id)->where('subject',2)->pluck('planned_price')->toArray();
            return array_sum($applications);
        })
        ->addColumn('usluga_3', function($branch){
            $start_date = Carbon::parse('2022-07-01')
                             ->toDateTimeString();

            $end_date = Carbon::parse('2022-09-31')
                             ->toDateTimeString();
            $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where('branch_initiator_id', $branch->id)->where('subject',3)->pluck('planned_price')->toArray();
            return array_sum($applications);
        })
        ->addColumn('tovar_4', function($branch){
            $start_date = Carbon::parse('2022-10-01')
                             ->toDateTimeString();

            $end_date = Carbon::parse('2022-12-31')
                             ->toDateTimeString();
            $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where('branch_initiator_id', $branch->id)->where('subject',1)->pluck('planned_price')->toArray();
            return array_sum($applications);
        })
        ->addColumn('rabota_4', function($branch){
            $start_date = Carbon::parse('2022-10-01')
                             ->toDateTimeString();

            $end_date = Carbon::parse('2022-12-31')
                             ->toDateTimeString();
            $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where('branch_initiator_id', $branch->id)->where('subject',2)->pluck('planned_price')->toArray();
            return array_sum($applications);
        })
        ->addColumn('usluga_4', function($branch){
            $start_date = Carbon::parse('2022-10-01')
                             ->toDateTimeString();

            $end_date = Carbon::parse('2022-12-31')
                             ->toDateTimeString();
            $applications = Application::whereBetween('created_at',[$start_date,$end_date])->where('branch_initiator_id', $branch->id)->where('subject',3)->pluck('planned_price')->toArray();
            return array_sum($applications);
        })
                ->make(true);
    }
}
