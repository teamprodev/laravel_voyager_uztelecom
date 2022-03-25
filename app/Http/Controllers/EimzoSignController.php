<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\SignedDocs;
use Teamprodev\Eimzo\Jobs\EriJoinSignJob;
use App\Jobs\EriSignJob;
use App\Http\Requests\SignRequest;
use Teamprodev\Eimzo\Services\EimzoService;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Models\User;
class EimzoSignController extends Controller
{
    private EimzoService $eimzoService;
    public function __construct()
    {
        $this->eimzoService = new EimzoService();
    }

    public function index()
    {
        $signs = SignedDocs::all();
        return view('Teamprodev.eimzo.sign.master', compact('signs'));
    }

    public function verifyPks(SignRequest $request, Application $application)
    {

        try {
                $pkcs7[] = $request->pkcs7;
                $signers = $this->eimzoService->getXML($pkcs7);
                $signedDoc = SignedDocs::where('application_id', $application->id)->where('user_id', auth()->id())
                    ->first();
                if($signedDoc)
                    return redirect()->back()->with('danger', 'You signed already');
                if(!$signers)
                    return redirect()->back()->with('danger', 'Fix Eimzo Service!');
                $this->dispatchNow(new EriSignJob($request, $signers, $application));

            return redirect()->route('eimzo.back')->with('success', 'Signed');
        } catch (\Exception $exception) {
            dd($exception);
            return redirect()->route('eimzo.back')->with('danger', 'Something went wrong! Contact developer!');
        }

    }

    public function joinTwoPks(SignRequest $request)
    {
        try {
            return redirect()->route('sign.index')->with('success', 'Signed');
        } catch (\Exception $exception) {
            return redirect()->route('sign.index')->with('danger', 'Something went wrong! Contact developer!');
        }
    }

    public function sign()
    {

    }

    public function docsList(Request $request)
    {
        if (isset($request->orderBy)) {
            if ($request->orderBy == 'all') {
                $data = SignedDocs::get();
            }
        }
        return $data;
    }

}