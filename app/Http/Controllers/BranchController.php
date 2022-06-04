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
        $v = PermissionRole::where('permission_id',167)->pluck('role_id')->toArray();
        foreach ($v as $b)
        {
            $a = PermissionRole::where('permission_id',168)->where('role_id',$b)->pluck('role_id')->toArray();
            PermissionRole::where('permission_id',168)->where('role_id',$a)->delete();
            echo $b;
        }
        $add_signers = PermissionRole::where('permission_id',167)->select('role_id')->get();
        $add_signers = Roles::find($add_signers)->pluck('display_name','id');
        $signers = PermissionRole::where('permission_id',168)->select('role_id')->get();
        $signers = Roles::find($signers)->pluck('display_name','id');
        if($id->id == 9)
        {
            $add_signers = PermissionRole::where('permission_id',166)->select('role_id')->get();
            $add_signers = Roles::find($add_signers)->pluck('display_name','id');
            $signers = PermissionRole::where('permission_id',165)->select('role_id')->get();
            $signers = Roles::find($signers)->pluck('display_name','id');
        }
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
