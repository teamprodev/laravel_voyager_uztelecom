<?php

namespace App\Reports;

use App\Enums\ApplicationMagicNumber;
use App\Enums\PermissionEnum;
use App\Models\Application;
use App\Models\Branch;
use App\Models\ReportDate;
use App\Models\Resource;
use App\Models\StatusExtended;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class Ten implements ALL
{

    public $a;

    public static function core() {
        if(auth()->user()->hasPermission(PermissionEnum::Purchasing_Management_Center))
        {
            $operator = '!=';
            $b = null;
        }else{
            $operator = '==';
            $b = auth()->user()->branch_id;
        }
        $a = 'branch_id';
        $query =  Application::query()->where('status','!=','draft')->where('name', '!=', null)->where($a,$operator,$b);
        return $query;

    }
    public static function condition($startDate, $endDate)
    {
        $status = StatusExtended::query();
        return $status;
    }


    public static function data($startDate, $endDate) {




        $data = [
            'name' => [
                'name' => 'name',
                'title' => __('Год'),
                'data' => function($application){
                    return  $application->name;
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
            'january' => [
                'name' => 'january',
                'title' => __('Январь'),
                'data' => function($status) use ($startDate, $endDate){
                    $startDate = $startDate ? "$startDate-01-01" : "2022-01-01";
                    $endDate = $endDate ? "$endDate-02-01" : "2022-02-01";

                    $applications = self::core()->where('performer_status', $status->id)->whereBetween('created_at',[$startDate, $endDate])->get();
                    return count($applications);
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
            'february' => [
                'name' => 'february',
                'title' => __('Февраль'),
                'data' => function($status) use ($startDate, $endDate){
                    $startDate = $startDate ? "$startDate-02-01" : "2022-02-01";
                    $endDate = $endDate ? "$endDate-03-01" : "2022-03-01";

                    $applications = self::core()->where('performer_status', $status->id)->whereBetween('created_at',[$startDate, $endDate])->get();
                    return count($applications);
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
            'march' => [
                'name' => 'march',
                'title' => __('Март'),
                'data' => function($status) use ($startDate, $endDate){
                    $startDate = $startDate ? "$startDate-03-01" : "2022-03-01";
                    $endDate = $endDate ? "$endDate-04-01" : "2022-04-01";

                    $applications = self::core()->where('performer_status', $status->id)->whereBetween('created_at',[$startDate, $endDate])->get();
                    return count($applications);
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
            'april' => [
                'name' => 'april',
                'title' => __('Апрель'),
                'data' => function($status) use ($startDate, $endDate){
                    $startDate = $startDate ? "$startDate-04-01" : "2022-04-01";
                    $endDate = $endDate ? "$endDate-05-01" : "2022-05-01";

                    $applications = self::core()->where('performer_status', $status->id)->whereBetween('created_at',[$startDate, $endDate])->get();
                    return count($applications);
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
            'may' => [
                'name' => 'may',
                'title' => __('Май'),
                'data' => function($status) use ($startDate, $endDate){
                    $startDate = $startDate ? "$startDate-05-01" : "2022-05-01";
                    $endDate = $endDate ? "$endDate-06-01" : "2022-06-01";

                    $applications = self::core()->where('performer_status', $status->id)->whereBetween('created_at',[$startDate, $endDate])->get();
                    return count($applications);
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
            'june' => [
                'name' => 'june',
                'title' => __('Июнь'),
                'data' => function($status) use ($startDate, $endDate){
                    $startDate = $startDate ? "$startDate-06-01" : "2022-06-01";
                    $endDate = $endDate ? "$endDate-07-01" : "2022-07-01";

                    $applications = self::core()->where('performer_status', $status->id)->whereBetween('created_at',[$startDate, $endDate])->get();
                    return count($applications);
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
            'july' => [
                'name' => 'july',
                'title' => __('Июль'),
                'data' => function($status) use ($startDate, $endDate){
                    $startDate = $startDate ? "$startDate-07-01" : "2022-07-01";
                    $endDate = $endDate ? "$endDate-08-01" : "2022-08-01";

                    $applications = self::core()->where('performer_status', $status->id)->whereBetween('created_at',[$startDate, $endDate])->get();
                    return count($applications);
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
            'august' => [
                'name' => 'august',
                'title' => __('Август'),
                'data' => function($status) use ($startDate, $endDate){
                    $startDate = $startDate ? "$startDate-08-01" : "2022-08-01";
                    $endDate = $endDate ? "$endDate-09-01" : "2022-09-01";

                    $applications = self::core()->where('performer_status', $status->id)->whereBetween('created_at',[$startDate, $endDate])->get();
                    return count($applications);
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
            'september' => [
                'name' => 'september',
                'title' => __('Сентябрь'),
                'data' => function($status) use ($startDate, $endDate){
                    $startDate = $startDate ? "$startDate-09-01" : "2022-09-01";
                    $endDate = $endDate ? "$endDate-10-01" : "2022-10-01";

                    $applications = self::core()->where('performer_status', $status->id)->whereBetween('created_at',[$startDate, $endDate])->get();
                    return count($applications);
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
            'october' => [
                'name' => 'october',
                'title' => __('Октябрь'),
                'data' => function($status) use ($startDate, $endDate){
                    $startDate = $startDate ? "$startDate-10-01" : "2022-10-01";
                    $endDate = $endDate ? "$endDate-11-01" : "2022-11-01";

                    $applications = self::core()->where('performer_status', $status->id)->whereBetween('created_at',[$startDate, $endDate])->get();
                    return count($applications);
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
            'november' => [
                'name' => 'november',
                'title' => __('Ноябрь'),
                'data' => function($status) use ($startDate, $endDate){
                    $startDate = $startDate ? "$startDate-11-01" : "2022-11-01";
                    $endDate = $endDate ? "$endDate-12-01" : "2022-12-01";

                    $applications = self::core()->where('performer_status', $status->id)->whereBetween('created_at',[$startDate, $endDate])->get();
                    return count($applications);
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
            'december' => [
                'name' => 'december',
                'title' => __('Декабрь'),
                'data' => function($status) use ($startDate, $endDate){
                    $startDate = $startDate ? "$startDate-12-01" : "2022-12-01";
                    $endDate = $endDate ? "$endDate-12-31" : "2022-12-31";

                    $applications = self::core()->where('performer_status', $status->id)->whereBetween('created_at',[$startDate, $endDate])->get();
                    return count($applications);
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],

            'all' => [
                'name' => 'all',
                'title' => __('Итого'),
                'data' => function($status) use ($startDate, $endDate){
                    $applications = self::core()->where('performer_status', $status->id)->whereBetween('created_at',[$startDate, $endDate])->get();
                    return count($applications);
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
        ];

        return $data;
    }


    public static function title() {

        return  __('10 - Отчет по кол-ву статусам.xlsx');
    }
}
