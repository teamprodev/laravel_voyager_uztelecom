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
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\DefaultValueBinder;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class Four extends DefaultValueBinder implements FromCollection,WithColumnFormatting,WithHeadings,WithCustomStartCell,WithStyles
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
                $this->query = self::core()->select('id', 'branch_id', 'number', 'date', 'user_id', 'department_initiator_id', 'type_of_purchase_id', 'name', 'subject', 'expire_warranty_date', 'planned_price', 'with_nds', 'currency', 'supplier_name', 'contract_price', 'delivery_date', 'status', 'performer_leader_user_id', 'performer_user_id', 'info_business_plan', 'info_purchase_plan', 'purchase_basis', 'basis');
            }else{
                $this->query = self::core()->select('id', 'branch_id', 'number', 'date', 'user_id', 'department_initiator_id', 'type_of_purchase_id', 'name', 'subject', 'expire_warranty_date', 'planned_price', 'with_nds', 'currency', 'supplier_name', 'contract_price', 'delivery_date', 'status', 'performer_leader_user_id', 'performer_user_id', 'info_business_plan', 'info_purchase_plan', 'purchase_basis', 'basis')->whereBetween('created_at', [$this->startDate, $this->endDate]);
            }
        }else{
            $this->query = self::core()->select('id', 'branch_id', 'number', 'date', 'user_id', 'department_initiator_id', 'type_of_purchase_id', 'name', 'subject', 'expire_warranty_date', 'planned_price', 'with_nds', 'currency', 'supplier_name', 'contract_price', 'delivery_date', 'status', 'performer_leader_user_id', 'performer_user_id', 'info_business_plan', 'info_purchase_plan', 'purchase_basis', 'basis')->where('branch_id',auth()->user()->branch_id)->where('draft','!=',ApplicationMagicNumber::one)->get();
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

        for($i = 0;$i<count($query);$i++)
        {
            $attributes1 = array_keys($query[$i]->getAttributes());
            $attributes2 = array_values($query[$i]->getAttributes());
            array_splice($attributes1,
                5,0,'phone');
            array_splice($attributes2,
                5,0,isset($query[$i]->user->phone) ? $query[$i]->user->phone:"Not Phone Number");
            $query[$i]->branch_id = $query[$i]->branch_id ? $query[$i]->branch->name:"";
            $query[$i]->performer_user_id = $query[$i]->performer->name ?? $query[$i]->performer_user_id;
            $query[$i]->department_initiator_id = $query[$i]->department_initiator_id ? $query[$i]->department->name:"";
            $query[$i]->user_id = $query[$i]->user->name;
            $query[$i]->type_of_purchase_id = $query[$i]->type_of_purchase_id ? $query[$i]->purchase->name:'';
            $query[$i]->subject = $query[$i]->subject ? $query[$i]->subjects->name:'';
            $query[$i]->planned_price = !Str::contains($query[$i]->planned_price, ' ') ? number_format($query[$i]->planned_price, ApplicationMagicNumber::zero, '', ' ') : $query[$i]->planned_price;
            $query[$i]->with_nds = $query[$i]->with_nds ?'Да':'Нет';
            $query[$i]->status = $query[$i]->status ? $this->translateStatus($query[$i]->status) : StatusExtended::find($query[$i]->performer_status)->name;
            $query[$i]->setRawAttributes(array_combine($attributes1,$attributes2));
        }
        return $query;
    }
    public function columnFormats(): array
    {
        return [
            'F' =>  "0",
        ];
    }
    public function headings(): array
    {
        return [
            __('ID'),
            __('Филиал'),
            __('номер заявки'),
            __('дата заявки'),
            __('ФИО инициатора'),
            __('Контактный телефон инициатора'),
            __('отдел инициатора'),
            __('вид закупки'),
            __('Наименование предмета закупки(товар, работа, услуги)'),
            __('Предмет закупки (товар,работа,услуга)'),
            __('Гарантийный срок качества товара (работ, услуг)'),
            __('сумма заявки'),
            __('С НДС'),
            __('Валюта'),
            __('Наименование поставщика'),
            __('сумма договора'),
            __('Махсулот келишининг муддати'),
            __('Статус'),
            __('Начальник Исполнителя заявки'),
            __('Исполнитель заявки'),
            __('Бюджетни режалаштириш булими. Маълумот'),
            __('Харидлар режасида мавжудлиги буича маълумот'),
            __('Цель закупки'),
            __('Основание(план закупок, рапорт, расспорежение руководства)'),
        ];
    }
    public static function title() : string
    {
        return '4 - Отчет заявки по статусам';
    }
    private function translateStatus($status)
    {
        switch ($status) {
            case 'new':
                return __('new');
                break;
            case "in_process":
                return __('in_process');
                break;
            case "overdue":
                return __('overdue');
                break;
            case "refused":
                return __('refused');
                break;
            case "agreed":
                return __('agreed');
                break;
            case "rejected":
                return __('rejected');
                break;
            case "distributed":
                return __('distributed');
                break;
            case "canceled":
                return __('canceled');
                break;
            default:
                return $status;
        }
    }
}
