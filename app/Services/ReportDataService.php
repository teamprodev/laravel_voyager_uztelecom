<?php


namespace App\Services;

use App\Enums\ApplicationMagicNumber;
use App\Enums\ApplicationStatusEnum;
use App\Enums\PermissionEnum;
use App\Models\Application;
use App\Models\Branch;
use App\Models\ReportDate;
use App\Models\Resource;
use App\Models\StatusExtended;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use App\Models\Purchase;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class ReportDataService
{
    /**
     * @param $report
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
     */
    final public function report1_data($report): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $dtHeaders = [
            [
                __('ID') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('Филиал') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('Количество заявок') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('Товар') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('Работа') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('Услуга') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('Сумма без НДС') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('Сумма с НДС') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
            ],
        ];


        $dtColumns = "[
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'count', name: 'count'},
            {data: 'tovar', name: 'tovar'},
            {data: 'rabota', name: 'rabota'},
            {data: 'usluga', name: 'usluga'},
            {data: 'summa', name: 'summa'},
            {data: 'nds', name: 'nds'},
        ]";
        return view("site.report.1",compact('report', 'dtHeaders','dtColumns'));
    }

    /**
     * @param $report
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
     */
    final public function report2_data($report): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $dtHeaders = [
            [
                __('ID') => [
                    'rowspan' => 2,
                    'colspan' => 0,
                ],
                __('Филиал') => [
                    'rowspan' => 2,
                    'colspan' => 0,
                ],
                __('1 - Квартал') => [
                    'rowspan' => 0,
                    'colspan' => 3,
                ],
                __('2 - Квартал') => [
                    'rowspan' => 0,
                    'colspan' => 3,
                ],
                __('3 - Квартал') => [
                    'rowspan' => 0,
                    'colspan' => 3,
                ],
                __('4 - Квартал') => [
                    'rowspan' => 0,
                    'colspan' => 3,
                ],
            ],

            [
                __('товар 1') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('работа 1') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('услуга 1') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],

                __('товар 2') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('работа 2') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('услуга 2') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],

                __('товар 3') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('работа 3') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('услуга 3') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],

                __('товар 4') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('работа 4') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('услуга 4') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
            ]
        ];

        $dtColumns = "[
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},

                {data: 'tovar_1', name: 'tovar_1'},
                {data: 'rabota_1', name: 'rabota_1'},
                {data: 'usluga_1', name: 'usluga_1'},

                {data: 'tovar_2', name: 'tovar_2'},
                {data: 'rabota_2', name: 'rabota_2'},
                {data: 'usluga_2', name: 'usluga_2'},

                {data: 'tovar_3', name: 'tovar_3'},
                {data: 'rabota_3', name: 'rabota_3'},
                {data: 'usluga_3', name: 'usluga_3'},

                {data: 'tovar_4', name: 'tovar_4'},
                {data: 'rabota_4', name: 'rabota_4'},
                {data: 'usluga_4', name: 'usluga_4'},
        ]";
        return view("site.report.2",compact('report', 'dtHeaders','dtColumns'));
    }

    /**
     * @param $report
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
     */
    final public function report22_data($report): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $dtHeaders = [
            [
                __('ID') => [
                    'rowspan' => 3,
                    'colspan' => 0,
                ],
                __('Филиал') => [
                    'rowspan' => 3,
                    'colspan' => 0,
                ],
                __('1 - Квартал') => [
                    'rowspan' => 0,
                    'colspan' => 6,
                ],
                __('2 - Квартал') => [
                    'rowspan' => 0,
                    'colspan' => 6,
                ],
                __('3 - Квартал') => [
                    'rowspan' => 0,
                    'colspan' => 6,
                ],
                __('4 - Квартал') => [
                    'rowspan' => 0,
                    'colspan' => 6,
                ],
            ],

            [
                __('товар 1') => [
                    'rowspan' => 0,
                    'colspan' => 2,
                ],
                __('работа 1') => [
                    'rowspan' => 0,
                    'colspan' => 2,
                ],
                __('услуга 1') => [
                    'rowspan' => 0,
                    'colspan' => 2,
                ],

                __('товар 2') => [
                    'rowspan' => 0,
                    'colspan' => 2,
                ],
                __('работа 2') => [
                    'rowspan' => 0,
                    'colspan' => 2,
                ],
                __('услуга 2') => [
                    'rowspan' => 0,
                    'colspan' => 2,
                ],

                __('товар 3') => [
                    'rowspan' => 0,
                    'colspan' => 2,
                ],
                __('работа 3') => [
                    'rowspan' => 0,
                    'colspan' => 2,
                ],
                __('услуга 3') => [
                    'rowspan' => 0,
                    'colspan' => 2,
                ],

                __('товар 4') => [
                    'rowspan' => 0,
                    'colspan' => 2,
                ],
                __('работа 4') => [
                    'rowspan' => 0,
                    'colspan' => 2,
                ],
                __('услуга 4') => [
                    'rowspan' => 0,
                    'colspan' => 2,
                ],
            ],

            [
                __('Без НДС 1') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('С НДС 1') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('Без НДС 1 ') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('С НДС 1 ') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('Без НДС 1  ') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('С НДС 1  ') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],

                __('Без НДС 2') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('С НДС 2') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('Без НДС 2 ') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('С НДС 2 ') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('Без НДС 2  ') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('С НДС 2  ') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],

                __('Без НДС 3') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('С НДС 3') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('Без НДС 3 ') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('С НДС 3 ') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('Без НДС 3  ') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('С НДС 3  ') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],

                __('Без НДС 4') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('С НДС 4') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('Без НДС 4 ') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('С НДС 4 ') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('Без НДС 4  ') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('С НДС 4  ') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
            ],
        ];


        $dtColumns = "[
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},

            {data: 'tovar_1', name: 'tovar_1'},
            {data: 'tovar_1_nds', name: 'tovar_1_nds'},

            {data: 'rabota_1', name: 'rabota_1'},
            {data: 'rabota_1_nds', name: 'rabota_1_nds'},

            {data: 'usluga_1', name: 'usluga_1'},
            {data: 'usluga_1_nds', name: 'usluga_1_nds'},


            {data: 'tovar_2', name: 'tovar_2'},
            {data: 'tovar_2_nds', name: 'tovar_2_nds'},

            {data: 'rabota_2', name: 'rabota_2'},
            {data: 'rabota_2_nds', name: 'rabota_2_nds'},

            {data: 'usluga_2', name: 'usluga_2'},
            {data: 'usluga_2_nds', name: 'usluga_2_nds'},


            {data: 'tovar_3', name: 'tovar_3'},
            {data: 'tovar_3_nds', name: 'tovar_3_nds'},

            {data: 'rabota_3', name: 'rabota_3'},
            {data: 'rabota_3_nds', name: 'rabota_3_nds'},

            {data: 'usluga_3', name: 'usluga_3'},
            {data: 'usluga_3_nds', name: 'usluga_3_nds'},


            {data: 'tovar_4', name: 'tovar_4'},
            {data: 'tovar_4_nds', name: 'tovar_4_nds'},

            {data: 'rabota_4', name: 'rabota_4'},
            {data: 'rabota_4_nds', name: 'rabota_4_nds'},

            {data: 'usluga_4', name: 'usluga_4'},
            {data: 'usluga_4_nds', name: 'usluga_4_nds'},
        ]";
        return view("site.report.22",compact('report', 'dtHeaders','dtColumns'));
    }

    /**
     * @param $report
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
     */
    final public function report3_data($report): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $dtHeaders = [
            [
                __('ID') => [
                    'rowspan' => 2,
                    'colspan' => 0,
                ],
                __('Филиал') => [
                    'rowspan' => 2,
                    'colspan' => 0,
                ],
                __('товар') => [
                    'rowspan' => 0,
                    'colspan' => 2,
                ],
                __('работа') => [
                    'rowspan' => 0,
                    'colspan' => 2,
                ],
                __('услуга') => [
                    'rowspan' => 0,
                    'colspan' => 2,
                ],
            ],

            [
                __(' Без НДС') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __(' С НДС') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],

                __('Без НДС') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('С НДС') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],

                __('Без НДС  ') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('С НДС  ') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
            ],
        ];


        $dtColumns = "[
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},

            {data: 'tovar_1', name: 'tovar_1'},
            {data: 'tovar_1_nds', name: 'tovar_1_nds'},
            {data: 'rabota_1', name: 'rabota_1'},
            {data: 'rabota_1_nds', name: 'rabota_1_nds'},
            {data: 'usluga_1', name: 'usluga_1'},
            {data: 'usluga_1_nds', name: 'usluga_1_nds'},
        ]";
        return view("site.report.3",compact('report', 'dtHeaders','dtColumns'));
    }

    /**
     * @param $report
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
     */
    final public function report4_data($report): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $dtHeaders = [
            [
                __('ID') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('Филиал') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('номер заявки') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('дата заявки') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('ФИО инициатора') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('Контактный телефон инициатора') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('отдел инициатора') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('вид закупки') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('Наименование предмета закупки(товар, работа, услуги)') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('Предмет закупки (товар,работа,услуга)') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('Гарантийный срок качества товара (работ, услуг)') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('сумма заявки') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('С НДС') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('Валюта') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('Наименование поставщика') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('сумма договора') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('Махсулот келишининг муддати') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('Статус') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('Начальник Исполнителя заявки') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('Исполнитель заявки') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('Бюджетни режалаштириш булими. Маълумот') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('Харидлар режасида мавжудлиги буича маълумот') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('Цель закупки') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('Основание(план закупок, рапорт, расспорежение руководства)') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
            ],
        ];


        $dtColumns = "[
        {data: 'id', name: 'id'},
        {data: 'branch_id', name: 'branch_id'},
        {data: 'number', name: 'number'},
        {data: 'date', name: 'date'},
        {data: 'user_id', name: 'user_id'},
        {data: 'phone', name: 'phone'},
        {data: 'department_initiator_id', name: 'department_initiator_id'},
        {data: 'type_of_purchase_id', name: 'type_of_purchase_id'},
        {data: 'name', name: 'name'},
        {data: 'subject', name: 'subject'},
        {data: 'expire_warranty_date', name: 'expire_warranty_date'},
        {data: 'planned_price', name: 'planned_price'},
        {data: 'with_nds', name: 'with_nds'},
        {data: 'currency', name: 'currency'},
        {data: 'supplier_name', name: 'supplier_name'},
        {data: 'contract_price', name: 'contract_price'},
        {data: 'delivery_date', name: 'delivery_date'},
        {
            'data': 'status',
            'name': 'status'
        },
        {data: 'performer_leader_user_id', name: 'performer_leader_user_id'},
        {data: 'performer_user_id', name: 'performer_user_id'},
        {data: 'info_business_plan', name: 'info_business_plan'},
        {data: 'info_purchase_plan', name: 'info_purchase_plan'},
        {data: 'purchase_basis', name: 'purchase_basis'},
        {data: 'basis', name: 'basis'},
    ]";
        return view('site.report.4',compact('report', 'dtHeaders','dtColumns'));
    }
    final public function report5_data($report): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $dtHeaders = [
            [
                __('ID') => [
                    'rowspan' => 2,
                    'colspan' => 0,
                ],
                __('Филиал') => [
                    'rowspan' => 2,
                    'colspan' => 0,
                ],
                __('Заключенные договора') => [
                    'rowspan' => 0,
                    'colspan' => 2,
                ],
                __('товар') => [
                    'rowspan' => 0,
                    'colspan' => 2,
                ],
                __('работа') => [
                    'rowspan' => 0,
                    'colspan' => 2,
                ],
                __('услуга') => [
                    'rowspan' => 0,
                    'colspan' => 2,
                ],
            ],
            [
                __(' кол-во') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __(' сумма') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],

                __('кол-во') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('сумма') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],

                __('кол-во ') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('сумма ') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],

                __('кол-во  ') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('сумма  ') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
            ],
        ];

        $dtColumns = "[
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},

            {data: 'count', name: 'count'},
            {data: 'summa', name: 'summa'},
            {data: 'count_1', name: 'count_1'},
            {data: 'summa_1', name: 'summa_1'},
            {data: 'count_2', name: 'count_2'},
            {data: 'summa_2', name: 'summa_2'},
            {data: 'count_3', name: 'count_3'},
            {data: 'summa_3', name: 'summa_3'},
        ]";
        return view('site.report._5',compact('report', 'dtHeaders','dtColumns'));
    }
}
