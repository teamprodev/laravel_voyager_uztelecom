<?php

namespace App\Jobs;

use Teamprodev\Eimzo\Http\Classes\ImzoData;
use Teamprodev\Eimzo\Models\SignedDocs;
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
    public function __construct(SignRequest $request, array $signers)
    {
        $this->request=$request;
        $this->signers = $signers[0];
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
            $document = new SignedDocs();
            $document->pkcs = $this->request->pkcs7;
            $document->text = $this->request->data;
            $document->comment = $this->request->comment;
            $document->status = $this->request->status;
            $document->user_id = $this->request->user_id;
            $document->table_name = $this->request->table_name;
            $document->application_id = $this->request->application_id;
            $data[] = new ImzoData($this->signers['name'], $this->signers['date'], $this->signers['serialNumber'],
                $this->signers['stir']);
            $document->data = json_encode($data);
            $document->save();
        } catch (\Exception $exception){
            dd('Ex'.$exception->getMessage());
            DB::rollBack();
            throw $exception;
        }
        DB::commit();

    }
}
