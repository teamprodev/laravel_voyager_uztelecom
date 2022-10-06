<?php

namespace App\Http\Controllers;

use App\Enums\ApplicationMagicNumber;
use App\Models\StatusExtended;
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
    const Quarterly_Planned_Report = 22;
    const Report_Statuses_Quantity = 10;

    private ReportService $service;

    public function __construct(ReportService $service)
    {
        $this->middleware('auth');
        $this->service = $service;
    }
    /**
     * Request da Reportlar date keladi.
     * Shuni Cache ga put qiladi.
    **/
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
    /**
     * Nechinchi Reportligiga qarab blade korsatiladi.
     **/
    public function index($id)
    {
            if($id == self::Quarterly_Planned_Report)
                return view("site.report.{$id}");
            elseif($id < self::Report_Statuses_Quantity){
                return view("site.report.{$id}");
            }
            return view("site.report.10");
    }
    /**
     * Nechinchi Report ligiga qarab data chiqadi.
     **/
    public function report($id)
    {
        switch ($id)
        {
            case ApplicationMagicNumber::one:
            return $this->service->report_1();
            break;
            case ApplicationMagicNumber::two:
            return $this->service->report_2();
            break;
            case ApplicationMagicNumber::twentyTwo:
            return $this->service->report_2_2();
            break;
            case ApplicationMagicNumber::three:
            return $this->service->report_3();
            break;
            case ApplicationMagicNumber::four:
            return $this->service->report_4();
            break;
            case ApplicationMagicNumber::five:
            return $this->service->report_5();
            break;
            case ApplicationMagicNumber::six:
            return $this->service->report_6();
            break;
            case ApplicationMagicNumber::seven:
            return $this->service->report_7();
            break;
            case ApplicationMagicNumber::eight:
            return $this->service->report_8();
            break;
            case ApplicationMagicNumber::nine:
            return $this->service->report_9();
            break;
            default:
            return $this->service->report_10();
        }


    }
}
