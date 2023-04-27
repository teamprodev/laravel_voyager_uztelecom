<?php

namespace App\Services;

use App\Enums\ApplicationMagicNumber;
use App\Enums\ApplicationStatusEnum;
use App\Enums\PermissionEnum;
use App\Models\Application;
use App\Models\Resource;
use App\Models\StatusExtended;
use App\Models\User;
use App\Reports\ALL;
use App\Reports\One;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Rap2hpoutre\FastExcel\FastExcel;

class ReportExportService
{
    public function application_query()
    {
        $application =  Application::query()->where('status','!=','draft')->where('name', '!=', null);
        return $this->query = $application;
    }



    public function export_1(object $request, object $user)
    {
        if (!$user->hasPermission(PermissionEnum::Purchasing_Management_Center)) {
            $query = $this->application_query()
                ->where('branch_id', $user->branch_id)
                ->where('draft', '!=', ApplicationMagicNumber::one);
        } elseif ($request->startDate === null) {
            $query = $this->application_query();
        } else {
            $query = $this->application_query()
                ->whereBetween('created_at', [$request->startDate, $request->endDate]);
        }
        $this->columns = $request->dtcolumns;
        $this->headers = $request->dtheaders;
        setlocale(LC_TIME, 'ru_RU.utf8');
        $applications = $query->with(['branch', 'performer', 'department', 'user', 'purchase'])
            ->get()
            ->map(function ($application) {
                $data = One::init();
                foreach ($data as $item=>$key)
                {
                    $return[] = [$item['name'] => $item['data']];
                    $my_array['index_name'] = 'value';

                    $my_array = ['index_name' => 'value'];
                }

                dd($return);
//                foreach ($this->columns as $column)
//                {
//                    $id = $column["data"];
//                    $columns[] = $application->$id;
//                }
//                dd($columns,$this->columns);
//                foreach ($this->headers as $header)
//                {
//                    $headers[] = array_keys($header);
//                }
//
//                $combinedArray = array_combine($headers[0],$columns);
//
//                return $combinedArray;
            });

        return (new FastExcel($applications))->download('4 - Отчет заявки по статусам.xlsx');
    }




    public function export(ALL $model, object $request, object $user)
    {

        $query = $model::condition();
        $applications = $query
            ->get()
            ->map(function ($application) use ($model) {
                $data = $model::data();
                foreach ($data as $item)
                {
                    $return[$item['title']] = $item['data']($application);
                }
                return $return;

            });

        return (new FastExcel($applications))->download($model::title());
    }



    public function export_4(object $request, object $user)
    {
        if (!$user->hasPermission(PermissionEnum::Purchasing_Management_Center)) {
            $query = $this->application_query()
                ->where('branch_id', $user->branch_id)
                ->where('draft', '!=', ApplicationMagicNumber::one);
        } elseif ($request->startDate === null) {
            $query = $this->application_query();
        } else {
            $query = $this->application_query()
                ->whereBetween('created_at', [$request->startDate, $request->endDate]);
        }
        setlocale(LC_TIME, 'ru_RU.utf8');
        $applications = $query->with(['branch', 'performer', 'department', 'user', 'purchase'])
            ->get()
            ->map(function ($application) {


                $status_extended = StatusExtended::find($application->performer_status);
                $status = match (true) {
                    $application->status === ApplicationStatusEnum::Order_Arrived => 'товар прибыл',
                    $application->status === ApplicationStatusEnum::Order_Delivered => 'товар доставлен',
                    $application->status === ApplicationStatusEnum::Agreed => 'Согласована',
                    $application->status === ApplicationStatusEnum::In_Process => 'На рассмотрении',
                    $application->status === ApplicationStatusEnum::Distributed => 'Распределен',
                    $application->status === ApplicationStatusEnum::Refused => 'Отказана',
                    $application->status === ApplicationStatusEnum::Rejected => 'Отклонена',
                    $application->status === ApplicationStatusEnum::Draft => 'Черновик',
                    $application->status === ApplicationStatusEnum::New => 'Новая',
                    $application->performer_status !== null => $status_extended->name,
                    default => $application->status
                };



                return [
                    'ID' => $application->id,
                    'Филиал' => $application->branch_id ? $application->branch->name : '',
                    'номер заявки' => $application->number,
                    'дата заявки' => Carbon::parse($application->date)->translatedFormat('d.m.Y'),
                    'ФИО инициатора' => $application->user->name,
                    'Контактный телефон инициатора' => $application->user->phone ? $application->user->phone : 'Not Phone Number',
                    'отдел инициатора' => $application->department_initiator_id ? $application->department->name : '',
                    'вид закупки' => $application->type_of_purchase_id ? $application->purchase->name : '',
                    'Наименование предмета закупки(товар, работа, услуги)' => $application->name,
                    'Предмет закупки (товар,работа,услуга)' => $application->subject ? $application->subjects->name:'',
                    'Гарантийный срок качества товара (работ, услуг)' => $application->expire_warranty_date,
                    'сумма заявки' => $application->planned_price,
                    'С НДС' => fn() => $application->with_nds ?'Да':'Нет',
                    'Валюта' => fn() => $application->currency,
                    'Наименование поставщика' => $application->supplier_name,
                    'сумма договора' => $application->contract_price,
                    'Махсулот келишининг муддати' => $application->delivery_date,
                    'Статус' => $status,
                    'Начальник Исполнителя заявки' => $application->performer_leader->name ? $application->performer_leader->name : '',
                    'Исполнитель заявки' => $application->performer_user_id ? $application->performer->name : '',
                    'Бюджетни режалаштириш булими. Маълумот' => $application->info_business_plan,
                    'Харидлар режасида мавжудлиги буича маълумот' => $application->info_purchase_plan,
                    'Цель закупки' => $application->purchase_basis,
                    'Основание(план закупок, рапорт, расспорежение руководства)' => $application->basis,
                ];
            });

        return (new FastExcel($applications))->download('4 - Отчет заявки по статусам.xlsx');
    }

    public function export_6(object $request, object $user)
    {
        if (!$user->hasPermission(PermissionEnum::Purchasing_Management_Center)) {
            $query = $this->application_query()
                ->where('branch_id', $user->branch_id)
                ->where('draft', '!=', ApplicationMagicNumber::one);
        } elseif ($request->startDate === null) {
            $query = $this->application_query();
        } else {
            $query = $this->application_query()
                ->whereBetween('created_at', [$request->startDate, $request->endDate]);
        }
        setlocale(LC_TIME, 'ru_RU.utf8');
        $applications = $query->with(['branch'])
            ->get()
            ->map(function ($application) {
                return [
                    'ID' => $application->id,
                    'Филиал' => $application->branch_id ? $application->branch->name : '',
                    'Контрагент (предприятия поставляющий товаров. работ. услуг)' => $application->supplier_name,
                    'Договор (контракт)' => $application->contract_number,
                    'Предмет закупки (товар,работа,услуга)' => $application->subject,
                    'номер заявки' => $application->number,
                    'сумма заявки' => $application->planned_price,
                    'Предмет договора (контракта) и краткая характеристика' => $application->contract_info,
                    'Общая сумма договора (контракта)' => $application->contract_price,
                    'Номер протокола внутренней комиссии' => $application->protocol_number,
                    'Дата протокола внутренней комиссии' => $application->protocol_date ? Carbon::parse($application->protocol_date)->format('d.m.Y') : '',
                ];
            });

        return (new FastExcel($applications))->download('6 - Отчет свод.xlsx');
    }

    public function export_7(object $request, object $user)
    {
        if (!$user->hasPermission(PermissionEnum::Purchasing_Management_Center)) {
            $query = $this->application_query()
                ->where('branch_id', $user->branch_id)
                ->where('draft', '!=', ApplicationMagicNumber::one);
        } elseif ($request->startDate === null) {
            $query = $this->application_query();
        } else {
            $query = $this->application_query()
                ->whereBetween('created_at', [$request->startDate, $request->endDate]);
        }
        $query = $this->application_query()->where('status', 'extended');
        $applications = $query->with(['branch', 'type_of_purchase'])->get()->map(function ($application) {
            return [
                'ID' => $application->id,
                'Источник финансирование' => $application->branch->name,
                'Наименование доставщика' => $application->supplier_name,
                'Стир доставщика' => $application->supplier_inn,
                'Номер договора' => $application->contract_number,
                'Дата договора' => $application->contract_date,
                'Сумма договора' => $application->contract_price,
                'Валюта' => $application->currency,
                'Номер и дата лота размещенных на специальном информационном портале о государственных закупках' => $application->lot_number,
                'Тип закупки' => optional($application->type_of_purchase)->name,
                'Предмет закупки' => $application->contract_info,
                'Страна происхождения товаров (услуг)' => $application->country_produced_id,
                'Основание: Закон о государственных закупках / другие решения' => $application->purchase_basis,
            ];
        });

        return (new FastExcel($applications))->download('7 - Плановый.xlsx');
    }

    public function export_8(object $request, object $user)
    {
        if (!$user->hasPermission(PermissionEnum::Purchasing_Management_Center)) {
            $query = $this->application_query()
                ->where('branch_id', $user->branch_id)
                ->where('draft', '!=', ApplicationMagicNumber::one);
        } elseif ($request->startDate === null) {
            $query = $this->application_query();
        } else {
            $query = $this->application_query()
                ->whereBetween('created_at', [$request->startDate, $request->endDate]);
        }
        setlocale(LC_TIME, 'ru_RU.utf8');
        $query = $this->application_query()->where('status', 'extended');
        $applications = $query->get()->map(function ($application) {
            return [
                'ID' => $application->id,
                'Филиал' => optional($application->branch)->name,
                'Номер и дата заявки' => "{$application->number} {$application->date}",
                'Планируемый бюджет закупки (сум)' => !Str::contains($application->planned_price, ' ') ? number_format($application->planned_price, ApplicationMagicNumber::zero, '', ' ') : $application->planned_price,
                'Дата получения отделом' => $application->performer_received_date,
                'Инициатор' => optional(User::find($application->user_id))->name,
                'Наименование товара' => collect(json_decode($application->resource_id, true))
                                            ->map(fn($item) => Resource::find($item)->name)
                                            ->implode(', '),
                'Вид закупки' => optional($application->type_of_purchase)->name,
                'Номер договора' => $application->contract_number,
                'Поставщик' => $application->supplier_name,
                'Сумма' => $application->contract_price,
                'Исполнитель' => optional($application->performer)->name,
                'Дата Создания' => $application->created_at ? with(new Carbon($application->created_at))->format('d.m.Y') : '',
            ];
        });


        return (new FastExcel($applications))->download('8 - Отчет по видам закупки.xlsx');
    }
}
