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

        $dtColumns = array(
            array('data' => 'id', 'name' => 'id'),
            array('data' => 'name', 'name' => 'name'),
            array('data' => 'count', 'name' => 'count'),
            array('data' => 'tovar', 'name' => 'tovar'),
            array('data' => 'rabota', 'name' => 'rabota'),
            array('data' => 'usluga', 'name' => 'usluga'),
            array('data' => 'summa', 'name' => 'summa'),
            array('data' => 'nds', 'name' => 'nds')
        );
        return view("site.report._1",compact('report', 'dtHeaders','dtColumns'));
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

        $dtColumns = array(
            array('data' => 'id', 'name' => 'id'),
            array('data' => 'name', 'name' => 'name'),

            array('data' => 'tovar_1', 'name' => 'tovar_1'),
            array('data' => 'rabota_1', 'name' => 'rabota_1'),
            array('data' => 'usluga_1', 'name' => 'usluga_1'),

            array('data' => 'tovar_2', 'name' => 'tovar_2'),
            array('data' => 'rabota_2', 'name' => 'rabota_2'),
            array('data' => 'usluga_2', 'name' => 'usluga_2'),

            array('data' => 'tovar_3', 'name' => 'tovar_3'),
            array('data' => 'rabota_3', 'name' => 'rabota_3'),
            array('data' => 'usluga_3', 'name' => 'usluga_3'),

            array('data' => 'tovar_4', 'name' => 'tovar_4'),
            array('data' => 'rabota_4', 'name' => 'rabota_4'),
            array('data' => 'usluga_4', 'name' => 'usluga_4')
        );
        return view("site.report._2",compact('report', 'dtHeaders','dtColumns'));
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


        $dtColumns = array(
            array('data' => 'id', 'name' => 'id'),
            array('data' => 'name', 'name' => 'name'),
            array('data' => 'tovar_1', 'name' => 'tovar_1'),
            array('data' => 'tovar_1_nds', 'name' => 'tovar_1_nds'),
            array('data' => 'rabota_1', 'name' => 'rabota_1'),
            array('data' => 'rabota_1_nds', 'name' => 'rabota_1_nds'),
            array('data' => 'usluga_1', 'name' => 'usluga_1'),
            array('data' => 'usluga_1_nds', 'name' => 'usluga_1_nds'),
            array('data' => 'tovar_2', 'name' => 'tovar_2'),
            array('data' => 'tovar_2_nds', 'name' => 'tovar_2_nds'),
            array('data' => 'rabota_2', 'name' => 'rabota_2'),
            array('data' => 'rabota_2_nds', 'name' => 'rabota_2_nds'),
            array('data' => 'usluga_2', 'name' => 'usluga_2'),
            array('data' => 'usluga_2_nds', 'name' => 'usluga_2_nds'),
            array('data' => 'tovar_3', 'name' => 'tovar_3'),
            array('data' => 'tovar_3_nds', 'name' => 'tovar_3_nds'),
            array('data' => 'rabota_3', 'name' => 'rabota_3'),
            array('data' => 'rabota_3_nds', 'name' => 'rabota_3_nds'),
            array('data' => 'usluga_3', 'name' => 'usluga_3'),
            array('data' => 'usluga_3_nds', 'name' => 'usluga_3_nds'),
            array('data' => 'tovar_4', 'name' => 'tovar_4'),
            array('data' => 'tovar_4_nds', 'name' => 'tovar_4_nds'),
            array('data' => 'rabota_4', 'name' => 'rabota_4'),
            array('data' => 'rabota_4_nds', 'name' => 'rabota_4_nds'),
            array('data' => 'usluga_4', 'name' => 'usluga_4'),
            array('data' => 'usluga_4_nds', 'name' => 'usluga_4_nds')
        );
        return view("site.report._22",compact('report', 'dtHeaders','dtColumns'));
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


        $dtColumns = array(
            array('data' => 'id', 'name' => 'id'),
            array('data' => 'name', 'name' => 'name'),
            array('data' => 'tovar_1', 'name' => 'tovar_1'),
            array('data' => 'tovar_1_nds', 'name' => 'tovar_1_nds'),
            array('data' => 'rabota_1', 'name' => 'rabota_1'),
            array('data' => 'rabota_1_nds', 'name' => 'rabota_1_nds'),
            array('data' => 'usluga_1', 'name' => 'usluga_1'),
            array('data' => 'usluga_1_nds', 'name' => 'usluga_1_nds')
        );
        return view("site.report._3",compact('report', 'dtHeaders','dtColumns'));
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


        $dtColumns = array(
            array('data' => 'id', 'name' => 'id'),
            array('data' => 'branch_id', 'name' => 'branch_id'),
            array('data' => 'number', 'name' => 'number'),
            array('data' => 'date', 'name' => 'date'),
            array('data' => 'user_id', 'name' => 'user_id'),
            array('data' => 'phone', 'name' => 'phone'),
            array('data' => 'department_initiator_id', 'name' => 'department_initiator_id'),
            array('data' => 'type_of_purchase_id', 'name' => 'type_of_purchase_id'),
            array('data' => 'name', 'name' => 'name'),
            array('data' => 'subject', 'name' => 'subject'),
            array('data' => 'expire_warranty_date', 'name' => 'expire_warranty_date'),
            array('data' => 'planned_price', 'name' => 'planned_price'),
            array('data' => 'with_nds', 'name' => 'with_nds'),
            array('data' => 'currency', 'name' => 'currency'),
            array('data' => 'supplier_name', 'name' => 'supplier_name'),
            array('data' => 'contract_price', 'name' => 'contract_price'),
            array('data' => 'delivery_date', 'name' => 'delivery_date'),
            array('data' => 'status', 'name' => 'status'),
            array('data' => 'performer_leader_user_id', 'name' => 'performer_leader_user_id'),
            array('data' => 'performer_user_id', 'name' => 'performer_user_id'),
            array('data' => 'info_business_plan', 'name' => 'info_business_plan'),
            array('data' => 'info_purchase_plan', 'name' => 'info_purchase_plan'),
            array('data' => 'purchase_basis', 'name' => 'purchase_basis'),
            array('data' => 'basis', 'name' => 'basis')
        );
        return view('site.report._4',compact('report', 'dtHeaders','dtColumns'));
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

        $dtColumns = array(
            array('data' => 'id', 'name' => 'id'),
            array('data' => 'name', 'name' => 'name'),
            array('data' => 'count', 'name' => 'count'),
            array('data' => 'summa', 'name' => 'summa'),
            array('data' => 'count_1', 'name' => 'count_1'),
            array('data' => 'summa_1', 'name' => 'summa_1'),
            array('data' => 'count_2', 'name' => 'count_2'),
            array('data' => 'summa_2', 'name' => 'summa_2'),
            array('data' => 'count_3', 'name' => 'count_3'),
            array('data' => 'summa_3', 'name' => 'summa_3'),
        );
        return view('site.report._5',compact('report', 'dtHeaders','dtColumns'));
    }
    final public function report6_data($report): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
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
                __('Контрагент (предприятия поставляющий товаров. работ. услуг)') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('Договор (контракт)') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('Предмет закупки (товар,работа,услуга)') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('номер заявки') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('сумма заявки') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('Предмет договора (контракта) и краткая характеристика') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('Общая сумма договора (контракта)') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('Номер протокола внутренней комиссии') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('Дата протокола внутренней комиссии') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
            ],
        ];

        $dtColumns = array(
            array('data' => 'id', 'name' => 'id'),
            array('data' => 'name', 'name' => 'name'),
            array('data' => 'supplier_name', 'name' => 'supplier_name'),
            array('data' => 'contract_number', 'name' => 'contract_number'),
            array('data' => 'subject', 'name' => 'subject'),
            array('data' => 'number', 'name' => 'number'),
            array('data' => 'planned_price', 'name' => 'planned_price'),
            array('data' => 'contract_info', 'name' => 'contract_info'),
            array('data' => 'contract_price', 'name' => 'contract_price'),
            array('data' => 'protocol_number', 'name' => 'protocol_number'),
            array('data' => 'protocol_date', 'name' => 'protocol_date'),
        );
        return view('site.report._6',compact('report', 'dtHeaders','dtColumns'));
    }
    final public function report7_data($report): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $dtHeaders = [
            [
                __('ID') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('Источник финансирование') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('Наименование доставщика') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('Стир доставщика') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('Номер договора') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('Дата договора') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('Сумма договора') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('Валюта') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('Номер и дата лота размещенных на специальном информационном портале о государственных закупках') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('Тип закупки') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('Предмет закупки') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('Страна происхождения товаров (услуг)') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('Основание: Закон о государственных закупках / другие решения') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
            ],
        ];

        $dtColumns = array(
            array('data' => 'id', 'name' => 'id'),
            array('data' => 'name', 'name' => 'name'),
            array('data' => 'supplier_name', 'name' => 'supplier_name'),
            array('data' => 'supplier_inn', 'name' => 'supplier_inn'),
            array('data' => 'contract_number', 'name' => 'contract_number'),
            array('data' => 'contract_date', 'name' => 'contract_date'),
            array('data' => 'contract_price', 'name' => 'contract_price'),
            array('data' => 'currency', 'name' => 'currency'),
            array('data' => 'lot_number', 'name' => 'lot_number'),
            array('data' => 'type_of_purchase', 'name' => 'type_of_purchase'),
            array('data' => 'contract_info', 'name' => 'contract_info'),
            array('data' => 'country_produced_id', 'name' => 'country_produced_id'),
            array('data' => 'purchase_basis', 'name' => 'purchase_basis'),
        );
        return view('site.report._7',compact('report', 'dtHeaders','dtColumns'));
    }
    final public function report8_data($report): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
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
                __('Информация о заявке') => [
                    'rowspan' => 0,
                    'colspan' => 4,
                ],
                __('Наименование товара') => [
                    'rowspan' => 2,
                    'colspan' => 0,
                ],
                __('Вид закупки') => [
                    'rowspan' => 2,
                    'colspan' => 0,
                ],
                __('Договор') => [
                    'rowspan' => 0,
                    'colspan' => 3,
                ],
                __('Исполнитель') => [
                    'rowspan' => 2,
                    'colspan' => 0,
                ],
                __('Дата Создания') => [
                    'rowspan' => 2,
                    'colspan' => 0,
                ],
            ],
            [
                __('Номер и дата заявки') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('Планируемый бюджет закупки (сум)') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('Дата получения отделом') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('Инициатор') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('Номер договора') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('Поставщик') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
                __('Сумма') => [
                    'rowspan' => 0,
                    'colspan' => 0,
                ],
            ],
        ];

        $dtColumns = array(
            array('data' => 'id', 'name' => 'id'),
            array('data' => 'filial', 'name' => 'filial'),
            array('data' => 'number_and_date_of_app', 'name' => 'number_and_date_of_app'),
            array('data' => 'planned_price', 'name' => 'planned_price'),
            array('data' => 'performer_received_date', 'name' => 'performer_received_date'),
            array('data' => 'initiator', 'name' => 'initiator'),
            array('data' => 'product', 'name' => 'product'),
            array('data' => 'type_of_purchase', 'name' => 'type_of_purchase'),
            array('data' => 'contract_number', 'name' => 'contract_number'),
            array('data' => 'supplier_name', 'name' => 'supplier_name'),
            array('data' => 'contract_price', 'name' => 'contract_price'),
            array('data' => 'performer_user_id', 'name' => 'performer_user_id'),
            array('data' => 'created_at', 'name' => 'created_at'),
        );
        return view('site.report._8',compact('report', 'dtHeaders','dtColumns'));
    }
    final public function report9_data($report): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $dtHeaders = [
            [
                __('ID') => [
                    'rowspan' => 2,
                    'colspan' => 0,
                ],
                __('Наименование заказчика') => [
                    'rowspan' => 2,
                    'colspan' => 0,
                ],
                __('СТИР') => [
                    'rowspan' => 2,
                    'colspan' => 0,
                ],
                __('Договоры') => [
                    'rowspan' => 0,
                    'colspan' => 2,
                ],
                __('Через электронный магазин (E-shop)') => [
                    'rowspan' => 0,
                    'colspan' => 2,
                ],
                __('Через национальный магазин') => [
                    'rowspan' => 0,
                    'colspan' => 2,
                ],
                __('Через электронный аукцион') => [
                    'rowspan' => 0,
                    'colspan' => 2,
                ],
                __('Через кооперационный портал') => [
                    'rowspan' => 0,
                    'colspan' => 2,
                ],
                __('Через платформы "Шаффоф қурилиш"') => [
                    'rowspan' => 0,
                    'colspan' => 2,
                ],
                __('Через электронные биржевые торги на специальных торговых площадках') => [
                    'rowspan' => 0,
                    'colspan' => 2,
                ],
                __('Через конкурс(выбор)') => [
                    'rowspan' => 0,
                    'colspan' => 2,
                ],
                __('Через тендер') => [
                    'rowspan' => 0,
                    'colspan' => 2,
                ],
                __('Выбор наиболее приемлемых предложений') => [
                    'rowspan' => 0,
                    'colspan' => 2,
                ],
                __('С едиными поставщиками') => [
                    'rowspan' => 0,
                    'colspan' => 2,
                ],
                __('Прямые (ПП-3988 и др. ПП, УП, РП)') => [
                    'rowspan' => 0,
                    'colspan' => 2,
                ],
            ],
        ];


        $dtColumns = "[
        {data: 'id', name: 'id'},
        {data: 'name', name: 'name'},

        {data: 'supplier_inn', name: 'supplier_inn'},

        {data: 'contract_count', name: 'contract_count'},
        {data: 'contract_sum', name: 'contract_sum'},

        {data: 'eshop_count', name: 'eshop_count'},
        {data: 'eshop_sum', name: 'eshop_sum'},

        {data: 'nat_eshop_count', name: 'nat_eshop_count'},
        {data: 'nat_eshop_sum', name: 'nat_eshop_sum'},

        {data: 'auction_count', name: 'auction_count'},
        {data: 'auction_sum', name: 'auction_sum'},

        {data: 'coop_count', name: 'coop_count'},
        {data: 'coop_sum', name: 'coop_sum'},

        {data: 'shaffof_count', name: 'shaffof_count'},
        {data: 'shaffof_sum', name: 'shaffof_sum'},


        {data: 'exchange_count', name: 'exchange_count'},
        {data: 'exchange_sum', name: 'exchange_sum'},


        {data: 'konkurs_count', name: 'konkurs_count'},
        {data: 'konkurs_sum', name: 'konkurs_sum'},

        {data: 'tender_count', name: 'tender_count'},
        {data: 'tender_sum', name: 'tender_sum'},

        {data: 'offers_count', name: 'offers_count'},
        {data: 'offers_sum', name: 'offers_sum'},

        {data: 'sole_supplier_count', name: 'sole_supplier_count'},
        {data: 'sole_supplier_sum', name: 'sole_supplier_sum'},

        {data: 'direct_count', name: 'direct_count'},
        {data: 'direct_sum', name: 'direct_sum'},
        ]";
        return view("site.report._9",compact('report', 'dtHeaders','dtColumns'));
    }
}
