<?php

namespace App\Http\Controllers\Site;

use App\Models\Application;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqsController extends Controller
{
    public function index(Request $request){
        $faqs = Faq::all();
        return view('site.faqs.index', compact('faqs'));

    }
    public function show(Faq $faq){
        return view('site.faqs.show', compact('faq'));
    }
}
