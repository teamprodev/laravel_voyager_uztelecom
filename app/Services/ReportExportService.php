<?php

namespace App\Services;

use App\Enums\ApplicationMagicNumber;
use App\Enums\ApplicationStatusEnum;
use App\Enums\PermissionEnum;
use App\Exports\ApplicationExport;
use App\Models\Application;
use App\Models\Resource;
use App\Models\StatusExtended;
use App\Models\User;
use App\Reports\ALL;
use App\Reports\One;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Facades\Excel;
use OpenSpout\Common\Entity\Style\Style;
use Rap2hpoutre\FastExcel\FastExcel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ReportExportService
{
    public function export($model, object $request, object $user)
    {
        $title = $model::title();
        return Excel::download(new $model(Application::query()->where('status','!=','draft')->where('name', '!=', null),$request->startDate,$request->endDate), "$title.xlsx");
    }
    public function export1(ALL $model, object $request, object $user)
    {

        $query = $model::condition($request->startDate, $request->endDate);
        $applications = $query
            ->get()
            ->map(function ($application) use ($model,$request) {
                $data = $model::data($request->startDate, $request->endDate);
                foreach ($data as $item)
                {
                    $return[$item['title']] = $item['data']($application);
                }
                return $return;

            });
        $header_style = (new Style())->setFontBold();
        $rows_style = (new Style())
            ->setFontSize(15)
            ->setShouldWrapText(true)
            ->setBackgroundColor("EDEDED");
        dd($rows_style);
        return (new FastExcel($data))->download($model::title());
    }
    public function export_8(object $request, object $user)
    {
        if (!$user->hasPermission(PermissionEnum::Purchasing_Management_Center)) {
            $query = $this->application_query()
                ->where('branch_id', $user->branch_id)
                ->where('draft', '!=', ApplicationMagicNumber::one);
        } elseif ($request->startDate === null) {
            $query = $this->application_query();
        } else {
            $query = $this->application_query()
                ->whereBetween('created_at', [$request->startDate, $request->endDate]);
        }
        setlocale(LC_TIME, 'ru_RU.utf8');
        $query = $this->application_query()->where('status', 'extended');
        $applications = $query->get()->map(function ($application) {
            return [
                'ID' => $application->id,
                'Филиал' => optional($application->branch)->name,
                'Номер и дата заявки' => "{$application->number} {$application->date}",
                'Планируемый бюджет закупки (сум)' => !Str::contains($application->planned_price, ' ') ? number_format($application->planned_price, ApplicationMagicNumber::zero, '', ' ') : $application->planned_price,
                'Дата получения отделом' => $application->performer_received_date,
                'Инициатор' => optional(User::find($application->user_id))->name,
                'Наименование товара' => collect(json_decode($application->resource_id, true))
                                            ->map(fn($item) => Resource::find($item)->name)
                                            ->implode(', '),
                'Вид закупки' => optional($application->type_of_purchase)->name,
                'Номер договора' => $application->contract_number,
                'Поставщик' => $application->supplier_name,
                'Сумма' => $application->contract_price,
                'Исполнитель' => optional($application->performer)->name,
                'Дата Создания' => $application->created_at ? with(new Carbon($application->created_at))->format('d.m.Y') : '',
            ];
        });


        return (new FastExcel($applications))->download('8 - Отчет по видам закупки.xlsx');
    }
}
