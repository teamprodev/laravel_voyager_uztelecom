<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\Branch;
use App\Models\Subject;
use Yajra\DataTables\DataTables;

class ReportController extends Controller
{
    public function index($id)
    {
        if($id == 1)
            return view('site.report.1');
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
}
