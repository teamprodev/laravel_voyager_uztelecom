<?php

namespace App\Console\Commands;

use App\Models\Application;
use App\Models\StatusExtented;
use App\Services\ApplicationData;
use Illuminate\Console\Command;

class PerformerStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'performer:status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $application_s = Application::where('performer_status','!=',null)->get();
        foreach ($application_s as $app)
        {
            $update = StatusExtented::where('name',$app->performer_status)->first();
            if($app->status === $update)
            {
                    $app->status = ApplicationData::Status_Extended;
            }
            $app->performer_status = $update->id;
            $app->status_extended_id = $update->id;
            $app->save();
        }
        return 1;
    }
}
