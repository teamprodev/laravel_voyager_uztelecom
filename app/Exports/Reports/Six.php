<?php

namespace App\Exports\Reports;

use App\Enums\ApplicationMagicNumber;
use App\Enums\PermissionEnum;
use App\Models\Application;
use App\Models\StatusExtended;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\DefaultValueBinder;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class Six extends DefaultValueBinder implements FromCollection,WithEvents,WithHeadings,WithCustomStartCell,WithStyles
{
    use Exportable;

    private $startDate;
    private $endDate;

    public function __construct($startDate,$endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        if(auth()->user()->hasPermission(PermissionEnum::Purchasing_Management_Center))
        {
            if($this->startDate === null){
                $this->query = self::core()->select('id', 'name', 'supplier_name', 'contract_number', 'subject', 'number', 'planned_price', 'contract_info', 'contract_price', 'protocol_number', 'protocol_date');
            }else{
                $this->query = self::core()->select('id', 'name', 'supplier_name', 'contract_number', 'subject', 'number', 'planned_price', 'contract_info', 'contract_price', 'protocol_number', 'protocol_date');
            }
        }else{
            $this->query = self::core()->select('id', 'name', 'supplier_name', 'contract_number', 'subject', 'number', 'planned_price', 'contract_info', 'contract_price', 'protocol_number', 'protocol_date');
        }
    }
    private static function core()
    {
        $query =  Application::query()->where('status','!=','draft')->where('name', '!=', null);
        return $query;
    }

    public function startCell(): string
    {
        return 'A1';
    }
    /**
     * @return Worksheet
     */
    public function styles(Worksheet $sheet): Worksheet
    {
        $sheet->getStyle('1')->getFont()->setBold(true);
        return $sheet;
    }

    public function collection()
    {
        $query = $this->query->get();
        $branches = $this->query->select('branch_id')->get();
        for($i = 0;$i<count($query);$i++)
        {
            $query[$i]->name = $branches[$i]->branch_id ? $branches[$i]->branch->name:"";
            $query[$i]->planned_price = !Str::contains($query[$i]->planned_price, ' ') ? number_format($query[$i]->planned_price, ApplicationMagicNumber::zero, '', ' ') : $query[$i]->planned_price;
        }
        return $query;
    }
    public function headings(): array
    {
        return [
            __('ID'),
            __('Филиал'),
            __('Контрагент (предприятия поставляющий товаров. работ. услуг)'),
            __('Договор (контракт)'),
            __('Предмет закупки (товар,работа,услуга)'),
            __('номер заявки'),
            __('сумма заявки'),
            __('Предмет договора (контракта) и краткая характеристика'),
            __('Общая сумма договора (контракта)'),
            __('Номер протокола внутренней комиссии'),
            __('Дата протокола внутренней комиссии'),
        ];
    }
    public static function title() : string
    {
        return '6 - Отчет свод';
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {

                $event->sheet->getDelegate()->getColumnDimension('B')->setWidth(60);
                $event->sheet->getDelegate()->getColumnDimension('C')->setWidth(60);
                $event->sheet->getDelegate()->getColumnDimension('D')->setWidth(50);
                $event->sheet->getDelegate()->getColumnDimension('H')->setWidth(55);
                $event->sheet->getDelegate()->getColumnDimension('I')->setWidth(50);
                $event->sheet->getDelegate()->getColumnDimension('J')->setWidth(50);
                $event->sheet->getDelegate()->getColumnDimension('K')->setWidth(50);
            },
        ];
    }
}
