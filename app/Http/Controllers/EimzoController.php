<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Teamprodev\Eimzo\Requests\EriRequest;
use Teamprodev\Eimzo\Services\AuthLogService;
use App\Services\EriService;
use Illuminate\Support\Facades\Log;

class EimzoController extends Controller
{
    public function login()
    {
        return view('auth.auth');
    }
    public function auth(Request $request)
    {
        $oneAuthService = new EriService();
        $params = $oneAuthService->makeParams($request->toArray());
        return $oneAuthService->authorizeUser($params);
    }
    public function register(Request $request)
    {
        $data = $request->validate([
            'email' => 'unique:users',
        ]);
        $oneAuthService = new EriService();
        $new_request = json_decode($request->params,true);
        $new_request['username'] = $request->name;
        $new_request['email']= $data['email'];
        $new_request['branch_id'] = $request->branch;
        $new_request['department_id'] = $request->department;
        $new_request['status'] = 0;
        $user = User::firstOrCreate(
            ['pinfl' => $new_request['pinfl']],
            $new_request
        );
        return $oneAuthService->authorizeUser($new_request);
    }
}
