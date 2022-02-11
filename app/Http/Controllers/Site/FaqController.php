<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index(){
        return view('site.applications.base');
    }
}
