<?php

namespace App\Http\Controllers;

use App\Events\NotificationEvent;
use App\Jobs\NotificationJob;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(){
        try{
            $this->dispatch(new NotificationJob());
            event(new NotificationEvent('Monika'));
            return "Event has been sent!";
        } catch(\Exception $exception){
            dd($exception);
        }
        return back();
    }
}
