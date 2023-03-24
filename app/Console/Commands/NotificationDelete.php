<?php

namespace App\Console\Commands;

use App\Models\Application;
use App\Models\Notification;
use Illuminate\Console\Command;

class NotificationDelete extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notification:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete deleted application\'s notification';

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
     * @return Application[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Query\Builder[]|\Illuminate\Support\Collection
     */
    public function handle()
    {
        $application = Application::onlyTrashed()->pluck('id')->toArray();
        return Notification::whereIn('application_id',$application)->delete();
    }
}
