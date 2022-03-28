<?php

namespace App\Http\Controllers;

use App\Events\Notify;

class NotificationController extends Controller
{
    public function notify()
    {
        broadcast(new Notify('12312321', '1', 13))->toOthers();
    }
}
