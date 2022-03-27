<?php

namespace App\Http\Controllers;

use App\Events\Notify;
use Pusher\Pusher;

class NotificationController extends Controller
{
    public function notify()
    {
        $options = array(
            'cluster' => env('PUSHER_APP_CLUSTER'),
            'encrypted' => true
        );
        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $data['message'] = 'hello investmentnovel';
//        $pusher->trigger('notification-send', 'App\\Events\\Notify', $data);
        broadcast(new Notify('test'))->toOthers();
    }
}
