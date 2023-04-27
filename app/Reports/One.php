<?php

namespace App\Reports;

use App\Enums\ApplicationMagicNumber;
use App\Enums\ApplicationStatusEnum;
use App\Enums\PermissionEnum;
use App\Models\Application;
use App\Models\Branch;
use App\Models\StatusExtended;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class One implements ALL
{



    public static function core() {
        $query =  Application::query()->where('status','!=','draft')->where('name', '!=', null);
        return $query;

    }
    public static function condition()
    {
        if(auth()->user()->hasPermission(PermissionEnum::Purchasing_Management_Center))
        {
            $query = Branch::query();
        }
        else{
            $query = Branch::query()->where('id', auth()->user()->branch_id)->get();
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
            'count' => [
                'name' =>  'count',
                'title' => __('Количество заявок'),
                'data' => function($branch){
                    $applications = self::core()->where('branch_id', $branch->id)->get();
                    return count($applications);
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
            'tovar' => [
                'name' =>  'tovar',
                'title' => __('Товар'),
                'data' => function($branch){
                    $applications = self::core()->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::one)->get();
                    return count($applications);
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
            'rabota' => [
                'name' =>  'rabota',
                'title' => __('Работа'),
                'data' => function($branch){
                    $applications = self::core()->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::two)->get();
                    return count($applications);
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
            'usluga' => [
                'name' =>  'usluga',
                'title' => __('Услуга'),
                'data' => function($branch){
                    $applications = self::core()->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::three)->get();
                    return count($applications);
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
            'summa' => [
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
            'nds' => [
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
      return  __('4 - Отчет заявки по статусам.xlsx');

    }




}
