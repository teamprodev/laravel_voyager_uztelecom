<?php

namespace App\Observers;

use App\Models\Application;
use App\Models\Roles;
use App\Models\User;
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
        if($application->performer_leader_comment == null && $application->performer_status != null)
        {
            $application->performer_user_id = auth()->user()->id;
            $application->save();
        }elseif($application->performer_role_id == null && $application->status != Application::AGREED)
        {
            $app_time = strtotime($application->created_at->toDateTimeString());
            $overdue_time = setting('admin.overdue_time');

            $now = strtotime(Carbon::now()->toDateTimeString());

            $diff = $app_time - $now;
            $dt1 = new DateTime("@0");
            $result = abs($diff);
            $dt2 = new DateTime("@{$result}");
            $day = $dt1->diff($dt2)->format('%a');
            if($day >= $overdue_time)
                $application->status = 'Overdue';
            $application->save();
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
