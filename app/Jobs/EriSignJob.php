<?php

namespace App\Jobs;

use App\Models\Application;
use Teamprodev\Eimzo\Http\Classes\ImzoData;
use App\Models\SignedDocs;
use App\Http\Requests\SignRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class EriSignJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    private SignRequest $request;
    private array $signers;
    private Application $application;
    public function __construct(SignRequest $request, array $signers, Application $application)
    {
        $this->request=$request;
        $this->signers = $signers[0];
        $this->application = $application;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        DB::beginTransaction();
        try{
            $data[] = new ImzoData($this->signers['name'], $this->signers['date'], $this->signers['serialNumber'], $this->signers['stir']);

            $document = SignedDocs::create([
                'pkcs' => $this->request->pkcs7,
                'text' => $this->request->data,
                'comment' => $this->request->comment,
                'status' => $this->request->status,
                'user_id' => auth()->id(),
                'application_id' => $this->application->id,
                'data' => json_encode($data),

            ]);
        } catch (\Exception $exception){
            dd('Ex'.$exception->getMessage());
            DB::rollBack();
            throw $exception;
        }
        DB::commit();
        return $document;
    }
}
