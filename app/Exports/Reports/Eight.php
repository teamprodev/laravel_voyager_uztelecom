<?php

namespace App\Exports\Reports;

use App\Enums\ApplicationMagicNumber;
use App\Enums\PermissionEnum;
use App\Models\Application;
use App\Models\Branch;
use App\Models\Resource;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithStyles;
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

class Eight extends DefaultValueBinder implements FromCollection,WithEvents,WithHeadings,WithCustomStartCell,WithStyles
{
    use Exportable;

    private $startDate;
    private $endDate;

    /**
     * @param $startDate
     * @param $endDate
     */
    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        if(auth()->user()->hasPermission(PermissionEnum::Purchasing_Management_Center))
        {
            if($this->startDate === null){
                $this->query = self::core()->select('id', 'branch_id','number', 'planned_price', 'performer_received_date', 'initiator', 'product_info', 'type_of_purchase_id', 'contract_number', 'supplier_name', 'contract_price', 'performer_user_id', 'created_at');
            }else{
                $this->query = self::core()->select('id', 'branch_id','number', 'planned_price', 'performer_received_date', 'initiator', 'product_info', 'type_of_purchase_id', 'contract_number', 'supplier_name', 'contract_price', 'performer_user_id', 'created_at')->whereBetween('created_at', [$this->startDate, $this->endDate]);
            }
        }else{
            $this->query = self::core()->select('id', 'branch_id','number', 'planned_price', 'performer_received_date', 'initiator', 'product_info', 'type_of_purchase_id', 'contract_number', 'supplier_name', 'contract_price', 'performer_user_id', 'created_at')->where('branch_id',auth()->user()->branch_id)->where('draft','!=',ApplicationMagicNumber::one);
        }
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    private static function core(): \Illuminate\Database\Eloquent\Builder
    {
        $query =  Application::query()->where('status','!=','draft')->where('name', '!=', null);
        return $query;
    }

    /**
     * @return string
     */
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
            'Информация о заявке ' => 'D1',
            'Договор' => 'J1',
        ];
        foreach($data as $value=>$item){
            $sheet->setCellValue($item, $value);
        }
        $sheet->getStyle('1:2')->getFont()->setBold(true);
        return $sheet;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
     */
    public function collection(): \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection|array
    {
        $query = $this->query->get();
        for($i = 0;$i<count($query);$i++)
        {
            $query[$i]->initiator = isset($query[$i]->user->name) ? $query[$i]->user->name : 'User Deleted';
            $query[$i]->created_at = $query[$i]->created_at ? with(new Carbon($query[$i]->created_at))->format('d-m-Y') : '';
            $query[$i]->branch_id = $query[$i]->branch->name;
            $query[$i]->type_of_purchase_id = $query[$i]->type_of_purchase->name ?? [];
            //number_and_date_of_app
            $query[$i]->number = "{$query[$i]->number}  {$query[$i]->date}";
            $query[$i]->planned_price = !Str::contains($query[$i]->planned_price, ' ') ? number_format($query[$i]->planned_price, ApplicationMagicNumber::zero, '', ' ') : $query[$i]->planned_price;
            //product
            $query[$i]->product_info = $this->get_product($query[$i]);
            $query[$i]->performer_user_id = $query[$i]->performer->name ?? $query[$i]->performer_user_id;
        }
        return $query;
    }

    /**
     * @param $query
     * @return mixed
     */
    private function get_product($query)
    {
        $product = json_decode($query->resource_id,true);
        $names = collect($product);
        $ucnames = $names->map(function($item, $key) {
            return Resource::find($item)->name;
        });
        return json_decode($ucnames);
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            __('ID'),
            __('Филиал'),
            __('Номер и дата заявки'),
            __('Планируемый бюджет закупки (сум)'),
            __('Дата получения отделом'),
            __('Инициатор'),
            __('Наименование товара'),
            __('Вид закупки'),
            __('Номер договора'),
            __('Поставщик'),
            __('Сумма'),
            __('Исполнитель'),
            __('Дата Создания'),
        ];
    }

    /**
     * @return string
     */
    public static function title() : string
    {
        return '8 - Отчет по видам закупки';
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

                $event->sheet->getDelegate()->getColumnDimension('B')->setWidth(40);
                $event->sheet->getDelegate()->getColumnDimension('D')->setWidth(20);
                $event->sheet->getDelegate()->getColumnDimension('E')->setWidth(20);
                $event->sheet->getDelegate()->getColumnDimension('F')->setWidth(40);
                $event->sheet->getDelegate()->getColumnDimension('H')->setWidth(40);
                $event->sheet->getDelegate()->getColumnDimension('J')->setWidth(40);
                $event->sheet->getDelegate()->getColumnDimension('L')->setWidth(50);

                $event->sheet->mergeCells('C1:E1', Worksheet::MERGE_CELL_CONTENT_MERGE);
                $event->sheet->mergeCells('I1:K1', Worksheet::MERGE_CELL_CONTENT_MERGE);

                $event->sheet->getDelegate()->getStyle('1')
                    ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            },
        ];
    }
}
