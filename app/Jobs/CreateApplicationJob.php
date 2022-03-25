<?php

namespace App\Jobs;

use App\Http\Requests\ApplicationRequest;
use App\Models\Application;
use App\Models\Roles;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class CreateApplicationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    private ApplicationRequest $applicationRequest;

    public function __construct(ApplicationRequest $applicationRequest)
    {
        $this->applicationRequest = $applicationRequest;
    }

    /**
     * Execute the job.
     *
     * @return Application
     */
    public function handle()
    {
        DB::beginTransaction();
        try {
            $application = new Application();
            $application->user_id = auth()->id();
            $application->status = Application::NEW;
            $application->name = $this->applicationRequest->name;
            $application->basis = $this->applicationRequest->basis;
            $application->separate_requirements = $this->applicationRequest->separate_requirements;
            $application->expire_warranty_date = $this->applicationRequest->expire_warranty_date;
            $application->planned_price = $this->applicationRequest->planned_price;
            $application->is_more_than_limit = $this->applicationRequest->is_more_than_limit;
            $application->currency = $this->applicationRequest->currency;
            $application->info_business_plan = $this->applicationRequest->info_business_plan;
            $application->equal_planned_price = $this->applicationRequest->equal_planned_price;
            $application->supplier_name = $this->applicationRequest->supplier_name;
            $application->subject = $this->applicationRequest->subject;
            $application->type_of_purchase_id = $this->applicationRequest->type_of_purchase_id;
            $application->info_purchase_plan = $this->applicationRequest->info_purchase_plan;
            $application->comment = $this->applicationRequest->comment;
            $application->filial_initiator_id = $this->applicationRequest->filial_initiator_id;
            $application->country_produced_id = $this->applicationRequest->country_produced_id;
            $application->with_nds = $this->applicationRequest->with_nds;
            $application->signers = json_encode($this->applicationRequest->signers);
            $application->save();
        } catch (\Exception $exception){
            DB::rollBack();
            dd($exception);
            throw $exception;
        }
        DB::commit();
        return $application;
    }
}
