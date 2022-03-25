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
            $application->initiator = Application::NEW;
            $application->purchase_basis = $this->applicationRequest->initiator;
            $application->specification = $this->applicationRequest->purchase_basis;
            $application->delivery_date = $this->applicationRequest->specification;
            $application->name = $this->applicationRequest->delivery_date;
            $application->basis = $this->applicationRequest->name;
            $application->separate_requirements = $this->applicationRequest->basis;
            $application->expire_warranty_date = $this->applicationRequest->separate_requirements;
            $application->planned_price = $this->applicationRequest->expire_warranty_date;
            $application->info_business_plan = $this->applicationRequest->planned_price;
            $application->equal_planned_price = $this->applicationRequest->info_business_plan;
            $application->subject = $this->applicationRequest->equal_planned_price;
            $application->type_of_purchase_id = $this->applicationRequest->subject;
            $application->info_purchase_plan = $this->applicationRequest->type_of_purchase_id;
            $application->comment = $this->applicationRequest->info_purchase_plan;
            $application->filial_initiator_id = $this->applicationRequest->comment;
            $application->country_produced_id = $this->applicationRequest->filial_initiator_id;
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
