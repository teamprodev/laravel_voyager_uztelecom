<?php

namespace App\Exports\Reports;

use App\Models\Application;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\DefaultValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class Seven extends DefaultValueBinder implements WithStyles, FromQuery, WithHeadings,WithCustomStartCell
{
    use Exportable;

    private $startDate;
    private $endDate;

    public function __construct($startDate,$endDate)
    {
        $this->query = Application::query()->where('status','!=','draft')->where('name', '!=', null);
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }
    public function startCell(): string
    {
        return 'A1';
    }
    public function styles(Worksheet $sheet): Worksheet
    {
        $sheet->getStyle('1')->getFont()->setBold(true);
        return $sheet;
    }
    public function query()
    {
        return $this->query->select(
            'id',
            'supplier_name',
            'supplier_inn',
            'contract_number',
            'contract_date',
            'contract_price',
            'currency',
            'lot_number',
            'contract_info',
            'country_produced_id',
            'purchase_basis'
        )
            ->with(['branch', 'type_of_purchase'])
            ->whereHas('branch')
            ->whereHas('type_of_purchase');
    }

    public function headings(): array
    {
        return [
            'ID',
            'Источник финансирование',
            'Наименование доставщика',
            'Стир доставщика',
            'Номер договора',
            'Дата договора',
            'Сумма договора',
            'Валюта',
            'Номер и дата лота размещенных на специальном информационном портале о государственных закупках',
            'Тип закупки',
            'Предмет закупки',
            'Страна происхождения товаров (услуг)',
            'Основание: Закон о государственных закупках / другие решения',
        ];
    }
    public static function title() : string
    {
        return '7 - Плановый';
    }
}
