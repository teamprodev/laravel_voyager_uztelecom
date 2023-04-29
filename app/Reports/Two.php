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
    public static function condition($startDate, $endDate)
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


    public static function data($startDate,$endDate,$subject, $startMonth, $endMonth) {




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
                'name' =>  'tovar_1',
                'title' => __('товар 1'),
                'data' => function($branch) use ($request,$subject, $startMonth, $endMonth){
                    return $this->get_2($branch, $request, ApplicationMagicNumber::one, '01', '03');
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
            'rabota_1' => [
                'name' =>  'rabota_1',
                'title' => __('работа 1'),
                'data' => function($branch) use ($request,$subject, $startMonth, $endMonth){
                    return $this->get_2($branch, $request, ApplicationMagicNumber::two, '01', '03');
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
            'usluga_1' => [
                'name' =>  'usluga_1',
                'title' => __('услуга 1'),
                'data' => function($branch) use ($request,$subject, $startMonth, $endMonth){
                    return $this->get_2($branch, $request, ApplicationMagicNumber::three, '01', '03');
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
            'tovar_2' => [
                'name' =>  'tovar_2',
                'title' => __('товар 2'),
                'data' => function($branch) use ($request,$subject, $startMonth, $endMonth){
                    return $this->get_2($branch, $request, ApplicationMagicNumber::one, '04', '06');
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
            'rabota_2' => [
                'name' =>  'rabota_2',
                'title' => __('работа 2'),
                'data' => function($branch) use ($request,$subject, $startMonth, $endMonth){
                    return $this->get_2($branch, $request, ApplicationMagicNumber::two, '04', '06');
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
            'usluga_2' => [
                'name' =>  'usluga_2',
                'title' => __('услуга 2'),
                'data' => function($branch) use ($request,$subject, $startMonth, $endMonth){
                    return $this->get_2($branch, $request, ApplicationMagicNumber::three, '04', '06');
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
            'tovar_3' => [
                'name' =>  'tovar_3',
                'title' => __('товар 3'),
                'data' => function($branch) use ($request,$subject, $startMonth, $endMonth){
                    return $this->get_2($branch, $request, ApplicationMagicNumber::one, '07', '09');
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
            'rabota_3' => [
                'name' =>  'rabota_3',
                'title' => __('работа 3'),
                'data' => function($branch) use ($request,$subject, $startMonth, $endMonth){
                    return $this->get_2($branch, $request, ApplicationMagicNumber::two, '07', '09');
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
            'usluga_3' => [
                'name' =>  'usluga_3',
                'title' => __('услуга 3'),
                'data' => function($branch) use ($request,$subject, $startMonth, $endMonth){
                    return $this->get_2($branch, $request, ApplicationMagicNumber::three, '07', '09');
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
            'tovar_4' => [
                'name' =>  'tovar_4',
                'title' => __('товар 4'),
                'data' => function($branch) use ($request,$subject, $startMonth, $endMonth){
                    return $this->get_2($branch, $request, ApplicationMagicNumber::one, '10', '12');
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
            'rabota_4' => [
                'name' =>  'rabota_4',
                'title' => __('работа 4'),
                'data' => function($branch) use ($request,$subject, $startMonth, $endMonth){
                    return $this->get_2($branch, $request, ApplicationMagicNumber::two, '10', '12');
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
            'usluga_4' => [
                'name' =>  'usluga_4',
                'title' => __('услуга 4'),
                'data' => function($branch) use ($request,$subject, $startMonth, $endMonth){
                    return $this->get_2($branch, $request, ApplicationMagicNumber::three, '10', '12');
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
