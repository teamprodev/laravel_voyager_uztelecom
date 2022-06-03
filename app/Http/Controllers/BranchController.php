<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\PermissionRole;
use App\Models\Roles;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function edit(Branch $id)
    {
        $add_signers = PermissionRole::where('permission_id',167)->select('role_id')->get();
        $add_signers = Roles::find($add_signers)->pluck('display_name','id');
        $signers = PermissionRole::where('permission_id',168)->select('role_id')->get();
        $signers = Roles::find($signers)->pluck('display_name','id');
        return view('vendor.voyager.branches.signers-add',[
            'add_signers' => $add_signers,
            'signers' => $signers,
            'branch' => $id,
        ]);
    }
    public function ajax()
    {
        $add_signers = PermissionRole::where('permission_id',167)->select('role_id')->get();
        $add_signers = Roles::find($add_signers)->pluck('display_name','id');
        $signers = PermissionRole::where('permission_id',168)->select('role_id')->get();
        $signers = Roles::find($signers)->pluck('display_name','id');
        return $add_signers;
    }
    public function update(Branch $id,Request $req)
    {
        $id->add_signers = $req->add_signers ? json_encode($req->add_signers): null;
        $id->signers = $req->signers ? json_encode($req->signers): null;
        $id->update();
        return redirect('/admin/branches/');
    }
}
