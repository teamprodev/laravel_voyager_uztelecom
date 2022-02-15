<?php

namespace App\Jobs;

use App\Http\Requests\ApplicationRequest;
use App\Models\Application;
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
            $application->initiator = $this->applicationRequest->initiator;

            $application->delivery_date = $this->applicationRequest->delivery_date;
            $application->specification = $this->applicationRequest->specification;
            $application->comment = $this->applicationRequest->comment;
            $application->expire_warranty_date = $this->applicationRequest->expire_warranty_date;
            $application->user_id = auth()->id();
            $application->status = $this->applicationRequest->status;
            $application->plan_id = $this->applicationRequest->plan_id;
            $application->initiator = $this->applicationRequest->initiator;
            $application->basis = $this->applicationRequest->basis;
            $application->report = $this->applicationRequest->report;
            $application->special_specification = $this->applicationRequest->special_specification;
            $application->amount = $this->applicationRequest->amount;
            $application->currency = $this->applicationRequest->currency;
            $application->incoterms = $this->applicationRequest->incoterms;
            $application->business_planned = $this->applicationRequest->business_planned;
            $application->purchase_plan = $this->applicationRequest->purchase_plan;
            $application->file_basis = $this->applicationRequest->file_basis;
            $application->file_tech_spec = $this->applicationRequest->file_tech_spec;
            $application->other_files = $this->applicationRequest->other_files;
            $application->draft = $this->applicationRequest->draft;
            $application->status = 0;

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
