<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use App\Models\User;
use TCG\Voyager\Http\Controllers\VoyagerUserController;

class UserController extends VoyagerUserController
{
    public function changeLeader(User $user)
    {
        $user->leader = $user->leader?0:1;
        $user->save();
        return back()->with([
            'message' => "Muvafaqiyatli o'zgartirildi!"
        ]);
    }
}
