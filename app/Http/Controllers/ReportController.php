<?php

namespace App\Http\Controllers;

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
        Cache::put('date_3_month',$request->date_3_month);
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
    }
}
