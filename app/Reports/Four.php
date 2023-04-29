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

class Four implements ALL
{

    public static function core() {
        $query =  Application::query()->where('status','!=','draft')->where('name', '!=', null);
        return $query;

    }
    private function get_2($branch, $request, $subject, $startMonth, $endMonth)
    {
        $start_date = $request->startDate ? "$request->startDate-$startMonth-01" : "2022-$startMonth-01";
        $end_date = $request->endDate ? "$request->endDate-$endMonth-31" : "2022-$endMonth-31";

        $branchs = self::core()
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
            $query = self::core()->whereBetween('created_at', [$startDate, $endDate]);
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
                'title' =>  __('Филиал'),
                'data' => function($application){
                    return  $application->name;
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
                'data' => function($application) use ($request,$subject, $startMonth, $endMonth){
                    return $application->user->name;
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
            'phone' => [
                'name' =>  'phone',
                'title' => __('Контактный телефон инициатора'),
                'data' => function($application) use ($request,$subject, $startMonth, $endMonth){
                    return $application->user->phone ? $application->user->phone:"Not Phone Number";
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
            'department_initiator_id' => [
                'name' =>  'department_initiator_id',
                'title' => __('отдел инициатора'),
                'data' => function($application) use ($request,$subject, $startMonth, $endMonth){
                    return $application->department_initiator_id ? $application->department->name:"";
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
            'branch_id' => [
                'name' =>  'branch_id',
                'title' => __('номер заявки'),
                'data' => function($application) use ($request,$subject, $startMonth, $endMonth){
                    return $application->branch_id ? $application->branch->name:"";
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
            'performer_user_id' => [
                'name' =>  'performer_user_id',
                'title' => __('дата заявки'),
                'data' => function($application) use ($request,$subject, $startMonth, $endMonth){
                    return $application->performer->name ?? $application->performer_user_id;
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
            'type_of_purchase_id' => [
                'name' =>  'type_of_purchase_id',
                'title' => __('Наименование предмета закупки(товар, работа, услуги)'),
                'data' => function($application) use ($request,$subject, $startMonth, $endMonth){
                    return $application->type_of_purchase_id ? $application->purchase->name:'';
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
            'subject' => [
                'name' =>  'subject',
                'title' => __('Предмет закупки (товар,работа,услуга)'),
                'data' => function($application) use ($request,$subject, $startMonth, $endMonth){
                    return $application->subject ? $application->subjects->name:'';
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
            'planned_price' => [
                'name' =>  'planned_price',
                'title' => __('Гарантийный срок качества товара (работ, услуг)'),
                'data' => function($application) use ($request,$subject, $startMonth, $endMonth){
                    return !Str::contains($query->planned_price, ' ') ? number_format($query->planned_price, ApplicationMagicNumber::zero, '', ' ') : $query->planned_price;
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
            'with_nds' => [
                'name' =>  'with_nds',
                'title' => __('сумма заявки'),
                'data' => function($application) use ($request,$subject, $startMonth, $endMonth){
                    return $application->with_nds ?'Да':'Нет';
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
            'status' => [
                'name' =>  'status',
                'title' => __('С НДС'),
                'data' => function($application) use ($request,$subject, $startMonth, $endMonth){
                    $status = $application->status;
                    if ($application->performer_status !== null) {
                        $status = StatusExtended::find($application->performer_status)->name;
                    }
                    return $status;
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
            'product' => [
                'name' =>  'product',
                'title' => __('Валюта'),
                'data' => function($application) use ($request,$subject, $startMonth, $endMonth){
                    if($application->resource_id != null)
                    {
                        foreach (json_decode($application->resource_id) as $product)
                        {
                            $all[] = Resource::withTrashed()->find($product)->name;
                        }
                        return $all;
                    }
                },
                'rowspan' => 0,
                'colspan' => 0,
            ],
            'tovar_1' => [
                'name' =>  'tovar_1',
                'title' => __('Наименование поставщика'),
                'data' => function($application) use ($request,$subject, $startMonth, $endMonth){
                    $date = ReportDate::where('report_key','date_3_month')->pluck('report_value')[0];
                    $start_date = Carbon::parse("{$date}-01")
                        ->toDateTimeString();

                    $end_date = Carbon::parse("{$date}-31")
                        ->toDateTimeString();
                    $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::one)->where('with_nds','=',null)->pluck('planned_price')->toArray();
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
