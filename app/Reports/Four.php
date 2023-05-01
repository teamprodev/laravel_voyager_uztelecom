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

class Four implements ALL
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
            'branch_id' => [
                'name' =>  'branch_id',
                'title' => __('Филиал'),
                'data' => function($application){
                    return $application->branch_id ? $application->branch->name:"";
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
            'date' => [
                'name' =>  'date',
                'title' =>  __('дата заявки'),
                'data' => function($application){
                    return  $application->date;
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
            'user_id' => [
                'name' =>  'user_id',
                'title' => __('ФИО инициатора'),
                'data' => function($application){
                    return $application->user->name;
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
            'phone' => [
                'name' =>  'phone',
                'title' => __('Контактный телефон инициатора'),
                'data' => function($application){
                    return $application->user->phone ? $application->user->phone:"Not Phone Number";
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
            'department_initiator_id' => [
                'name' =>  'department_initiator_id',
                'title' => __('отдел инициатора'),
                'data' => function($application){
                    return $application->department_initiator_id ? $application->department->name:"";
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
            'type_of_purchase_id' => [
                'name' =>  'type_of_purchase_id',
                'title' => __('вид закупки'),
                'data' => function($application){
                    return $application->type_of_purchase_id ? $application->purchase->name:'';
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
            'name' => [
                'name' =>  'name',
                'title' =>  __('Наименование предмета закупки(товар, работа, услуги)'),
                'data' => function($application){
                    return  $application->name;
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
            'expire_warranty_date' => [
                'name' =>  'expire_warranty_date',
                'title' => __('Гарантийный срок качества товара (работ, услуг)'),
                'data' => function($application){
                    return $application->expire_warranty_date;
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
            'with_nds' => [
                'name' =>  'with_nds',
                'title' => __('С НДС'),
                'data' => function($application){
                    return $application->with_nds ?'Да':'Нет';
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
            'supplier_name' => [
                'name' =>  'supplier_name',
                'title' => __('Наименование поставщика'),
                'data' => function($application){
                    return $application->supplier_name;
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
            'contract_price' => [
                'name' =>  'contract_price',
                'title' => __('сумма договора'),
                'data' => function($application){
                    return $application->contract_price;
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
            'delivery_date' => [
                'name' =>  'delivery_date',
                'title' => __('Махсулот келишининг муддати'),
                'data' => function($application){
                    return $application->delivery_date;
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
            'status' => [
                'name' =>  'status',
                'title' => __('Статус'),
                'data' => function($application){
                    $status = $application->status;
                    if ($application->performer_status !== null) {
                        $status = StatusExtended::find($application->performer_status)->name;
                    }
                    return (new Four)->translateStatus($status);
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
            'performer_leader_user_id' => [
                'name' =>  'performer_leader_user_id',
                'title' => __('Начальник Исполнителя заявки'),
                'data' => function($application){
                    return $application->performer->name ?? $application->performer_leader_user_id;
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
            'performer_user_id' => [
                'name' =>  'performer_user_id',
                'title' => __('Исполнитель заявки'),
                'data' => function($application){
                    return $application->performer->name ?? $application->performer_user_id;
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
            'info_business_plan' => [
                'name' =>  'info_business_plan',
                'title' => __('Бюджетни режалаштириш булими. Маълумот'),
                'data' => function($application){
                    return $application->info_business_plan;
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
            'info_purchase_plan' => [
                'name' =>  'info_purchase_plan',
                'title' => __('Харидлар режасида мавжудлиги буича маълумот'),
                'data' => function($application){
                    return $application->info_business_plan;
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
            'purchase_basis' => [
                'name' =>  'purchase_basis',
                'title' => __('Цель закупки'),
                'data' => function($application){
                    return $application->info_business_plan;
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
        ];

        return $data;
    }


    public static function title() {

        return  __('4 - Отчет заявки по статусам.xlsx');
    }

    private function translateStatus($status)
    {
        switch ($status) {
            case 'new':
                return __('new');
                break;
            case "in_process":
                return __('in_process');
                break;
            case "overdue":
                return __('overdue');
                break;
            case "refused":
                return __('refused');
                break;
            case "agreed":
                return __('agreed');
                break;
            case "rejected":
                return __('rejected');
                break;
            case "distributed":
                return __('distributed');
                break;
            case "canceled":
                return __('canceled');
                break;
            default:
                return $status;
        }
    }
}
