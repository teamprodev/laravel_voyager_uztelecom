<?php

namespace App\Observers;

use App\Models\Application;
use App\Models\Roles;
use App\Models\User;
use App\Services\ApplicationService;
use DateTime;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Artisan;

class ApplicationObserver
{
    /**
     * Handle the Application "created" event.
     *
     * @param \App\Models\Application $application
     * @return void
     */
    public function created(Application $application)
    {
        //
    }

    /**
     * Handle the Application "updated" event.
     *
     * @param \App\Models\Application $application
     * @return void
     */
    public function updated(Application $application)
    {
        $app_time = strtotime($application->created_at->toDateTimeString());
        $overdue_time = setting('admin.overdue_time');

        $now = strtotime(Carbon::now()->toDateTimeString());

        $diff = $app_time - $now;
        $dt1 = new DateTime("@0");
        $result = abs($diff);
        $dt2 = new DateTime("@{$result}");
        $day = $dt1->diff($dt2)->format('%a');

        if($application->performer_status != null && $application->performer_leader_comment == null)
        {
            $application->performer_user_id = auth()->user()->id;
            $result = $application->save();
        }elseif($day >= $overdue_time && $application->status != 'Overdue')
        {
            $application->status = 'Overdue';
            $result = $application->save();
        }
    }

    /**
     * Handle the Application "deleted" event.
     *
     * @param \App\Models\Application $application
     * @return void
     */
    public function deleted(Application $application)
    {
        //
    }

    /**
     * Handle the Application "restored" event.
     *
     * @param \App\Models\Application $application
     * @return void
     */
    public function restored(Application $application)
    {
        //
    }

    /**
     * Handle the Application "force deleted" event.
     *
     * @param \App\Models\Application $application
     * @return void
     */
    public function forceDeleted(Application $application)
    {
        //
    }
}
