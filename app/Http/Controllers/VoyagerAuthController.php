<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VoyagerAuthController extends \TCG\Voyager\Http\Controllers\VoyagerAuthController
{
    public function login(){
        return view('vendor.voyager.login');
    }
}
