<?php

namespace App\Services;

use App\Enums\ApplicationMagicNumber;
use App\Enums\PermissionEnum;
use App\Models\Application;
use Rap2hpoutre\FastExcel\FastExcel;

class ReportExportService
{
    public function application_query()
    {
        $application =  Application::query()->where('status','!=','draft')->where('name', '!=', null);
        return $this->query = $application;
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

        return (new FastExcel($applications))->download('report_7.xlsx');
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

        $applications = $query->with(['branch', 'performer', 'department', 'user', 'purchase'])
            ->get()
            ->map(function ($application) {
                return [
                    'ID' => $application->id,
                    'Филиал' => $application->branch_id ? $application->branch->name : '',
                    'номер заявки' => $application->number,
                    'дата заявки' => $application->date,
                    'ФИО инициатора' => $application->user->name,
                    'Контактный телефон инициатора' => $application->user->phone ? $application->user->phone : 'Not Phone Number',
                    'отдел инициатора' => $application->department_initiator_id ? $application->department->name : '',
                    'вид закупки' => $application->type_of_purchase_id ? $application->purchase->name : '',
                    'Наименование предмета закупки(товар, работа, услуги)' => $application->name,
                    'Предмет закупки (товар,работа,услуга)' => $application->subject ? $application->subjects->name:'',
                    'Гарантийный срок качества товара (работ, услуг)' => $application->expire_warranty_date,
                    'сумма заявки' => $application->planned_price,
                    'С НДС' => $application->with_nds ?'Да':'Нет',
                    'Валюта' => $application->currency,
                    'Наименование поставщика' => $application->supplier_name,
                    'сумма договора' => $application->contract_price,
                    'Махсулот келишининг муддати' => $application->delivery_date,
                    'Статус' => $application->status,
                    'Начальник Исполнителя заявки' => $application->performer_leader_user_id ? $application->performer_leader->name : '',
                    'Исполнитель заявки' => $application->performer_user_id ? $application->performer->name : '',
                    'Бюджетни режалаштириш булими. Маълумот' => $application->info_business_plan,
                    'Харидлар режасида мавжудлиги буича маълумот' => $application->info_purchase_plan,
                    'Цель закупки' => $application->purchase_basis,
                    'Основание(план закупок, рапорт, расспорежение руководства)' => $application->basis,
                ];
            });

        return (new FastExcel($applications))->download('4 - Отчет заявки по статусам.xlsx');
    }
}
