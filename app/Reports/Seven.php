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

class Seven implements ALL
{

    public static function core() {
        $query =  Application::query()->where('status','!=','draft')->where('name', '!=', null);
        return $query;

    }
    public static function condition($startDate, $endDate)
    {
        if(auth()->user()->hasPermission(PermissionEnum::Purchasing_Management_Center))
        {
            if($startDate === null){
                $query = self::core();
            }else{
                $query = self::core()->whereBetween('created_at', [$startDate, $endDate]);
            }
        }else{
            $query = self::core()->where('branch_id',auth()->user()->branch_id)->where('draft','!=',ApplicationMagicNumber::one)->get();
        }
        return $query;
    }


    public static function data() {




        $data = [
            'id' => [
                'name' => 'id',
                'title' => __('ID'),
                'data' => function($application){
                    return  $application->id;
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
            'name' => [
                'name' =>  'name',
                'title' => __('Источник финансирование'),
                'data' => function($application){
                    return $application->branch_id ? $application->branch->name:"";
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
            'supplier_name' => [
                'name' =>  'supplier_name',
                'title' => __('Наименование доставщика'),
                'data' => function($application){
                    return $application->supplier_name;
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
            'supplier_inn' => [
                'name' =>  'supplier_inn',
                'title' => __('Стир доставщика'),
                'data' => function($application){
                    return $application->supplier_inn;
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
            'contract_number' => [
                'name' =>  'contract_number',
                'title' => __('Номер договора'),
                'data' => function($application){
                    return $application->contract_number;
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
            'contract_date' => [
                'name' =>  'contract_date',
                'title' => __('Дата договора'),
                'data' => function($application){
                    return $application->contract_date;
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
            'contract_price' => [
                'name' =>  'contract_price',
                'title' => __('Сумма договора'),
                'data' => function($application){
                    return $application->contract_price;
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
            'currency' => [
                'name' =>  'currency',
                'title' => __('Валюта'),
                'data' => function($application){
                    return $application->currency;
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
            'lot_number' => [
                'name' =>  'lot_number',
                'title' => __('Номер и дата лота размещенных на специальном информационном портале о государственных закупках'),
                'data' => function($application){
                    return $application->lot_number;
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
            'type_of_purchase' => [
                'name' =>  'type_of_purchase',
                'title' => __('Тип закупки'),
                'data' => function($application){
                    return $application->type_of_purchase_id ? $application->purchase->name:'';
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
            'contract_info' => [
                'name' =>  'contract_info',
                'title' => __('Предмет закупки'),
                'data' => function($application){
                    return $application->contract_info;
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
            'country_produced_id' => [
                'name' =>  'country_produced_id',
                'title' => __('Страна происхождения товаров (услуг)'),
                'data' => function($application){
                    return $application->country_produced_id;
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
            'purchase_basis' => [
                'name' =>  'purchase_basis',
                'title' => __('Основание: Закон о государственных закупках / другие решения'),
                'data' => function($application){
                    return $application->country_produced_id;
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
        ];

        return $data;
    }


    public static function title() {

        return  __('7 - Плановый.xlsx');
    }
}
