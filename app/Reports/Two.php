<?php

namespace App\Reports;

use App\Enums\ApplicationMagicNumber;
use App\Enums\PermissionEnum;
use App\Models\Application;
use App\Models\Branch;

class Two implements ALL
{

    public static function core() {
        $query =  Application::query()->where('status','!=','draft')->where('name', '!=', null);
        return $query;

    }
    private function get_2($branch, $request, $subject, $startMonth, $endMonth)
    {
        $start_date = $request->startDate ? "$request->startDate-$startMonth-01" : "2022-$startMonth-01";
        $end_date = $request->endDate ? "$request->endDate-$endMonth-31" : "2022-$endMonth-31";

        $applications = self::core()
            ->whereBetween('created_at', [$start_date, $end_date])
            ->where('branch_id', $branch->id)
            ->where('subject', $subject)
            ->where('status', 'extended')
            ->pluck('planned_price')
            ->toArray();
        $result = array_sum(preg_replace('/[^0-9]/', '', $applications));
        return $result ? number_format($result, ApplicationMagicNumber::zero, '', ' ') : '0';
    }
    public static function condition()
    {
        if(auth()->user()->hasPermission(PermissionEnum::Purchasing_Management_Center))
        {
            $query = Branch::query();
        }
        else{
            $query = Branch::query()->where('id',auth()->user()->branch_id)->get();
        }
        return $query;
    }


    public static function data() {




        $data = [
            'id' => [
                'name' => 'id',
                'title' => __('ID'),
                'data' => function($branch){
                    return  $branch->id;
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
            'name' => [
                'name' =>  'name',
                'title' =>  __('Филиал'),
                'data' => function($branch){
                    return  $branch->name;
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
            'tovar_1' => [
                'name' =>  'count',
                'title' => __('Количество заявок'),
                'data' => function($branch){
                    $applications = self::core()->where('branch_id', $branch->id)->get();
                    return count($applications);
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
            'rabota_1' => [
                'name' =>  'tovar',
                'title' => __('Товар'),
                'data' => function($branch){
                    $applications = self::core()->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::one)->get();
                    return count($applications);
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
            'usluga_1' => [
                'name' =>  'rabota',
                'title' => __('Работа'),
                'data' => function($branch){
                    $applications = self::core()->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::two)->get();
                    return count($applications);
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
            'tovar_2' => [
                'name' =>  'usluga',
                'title' => __('Услуга'),
                'data' => function($branch){
                    $applications = self::core()->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::three)->get();
                    return count($applications);
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
            'rabota_2' => [
                'name' =>  'summa',
                'title' => __('Сумма без НДС'),
                'data' => function($branch){
                    $applications = self::core()->where('branch_id', $branch->id)->where('with_nds', '=',null)->pluck('planned_price')->toArray();
                    $result = array_sum(preg_replace( '/[^0-9]/', '', $applications));
                    return $result ? number_format($result, ApplicationMagicNumber::zero, '', ' ') : '0';
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
            'usluga_2' => [
                'name' =>  'nds',
                'title' => __('Сумма с НДС'),
                'data' => function($branch){
                    $applications = self::core()->where('branch_id', $branch->id)->where('with_nds', '!=',null)->pluck('planned_price')->toArray();
                    $result = array_sum(preg_replace( '/[^0-9]/', '', $applications));
                    return $result ? number_format($result, ApplicationMagicNumber::zero, '', ' ') : '0';
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
            'tovar_3' => [
                'name' =>  'count',
                'title' => __('Количество заявок'),
                'data' => function($branch){
                    $applications = self::core()->where('branch_id', $branch->id)->get();
                    return count($applications);
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
            'rabota_3' => [
                'name' =>  'tovar',
                'title' => __('Товар'),
                'data' => function($branch){
                    $applications = self::core()->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::one)->get();
                    return count($applications);
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
            'usluga_3' => [
                'name' =>  'rabota',
                'title' => __('Работа'),
                'data' => function($branch){
                    $applications = self::core()->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::two)->get();
                    return count($applications);
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
            'tovar_4' => [
                'name' =>  'usluga',
                'title' => __('Услуга'),
                'data' => function($branch){
                    $applications = self::core()->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::three)->get();
                    return count($applications);
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
            'rabota_4' => [
                'name' =>  'summa',
                'title' => __('Сумма без НДС'),
                'data' => function($branch){
                    $applications = self::core()->where('branch_id', $branch->id)->where('with_nds', '=',null)->pluck('planned_price')->toArray();
                    $result = array_sum(preg_replace( '/[^0-9]/', '', $applications));
                    return $result ? number_format($result, ApplicationMagicNumber::zero, '', ' ') : '0';
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
            'usluga_4' => [
                'name' =>  'nds',
                'title' => __('Сумма с НДС'),
                'data' => function($branch){
                    $applications = self::core()->where('branch_id', $branch->id)->where('with_nds', '!=',null)->pluck('planned_price')->toArray();
                    $result = array_sum(preg_replace( '/[^0-9]/', '', $applications));
                    return $result ? number_format($result, ApplicationMagicNumber::zero, '', ' ') : '0';
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
        ];

        return $data;
    }


    public static function title() {

        return  __('2 - Отчет квартальный итоговый.xlsx');
    }
}
