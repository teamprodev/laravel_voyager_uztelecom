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

class Six implements ALL
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
                'title' => __('Филиал'),
                'data' => function($application){
                    return $application->branch_id ? $application->branch->name:"";
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
            'supplier_name' => [
                'name' =>  'supplier_name',
                'title' => __('Контрагент (предприятия поставляющий товаров. работ. услуг)'),
                'data' => function($application){
                    return $application->supplier_name;
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
            'contract_number' => [
                'name' =>  'contract_number',
                'title' => __('Договор (контракт)'),
                'data' => function($application){
                    return $application->contract_number;
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
            'subject' => [
                'name' =>  'subject',
                'title' => __('Предмет закупки (товар,работа,услуга)'),
                'data' => function($application){
                    return $application->subject ? $application->subjects->name:'';
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
            'number' => [
                'name' =>  'number',
                'title' =>  __('номер заявки'),
                'data' => function($application){
                    return  $application->number;
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
            'planned_price' => [
                'name' =>  'planned_price',
                'title' => __('сумма заявки'),
                'data' => function($application){
                    return !Str::contains($application->planned_price, ' ') ? number_format($application->planned_price, ApplicationMagicNumber::zero, '', ' ') : $application->planned_price;
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
            'contract_info' => [
                'name' =>  'contract_info',
                'title' => __('Предмет договора (контракта) и краткая характеристика'),
                'data' => function($application){
                    return $application->contract_info;
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
            'contract_price' => [
                'name' =>  'contract_price',
                'title' => __('Общая сумма договора (контракта)'),
                'data' => function($application){
                    return $application->contract_price;
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
            'protocol_number' => [
                'name' =>  'protocol_number',
                'title' => __('Номер протокола внутренней комиссии'),
                'data' => function($application){
                    return $application->protocol_number;
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
            'protocol_date' => [
                'name' =>  'protocol_date',
                'title' => __('Дата протокола внутренней комиссии'),
                'data' => function($application){
                    return $application->protocol_date;
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
        ];

        return $data;
    }


    public static function title() {

        return  __('6 - Отчет свод.xlsx');
    }
}
