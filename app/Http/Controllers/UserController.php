<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
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
