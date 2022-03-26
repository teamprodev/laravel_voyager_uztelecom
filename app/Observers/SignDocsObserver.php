<?php

namespace App\Observers;

use App\Models\Application;
use App\Models\SignedDocs;
use App\Models\User;

class SignDocsObserver
{
    /**
     * Handle the SignedDocs "created" event.
     *
     * @param \App\Models\SignedDocs $signedDocs
     * @return void
     */
    public function created(SignedDocs $signedDocs)
    {
        $signedDocs = SignedDocs::latest('id')->first();
        $allDocs = SignedDocs::where('application_id', $signedDocs->application->id)->get();
        $allUsers = $allDocs->map(function ($doc) {
            $role_id = $doc->user->role_id;
            return $role_id;
        });
        $agreedUsers = $allDocs->where('status', 1)->map(function ($doc) {
            $role_id = $doc->user->role_id;
            return $role_id;
        });
        $canceledUsers = $allDocs->where('status', 0)->map(function ($doc) {
            $role_id = $doc->user->role_id;
            return $role_id;
        });
        $roles_need_sign = json_decode($signedDocs->application->signers, true);

        if (!array_diff($roles_need_sign, $agreedUsers->toArray())) {
            $signedDocs->application->status = Application::ACCEPTED;
        } elseif(!array_diff($roles_need_sign, $canceledUsers->toArray())) {
            $signedDocs->application->status = Application::REJECTED;
        } else
            $signedDocs->application->status = Application::IN_PROCESS;
        $signedDocs->application->save();
    }

    /**
     * Handle the SignedDocs "updated" event.
     *
     * @param \App\Models\SignedDocs $signedDocs
     * @return void
     */
    public function updated(SignedDocs $signedDocs)
    {
        //
    }

    /**
     * Handle the SignedDocs "deleted" event.
     *
     * @param \App\Models\SignedDocs $signedDocs
     * @return void
     */
    public function deleted(SignedDocs $signedDocs)
    {
        //
    }

    /**
     * Handle the SignedDocs "restored" event.
     *
     * @param \App\Models\SignedDocs $signedDocs
     * @return void
     */
    public function restored(SignedDocs $signedDocs)
    {
        //
    }

    /**
     * Handle the SignedDocs "force deleted" event.
     *
     * @param \App\Models\SignedDocs $signedDocs
     * @return void
     */
    public function forceDeleted(SignedDocs $signedDocs)
    {
        //
    }
}
