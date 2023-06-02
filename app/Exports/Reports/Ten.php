<?php

namespace App\Exports\Reports;

use App\Enums\ApplicationMagicNumber;
use App\Enums\PermissionEnum;
use App\Models\Application;
use App\Models\Branch;
use App\Models\StatusExtended;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
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

class Ten extends DefaultValueBinder implements WithStyles, FromCollection, WithHeadings,WithCustomStartCell,WithEvents
{
    use Exportable;

    private $startDate;
    private $endDate;

    public function __construct($startDate,$endDate)
    {
        if(auth()->user()->hasPermission(PermissionEnum::Purchasing_Management_Center))
        {
            $this->operator = '!=';
            $this->b = null;
        }else{
            $this->operator = '==';
            $this->b = auth()->user()->branch_id;
        }
        $this->a = 'branch_id';

        $this->query = StatusExtended::select('id','name');
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
    public function collection()
    {
        $query = $this->query->get();
        for($i = 0;$i<count($query);$i++)
        {
            $query[$i]->january = $this->get_10('01-01','02-01',$query[$i]);
            $query[$i]->february = $this->get_10('02-01','03-01',$query[$i]);
            $query[$i]->march = $this->get_10('03-01','04-01',$query[$i]);
            $query[$i]->april = $this->get_10('04-01','05-01',$query[$i]);
            $query[$i]->may = $this->get_10('05-01','06-01',$query[$i]);
            $query[$i]->june = $this->get_10('06-01','07-01',$query[$i]);
            $query[$i]->july = $this->get_10('07-01','08-01',$query[$i]);
            $query[$i]->august = $this->get_10('08-01','09-01',$query[$i]);
            $query[$i]->september = $this->get_10('09-01','10-01',$query[$i]);
            $query[$i]->october = $this->get_10('10-01','11-01',$query[$i]);
            $query[$i]->november = $this->get_10('11-01','12-01',$query[$i]);
            $query[$i]->december = $this->get_10('12-01','12-31',$query[$i]);
            $query[$i]->all = $this->get_10('01-01','12-31',$query[$i]);
            unset($query[$i]->id);
        }
        return $query;
    }
    private function get_10($startMonth,$endMonth,$query)
    {
        $year = Carbon::now()->year;
        $start_date = $this->startDate ? "$this->startDate-$startMonth" : "$year-$startMonth";
        $end_date = $this->endDate ? "$this->endDate-$endMonth" : "$year-$endMonth";

        $applications = Application::where('draft','!=',ApplicationMagicNumber::one)->whereBetween('created_at',[$start_date,$end_date])->where($this->a,$this->operator,$this->b)->where('performer_status', $query->id)->get();
        return count($applications);
    }
    public function headings(): array
    {
        return [
            __('Год'),
            __('Январь'),
            __('Февраль'),
            __('Март'),
            __('Апрель'),
            __('Май'),
            __('Июнь'),
            __('Июль'),
            __('Август'),
            __('Сентябрь'),
            __('Октябрь'),
            __('Ноябрь'),
            __('Декабрь'),
            __('Итого'),
        ];
    }
    public static function title() : string
    {
        return '10 - Отчет по кол-ву статусам';
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

                $event->sheet->getDelegate()->getColumnDimension('A')->setWidth(100);
                $event->sheet->getDelegate()->getStyle('1')
                    ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            },
        ];
    }
}
