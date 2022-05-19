<?php

namespace App\Http\Controllers;

use App\Models\StatusExtented;
use App\Services\ApplicationService;
use App\Services\ReportService;
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
        Cache::put('date_10',$request->date_10);
        Cache::put('date_5',$request->date_5);
        Cache::put('date_3_month',$request->date_3_month);
        Cache::put('date_4',$request->date_4);
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
        if($id == 3)
            return view('site.report.3');
        if($id == 4)
            return view('site.report.4');
        if($id == 5)
            return view('site.report.5');
        if($id == 7)
            return view('site.report.7');
        if($id == 10)
            return view('site.report.10');
    }
    public function report($id)
    {
        $new = new ReportService();
        if($id == 1)
            return $new->report_1();
        elseif($id == 2)
            return $new->report_2();
        elseif($id == 22)
            return $new->report_2_2();
        elseif($id == 3)
            return $new->report_3();
        elseif($id == 4)
            return $new->report_4();
        elseif($id == 5)
            return $new->report_5();
        elseif($id == 7)
            return $new->report_7();
        elseif($id == 10)
            return $new->report_10();
    }
}
