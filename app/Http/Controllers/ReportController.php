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
    private ReportService $service;

    public function __construct(ReportService $service)
    {
        $this->middleware('auth');
        $this->service = $service;
    }
    public function request(Request $request)
    {
        Cache::put('date',$request->date);
        Cache::put('date_2',$request->date_2);
        Cache::put('date_10',$request->date_10);
        Cache::put('date_5',$request->date_5);
        Cache::put('date_6',$request->date_6);
        Cache::put('date_9',$request->date_9);
        Cache::put('date_3_month',$request->date_3_month);
        Cache::put('date_4',$request->date_4);
        return redirect()->back();
    }
    public function index($id)
    {
            if($id <= 10 && $id != 22)
                return view("site.report.{$id}");
            return view("site.report.10");
    }
    public function report($id)
    {
        switch ($id)
        {
            case 1:
            return $this->service->report_1();
            break;
            case 2:
            return $this->service->report_2();
            break;
            case 22:
            return $this->service->report_2_2();
            break;
            case 3:
            return $this->service->report_3();
            break;
            case 4:
            return $this->service->report_4();
            break;
            case 5:
            return $this->service->report_5();
            break;

            case 6:
            return $this->service->report_6();
            break;

            case 7:
            return $this->service->report_7();
            break;
            case 8:
            return $this->service->report_8();
            break;

            case 9:
            return $this->service->report_9();
            break;

            default:
            return $this->service->report_10();
        }


    }
}
