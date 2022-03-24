<?php

namespace App\Http\Controllers;

use Teamprodev\Eimzo\Http\Controllers\EimzoController;
use Teamprodev\Eimzo\Http\Controllers\EimzoLoginController;
use Teamprodev\Eimzo\Requests\EriRequest;
use Teamprodev\Eimzo\Services\AuthLogService;
use Teamprodev\Eimzo\Services\EriService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class EimzoAuthController extends EimzoController
{
    public function auth(Request $request) {
        try {
            $oneAuthService = new EriService();
            $params = $oneAuthService->makeParams($request->toArray());
            $oneAuthService->authorizeUser($params);
            AuthLogService::logAuth();

        } catch (\Throwable $th) {
            $errorMessage = "Киришда хатолик юз берди, илтимос кейинроқ уруниб кўринг.";
            if(in_array($th->getCode(), [401])) {
                $errorMessage = $th->getMessage();
            }

            Log::error(sprintf("ERI error: Message: %s, Line: %s, File: %s", $th->getMessage(), $th->getLine(), $th->getFile()));
            return redirect()->route("voyager.login");
        }

        return redirect()->route('eimzo.back');
    }
}
