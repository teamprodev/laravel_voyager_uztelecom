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
                $same_role_user_ids = User::where('role_id', auth()->user()->role_id)->get()->plcuk('id')->toArray();
                $b1 = in_array(auth()->user()->role_id, $application->roles_need_sign);
                $b2 = in_array(auth()->id(), $same_role_user_ids);
                $signedDoc = SignedDocs::where('application_id', $application->id)->where('user_id',auth()->id())
                    ->first();
                if(!$signedDoc)
                    return redirect()->route('eimzo.back')->with('danger', 'You signed already');
                if(!$signers)
                    return redirect()->route('eimzo.back')->with('danger', 'Fix Eimzo Service!');
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