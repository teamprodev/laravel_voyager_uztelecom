<?php

namespace App\Exports\Reports;

use App\Enums\ApplicationMagicNumber;
use App\Enums\PermissionEnum;
use App\Models\Application;
use App\Models\Branch;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithStyles;
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

class Two extends DefaultValueBinder implements FromCollection,WithHeadings,WithCustomStartCell,WithStyles
{
    use Exportable;

    private $startDate;
    private $endDate;

    public function __construct($startDate,$endDate)
    {
        if(auth()->user()->hasPermission(PermissionEnum::Purchasing_Management_Center))
        {
            $this->query = Branch::query()->select('id','name');
        }
        else{
            $this->query = Branch::query()->select('id','name')->where('id',auth()->user()->branch_id);
        }
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }
    private static function core()
    {
        $query =  Application::query()->where('status','!=','draft')->where('name', '!=', null);
        return $query;
    }

    public function startCell(): string
    {
        return 'A2';
    }
    /**
     * @return Worksheet
     */
    public function styles(Worksheet $sheet): Worksheet
    {
        $data = [
            '1 - Квартал ' => 'D1',
            '2 - Квартал' => 'G1',
            '3 - Квартал' => 'J1',
            '4 - Квартал' => 'M1',
        ];
        foreach($data as $value=>$item){
            $sheet->setCellValue($item, $value);
        }
        $sheet->getStyle(1)->getFont()->setBold(true);
        $sheet->getStyle(2)->getFont()->setBold(true);
        return $sheet;
    }

    public function collection()
    {
        $query = $this->query->get();
        for($i = 0;$i<count($query);$i++)
        {
            $query[$i]->tovar_1 = $this->get_2($query[$i], $this->startDate, $this->endDate, ApplicationMagicNumber::one, '01', '03');
            $query[$i]->rabota_1 = $this->get_2($query[$i], $this->startDate, $this->endDate, ApplicationMagicNumber::two, '01', '03');
            $query[$i]->usluga_1 = $this->get_2($query[$i], $this->startDate, $this->endDate, ApplicationMagicNumber::three, '01', '03');
            $query[$i]->tovar_2 = $this->get_2($query[$i], $this->startDate, $this->endDate, ApplicationMagicNumber::one, '04', '06');
            $query[$i]->rabota_2 = $this->get_2($query[$i], $this->startDate, $this->endDate, ApplicationMagicNumber::two, '04', '06');
            $query[$i]->usluga_2 = $this->get_2($query[$i], $this->startDate, $this->endDate, ApplicationMagicNumber::three, '04', '06');
            $query[$i]->tovar_3 = $this->get_2($query[$i], $this->startDate, $this->endDate, ApplicationMagicNumber::one, '07', '09');
            $query[$i]->rabota_3 = $this->get_2($query[$i], $this->startDate, $this->endDate, ApplicationMagicNumber::two, '07', '09');
            $query[$i]->usluga_3 = $this->get_2($query[$i], $this->startDate, $this->endDate, ApplicationMagicNumber::two, '07', '09');
            $query[$i]->tovar_4 = $this->get_2($query[$i], $this->startDate, $this->endDate, ApplicationMagicNumber::one, '10', '12');
            $query[$i]->rabota_4 = $this->get_2($query[$i], $this->startDate, $this->endDate, ApplicationMagicNumber::two, '10', '12');
            $query[$i]->usluga_4 = $this->get_2($query[$i], $this->startDate, $this->endDate, ApplicationMagicNumber::three, '10', '12');
        }
        return $query;
    }
    private function get_2($branch, $start_date,$end_date, $subject,$startMonth,$endMonth)
    {
        $start_date = $start_date ? "$start_date-$startMonth-01" : "2022-$startMonth-01";
        $end_date = $end_date ? "$end_date-$endMonth-31" : "2022-$endMonth-31";

        $applications = self::core()
            ->whereBetween('created_at', [$start_date, $end_date])->where('branch_id', $branch->id)
            ->where('subject', $subject)
            ->where('status', 'extended')
            ->pluck('planned_price')
            ->toArray();
        $result = array_sum(preg_replace('/[^0-9]/', '', $applications));
        return $result ? number_format($result, ApplicationMagicNumber::zero, '', ' ') : '0';
    }
    public function headings(): array
    {
        return [
            __('ID'),
            __('Филиал'),
            __('товар 1'),
            __('работа 1'),
            __('услуга 1'),
            __('товар 2'),
            __('работа 2'),
            __('услуга 2'),
            __('товар 3'),
            __('работа 3'),
            __('услуга 3'),
            __('товар 4'),
            __('работа 4'),
            __('услуга 4'),
        ];
    }
    public static function title() : string
    {
        return '2 - Отчет квартальный итоговый';
    }
}
