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
use http\Client\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use App\Models\Purchase;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class ReportService
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

    public function application_query()
    {
        $application =  Application::query()->where('status','!=','draft')->where('name', '!=', null);
        return $this->query = $application;
    }
    public function report_1(object $request, object $user)
    {
        if($user->hasPermission(PermissionEnum::Purchasing_Management_Center))
        {
            $query = Branch::query();
        }
        else{
            $query = Branch::query()->where('id', $user->branch_id)->get();
        }
        return Datatables::of($query)
            ->addColumn('count', function($branch){
                $applications = $this->application_query()->where('branch_id', $branch->id)->get();
                return count($applications);
            })
            ->addColumn('tovar', function($branch){
                $applications = $this->application_query()->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::one)->get();
                return count($applications);
            })
            ->addColumn('rabota', function($branch){
                $applications = $this->application_query()->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::two)->get();
                return count($applications);
            })
            ->addColumn('usluga', function($branch){
                $applications = $this->application_query()->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::three)->get();
                return count($applications);
            })
            ->addColumn('summa', function($branch){
                $applications = $this->application_query()->where('branch_id', $branch->id)->where('with_nds', '=',null)->pluck('planned_price')->toArray();
                $result = array_sum(preg_replace( '/[^0-9]/', '', $applications));
                return $result ? number_format($result, ApplicationMagicNumber::zero, '', ' ') : '0';
            })
            ->addColumn('nds', function($branch){
                $applications = $this->application_query()->where('branch_id', $branch->id)->where('with_nds', '!=',null)->pluck('planned_price')->toArray();
                $result = array_sum(preg_replace( '/[^0-9]/', '', $applications));
                return $result ? number_format($result, ApplicationMagicNumber::zero, '', ' ') : '0';
            })
            ->make(true);
    }
    public function report_2(object $request, object $user)
    {
        if($user->hasPermission(PermissionEnum::Purchasing_Management_Center))
        {
            $query = Branch::query();
        }
        else{
            $query = Branch::query()->where('id',$user->branch_id)->get();
        }
        return Datatables::of($query)
            ->addColumn('tovar_1', function($branch) use ($request){
                if($request->startDate !== null){
                    $start_date = $request->startDate;
                    $end_date = $request->endDate;
                }
                else{
                    $start_date = "2022-08-01";
                    $end_date = "2025-12-31";
                }
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::one)->pluck('planned_price')->toArray();
                $result = array_sum(preg_replace( '/[^0-9]/', '', $applications));
                return $result ? number_format($result, ApplicationMagicNumber::zero, '', ' ') : '0';
            })
            ->addColumn('rabota_1', function($branch) use ($request){
                if($request->startDate !== null){
                    $start_date = $request->startDate;
                    $end_date = $request->endDate;
                }
                else{
                    $start_date = "2022-08-01";
                    $end_date = "2025-12-31";
                }
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::two)->pluck('planned_price')->toArray();
                $result = array_sum(preg_replace( '/[^0-9]/', '', $applications));
                return $result ? number_format($result, ApplicationMagicNumber::zero, '', ' ') : '0';
            })
            ->addColumn('usluga_1', function($branch) use ($request){
                if($request->startDate !== null){
                    $start_date = $request->startDate;
                    $end_date = $request->endDate;
                }
                else{
                    $start_date = "2022-08-01";
                    $end_date = "2025-12-31";
                }
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::three)->pluck('planned_price')->toArray();
                $result = array_sum(preg_replace( '/[^0-9]/', '', $applications));
                return $result ? number_format($result, ApplicationMagicNumber::zero, '', ' ') : '0';
            })
            ->addColumn('tovar_2', function($branch) use ($request){
                if($request->startDate !== null){
                    $start_date = $request->startDate;
                    $end_date = $request->endDate;
                }
                else{
                    $start_date = "2022-08-01";
                    $end_date = "2025-12-31";
                }
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::one)->pluck('planned_price')->toArray();
                $result = array_sum(preg_replace( '/[^0-9]/', '', $applications));
                return $result ? number_format($result, ApplicationMagicNumber::zero, '', ' ') : '0';
            })
            ->addColumn('rabota_2', function($branch) use ($request){
                if($request->startDate !== null){
                    $start_date = $request->startDate;
                    $end_date = $request->endDate;
                }
                else{
                    $start_date = "2022-08-01";
                    $end_date = "2025-12-31";
                }
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::two)->pluck('planned_price')->toArray();
                $result = array_sum(preg_replace( '/[^0-9]/', '', $applications));
                return $result ? number_format($result, ApplicationMagicNumber::zero, '', ' ') : '0';
            })
            ->addColumn('usluga_2', function($branch) use ($request){
                if($request->startDate !== null){
                    $start_date = $request->startDate;
                    $end_date = $request->endDate;
                }
                else{
                    $start_date = "2022-08-01";
                    $end_date = "2025-12-31";
                }
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::three)->pluck('planned_price')->toArray();
                $result = array_sum(preg_replace( '/[^0-9]/', '', $applications));
                return $result ? number_format($result, ApplicationMagicNumber::zero, '', ' ') : '0';
            })
            ->addColumn('tovar_3', function($branch) use ($request){
                if($request->startDate !== null){
                    $start_date = $request->startDate;
                    $end_date = $request->endDate;
                }
                else{
                    $start_date = "2022-08-01";
                    $end_date = "2025-12-31";
                }
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::one)->pluck('planned_price')->toArray();
                $result = array_sum(preg_replace( '/[^0-9]/', '', $applications));
                return $result ? number_format($result, ApplicationMagicNumber::zero, '', ' ') : '0';
            })
            ->addColumn('rabota_3', function($branch) use ($request){
                if($request->startDate !== null){
                    $start_date = $request->startDate;
                    $end_date = $request->endDate;
                }
                else{
                    $start_date = "2022-08-01";
                    $end_date = "2025-12-31";
                }
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::two)->pluck('planned_price')->toArray();
                $result = array_sum(preg_replace( '/[^0-9]/', '', $applications));
                return $result ? number_format($result, ApplicationMagicNumber::zero, '', ' ') : '0';
            })
            ->addColumn('usluga_3', function($branch) use ($request){
                if($request->startDate !== null){
                    $start_date = $request->startDate;
                    $end_date = $request->endDate;
                }
                else{
                    $start_date = "2022-08-01";
                    $end_date = "2025-12-31";
                }
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::three)->pluck('planned_price')->toArray();
                $result = array_sum(preg_replace( '/[^0-9]/', '', $applications));
                return $result ? number_format($result, ApplicationMagicNumber::zero, '', ' ') : '0';
            })
            ->addColumn('tovar_4', function($branch) use ($request){
                if($request->startDate !== null){
                    $start_date = $request->startDate;
                    $end_date = $request->endDate;
                }
                else{
                    $start_date = "2022-08-01";
                    $end_date = "2025-12-31";
                }
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::one)->pluck('planned_price')->toArray();
                $result = array_sum(preg_replace( '/[^0-9]/', '', $applications));
                return $result ? number_format($result, ApplicationMagicNumber::zero, '', ' ') : '0';
            })
            ->addColumn('rabota_4', function($branch) use ($request){
                if($request->startDate !== null){
                    $start_date = $request->startDate;
                    $end_date = $request->endDate;
                }
                else{
                    $start_date = "2022-08-01";
                    $end_date = "2025-12-31";
                }
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::two)->pluck('planned_price')->toArray();
                $result = array_sum(preg_replace( '/[^0-9]/', '', $applications));
                return $result ? number_format($result, ApplicationMagicNumber::zero, '', ' ') : '0';
            })
            ->addColumn('usluga_4', function($branch) use ($request){
                if($request->startDate !== null){
                    $start_date = $request->startDate;
                    $end_date = $request->endDate;
                }
                else{
                    $start_date = "2022-08-01";
                    $end_date = "2025-12-31";
                }
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::three)->pluck('planned_price')->toArray();
                $result = array_sum(preg_replace( '/[^0-9]/', '', $applications));
                return $result ? number_format($result, ApplicationMagicNumber::zero, '', ' ') : '0';
            })
            ->make(true);
    }
    public function report_2_2(object $request, object $user)
    {
        if($user->hasPermission(PermissionEnum::Purchasing_Management_Center))
        {
            $query = Branch::query();
        }
        else{
            $query = Branch::query()->where('id',$user->branch_id)->get();
        }
        return Datatables::of($query)
            ->addColumn('tovar_1', function($branch) use ($request){
                if($request->startDate !== null){
                    $start_date = $request->startDate;
                    $end_date = $request->endDate;
                }
                else{
                    $start_date = "2022-08-01";
                    $end_date = "2025-12-31";
                }
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::one)->where('with_nds','=',null)->pluck('planned_price')->toArray();
                $result = array_sum(preg_replace( '/[^0-9]/', '', $applications));
                return $result ? number_format($result, ApplicationMagicNumber::zero, '', ' ') : '0';
            })
            ->addColumn('tovar_1_nds', function($branch) use ($request){
                if($request->startDate !== null){
                    $start_date = $request->startDate;
                    $end_date = $request->endDate;
                }
                else{
                    $start_date = "2022-08-01";
                    $end_date = "2025-12-31";
                }
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::one)->where('with_nds','!=',null)->pluck('planned_price')->toArray();
                $result = array_sum(preg_replace( '/[^0-9]/', '', $applications));
                return $result ? number_format($result, ApplicationMagicNumber::zero, '', ' ') : '0';
            })

            ->addColumn('rabota_1', function($branch) use ($request){
                if($request->startDate !== null){
                    $start_date = $request->startDate;
                    $end_date = $request->endDate;
                }
                else{
                    $start_date = "2022-08-01";
                    $end_date = "2025-12-31";
                }
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::two)->where('with_nds','=',null)->pluck('planned_price')->toArray();
                $result = array_sum(preg_replace( '/[^0-9]/', '', $applications));
                return $result ? number_format($result, ApplicationMagicNumber::zero, '', ' ') : '0';
            })
            ->addColumn('rabota_1_nds', function($branch) use ($request){
                if($request->startDate !== null){
                    $start_date = $request->startDate;
                    $end_date = $request->endDate;
                }
                else{
                    $start_date = "2022-08-01";
                    $end_date = "2025-12-31";
                }

                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::two)->where('with_nds','!=',null)->pluck('planned_price')->toArray();
                $result = array_sum(preg_replace( '/[^0-9]/', '', $applications));
                return $result ? number_format($result, ApplicationMagicNumber::zero, '', ' ') : '0';
            })
            ->addColumn('usluga_1', function($branch) use ($request){
                if($request->startDate !== null){
                    $start_date = $request->startDate;
                    $end_date = $request->endDate;
                }
                else{
                    $start_date = "2022-08-01";
                    $end_date = "2025-12-31";
                }
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::three)->where('with_nds','=',null)->pluck('planned_price')->toArray();
                $result = array_sum(preg_replace( '/[^0-9]/', '', $applications));
                return $result ? number_format($result, ApplicationMagicNumber::zero, '', ' ') : '0';
            })
            ->addColumn('usluga_1_nds', function($branch) use ($request){
                if($request->startDate !== null){
                    $start_date = $request->startDate;
                    $end_date = $request->endDate;
                }
                else{
                    $start_date = "2022-08-01";
                    $end_date = "2025-12-31";
                }
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::three)->where('with_nds','!=',null)->pluck('planned_price')->toArray();
                $result = array_sum(preg_replace( '/[^0-9]/', '', $applications));
                return $result ? number_format($result, ApplicationMagicNumber::zero, '', ' ') : '0';
            })
            ->addColumn('tovar_2', function($branch) use ($request){
                if($request->startDate !== null){
                    $start_date = $request->startDate;
                    $end_date = $request->endDate;
                }
                else{
                    $start_date = "2022-08-01";
                    $end_date = "2025-12-31";
                }
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::one)->where('with_nds','=',null)->pluck('planned_price')->toArray();
                $result = array_sum(preg_replace( '/[^0-9]/', '', $applications));
                return $result ? number_format($result, ApplicationMagicNumber::zero, '', ' ') : '0';
            })
            ->addColumn('tovar_2_nds', function($branch) use ($request){
                if($request->startDate !== null){
                    $start_date = $request->startDate;
                    $end_date = $request->endDate;
                }
                else{
                    $start_date = "2022-08-01";
                    $end_date = "2025-12-31";
                }
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::one)->where('with_nds','!=',null)->pluck('planned_price')->toArray();
                $result = array_sum(preg_replace( '/[^0-9]/', '', $applications));
                return $result ? number_format($result, ApplicationMagicNumber::zero, '', ' ') : '0';
            })
            ->addColumn('rabota_2', function($branch) use ($request){
                if($request->startDate !== null){
                    $start_date = $request->startDate;
                    $end_date = $request->endDate;
                }
                else{
                    $start_date = "2022-08-01";
                    $end_date = "2025-12-31";
                }
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::two)->where('with_nds','=',null)->pluck('planned_price')->toArray();
                $result = array_sum(preg_replace( '/[^0-9]/', '', $applications));
                return $result ? number_format($result, ApplicationMagicNumber::zero, '', ' ') : '0';
            })
            ->addColumn('rabota_2_nds', function($branch) use ($request){
                if($request->startDate !== null){
                    $start_date = $request->startDate;
                    $end_date = $request->endDate;
                }
                else{
                    $start_date = "2022-08-01";
                    $end_date = "2025-12-31";
                }
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::two)->where('with_nds','!=',null)->pluck('planned_price')->toArray();
                $result = array_sum(preg_replace( '/[^0-9]/', '', $applications));
                return $result ? number_format($result, ApplicationMagicNumber::zero, '', ' ') : '0';
            })
            ->addColumn('usluga_2', function($branch) use ($request){
                if($request->startDate !== null){
                    $start_date = $request->startDate;
                    $end_date = $request->endDate;
                }
                else{
                    $start_date = "2022-08-01";
                    $end_date = "2025-12-31";
                }
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::three)->where('with_nds','=',null)->pluck('planned_price')->toArray();
                $result = array_sum(preg_replace( '/[^0-9]/', '', $applications));
                return $result ? number_format($result, ApplicationMagicNumber::zero, '', ' ') : '0';
            })
            ->addColumn('usluga_2_nds', function($branch) use ($request){
                if($request->startDate !== null){
                    $start_date = $request->startDate;
                    $end_date = $request->endDate;
                }
                else{
                    $start_date = "2022-08-01";
                    $end_date = "2025-12-31";
                }
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::three)->where('with_nds','!=',null)->pluck('planned_price')->toArray();
                $result = array_sum(preg_replace( '/[^0-9]/', '', $applications));
                return $result ? number_format($result, ApplicationMagicNumber::zero, '', ' ') : '0';
            })
            ->addColumn('tovar_3', function($branch) use ($request){
                if($request->startDate !== null){
                    $start_date = $request->startDate;
                    $end_date = $request->endDate;
                }
                else{
                    $start_date = "2022-08-01";
                    $end_date = "2025-12-31";
                }
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::one)->where('with_nds','=',null)->pluck('planned_price')->toArray();
                $result = array_sum(preg_replace( '/[^0-9]/', '', $applications));
                return $result ? number_format($result, ApplicationMagicNumber::zero, '', ' ') : '0';
            })
            ->addColumn('tovar_3_nds', function($branch) use ($request){
                if($request->startDate !== null){
                    $start_date = $request->startDate;
                    $end_date = $request->endDate;
                }
                else{
                    $start_date = "2022-08-01";
                    $end_date = "2025-12-31";
                }

                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::one)->where('with_nds','!=',null)->pluck('planned_price')->toArray();
                $result = array_sum(preg_replace( '/[^0-9]/', '', $applications));
                return $result ? number_format($result, ApplicationMagicNumber::zero, '', ' ') : '0';
            })
            ->addColumn('rabota_3', function($branch) use ($request){
                if($request->startDate !== null){
                    $start_date = $request->startDate;
                    $end_date = $request->endDate;
                }
                else{
                    $start_date = "2022-08-01";
                    $end_date = "2025-12-31";
                }
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::two)->where('with_nds','=',null)->pluck('planned_price')->toArray();
                $result = array_sum(preg_replace( '/[^0-9]/', '', $applications));
                return $result ? number_format($result, ApplicationMagicNumber::zero, '', ' ') : '0';
            })
            ->addColumn('rabota_3_nds', function($branch) use ($request){
                if($request->startDate !== null){
                    $start_date = $request->startDate;
                    $end_date = $request->endDate;
                }
                else{
                    $start_date = "2022-08-01";
                    $end_date = "2025-12-31";
                }
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::two)->where('with_nds','!=',null)->pluck('planned_price')->toArray();
                $result = array_sum(preg_replace( '/[^0-9]/', '', $applications));
                return $result ? number_format($result, ApplicationMagicNumber::zero, '', ' ') : '0';
            })
            ->addColumn('usluga_3', function($branch) use ($request){
                if($request->startDate !== null){
                    $start_date = $request->startDate;
                    $end_date = $request->endDate;
                }
                else{
                    $start_date = "2022-08-01";
                    $end_date = "2025-12-31";
                }
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::three)->where('with_nds','=',null)->pluck('planned_price')->toArray();
                $result = array_sum(preg_replace( '/[^0-9]/', '', $applications));
                return $result ? number_format($result, ApplicationMagicNumber::zero, '', ' ') : '0';
            })
            ->addColumn('usluga_3_nds', function($branch) use ($request){
                if($request->startDate !== null){
                    $start_date = $request->startDate;
                    $end_date = $request->endDate;
                }
                else{
                    $start_date = "2022-08-01";
                    $end_date = "2025-12-31";
                }
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::three)->where('with_nds','!=',null)->pluck('planned_price')->toArray();
                $result = array_sum(preg_replace( '/[^0-9]/', '', $applications));
                return $result ? number_format($result, ApplicationMagicNumber::zero, '', ' ') : '0';
            })
            ->addColumn('tovar_4', function($branch) use ($request){
                if($request->startDate !== null){
                    $start_date = $request->startDate;
                    $end_date = $request->endDate;
                }
                else{
                    $start_date = "2022-08-01";
                    $end_date = "2025-12-31";
                }
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::one)->where('with_nds','=',null)->pluck('planned_price')->toArray();
                $result = array_sum(preg_replace( '/[^0-9]/', '', $applications));
                return $result ? number_format($result, ApplicationMagicNumber::zero, '', ' ') : '0';
            })
            ->addColumn('tovar_4_nds', function($branch) use ($request){
                if($request->startDate !== null){
                    $start_date = $request->startDate;
                    $end_date = $request->endDate;
                }
                else{
                    $start_date = "2022-08-01";
                    $end_date = "2025-12-31";
                }
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::one)->where('with_nds','!=',null)->pluck('planned_price')->toArray();
                $result = array_sum(preg_replace( '/[^0-9]/', '', $applications));
                return $result ? number_format($result, ApplicationMagicNumber::zero, '', ' ') : '0';
            })
            ->addColumn('rabota_4', function($branch) use ($request){
                if($request->startDate !== null){
                    $start_date = $request->startDate;
                    $end_date = $request->endDate;
                }
                else{
                    $start_date = "2022-08-01";
                    $end_date = "2025-12-31";
                }
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::two)->where('with_nds','!=',null)->pluck('planned_price')->toArray();
                $result = array_sum(preg_replace( '/[^0-9]/', '', $applications));
                return $result ? number_format($result, ApplicationMagicNumber::zero, '', ' ') : '0';
            })
            ->addColumn('rabota_4_nds', function($branch) use ($request){
                if($request->startDate !== null){
                    $start_date = $request->startDate;
                    $end_date = $request->endDate;
                }
                else{
                    $start_date = "2022-08-01";
                    $end_date = "2025-12-31";
                }
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::two)->where('with_nds','!=',null)->pluck('planned_price')->toArray();
                $result = array_sum(preg_replace( '/[^0-9]/', '', $applications));
                return $result ? number_format($result, ApplicationMagicNumber::zero, '', ' ') : '0';
            })
            ->addColumn('usluga_4', function($branch) use ($request){
                if($request->startDate !== null){
                    $start_date = $request->startDate;
                    $end_date = $request->endDate;
                }
                else{
                    $start_date = "2022-08-01";
                    $end_date = "2025-12-31";
                }
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::three)->where('with_nds','=',null)->pluck('planned_price')->toArray();
                $result = array_sum(preg_replace( '/[^0-9]/', '', $applications));
                return $result ? number_format($result, ApplicationMagicNumber::zero, '', ' ') : '0';
            })
            ->addColumn('usluga_4_nds', function($branch) use ($request){
                if($request->startDate !== null){
                    $start_date = $request->startDate;
                    $end_date = $request->endDate;
                }
                else{
                    $start_date = "2022-08-01";
                    $end_date = "2025-12-31";
                }
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::three)->where('with_nds','!=',null)->pluck('planned_price')->toArray();
                $result = array_sum(preg_replace( '/[^0-9]/', '', $applications));
                return $result ? number_format($result, ApplicationMagicNumber::zero, '', ' ') : '0';
            })
            ->make(true);
    }
    public function report_3(object $request, object $user)
    {
        if($user->hasPermission(PermissionEnum::Purchasing_Management_Center))
        {
            $query = Branch::query();
        }
        else{
            $query = Branch::find($user->branch_id);
        }
        return Datatables::of($query)
            ->addColumn('tovar_1', function($branch) use ($request){
                if($request->startDate !== null){
                    $start_date = $request->startDate;
                    $end_date = $request->endDate;
                }
                else{
                    $start_date = "2022-08-01";
                    $end_date = "2025-12-31";
                }
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::one)->where('with_nds','=',null)->pluck('planned_price')->toArray();
                $result = array_sum(preg_replace( '/[^0-9]/', '', $applications));
                return $result ? number_format($result, ApplicationMagicNumber::zero, '', ' ') : '0';
            })
            ->addColumn('tovar_1_nds', function($branch) use ($request){
                if($request->startDate !== null){
                    $start_date = $request->startDate;
                    $end_date = $request->endDate;
                }
                else{
                    $start_date = "2022-08-01";
                    $end_date = "2025-12-31";
                }
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::one)->where('with_nds','!=',null)->pluck('planned_price')->toArray();
                $result = array_sum(preg_replace( '/[^0-9]/', '', $applications));
                return $result ? number_format($result, ApplicationMagicNumber::zero, '', ' ') : '0';
            })

            ->addColumn('rabota_1', function($branch) use ($request){
                if($request->startDate !== null){
                    $start_date = $request->startDate;
                    $end_date = $request->endDate;
                }
                else{
                    $start_date = "2022-08-01";
                    $end_date = "2025-12-31";
                }
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::two)->where('with_nds','=',null)->pluck('planned_price')->toArray();
                $result = array_sum(preg_replace( '/[^0-9]/', '', $applications));
                return $result ? number_format($result, ApplicationMagicNumber::zero, '', ' ') : '0';
            })
            ->addColumn('rabota_1_nds', function($branch) use ($request){
                if($request->startDate !== null){
                    $start_date = $request->startDate;
                    $end_date = $request->endDate;
                }
                else{
                    $start_date = "2022-08-01";
                    $end_date = "2025-12-31";
                }
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::two)->where('with_nds','!=',null)->pluck('planned_price')->toArray();
                $result = array_sum(preg_replace( '/[^0-9]/', '', $applications));
                return $result ? number_format($result, ApplicationMagicNumber::zero, '', ' ') : '0';
            })
            ->addColumn('usluga_1', function($branch) use ($request){
                if($request->startDate !== null){
                    $start_date = $request->startDate;
                    $end_date = $request->endDate;
                }
                else{
                    $start_date = "2022-08-01";
                    $end_date = "2025-12-31";
                }
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::three)->where('with_nds','=',null)->pluck('planned_price')->toArray();
                $result = array_sum(preg_replace( '/[^0-9]/', '', $applications));
                return $result ? number_format($result, ApplicationMagicNumber::zero, '', ' ') : '0';
            })
            ->addColumn('usluga_1_nds', function($branch) use ($request){
                if($request->startDate !== null){
                    $start_date = $request->startDate;
                    $end_date = $request->endDate;
                }
                else{
                    $start_date = "2022-08-01";
                    $end_date = "2025-12-31";
                }
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::three)->where('with_nds','!=',null)->pluck('planned_price')->toArray();
                $result = array_sum(preg_replace( '/[^0-9]/', '', $applications));
                return $result ? number_format($result, ApplicationMagicNumber::zero, '', ' ') : '0';
            })
            ->make(true);
    }

    public function report_4(object $request, object $user)
    {
        if($user->hasPermission(PermissionEnum::Purchasing_Management_Center))
        {
            if($request->startDate === null){
                $query = $this->application_query();
            }else{
                $query = $this->application_query()->whereBetween('created_at', [$request->startDate, $request->endDate]);
            }
        }else{
            $query = $this->application_query()->where('branch_id',$user->branch_id)->where('draft','!=',ApplicationMagicNumber::one)->get();
        }
        return Datatables::of($query)
            ->editColumn('branch_id', function($application)
            {
                return $application->branch_id ? $application->branch->name:"";
            })
            ->editColumn('performer_user_id', function($application)
            {
                return $application->performer_user_id ? $application->performer->name:"";
            })
            ->editColumn('department_initiator_id', function($application)
            {
                return $application->department_initiator_id ? $application->department->name:"";
            })
            ->addColumn('phone', function($application)
            {
                return $application->user->phone ? $application->user->phone:"Not Phone Number";
            })
            ->editColumn('user_id', function($application)
            {
                return $application->user->name;
            })
            ->editColumn('type_of_purchase_id', function($application)
            {
                return $application->type_of_purchase_id ? $application->purchase->name:'';
            })
            ->editColumn('subject', function($application)
            {
                return $application->subject ? $application->subjects->name:'';
            })
            ->addColumn('planned_price', function ($query) {
                return !Str::contains($query->planned_price, ' ') ? number_format($query->planned_price, ApplicationMagicNumber::zero, '', ' ') : $query->planned_price;
            })
            ->editColumn('with_nds', function($application)
            {
                return $application->with_nds ?'Да':'Нет';
            })
            ->editColumn('status', function ($query) {
                /*
                     *  Voyager admin paneldan status ranglarini olish va chiqarish
                     */

                $status = $query->status;
                $color = setting("color.{$status}");
                if ($query->performer_status !== null) {
                    $a = StatusExtended::find($query->performer_status);
                    $status = $a->name;
                    $color = $a->color;
                }
                return json_encode(['backgroundColor' => $color,'app' => $this->translateStatus($status),'color' => $color ? 'white':'black']);
            })
            ->editColumn('product', function($application)
            {
                if($application->resource_id != null)
                {
                    foreach (json_decode($application->resource_id) as $product)
                    {
                        $all[] = Resource::find($product)->name;
                    }
                    return $all;
                }

            })
            ->addColumn('tovar_1', function($branch)
            {
                $date = ReportDate::where('report_key','date_3_month')->pluck('report_value')[0];
                $start_date = Carbon::parse("{$date}-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-31")
                    ->toDateTimeString();
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::one)->where('with_nds','=',null)->pluck('planned_price')->toArray();
                $result = array_sum(preg_replace( '/[^0-9]/', '', $applications));
                return $result ? number_format($result, ApplicationMagicNumber::zero, '', ' ') : '0';
            })
            ->rawColumns(['status'])
            ->make(true);
    }

    public function report_5(object $request, object $user)
    {
        if($user->hasPermission(PermissionEnum::Purchasing_Management_Center))
        {
            $query = Branch::query();
        }
        else{
            $query = Branch::query()->where('id',$user->branch_id)->get();
        }

        return Datatables::of($query)
            ->addColumn('count', function($branch) use ($request){
                if($request->startDate !== null){
                    $start_date = $request->startDate;
                    $end_date = $request->endDate;
                }
                else{
                    $start_date = "2022-08-01";
                    $end_date = "2025-12-31";
                }
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->whereNotNull('contract_price')->where('performer_status', '<=' ,39)->get();
                return count($applications);
            })
            ->addColumn('summa', function($branch) use ($request){
                if($request->startDate !== null){
                    $start_date = $request->startDate;
                    $end_date = $request->endDate;
                }
                else{
                    $start_date = "2022-08-01";
                    $end_date = "2025-12-31";
                }
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->whereNotNull('contract_price')->where('performer_status', '<=' ,39)->pluck('contract_price')->toArray();
                $result = array_sum(preg_replace( '/[^0-9]/', '', $applications));
                return $result ? number_format($result, ApplicationMagicNumber::zero, '', ' ') : '0';
            })
            ->addColumn('count_1', function($branch) use ($request){
                if($request->startDate !== null){
                    $start_date = $request->startDate;
                    $end_date = $request->endDate;
                }
                else{
                    $start_date = "2022-08-01";
                    $end_date = "2025-12-31";
                }
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->whereNotNull('contract_price')->where('subject',ApplicationMagicNumber::one)->get();
                return count($applications);
            })
            ->addColumn('summa_1', function($branch) use ($request){
                if($request->startDate !== null){
                    $start_date = $request->startDate;
                    $end_date = $request->endDate;
                }
                else{
                    $start_date = "2022-08-01";
                    $end_date = "2025-12-31";
                }
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->whereNotNull('contract_price')->where('subject',ApplicationMagicNumber::one)->pluck('contract_price')->toArray();
                $result = array_sum(preg_replace( '/[^0-9]/', '', $applications));
                return $result ? number_format($result, ApplicationMagicNumber::zero, '', ' ') : '0';
            })
            ->addColumn('count_2', function($branch) use ($request){
                if($request->startDate !== null){
                    $start_date = $request->startDate;
                    $end_date = $request->endDate;
                }
                else{
                    $start_date = "2022-08-01";
                    $end_date = "2025-12-31";
                }
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->whereNotNull('contract_price')->where('subject',ApplicationMagicNumber::two)->get();
                return count($applications);
            })
            ->addColumn('summa_2', function($branch) use ($request){
                if($request->startDate !== null){
                    $start_date = $request->startDate;
                    $end_date = $request->endDate;
                }
                else{
                    $start_date = "2022-08-01";
                    $end_date = "2025-12-31";
                }
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->whereNotNull('contract_price')->where('subject',ApplicationMagicNumber::two)->pluck('contract_price')->toArray();
                $result = array_sum(preg_replace( '/[^0-9]/', '', $applications));
                return $result ? number_format($result, ApplicationMagicNumber::zero, '', ' ') : '0';
            })
            ->addColumn('count_3', function($branch) use ($request){
                if($request->startDate !== null){
                    $start_date = $request->startDate;
                    $end_date = $request->endDate;
                }
                else{
                    $start_date = "2022-08-01";
                    $end_date = "2025-12-31";
                }
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->whereNotNull('contract_price')->where('subject',ApplicationMagicNumber::three)->get();
                return count($applications);
            })
            ->addColumn('summa_3', function($branch) use ($request){
                if($request->startDate !== null){
                    $start_date = $request->startDate;
                    $end_date = $request->endDate;
                }
                else{
                    $start_date = "2022-08-01";
                    $end_date = "2025-12-31";
                }
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->whereNotNull('contract_price')->where('subject',ApplicationMagicNumber::three)->pluck('contract_price')->toArray();
                $result = array_sum(preg_replace( '/[^0-9]/', '', $applications));
                return $result ? number_format($result, ApplicationMagicNumber::zero, '', ' ') : '0';
            })
            ->make(true);
    }

    public function report_6(object $request, object $user)
    {
        if($user->hasPermission(PermissionEnum::Purchasing_Management_Center))
        {

            if($request->startDate === null){
                $query = $this->application_query();
            }else{
                $query = $this->application_query()->whereBetween('created_at', [$request->startDate, $request->endDate]);
            }
        }else{
            $query = $this->application_query()->where('branch_id',$user->branch_id)->where('draft','!=',ApplicationMagicNumber::one)->get();
        }
        return Datatables::of($query)
            ->addColumn('name', function($branch){
                return Branch::query()->where('id', $branch->branch_id)->get()->pluck('name')->toArray();
            })
            ->addColumn('planned_price', function ($query) {
                return !Str::contains($query->planned_price, ' ') ? number_format($query->planned_price, ApplicationMagicNumber::zero, '', ' ') : $query->planned_price;
            })
            ->addColumn('product', function($application){
                $product = json_decode($application->resource_id,true);
                $names = collect($product);
                $ucnames = $names->map(function($item, $key) {
                    return Resource::find($item)->name;
                });
                return json_decode($ucnames);
            })->make(true);

    }

    public function report_7(object $request, object $user){
        if($user->hasPermission(PermissionEnum::Purchasing_Management_Center))
        {

            if($request->startDate === null){
                $query = $this->application_query();
            }else{
                $query = $this->application_query()->whereBetween('created_at', [$request->startDate, $request->endDate]);
            }
        }else{
            $query = $this->application_query()->where('branch_id',$user->branch_id)->where('draft','!=',ApplicationMagicNumber::one)->get();
        }
        return Datatables::of($query)
            ->addColumn('name', function($branch){
                $applications = Branch::query()->where('id', $branch->branch_id)->get()->pluck('name');
                $json = json_encode($applications,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
                return trim($json, '[], "');
            })
            ->addColumn('type_of_purchase', function($branch){
                $applications = Purchase::query()->where('id', $branch->type_of_purchase_id)->get()->pluck('name');
                $json = json_encode($applications,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
                return trim($json, '[], "');
            })

            ->make(true);
    }
    public function report_8(object $request, object $user){
        if($user->hasPermission(PermissionEnum::Purchasing_Management_Center))
        {

            if($request->startDate === null){
                $query = $this->application_query();
            }else{
                $query = $this->application_query()->whereBetween('created_at', [$request->startDate, $request->endDate]);
            }
        }else{
            $query = $this->application_query()->where('branch_id',$user->branch_id)->where('draft','!=',ApplicationMagicNumber::one)->get();
        }
        return Datatables::of($query)
            ->addColumn('initiator', function($branch){
                $applications = User::query()->where('id', $branch->user_id)->get()->pluck('name');
                $json = json_encode($applications,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
                return trim($json, '[], "');
            })
            ->editColumn('created_at', function ($query) {
                return $query->created_at ? with(new Carbon($query->created_at))->format('d-m-Y') : '';
            })
            ->addColumn('filial', function($branch){
                $applications = Branch::query()->where('id', $branch->branch_id)->get()->pluck('name');
                $json = json_encode($applications,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
                return trim($json, '[], "');
            })
            ->addColumn('type_of_purchase', function($branch){
                $applications = Purchase::query()->where('id', $branch->type_of_purchase_id)->get()->pluck('name');
                $json = json_encode($applications,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
                return trim($json, '[], "');
            })->addColumn('number_and_date_of_app', function($branch){
                return "{$branch->number } {$branch->date }";
            })
            ->addColumn('planned_price', function ($query) {
                return !Str::contains($query->planned_price, ' ') ? number_format($query->planned_price, ApplicationMagicNumber::zero, '', ' ') : $query->planned_price;
            })
            ->addColumn('product', function($application){
                $product = json_decode($application->resource_id,true);
                $names = collect($product);
                $ucnames = $names->map(function($item, $key) {
                    return Resource::find($item)->name;
                });
                return json_decode($ucnames);
            })
            ->editColumn('performer_user_id', function($application){
                return $application->performer_user_id ?$application->performer->name:'';
            })
            ->make(true);
    }

    public function report_9(object $request, object $user)
    {
        if($user->hasPermission(PermissionEnum::Purchasing_Management_Center))
        {
            $query = Branch::query();
        }
        else{
            $query = Branch::query()->where('id',$user->branch_id)->get();
        }

        return Datatables::of($query)
            ->addColumn('supplier_inn', function($branch){
                return $this->application_query()->where('branch_id', $branch->id)->pluck('supplier_inn')->toArray();
            })
            ->addColumn('contract_count', function($branch){
                $applications = $this->application_query()->where('branch_id', $branch->id)->where('contract_price','!=', null)->get();
                return count($applications);
            })
            ->addColumn('contract_sum', function($branch){
                $applications = $this->application_query()->where('branch_id', $branch->id)->pluck('contract_price')->toArray();
                $result = array_sum(preg_replace( '/[^0-9]/', '', $applications));
                return $result ? number_format($result, ApplicationMagicNumber::zero, '', ' ') : '0';
            })
            ->addColumn('eshop_count', function($branch){
                $applications = $this->application_query()->where('branch_id', $branch->id)->where('type_of_purchase_id', self::EShop_id)->get();
                return count($applications);
            })
            ->addColumn('eshop_sum', function($branch){
                $applications = $this->application_query()->where('branch_id', $branch->id)->where('type_of_purchase_id', self::EShop_id)->pluck('contract_price')->toArray();
                $result = array_sum(preg_replace( '/[^0-9]/', '', $applications));
                return $result ? number_format($result, ApplicationMagicNumber::zero, '', ' ') : '0';
            })
            ->addColumn('nat_eshop_count', function($branch){
                $applications = $this->application_query()->where('branch_id', $branch->id)->where('type_of_purchase_id', self::NationalEshop_id)->get();
                return count($applications);
            })
            ->addColumn('nat_eshop_sum', function($branch){
                $applications = $this->application_query()->where('branch_id', $branch->id)->where('type_of_purchase_id', self::NationalEshop_id)->pluck('contract_price')->toArray();
                $result = array_sum(preg_replace( '/[^0-9]/', '', $applications));
                return $result ? number_format($result, ApplicationMagicNumber::zero, '', ' ') : '0';
            })
            ->addColumn('auction_count', function($branch){
                $applications = $this->application_query()->where('branch_id', $branch->id)->where('type_of_purchase_id', self::ElectronicAuction_id)->get();
                return count($applications);
            })
            ->addColumn('auction_sum', function($branch){
                $applications = $this->application_query()->where('branch_id', $branch->id)->where('type_of_purchase_id', self::ElectronicAuction_id)->pluck('contract_price')->toArray();
                $result = array_sum(preg_replace( '/[^0-9]/', '', $applications));
                return $result ? number_format($result, ApplicationMagicNumber::zero, '', ' ') : '0';
            })
            ->addColumn('shaffof_count', function($branch){
                $applications = $this->application_query()->where('branch_id', $branch->id)->where('type_of_purchase_id', self::Shaffof_id)->get();
                return count($applications);
            })
            ->addColumn('shaffof_sum', function($branch){
                $applications = $this->application_query()->where('branch_id', $branch->id)->where('type_of_purchase_id', self::Shaffof_id)->pluck('contract_price')->toArray();
                $result = array_sum(preg_replace( '/[^0-9]/', '', $applications));
                return $result ? number_format($result, ApplicationMagicNumber::zero, '', ' ') : '0';
            })
            ->addColumn('tender_platform_count', function($branch){
                $applications = $this->application_query()->where('branch_id', $branch->id)->where('type_of_purchase_id', self::TenderPlatform_id)->get();
                return count($applications);
            })
            ->addColumn('tender_platform_sum', function($branch){
                $applications = $this->application_query()->where('branch_id', $branch->id)->where('type_of_purchase_id', self::TenderPlatform_id)->pluck('contract_price')->toArray();
                $result = array_sum(preg_replace( '/[^0-9]/', '', $applications));
                return $result ? number_format($result, ApplicationMagicNumber::zero, '', ' ') : '0';
            })
            ->addColumn('exchange_count', function($branch){
                $applications = $this->application_query()->where('branch_id', $branch->id)->where('type_of_purchase_id', self::ExchangeTrading_id)->get();
                return count($applications);
            })
            ->addColumn('exchange_sum', function($branch){
                $applications = $this->application_query()->where('branch_id', $branch->id)->where('type_of_purchase_id', self::ExchangeTrading_id)->pluck('contract_price')->toArray();
                $result = array_sum(preg_replace( '/[^0-9]/', '', $applications));
                return $result ? number_format($result, ApplicationMagicNumber::zero, '', ' ') : '0';
            })
            ->addColumn('konkurs_count', function($branch){
                $applications = $this->application_query()->where('branch_id', $branch->id)->where('type_of_purchase_id', self::Competition_id)->get();
                return count($applications);
            })
            ->addColumn('konkurs_sum', function($branch){
                $applications = $this->application_query()->where('branch_id', $branch->id)->where('type_of_purchase_id', self::Competition_id)->pluck('contract_price')->toArray();
                $result = array_sum(preg_replace( '/[^0-9]/', '', $applications));
                return $result ? number_format($result, ApplicationMagicNumber::zero, '', ' ') : '0';
            })
            ->addColumn('tender_count', function($branch){
                $applications = $this->application_query()->where('branch_id', $branch->id)->where('type_of_purchase_id', self::Tender_id)->get();
                return count($applications);
            })
            ->addColumn('tender_sum', function($branch){
                $applications = $this->application_query()->where('branch_id', $branch->id)->where('type_of_purchase_id', self::Tender_id)->pluck('contract_price')->toArray();
                $result = array_sum(preg_replace( '/[^0-9]/', '', $applications));
                return $result ? number_format($result, ApplicationMagicNumber::zero, '', ' ') : '0';
            })
            ->addColumn('offers_count', function($branch){
                $applications = $this->application_query()->where('branch_id', $branch->id)->where('type_of_purchase_id', self::SelectionOffers_id)->get();
                return count($applications);
            })
            ->addColumn('offers_sum', function($branch){
                $applications = $this->application_query()->where('branch_id', $branch->id)->where('type_of_purchase_id', self::SelectionOffers_id)->pluck('contract_price')->toArray();
                $result = array_sum(preg_replace( '/[^0-9]/', '', $applications));
                return $result ? number_format($result, ApplicationMagicNumber::zero, '', ' ') : '0';
            })
            ->addColumn('sole_supplier_count', function($branch){
                $applications = $this->application_query()->where('branch_id', $branch->id)->where('type_of_purchase_id', self::SoleSupplier_id)->get();
                return count($applications);
            })
            ->addColumn('sole_supplier_sum', function($branch){
                $applications = $this->application_query()->where('branch_id', $branch->id)->where('type_of_purchase_id', self::SoleSupplier_id)->pluck('contract_price')->toArray();
                $result = array_sum(preg_replace( '/[^0-9]/', '', $applications));
                return $result ? number_format($result, ApplicationMagicNumber::zero, '', ' ') : '0';
            })
            ->addColumn('direct_count', function($branch){
                $applications = $this->application_query()->where('branch_id', $branch->id)->where('type_of_purchase_id', self::Direct_id)->get();
                return count($applications);
            })
            ->addColumn('direct_sum', function($branch){
                $applications = $this->application_query()->where('branch_id', $branch->id)->where('type_of_purchase_id', self::Direct_id)->pluck('contract_price')->toArray();
                $result = array_sum(preg_replace( '/[^0-9]/', '', $applications));
                return $result ? number_format($result, ApplicationMagicNumber::zero, '', ' ') : '0';
            })
            ->addColumn('coop_count', function($branch){
                $applications = $this->application_query()->where('branch_id', $branch->id)->where('type_of_purchase_id', self::CooperationPortal_id)->get();
                return count($applications);
            })
            ->addColumn('coop_sum', function($branch){
                $applications = $this->application_query()->where('branch_id', $branch->id)->where('type_of_purchase_id', self::CooperationPortal_id)->pluck('contract_price')->toArray();
                $result = array_sum(preg_replace( '/[^0-9]/', '', $applications));
                return $result ? number_format($result, ApplicationMagicNumber::zero, '', ' ') : '0';
            })
            ->make(true);
    }

    public function report_10(object $request, object $user)
    {
        if($user->hasPermission(PermissionEnum::Purchasing_Management_Center))
        {
            $operator = '!=';
            $b = null;
        }else{
            $operator = '==';
            $b = $user->branch_id;
        }
        $this->a = 'branch_id';
        $this->operator = $operator;
        $this->b = $b;
        $status = StatusExtended::query();
        return Datatables::of($status)
            ->addColumn('january', function($status){
                $date = ReportDate::where('report_key','date_10')->pluck('report_value')[0];
                $start_date = Carbon::parse("{$date}-01-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-02-01")
                    ->toDateTimeString();
                $applications = Application::where('draft','!=',ApplicationMagicNumber::one)->whereBetween('created_at',[$start_date,$end_date])->where($this->a,$this->operator,$this->b)->where('performer_status', $status->id)->get();
                return count($applications);
            })
            ->addColumn('february', function($status){
                $date = ReportDate::where('report_key','date_10')->pluck('report_value')[0];
                $start_date = Carbon::parse("{$date}-02-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-03-01")
                    ->toDateTimeString();
                $applications = Application::where('draft','!=',ApplicationMagicNumber::one)->whereBetween('created_at',[$start_date,$end_date])->where($this->a,$this->operator,$this->b)->where('performer_status', $status->id)->get();
                return count($applications);
            })
            ->addColumn('march', function($status){
                $date = ReportDate::where('report_key','date_10')->pluck('report_value')[0];
                $start_date = Carbon::parse("{$date}-03-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-04-01")
                    ->toDateTimeString();
                $applications = Application::where('draft','!=',ApplicationMagicNumber::one)->whereBetween('created_at',[$start_date,$end_date])->where($this->a,$this->operator,$this->b)->where('performer_status', $status->id)->get();
                return count($applications);
            })
            ->addColumn('april', function($status){
                $date = ReportDate::where('report_key','date_10')->pluck('report_value')[0];
                $start_date = Carbon::parse("{$date}-04-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-05-01")
                    ->toDateTimeString();
                $applications = Application::where('draft','!=',ApplicationMagicNumber::one)->whereBetween('created_at',[$start_date,$end_date])->where($this->a,$this->operator,$this->b)->where('performer_status', $status->id)->get();
                return count($applications);
            })
            ->addColumn('may', function($status){
                $date = ReportDate::where('report_key','date_10')->pluck('report_value')[0];
                $start_date = Carbon::parse("{$date}-05-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-06-01")
                    ->toDateTimeString();
                $applications = Application::where('draft','!=',ApplicationMagicNumber::one)->whereBetween('created_at',[$start_date,$end_date])->where($this->a,$this->operator,$this->b)->where('performer_status', $status->id)->get();
                return count($applications);
            })
            ->addColumn('june', function($status){
                $date = ReportDate::where('report_key','date_10')->pluck('report_value')[0];
                $start_date = Carbon::parse("{$date}-06-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-07-01")
                    ->toDateTimeString();
                $applications = Application::where('draft','!=',ApplicationMagicNumber::one)->whereBetween('created_at',[$start_date,$end_date])->where($this->a,$this->operator,$this->b)->where('performer_status', $status->id)->get();
                return count($applications);
            })
            ->addColumn('july', function($status){
                $date = ReportDate::where('report_key','date_10')->pluck('report_value')[0];
                $start_date = Carbon::parse("{$date}-07-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-08-01")
                    ->toDateTimeString();
                $applications = Application::where('draft','!=',ApplicationMagicNumber::one)->whereBetween('created_at',[$start_date,$end_date])->where($this->a,$this->operator,$this->b)->where('performer_status', $status->id)->get();
                return count($applications);
            })
            ->addColumn('august', function($status){
                $date = ReportDate::where('report_key','date_10')->pluck('report_value')[0];
                $start_date = Carbon::parse("{$date}-08-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-09-01")
                    ->toDateTimeString();
                $applications = Application::where('draft','!=',ApplicationMagicNumber::one)->whereBetween('created_at',[$start_date,$end_date])->where($this->a,$this->operator,$this->b)->where('performer_status', $status->id)->get();
                return count($applications);
            })
            ->addColumn('september', function($status){
                $date = ReportDate::where('report_key','date_10')->pluck('report_value')[0];
                $start_date = Carbon::parse("{$date}-09-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-10-01")
                    ->toDateTimeString();
                $applications = Application::where('draft','!=',ApplicationMagicNumber::one)->whereBetween('created_at',[$start_date,$end_date])->where($this->a,$this->operator,$this->b)->where('performer_status', $status->id)->get();
                return count($applications);
            })
            ->addColumn('october', function($status){
                $date = ReportDate::where('report_key','date_10')->pluck('report_value')[0];
                $start_date = Carbon::parse("{$date}-10-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-11-01")
                    ->toDateTimeString();
                $applications = Application::where('draft','!=',ApplicationMagicNumber::one)->whereBetween('created_at',[$start_date,$end_date])->where($this->a,$this->operator,$this->b)->where('performer_status', $status->id)->get();
                return count($applications);
            })
            ->addColumn('november', function($status){
                $date = ReportDate::where('report_key','date_10')->pluck('report_value')[0];
                $start_date = Carbon::parse("{$date}-11-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-11-31")
                    ->toDateTimeString();
                $applications = Application::where('draft','!=',ApplicationMagicNumber::one)->whereBetween('created_at',[$start_date,$end_date])->where($this->a,$this->operator,$this->b)->where('performer_status', $status->id)->get();
                return count($applications);
            })
            ->addColumn('december', function($status){
                $date = ReportDate::where('report_key','date_10')->pluck('report_value')[0];
                $start_date = Carbon::parse("{$date}-12-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-12-31")
                    ->toDateTimeString();
                $applications = Application::where('draft','!=',ApplicationMagicNumber::one)->whereBetween('created_at',[$start_date,$end_date])->where($this->a,$this->operator,$this->b)->where('performer_status', $status->id)->get();
                return count($applications);
            })
            ->addColumn('all', function($status){
                $date = ReportDate::where('report_key','date_10')->pluck('report_value')[0];
                $start_date = Carbon::parse("{$date}-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-12-31")
                    ->toDateTimeString();
                $applications = Application::where('draft','!=',ApplicationMagicNumber::one)->whereBetween('created_at',[$start_date,$end_date])->where($this->a,$this->operator,$this->b)->where('performer_status', $status->id)->get();
                return count($applications);
            })
            ->make(true);
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
