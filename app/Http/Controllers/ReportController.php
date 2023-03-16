<?php

namespace App\Http\Controllers;

use App\Enums\ApplicationMagicNumber;
use App\Http\Requests\ReportDateRequest;
use App\Models\ReportDate;
use App\Models\StatusExtended;
use App\Services\ApplicationService;
use App\Services\ReportExportService;
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
    private ReportExportService $exportService;

    public function __construct(ReportService $service, ReportExportService $exportService)
    {
        $this->middleware('auth');
        $this->service = $service;
        $this->exportService = $exportService;
    }
    /**
     * Request da Reportlar date keladi.
     * Shuni Cache ga put qiladi.
    **/
    public function request(ReportDateRequest $request)
    {
        $data = $request->validated();
        foreach($data as $key=>$value)
        {
            $report = ReportDate::UpdateOrCreate(['report_key' => $key]);
            $report->report_value = $value;
            $report->save();
        }
        return redirect()->back();
    }
    /**
     * Nechinchi Reportligiga qarab blade korsatiladi.
     **/
    public function index($id)
    {

        $dtHeaders = [
            __('ID') => [
              'rowspan' => 2,
              'colspan' => 0,
            ],
            __('Филиал') => [
              'rowspan' => 2,
              'colspan' => 0,
            ],
            __('1 - Квартал') => [
              'rowspan' => 0,
              'colspan' => 3,
            ],
            __('2 - Квартал') => [
              'rowspan' => 0,
              'colspan' => 3,
            ],
            __('3 - Квартал') => [
              'rowspan' => 0,
              'colspan' => 3,
            ],
            __('4 - Квартал') => [
              'rowspan' => 0,
              'colspan' => 3,
            ],
        ];


        $dtTitles = [
            __('товар'),
            __('работа'),
            __('услуга'),

            __('товар'),
            __('работа'),
            __('услуга'),

            __('товар'),
            __('работа'),
            __('услуга'),

            __('товар'),
            __('работа'),
            __('услуга'),
        ];

        $dtColumns = "[
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},

            {data: 'tovar_1', name: 'tovar_1'},
            {data: 'rabota_1', name: 'rabota_1'},
            {data: 'usluga_1', name: 'usluga_1'},

            {data: 'tovar_2', name: 'tovar_2'},
            {data: 'rabota_2', name: 'rabota_2'},
            {data: 'usluga_2', name: 'usluga_2'},

            {data: 'tovar_3', name: 'tovar_3'},
            {data: 'rabota_3', name: 'rabota_3'},
            {data: 'usluga_3', name: 'usluga_3'},

            {data: 'tovar_4', name: 'tovar_4'},
            {data: 'rabota_4', name: 'rabota_4'},
            {data: 'usluga_4', name: 'usluga_4'},
    ]";
        $report = ReportDate::all();
            if($id == self::Quarterly_Planned_Report)
                return view("site.report.{$id}",compact('report', 'dtHeaders', 'dtTitles','dtColumns'));
            elseif($id < self::Report_Statuses_Quantity){
                return view("site.report.{$id}",compact('report', 'dtHeaders', 'dtTitles','dtColumns'));
            }
            return view("site.report.10",compact('report'));
    }
    /**
     * Nechinchi Report ligiga qarab data chiqadi.
     **/
    public function report($id, Request $request)
    {
        /** @var object $user*/
        $user = auth()->user();
        if($request->startDate !== null && $request->endDate !== null){
            $request->session()->put("report_$id.startDate", $request->startDate);
            $request->session()->put("report_$id.endDate", $request->endDate);
        }
        $this->service->application_query($request);
        $reports = match ($id) {
            '1' => $this->service->report_1($request, $user),
            '2' => $this->service->report_2($request, $user),
            '3' => $this->service->report_3($request, $user),
            '4' => $this->service->report_4($request, $user),
            '5' => $this->service->report_5($request, $user),
            '6' => $this->service->report_6($request, $user),
            '7' => $this->service->report_7($request, $user),
            '8' => $this->service->report_8($request, $user),
            '9' => $this->service->report_9($request, $user),
            '10' => $this->service->report_10($request, $user),
            '22' => $this->service->report_2_2($request, $user),
        };

        return $reports;

    }

    public function report_export($id, Request $request){
        $user = auth()->user();

        $users = match ($id) {
            '4' => $this->exportService->export_4($request, $user),
            '6' => $this->exportService->export_6($request, $user),
            '7' => $this->exportService->export_7($request, $user),
            '8' => $this->exportService->export_8($request, $user),
        };
        return $users;
    }
}
