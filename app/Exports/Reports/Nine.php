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

class Nine extends DefaultValueBinder implements FromCollection,WithEvents,WithHeadings,WithCustomStartCell,WithStyles
{
    const EShop_id = 1;
    const NationalEshop_id = 2;
    const ElectronicAuction_id = 3;
    const CooperationPortal_id = 4;
    const TenderPlatform_id = 5;
    const ExchangeTrading_id = 6;
    const Competition_id = 7;
    const Tender_id = 8;
    const Selection_id = 9;
    const SoleSupplier_id = 10;
    const Direct_id = 11;
    const Shaffof_id = 27;
    const SelectionOffers_id = 28;

    use Exportable;

    private $startDate;
    private $endDate;

    public function __construct($startDate,$endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        if(auth()->user()->hasPermission(PermissionEnum::Purchasing_Management_Center))
        {
            $this->query = Branch::query()->select('id','name','inn');
        }
        else{
            $this->query = Branch::query()->select('id','name','inn')->where('id',auth()->user()->branch_id);
        }
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
            'Договоры' => 'D1',
            'Через электронный магазин (E-shop)' => 'F1',
            'Через национальный магазин' => 'H1',
            'Через электронный аукцион' => 'J1',
            'Через кооперационный портал' => 'L1',
            'Через платформы "Шаффоф қурилиш"' => 'N1',
            'Через электронные биржевые торги на специальных торговых площадках' => 'P1',
            'Через конкурс(выбор)' => 'R1',
            'Через тендер' => 'T1',
            'Выбор наиболее приемлемых предложений' => 'V1',
            'С едиными поставщиками' => 'X1',
            'Прямые (ПП-3988 и др. ПП, УП, РП)' => 'Z1',
        ];
        foreach($data as $value=>$item){
            $sheet->setCellValue($item, $value);
        }
        $sheet->getStyle('1:2')->getFont()->setBold(true);
        return $sheet;
    }

    public function collection()
    {
        $query = $this->query->get();
        for($i = 0;$i<count($query);$i++)
        {
            //supplier_inn
            $query[$i]->inn = $this->get_9($query[$i])->pluck('supplier_inn')->toArray();
            $query[$i]->contract_count = $this->get_9($query[$i])->where('contract_price','!=', null)->get()->count();
            $query[$i]->contract_sum = $this->get_summa($this->get_9($query[$i])->pluck('contract_price')->toArray());
            $query[$i]->eshop_count = $this->get_9($query[$i])->where('type_of_purchase_id', self::EShop_id)->get()->count();
            $query[$i]->eshop_sum = $this->get_summa($this->get_9($query[$i])->where('type_of_purchase_id', self::EShop_id)->pluck('contract_price')->toArray());
            $query[$i]->nat_eshop_count = $this->get_9($query[$i])->where('type_of_purchase_id', self::NationalEshop_id)->get()->count();
            $query[$i]->nat_eshop_sum = $this->get_summa($this->get_9($query[$i])->where('type_of_purchase_id', self::NationalEshop_id)->pluck('contract_price')->toArray());
            $query[$i]->auction_count = $this->get_9($query[$i])->where('type_of_purchase_id', self::ElectronicAuction_id)->get()->count();
            $query[$i]->auction_sum = $this->get_summa($this->get_9($query[$i])->where('type_of_purchase_id', self::ElectronicAuction_id)->pluck('contract_price')->toArray());
            $query[$i]->coop_count = $this->get_9($query[$i])->where('type_of_purchase_id', self::CooperationPortal_id)->get()->count();
            $query[$i]->coop_sum = $this->get_summa($this->get_9($query[$i])->where('type_of_purchase_id', self::CooperationPortal_id)->pluck('contract_price')->toArray());
            $query[$i]->shaffof_count = $this->get_9($query[$i])->where('type_of_purchase_id', self::Shaffof_id)->get()->count();
            $query[$i]->shaffof_sum = $this->get_summa($this->get_9($query[$i])->where('type_of_purchase_id', self::Shaffof_id)->pluck('contract_price')->toArray());
            $query[$i]->exchange_count = $this->get_9($query[$i])->where('type_of_purchase_id', self::ExchangeTrading_id)->get()->count();
            $query[$i]->exchange_sum = $this->get_summa($this->get_9($query[$i])->where('type_of_purchase_id', self::ExchangeTrading_id)->pluck('contract_price')->toArray());
            $query[$i]->konkurs_count = $this->get_9($query[$i])->where('type_of_purchase_id', self::Competition_id)->get()->count();
            $query[$i]->konkurs_sum = $this->get_summa($this->get_9($query[$i])->where('type_of_purchase_id', self::Competition_id)->pluck('contract_price')->toArray());
            $query[$i]->tender_count = $this->get_9($query[$i])->where('type_of_purchase_id', self::Tender_id)->get()->count();
            $query[$i]->tender_sum = $this->get_summa($this->get_9($query[$i])->where('type_of_purchase_id', self::Tender_id)->pluck('contract_price')->toArray());
            $query[$i]->offers_count = $this->get_9($query[$i])->where('type_of_purchase_id', self::SelectionOffers_id)->get()->count();
            $query[$i]->offers_sum = $this->get_summa($this->get_9($query[$i])->where('type_of_purchase_id', self::SelectionOffers_id)->pluck('contract_price')->toArray());
            $query[$i]->sole_supplier_count = $this->get_9($query[$i])->where('type_of_purchase_id', self::SoleSupplier_id)->get()->count();
            $query[$i]->sole_supplier_sum = $this->get_summa($this->get_9($query[$i])->where('type_of_purchase_id', self::SoleSupplier_id)->pluck('contract_price')->toArray());
            $query[$i]->direct_count = $this->get_9($query[$i])->where('type_of_purchase_id', self::Direct_id)->get()->count();
            $query[$i]->direct_sum = $this->get_summa($this->get_9($query[$i])->where('type_of_purchase_id', self::Direct_id)->pluck('contract_price')->toArray());
        }
        return $query;
    }
    private function get_9($branch)
    {
        $start_date = $this->startDate ?? null;
        $end_date = $this->endDate ?? null;
        $applications = self::core();
        if($start_date)
            $applications = self::core()
                ->whereBetween('created_at', [$start_date, $end_date]);

        $result = $applications->where('branch_id', $branch->id)
            ->where('status', 'extended')
            ->whereNotNull('contract_price');

        return $result;
    }
    private function get_summa($applications)
    {
        $result = array_sum(preg_replace( '/[^0-9]/', '', $applications));
        return $result ? number_format($result, ApplicationMagicNumber::zero, '', ' ') : '0';
    }
    public function headings(): array
    {
        return [
            __('ID'),
            __('Наименование заказчика'),
            __('СТИР'),
            __('Количество'),
            __('Сумма'),
            __('Количество'),
            __('Сумма'),
            __('Количество'),
            __('Сумма'),
            __('Количество'),
            __('Сумма'),
            __('Количество'),
            __('Сумма'),
            __('Количество'),
            __('Сумма'),
            __('Количество'),
            __('Сумма'),
            __('Количество'),
            __('Сумма'),
            __('Количество'),
            __('Сумма'),
            __('Количество'),
            __('Сумма'),
            __('Количество'),
            __('Сумма'),
            __('Количество'),
            __('Сумма'),
        ];
    }
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
                $event->sheet->getDelegate()->getColumnDimension('E')->setWidth(40);
                $event->sheet->getDelegate()->getColumnDimension('G')->setWidth(40);
                $event->sheet->getDelegate()->getColumnDimension('I')->setWidth(40);
                $event->sheet->getDelegate()->getColumnDimension('K')->setWidth(40);
                $event->sheet->getDelegate()->getColumnDimension('M')->setWidth(40);
                $event->sheet->getDelegate()->getColumnDimension('O')->setWidth(40);
                $event->sheet->getDelegate()->getColumnDimension('Q')->setWidth(40);
                $event->sheet->getDelegate()->getColumnDimension('S')->setWidth(40);
                $event->sheet->getDelegate()->getColumnDimension('U')->setWidth(40);
                $event->sheet->getDelegate()->getColumnDimension('W')->setWidth(40);
                $event->sheet->getDelegate()->getColumnDimension('Y')->setWidth(40);
                $event->sheet->getDelegate()->getColumnDimension('AA')->setWidth(40);

                $event->sheet->mergeCells('D1:E1', Worksheet::MERGE_CELL_CONTENT_MERGE);
                $event->sheet->mergeCells('F1:G1', Worksheet::MERGE_CELL_CONTENT_MERGE);
                $event->sheet->mergeCells('H1:I1', Worksheet::MERGE_CELL_CONTENT_MERGE);
                $event->sheet->mergeCells('J1:K1', Worksheet::MERGE_CELL_CONTENT_MERGE);
                $event->sheet->mergeCells('L1:M1', Worksheet::MERGE_CELL_CONTENT_MERGE);
                $event->sheet->mergeCells('N1:O1', Worksheet::MERGE_CELL_CONTENT_MERGE);
                $event->sheet->mergeCells('P1:Q1', Worksheet::MERGE_CELL_CONTENT_MERGE);
                $event->sheet->mergeCells('R1:S1', Worksheet::MERGE_CELL_CONTENT_MERGE);
                $event->sheet->mergeCells('T1:U1', Worksheet::MERGE_CELL_CONTENT_MERGE);
                $event->sheet->mergeCells('V1:W1', Worksheet::MERGE_CELL_CONTENT_MERGE);
                $event->sheet->mergeCells('X1:Y1', Worksheet::MERGE_CELL_CONTENT_MERGE);
                $event->sheet->mergeCells('Z1:AA1', Worksheet::MERGE_CELL_CONTENT_MERGE);

                $event->sheet->getDelegate()->getStyle('1')
                    ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            },
        ];
    }
}
