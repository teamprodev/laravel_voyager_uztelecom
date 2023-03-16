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
    final public function report1_data($report)
    {
        $dtHeaders = [
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
        ];


        $dtTitles = [];

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
        return view("site.report.1",compact('report', 'dtHeaders', 'dtTitles','dtColumns'));
    }
    final public function report2_data($report)
    {
        $dtHeaders = [
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
        ];


        $dtTitles = [
            __('товар'),
            __('работа'),
            __('услуга'),

            __('товар'),
            __('работа'),
            __('услуга'),

            __('товар'),
            __('работа'),
            __('услуга'),

            __('товар'),
            __('работа'),
            __('услуга'),
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
        return view("site.report.2",compact('report', 'dtHeaders', 'dtTitles','dtColumns'));
    }
}
