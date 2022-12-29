<?php

namespace App\Services;

use App\Models\Branch;
use App\Models\Department;
use Illuminate\Support\Arr;
use App\Models\User;
use Teamprodev\Eimzo\Jobs\NotifyOperatorJob;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EriService {
    public function makeParams($data) {
        $fullname_parts = $this->parseFullname($data['eri_fullname']);
        // #TODO: check table columns
        return [
            'username' => $data['eri_sn'],
            'fullname' => $data['eri_fullname'],
            'firstname' => $fullname_parts['firstname'],
            'lastname' => $fullname_parts['lastname'],
            'midname' => $fullname_parts['midname'],
            'pinfl' => $data['eri_pinfl'],
            // 'inn' => $data['eri_inn'],
            'passport' => null,
            'passport_expire_date' => null,
            'phone' => null,
            'address' => null,
            'email' => $data['eri_sn'] . "@test.uz",
            'name' => $data['eri_fullname'],
            'password' => Hash::make(uniqid()),
            'auth_type' => 'eri',
            'role_id' => config('eimzo.user.default_role_id'),
            'status' => 1,
            'user_type' => 'Jismoniy shaxs'
        ];
    }

    public function authorizeUser($params) {
        // CREATE NEW OR UPDATE EXISTING USER
        $user = User::where(
            ['pinfl' => $params['pinfl']],
            $params
        )->first();
        if($user === null)
            return view('site.auth.register',['branch' => Branch::all(),'department' => Department::all(),'params' => $params]);
        // AUTHORIZE USER
        Auth::login($user);
        return redirect()->route('site.applications.index');
    }

    protected function parseFullname($fullname) {
        $fullname_parts = explode(' ', $fullname);

        $data = [];
        $data['lastname'] = $fullname_parts[0];
        $data['firstname'] = $fullname_parts[1];
        $data['midname'] = "";
        $data['midname'] .= isset($fullname_parts[2]) ? $fullname_parts[2] : "";
        $data['midname'] .= isset($fullname_parts[3]) ? " " . $fullname_parts[3] : "";

        return $data;
    }
}
