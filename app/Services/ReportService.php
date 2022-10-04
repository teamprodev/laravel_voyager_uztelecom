<?php


namespace App\Services;

use App\Enums\ApplicationMagicNumber;
use App\Enums\ApplicationStatusEnum;
use App\Enums\PermissionEnum;
use App\Models\Application;
use App\Models\Branch;
use App\Models\Resource;
use App\Models\StatusExtented;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use App\Models\Purchase;
use Yajra\DataTables\DataTables;

class ReportService
{
    const TypeOfPurchaseElectronicShop_id = 1;
    const TypeOfPurchaseNationalEshop_id = 2;
    const TypeOfPurchaseElectronicAuction_id = 3;
    const TypeOfPurchaseCooperationPortal_id = 4;
    const TypeOfPurchaseTenderPlatform_id = 5;
    const TypeOfPurchaseExchangeTrading_id = 6;
    const TypeOfPurchaseCompetition_id = 7;
    const TypeOfPurchaseSoleSupplier_id = 10;
    const TypeOfPurchaseDirect_id = 11;

    public function application_query()
    {
        $application =  Application::query()->where('draft','!=',ApplicationMagicNumber::one);
        return $this->query = $application;
    }
    public function report_1()
    {
        /** @var User $authUser */
        $authUser = auth()->user();
        if($authUser->hasPermission('Purchasing_Management_Center'))
        {
            $query = Branch::query();
        }
        else{
            $query = Branch::query()->where('id', $authUser->branch_id)->get();
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
                return array_sum($applications);
            })
            ->addColumn('nds', function($branch){
                $applications = $this->application_query()->where('branch_id', $branch->id)->where('with_nds', '!=',null)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })
            ->make(true);
    }
    public function report_2()
    {
        if(auth()->user()->hasPermission('Purchasing_Management_Center'))
        {
            $query = Branch::query();
        }
        else{
            $query = Branch::query()->where('id',auth()->user()->branch_id)->get();
        }
        return Datatables::of($query)
            ->addColumn('tovar_1', function($branch){
                $date = Cache::get('date');
                $start_date = \Carbon\Carbon::parse("{$date}-01-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-03-31")
                    ->toDateTimeString();
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::one)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('rabota_1', function($branch){
                $date = Cache::get('date');
                $start_date = Carbon::parse("{$date}-01-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-03-31")
                    ->toDateTimeString();
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::two)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('usluga_1', function($branch){
                $date = Cache::get('date');
                $start_date = Carbon::parse("{$date}-01-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-03-31")
                    ->toDateTimeString();
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::three)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('tovar_2', function($branch){
                $date = Cache::get('date');
                $start_date = Carbon::parse("{$date}-04-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-06-31")
                    ->toDateTimeString();
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::one)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('rabota_2', function($branch){
                $date = Cache::get('date');
                $start_date = Carbon::parse("{$date}-04-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-06-31")
                    ->toDateTimeString();
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::two)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('usluga_2', function($branch){
                $date = Cache::get('date');
                $start_date = Carbon::parse("{$date}-04-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-06-31")
                    ->toDateTimeString();
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::three)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('tovar_3', function($branch){
                $date = Cache::get('date');
                $start_date = Carbon::parse("{$date}-07-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-09-31")
                    ->toDateTimeString();
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::one)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('rabota_3', function($branch){
                $date = Cache::get('date');
                $start_date = Carbon::parse("{$date}-07-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-09-31")
                    ->toDateTimeString();
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::two)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('usluga_3', function($branch){
                $date = Cache::get('date');
                $start_date = Carbon::parse("{$date}-07-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-09-31")
                    ->toDateTimeString();
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::three)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('tovar_4', function($branch){
                $date = Cache::get('date');
                $start_date = Carbon::parse("{$date}-10-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-12-31")
                    ->toDateTimeString();
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::one)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('rabota_4', function($branch){
                $date = Cache::get('date');
                $start_date = Carbon::parse("{$date}-10-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-12-31")
                    ->toDateTimeString();
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::two)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('usluga_4', function($branch){
                $date = Cache::get('date');
                $start_date = Carbon::parse("{$date}-10-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-12-31")
                    ->toDateTimeString();
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::three)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })
            ->make(true);
    }
    public function report_2_2()
    {
        if(auth()->user()->hasPermission('Purchasing_Management_Center'))
        {
            $query = Branch::query();
        }
        else{
            $query = Branch::query()->where('id',auth()->user()->branch_id)->get();
        }
        return Datatables::of($query)
            ->addColumn('tovar_1', function($branch){
                $date = Cache::get('date_2');
                $start_date = Carbon::parse("{$date}-01-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-03-31")
                    ->toDateTimeString();
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::one)->where('with_nds','=',null)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('tovar_1_nds', function($branch){
                $date = Cache::get('date_2');
                $start_date = Carbon::parse("{$date}-01-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-03-31")
                    ->toDateTimeString();
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::one)->where('with_nds','!=',null)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })

            ->addColumn('rabota_1', function($branch){
                $date = Cache::get('date_2');
                $start_date = Carbon::parse("{$date}-01-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-03-31")
                    ->toDateTimeString();
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::two)->where('with_nds','=',null)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('rabota_1_nds', function($branch){
                $date = Cache::get('date_2');
                $start_date = Carbon::parse("{$date}-01-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-03-31")
                    ->toDateTimeString();
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::two)->where('with_nds','!=',null)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('usluga_1', function($branch){
                $date = Cache::get('date_2');
                $start_date = Carbon::parse("{$date}-01-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-03-31")
                    ->toDateTimeString();
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::three)->where('with_nds','=',null)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('usluga_1_nds', function($branch){
                $date = Cache::get('date_2');
                $start_date = Carbon::parse("{$date}-01-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-03-31")
                    ->toDateTimeString();
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::three)->where('with_nds','!=',null)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('tovar_2', function($branch){
                $date = Cache::get('date_2');
                $start_date = Carbon::parse("{$date}-04-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-06-31")
                    ->toDateTimeString();
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::one)->where('with_nds','=',null)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('tovar_2_nds', function($branch){
                $date = Cache::get('date_2');
                $start_date = Carbon::parse("{$date}-04-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-06-31")
                    ->toDateTimeString();
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::one)->where('with_nds','!=',null)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('rabota_2', function($branch){
                $date = Cache::get('date_2');
                $start_date = Carbon::parse("{$date}-04-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-06-31")
                    ->toDateTimeString();
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::two)->where('with_nds','=',null)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('rabota_2_nds', function($branch){
                $date = Cache::get('date_2');
                $start_date = Carbon::parse("{$date}-04-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-06-31")
                    ->toDateTimeString();
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::two)->where('with_nds','!=',null)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('usluga_2', function($branch){
                $date = Cache::get('date_2');
                $start_date = Carbon::parse("{$date}-04-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-06-31")
                    ->toDateTimeString();
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::three)->where('with_nds','=',null)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('usluga_2_nds', function($branch){
                $date = Cache::get('date_2');
                $start_date = Carbon::parse("{$date}-04-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-06-31")
                    ->toDateTimeString();
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::three)->where('with_nds','!=',null)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('tovar_3', function($branch){
                $date = Cache::get('date_2');
                $start_date = Carbon::parse("{$date}-07-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-09-31")
                    ->toDateTimeString();
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::one)->where('with_nds','=',null)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('tovar_3_nds', function($branch){
                $date = Cache::get('date_2');
                $start_date = Carbon::parse("{$date}-07-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-09-31")
                    ->toDateTimeString();
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::one)->where('with_nds','!=',null)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('rabota_3', function($branch){
                $date = Cache::get('date_2');
                $start_date = Carbon::parse("{$date}-07-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-09-31")
                    ->toDateTimeString();
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::two)->where('with_nds','=',null)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('rabota_3_nds', function($branch){
                $date = Cache::get('date_2');
                $start_date = Carbon::parse("{$date}-07-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-09-31")
                    ->toDateTimeString();
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::two)->where('with_nds','!=',null)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('usluga_3', function($branch){
                $date = Cache::get('date_2');
                $start_date = Carbon::parse("{$date}-07-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-09-31")
                    ->toDateTimeString();
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::three)->where('with_nds','=',null)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('usluga_3_nds', function($branch){
                $date = Cache::get('date_2');
                $start_date = Carbon::parse("{$date}-07-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-09-31")
                    ->toDateTimeString();
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::three)->where('with_nds','!=',null)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('tovar_4', function($branch){
                $date = Cache::get('date_2');
                $start_date = Carbon::parse("{$date}-10-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-12-31")
                    ->toDateTimeString();
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::one)->where('with_nds','=',null)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('tovar_4_nds', function($branch){
                $date = Cache::get('date_2');
                $start_date = Carbon::parse("{$date}-10-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-12-31")
                    ->toDateTimeString();
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::one)->where('with_nds','!=',null)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('rabota_4', function($branch){
                $date = Cache::get('date_2');
                $start_date = Carbon::parse("{$date}-10-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-12-31")
                    ->toDateTimeString();
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::two)->where('with_nds','!=',null)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('rabota_4_nds', function($branch){
                $date = Cache::get('date_2');
                $start_date = Carbon::parse("{$date}-10-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-12-31")
                    ->toDateTimeString();
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::two)->where('with_nds','!=',null)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('usluga_4', function($branch){
                $date = Cache::get('date_2');
                $start_date = Carbon::parse("{$date}-10-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-12-31")
                    ->toDateTimeString();
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::three)->where('with_nds','=',null)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('usluga_4_nds', function($branch){
                $date = Cache::get('date_2');
                $start_date = Carbon::parse("{$date}-10-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-12-31")
                    ->toDateTimeString();
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::three)->where('with_nds','!=',null)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })
            ->make(true);
    }
    public function report_3()
    {
        if(auth()->user()->hasPermission('Purchasing_Management_Center'))
        {
            $query = Branch::query();
        }
        else{
            $query = Branch::find(auth()->user()->branch_id);
        }
        return Datatables::of($query)
            ->addColumn('tovar_1', function($branch){
                $date = Cache::get('date_3_month');
                $start_date = Carbon::parse("{$date}-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-31")
                    ->toDateTimeString();
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::one)->where('with_nds','=',null)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('tovar_1_nds', function($branch){
                $date = Cache::get('date_3_month');
                $start_date = Carbon::parse("{$date}-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-31")
                    ->toDateTimeString();
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::one)->where('with_nds','!=',null)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })

            ->addColumn('rabota_1', function($branch){
                $date = Cache::get('date_3_month');
                $start_date = Carbon::parse("{$date}-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-31")
                    ->toDateTimeString();
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::two)->where('with_nds','=',null)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('rabota_1_nds', function($branch){
                $date = Cache::get('date_3_month');
                $start_date = Carbon::parse("{$date}-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-31")
                    ->toDateTimeString();
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::two)->where('with_nds','!=',null)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('usluga_1', function($branch){
                $date = Cache::get('date_3_month');
                $start_date = Carbon::parse("{$date}-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-31")
                    ->toDateTimeString();
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::three)->where('with_nds','=',null)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('usluga_1_nds', function($branch){
                $date = Cache::get('date_3_month');
                $start_date = Carbon::parse("{$date}-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-31")
                    ->toDateTimeString();
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::three)->where('with_nds','!=',null)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })
            ->make(true);
    }

    public function report_4()
    {
        if(auth()->user()->hasPermission('Purchasing_Management_Center'))
        {

            $query = $this->application_query();
        }else{
            $query = $this->application_query()->where('branch_id',auth()->user()->branch_id)->where('draft','!=',ApplicationMagicNumber::one)->get();
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
                return $query->planned_price ? number_format($query->planned_price, ApplicationMagicNumber::zero, '', ' ') : '';
            })
            ->editColumn('with_nds', function($application)
            {
                return $application->with_nds ?'Да':'Нет';
            })
            ->editColumn('status', function ($query) {
                $application_status = $query->status;
                $status_new = __('Новая');
                $status_in_process = __('На рассмотрении');
                $status_refused = __('Отказана');
                $status_agreed = __('Согласована');
                $status_rejected = __('Отклонена');
                $status_accepted = __('Принята');
                $status_distributed = __('Распределен');
                $status_cancelled = __('Отменен');
                $status_performed = __('Товар доставлен');
                $status_overdue = ('просрочен');
                switch($application_status)
                {
                    case $query->performer_status !== null:
                        $application_service = new ApplicationService;
                        $a = StatusExtented::find($query->performer_status);
                        return $application_service->status($a->name);
                    case ApplicationStatusEnum::New:
                        $status = setting('color.new');
                        $color = $status ? 'white' : 'black';
                        return "<div style='background-color: {$status};color: {$color};' class='text-center m-1 col edit btn-sm'>{$status_new}</div>";
                        break;
                    case ApplicationStatusEnum::In_Process:
                        $status = setting('color.in_process');
                        $color = $status ? 'white' : 'black';
                        return "<div style='background-color: {$status};color: {$color};' class='text-center m-1 col edit btn-sm'>{$status_in_process}</div>";
                    case ApplicationStatusEnum::Overdue:
                        $status = setting('color.overdue');
                        $color = $status ? 'white' : 'black';
                        return "<div style='background-color: {$status};color: {$color};' class='text-center m-1 col edit btn-sm'>{$status_overdue}</div>";
                    case ApplicationStatusEnum::Accepted:
                        $status = setting('color.accepted');
                        $color = $status ? 'white' : 'black';
                        return "<div style='background-color: {$status};color: {$color};' class='text-center m-1 col edit btn-sm'>{$status_accepted}</div>";
                    case ApplicationStatusEnum::Refused:
                        $status = setting('color.rejected');
                        $color = $status ? 'white' : 'black';
                        return "<div style='background-color: {$status};color: {$color};' class='text-center m-1 col edit btn-sm'>{$status_refused}</div>";
                    case ApplicationStatusEnum::Agreed:
                        $status = setting('color.agreed');
                        $color = $status ? 'white' : 'black';
                        return "<div style='background-color: {$status};color: {$color};' class='text-center m-1 col edit btn-sm'>{$status_agreed}</div>";
                    case ApplicationStatusEnum::Rejected:
                        $status = setting('color.rejected');
                        $color = $status ? 'white' : 'black';
                        return "<div style='background-color: {$status};color: {$color};' class='text-center m-1 col edit btn-sm'>{$status_rejected}</div>";
                    case ApplicationStatusEnum::Distributed:
                        $status = setting('color.distributed');
                        $color = $status ? 'white' : 'black';
                        return "<div style='background-color: {$status};color: {$color};' class='text-center m-1 col edit btn-sm'>{$status_distributed}</div>";
                    case ApplicationStatusEnum::Canceled:
                        $status = setting('color.rejected');
                        $color = $status ? 'white' : 'black';
                        return "<div style='background-color: {$status};color: {$color};' class='text-center m-1 col edit btn-sm'>{$status_cancelled}</div>";
                    case ApplicationStatusEnum::Partially_Completed:
                        $status = setting('color.partially');
                        $color = $status ? 'white' : 'black';
                        return "<div style='background-color: {$status};color: {$color};' class='text-center m-1 col edit btn-sm'>Выполнено частично</div>";
                    case ApplicationStatusEnum::Completed_Full:
                        $status = setting('color.total_volume');
                        $color = $status ? 'white' : 'black';
                        return "<div style='background-color: {$status};color: {$color};' class='text-center m-1 col edit btn-sm'>Выполнено в полном объёме</div>";
                    case ApplicationStatusEnum::Management_Canceled:
                        $status = setting('color.nulled_by_management');
                        $color = $status ? 'white' : 'black';
                        return "<div style='background-color: {$status};color: {$color};' class='text-center m-1 col edit btn-sm'>Заявка аннулирована по заданию руководства</div>";
                    case ApplicationStatusEnum::Uztelecom_Canceled:
                        $status = setting('color.nulled_by_management');
                        $color = $status ? 'white' : 'black';
                        return "<div style='background-color: {$status};color: {$color};' class='text-center m-1 col edit btn-sm'>Договор аннулирован по инициативе Узбектелеком</div>";
                    case ApplicationStatusEnum::Application_Uztelecom:
                        $status = setting('color.nulled_by_management');
                        $color = $status ? 'white' : 'black';
                        return "<div style='background-color: {$status};color: {$color};' class='text-center m-1 col edit btn-sm'>заявка передана в Узтелеком</div>";
                    case ApplicationStatusEnum::Order_Delivered:
                        $status = setting('color.delivered');
                        $color = $status ? 'white' : 'black';
                        return "<div class='row'>
                            <div style='background-color: {$status};color: {$color};' class='text-center m-1 col edit btn-sm'>{$status_performed}</div>
                            </div>";
                    case ApplicationStatusEnum::Contract_Concluded:
                        $status = setting('color.concluded');
                        $color = $status ? 'white' : 'black';
                        return "<div class='row'>
                            <div style='background-color: {$status};color: {$color};' class='text-center m-1 col edit btn-sm'>договор заключен</div>
                            </div>";
                    default:
                        return $application_status;
                }
            })
            ->editColumn('resource_id', function($application)
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
                $date = Cache::get('date_3_month');
                $start_date = Carbon::parse("{$date}-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-31")
                    ->toDateTimeString();
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('subject',ApplicationMagicNumber::one)->where('with_nds','=',null)->pluck('planned_price')->toArray();
                return array_sum($applications);
            })
            ->rawColumns(['status'])
            ->make(true);
    }

    public function report_5()
    {
        if(auth()->user()->hasPermission('Purchasing_Management_Center'))
        {
            $query = Branch::query();
        }
        else{
            $query = Branch::query()->where('id',auth()->user()->branch_id)->get();
        }
        return Datatables::of($query)
            ->addColumn('count', function($branch){
                $date = Cache::get('date_5');
                $start_date = \Carbon\Carbon::parse("{$date}-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-31")
                    ->toDateTimeString();
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('currency','!=','USD')->get();
                return count($applications);
            })
            ->addColumn('summa', function($branch){
                $date = Cache::get('date_5');
                $start_date = \Carbon\Carbon::parse("{$date}-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-31")
                    ->toDateTimeString();
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('currency','!=','USD')->pluck('contract_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('count_1', function($branch){
                $date = Cache::get('date_5');
                $start_date = \Carbon\Carbon::parse("{$date}-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-31")
                    ->toDateTimeString();
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('currency','!=','USD')->where('subject',ApplicationMagicNumber::one)->get();
                return count($applications);
            })
            ->addColumn('summa_1', function($branch){
                $date = Cache::get('date_5');
                $start_date = \Carbon\Carbon::parse("{$date}-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-31")
                    ->toDateTimeString();
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('currency','!=','USD')->where('subject',ApplicationMagicNumber::one)->pluck('contract_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('count_2', function($branch){
                $date = Cache::get('date_5');
                $start_date = \Carbon\Carbon::parse("{$date}-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-31")
                    ->toDateTimeString();
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('currency','!=','USD')->where('subject',ApplicationMagicNumber::two)->get();
                return count($applications);
            })
            ->addColumn('summa_2', function($branch){
                $date = Cache::get('date_5');
                $start_date = \Carbon\Carbon::parse("{$date}-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-31")
                    ->toDateTimeString();
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('currency','!=','USD')->where('subject',ApplicationMagicNumber::two)->pluck('contract_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('count_3', function($branch){
                $date = Cache::get('date_5');
                $start_date = \Carbon\Carbon::parse("{$date}-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-31")
                    ->toDateTimeString();
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('currency','!=','USD')->where('subject',ApplicationMagicNumber::three)->get();
                return count($applications);
            })
            ->addColumn('summa_3', function($branch){
                $date = Cache::get('date_5');
                $start_date = \Carbon\Carbon::parse("{$date}-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-31")
                    ->toDateTimeString();
                $applications = $this->application_query()->whereBetween('created_at',[$start_date,$end_date])->where('branch_id', $branch->id)->where('currency','!=','USD')->where('subject',ApplicationMagicNumber::three)->pluck('contract_price')->toArray();
                return array_sum($applications);
            })
            ->make(true);
    }

    public function report_6()
    {
        if(auth()->user()->hasPermission('Purchasing_Management_Center'))
        {

            $query = $this->application_query();
        }else{
            $query = $this->application_query()->where('branch_id',auth()->user()->branch_id)->where('draft','!=',ApplicationMagicNumber::one)->get();
        }
        return Datatables::of($query)
            ->addColumn('name', function($branch){
                return Branch::query()->where('id', $branch->branch_id)->get()->pluck('name')->toArray();
            })
            ->addColumn('planned_price', function ($query) {
                return $query->planned_price ? number_format($query->planned_price, ApplicationMagicNumber::zero, '', ' ') : '';
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

    public function report_7(){
        if(auth()->user()->hasPermission('Purchasing_Management_Center'))
        {

            $query = $this->application_query();
        }else{
            $query = $this->application_query()->where('branch_id',auth()->user()->branch_id)->where('draft','!=',ApplicationMagicNumber::one)->get();
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
    public function report_8(){
        if(auth()->user()->hasPermission('Purchasing_Management_Center'))
        {

            $query = $this->application_query();
        }else{
            $query = $this->application_query()->where('branch_id',auth()->user()->branch_id)->where('draft','!=',ApplicationMagicNumber::one)->get();
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
                return $query->planned_price ? number_format($query->planned_price, ApplicationMagicNumber::zero, '', ' ') : '';
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

    public function report_9()
    {
        if(auth()->user()->hasPermission('Purchasing_Management_Center'))
        {
            $query = Branch::query();
        }
        else{
            $query = Branch::query()->where('id',auth()->user()->branch_id)->get();
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
                return array_sum($applications);
            })
            ->addColumn('eshop_count', function($branch){
                $applications = $this->application_query()->where('branch_id', $branch->id)->where('type_of_purchase_id', self::TypeOfPurchaseElectronicAuction_id)->get();
                return count($applications);
            })
            ->addColumn('eshop_sum', function($branch){
                $applications = $this->application_query()->where('branch_id', $branch->id)->where('type_of_purchase_id', self::TypeOfPurchaseElectronicAuction_id)->pluck('contract_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('nat_eshop_count', function($branch){
                $applications = $this->application_query()->where('branch_id', $branch->id)->where('type_of_purchase_id', self::TypeOfPurchaseCompetition_id)->get();
                return count($applications);
            })
            ->addColumn('nat_eshop_sum', function($branch){
                $applications = $this->application_query()->where('branch_id', $branch->id)->where('type_of_purchase_id', self::TypeOfPurchaseCompetition_id)->pluck('contract_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('auction_count', function($branch){
                $applications = $this->application_query()->where('branch_id', $branch->id)->where('type_of_purchase_id', self::TypeOfPurchaseCooperationPortal_id)->get();
                return count($applications);
            })
            ->addColumn('auction_sum', function($branch){
                $applications = $this->application_query()->where('branch_id', $branch->id)->where('type_of_purchase_id', self::TypeOfPurchaseCooperationPortal_id)->pluck('contract_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('coop_portal_count', function($branch){
                $applications = $this->application_query()->where('branch_id', $branch->id)->where('type_of_purchase_id', self::TypeOfPurchaseTenderPlatform_id)->get();
                return count($applications);
            })
            ->addColumn('coop_portal_sum', function($branch){
                $applications = $this->application_query()->where('branch_id', $branch->id)->where('type_of_purchase_id', self::TypeOfPurchaseTenderPlatform_id)->pluck('contract_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('tender_platform_count', function($branch){
                $applications = $this->application_query()->where('branch_id', $branch->id)->where('type_of_purchase_id', self::TypeOfPurchaseSoleSupplier_id)->get();
                return count($applications);
            })
            ->addColumn('tender_platform_sum', function($branch){
                $applications = $this->application_query()->where('branch_id', $branch->id)->where('type_of_purchase_id', self::TypeOfPurchaseSoleSupplier_id)->pluck('contract_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('exchange_count', function($branch){
                $applications = $this->application_query()->where('branch_id', $branch->id)->where('type_of_purchase_id', self::TypeOfPurchaseDirect_id)->get();
                return count($applications);
            })
            ->addColumn('exchange_sum', function($branch){
                $applications = $this->application_query()->where('branch_id', $branch->id)->where('type_of_purchase_id', self::TypeOfPurchaseDirect_id)->pluck('contract_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('konkurs_count', function($branch){
                $applications = $this->application_query()->where('branch_id', $branch->id)->where('type_of_purchase_id', self::TypeOfPurchaseExchangeTrading_id)->get();
                return count($applications);
            })
            ->addColumn('konkurs_sum', function($branch){
                $applications = $this->application_query()->where('branch_id', $branch->id)->where('type_of_purchase_id', self::TypeOfPurchaseExchangeTrading_id)->pluck('contract_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('tender_count', function($branch){
                $applications = $this->application_query()->where('branch_id', $branch->id)->where('type_of_purchase_id', self::TypeOfPurchaseElectronicShop_id)->get();
                return count($applications);
            })
            ->addColumn('tender_sum', function($branch){
                $applications = $this->application_query()->where('branch_id', $branch->id)->where('type_of_purchase_id', self::TypeOfPurchaseElectronicShop_id)->pluck('contract_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('otbor_count', function($branch){
                $applications = $this->application_query()->where('branch_id', $branch->id)->where('type_of_purchase_id', self::TypeOfPurchaseNationalEshop_id)->get();
                return count($applications);
            })
            ->addColumn('otbor_sum', function($branch){
                $applications = $this->application_query()->where('branch_id', $branch->id)->where('type_of_purchase_id', self::TypeOfPurchaseNationalEshop_id)->pluck('contract_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('sole_supplier_count', function($branch){
                $applications = $this->application_query()->where('branch_id', $branch->id)->where('type_of_purchase_id', self::TypeOfPurchaseElectronicShop_id)->get();
                return count($applications);
            })
            ->addColumn('sole_supplier_sum', function($branch){
                $applications = $this->application_query()->where('branch_id', $branch->id)->where('type_of_purchase_id', self::TypeOfPurchaseElectronicShop_id)->pluck('contract_price')->toArray();
                return array_sum($applications);
            })
            ->addColumn('direct_count', function($branch){
                $applications = $this->application_query()->where('branch_id', $branch->id)->where('type_of_purchase_id', self::TypeOfPurchaseElectronicShop_id)->get();
                return count($applications);
            })
            ->addColumn('direct_sum', function($branch){
                $applications = $this->application_query()->where('branch_id', $branch->id)->where('type_of_purchase_id', self::TypeOfPurchaseElectronicShop_id)->pluck('contract_price')->toArray();
                return array_sum($applications);
            })
            ->make(true);
    }

    public function report_10()
    {
        /** @var User $user */
        $user = auth()->user();
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
        $status = StatusExtented::query();
        return Datatables::of($status)
            ->addColumn('january', function($status){
                $date = Cache::get('date_10');
                $start_date = Carbon::parse("{$date}-01-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-02-01")
                    ->toDateTimeString();
                $applications = Application::where('draft','!=',ApplicationMagicNumber::one)->whereBetween('created_at',[$start_date,$end_date])->where($this->a,$this->operator,$this->b)->where('performer_status', $status->id)->get();
                return count($applications);
            })
            ->addColumn('february', function($status){
                $date = Cache::get('date_10');
                $start_date = Carbon::parse("{$date}-02-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-03-01")
                    ->toDateTimeString();
                $applications = Application::where('draft','!=',ApplicationMagicNumber::one)->whereBetween('created_at',[$start_date,$end_date])->where($this->a,$this->operator,$this->b)->where('performer_status', $status->id)->get();
                return count($applications);
            })
            ->addColumn('march', function($status){
                $date = Cache::get('date_10');
                $start_date = Carbon::parse("{$date}-03-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-04-01")
                    ->toDateTimeString();
                $applications = Application::where('draft','!=',ApplicationMagicNumber::one)->whereBetween('created_at',[$start_date,$end_date])->where($this->a,$this->operator,$this->b)->where('performer_status', $status->id)->get();
                return count($applications);
            })
            ->addColumn('april', function($status){
                $date = Cache::get('date_10');
                $start_date = Carbon::parse("{$date}-04-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-05-01")
                    ->toDateTimeString();
                $applications = Application::where('draft','!=',ApplicationMagicNumber::one)->whereBetween('created_at',[$start_date,$end_date])->where($this->a,$this->operator,$this->b)->where('performer_status', $status->id)->get();
                return count($applications);
            })
            ->addColumn('may', function($status){
                $date = Cache::get('date_10');
                $start_date = Carbon::parse("{$date}-05-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-06-01")
                    ->toDateTimeString();
                $applications = Application::where('draft','!=',ApplicationMagicNumber::one)->whereBetween('created_at',[$start_date,$end_date])->where($this->a,$this->operator,$this->b)->where('performer_status', $status->id)->get();
                return count($applications);
            })
            ->addColumn('june', function($status){
                $date = Cache::get('date_10');
                $start_date = Carbon::parse("{$date}-06-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-07-01")
                    ->toDateTimeString();
                $applications = Application::where('draft','!=',ApplicationMagicNumber::one)->whereBetween('created_at',[$start_date,$end_date])->where($this->a,$this->operator,$this->b)->where('performer_status', $status->id)->get();
                return count($applications);
            })
            ->addColumn('july', function($status){
                $date = Cache::get('date_10');
                $start_date = Carbon::parse("{$date}-07-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-08-01")
                    ->toDateTimeString();
                $applications = Application::where('draft','!=',ApplicationMagicNumber::one)->whereBetween('created_at',[$start_date,$end_date])->where($this->a,$this->operator,$this->b)->where('performer_status', $status->id)->get();
                return count($applications);
            })
            ->addColumn('august', function($status){
                $date = Cache::get('date_10');
                $start_date = Carbon::parse("{$date}-08-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-09-01")
                    ->toDateTimeString();
                $applications = Application::where('draft','!=',ApplicationMagicNumber::one)->whereBetween('created_at',[$start_date,$end_date])->where($this->a,$this->operator,$this->b)->where('performer_status', $status->id)->get();
                return count($applications);
            })
            ->addColumn('september', function($status){
                $date = Cache::get('date_10');
                $start_date = Carbon::parse("{$date}-09-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-10-01")
                    ->toDateTimeString();
                $applications = Application::where('draft','!=',ApplicationMagicNumber::one)->whereBetween('created_at',[$start_date,$end_date])->where($this->a,$this->operator,$this->b)->where('performer_status', $status->id)->get();
                return count($applications);
            })
            ->addColumn('october', function($status){
                $date = Cache::get('date_10');
                $start_date = Carbon::parse("{$date}-10-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-11-01")
                    ->toDateTimeString();
                $applications = Application::where('draft','!=',ApplicationMagicNumber::one)->whereBetween('created_at',[$start_date,$end_date])->where($this->a,$this->operator,$this->b)->where('performer_status', $status->id)->get();
                return count($applications);
            })
            ->addColumn('november', function($status){
                $date = Cache::get('date_10');
                $start_date = Carbon::parse("{$date}-11-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-11-31")
                    ->toDateTimeString();
                $applications = Application::where('draft','!=',ApplicationMagicNumber::one)->whereBetween('created_at',[$start_date,$end_date])->where($this->a,$this->operator,$this->b)->where('performer_status', $status->id)->get();
                return count($applications);
            })
            ->addColumn('december', function($status){
                $date = Cache::get('date_10');
                $start_date = Carbon::parse("{$date}-12-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-12-31")
                    ->toDateTimeString();
                $applications = Application::where('draft','!=',ApplicationMagicNumber::one)->whereBetween('created_at',[$start_date,$end_date])->where($this->a,$this->operator,$this->b)->where('performer_status', $status->id)->get();
                return count($applications);
            })
            ->addColumn('all', function($status){
                $date = Cache::get('date_10');
                $start_date = Carbon::parse("{$date}-01")
                    ->toDateTimeString();

                $end_date = Carbon::parse("{$date}-12-31")
                    ->toDateTimeString();
                $applications = Application::where('draft','!=',ApplicationMagicNumber::one)->whereBetween('created_at',[$start_date,$end_date])->where($this->a,$this->operator,$this->b)->where('performer_status', $status->id)->get();
                return count($applications);
            })
            ->make(true);
    }
}
