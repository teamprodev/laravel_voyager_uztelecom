<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Branch;
use App\Models\Roles;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use TCG\Voyager\Http\Controllers\VoyagerRoleController;
use TCG\Voyager\Models\Role;
use Yajra\DataTables\DataTables;

class RoleController extends VoyagerRoleController
{
    public function index(Request $request)
    {
        return view('vendor.voyager.roles.browse');
    }
    public function getData()
    {
            $query = Roles::query();
            return Datatables::of($query)
                ->editColumn('branch_id', function ($query) {
                    $all = json_decode($query->branch_id);
                    $branch = $all ? Branch::find($all)->pluck('name')->toArray(): [];
                    return $branch;
                })
                ->addColumn('action', function($row){
                    $edit_e = "/admin/roles/{$row->id}/edit";
                    $destroy_e = route("voyager.roles.delete",$row->id);
                    $app_edit = __('Изменить');
                    $app_delete = __('Удалить');;
                    $bgcolor = setting('color.edit');
                    $color = $bgcolor ? 'white':'black';
                    $edit = "<a style='background-color: {$bgcolor};color: {$color}' href='{$edit_e}' class='m-1 col edit btn btn-sm'>$app_edit</a>";
                    $bgcolor = setting('color.delete');
                    $color = $bgcolor ? 'white':'black';
                    $destroy = "<a style='background-color: {$bgcolor};color: {$color}' href='{$destroy_e}' class='m-1 col show btn btn-sm'>$app_delete</a>";
                    return "<div class='row'>
                        {$edit}
                        {$destroy}
                        </div>";
                })
                ->rawColumns(['action'])
                ->make(true);
    }
    public function delete(Role $id)
    {
        $role = $id;
        $add_json = DB::table('branches')->whereRaw('json_contains(add_signers, \'['.$role->id.']\')')->pluck('add_signers','id');
        $json = DB::table('branches')->whereRaw('json_contains(signers, \'['.$role->id.']\')')->pluck('signers','id');
        foreach ($add_json as $item => $value)
        {
            $signerssss = json_decode($value);
            $array_diff = array_diff($signerssss,array($role->id));
            $array_diff ? $add_s = $this->array_diff_array($array_diff):$add_s = null;
            $save = Branch::find($item);
            $save->add_signers = $add_s;
            $save->save();
        }
        foreach ($json as $item => $value)
        {
            $signerssss = json_decode($value);
            $array_diff = array_diff($signerssss,array($role->id));
            $array_diff ? $required_s = $this->array_diff_array($array_diff):$required_s = null;
            $save = Branch::find($item);
            $save->signers = $required_s;
            $save->save();
        }
        $users = User::where('role_id',$role->id)->get();
        foreach($users as $user)
        {
            $user->role_id = null;
            $user->save();
        }
        $role->delete();
        return redirect()->route('voyager.roles.index');
    }
    public function store(Request $request)
    {
        parent::store($request); // TODO: Change the autogenerated stub
        $role = Roles::latest()->take(1)->first();
        $role->branch_id = json_encode($request->branch_id);
        $role->index == null ? $role->index = 1:[];
        $role->save();
        $add_json = DB::table('branches')->whereRaw('json_contains(add_signers, \'['.$role->id.']\')')->pluck('add_signers','id');
        $json = DB::table('branches')->whereRaw('json_contains(signers, \'['.$role->id.']\')')->pluck('signers','id');
        $branch_id = $request->branch_id;
        $role->branch_id = json_encode($request->branch_id);
        $role->save();
        foreach ($add_json as $item => $value)
        {
            if(in_array(array($item),$branch_id))
            {
                $signerssss = json_decode($value);
                $array_diff = array_diff($signerssss,array($role->id));
                $add_s = $this->array_diff_array($array_diff);
                $save = Branch::find($item);
                $save->add_signers = $add_s;
                $save->save();
            }
        }
        foreach ($json as $item => $value)
        {
            if(in_array(array($item),$branch_id))
            {
                $signerssss = json_decode($value);
                $array_diff = array_diff($signerssss,array($role->id));
                $required_s = $this->array_diff_array($array_diff);
                $save = Branch::find($item);
                $save->signers = $required_s;
                $save->save();
            }
        }

        foreach ($request->branch_id as $branch)
        {

            $model = Branch::find($branch);
            if(in_array(165,$request->permissions)||in_array(168,$request->permissions))
            {
                if(isset($model->signers) && $model->add_signers != null)
                {
                    if(in_array($role->id,json_decode($model->add_signers)))
                    {
                        $role_1 = $role;
                        $model_1 = $model;
                        $this->changeTypeSigner($role_1,$model_1,1);
                        return parent::update($request, $id); // TODO: Change the autogenerated stub
                    }
                }

                $signers = json_decode($model->signers) ? json_decode($model->signers) : [];
                $signers[] = $role->id;
                $json = json_encode($signers);
                $model->signers ? in_array($role->id,json_decode($model->signers)) ? : $model->signers = $json: $model->signers = $json;
                $model->save();
            }elseif(in_array(166,$request->permissions)||in_array(167,$request->permissions)){
                if(isset($model->signers) && $model->signers != null)
                {
                    if(in_array($role->id,json_decode($model->signers)))
                    {
                        $role_1 = $role;
                        $model_1 = $model;
                        $this->changeTypeSigner($role_1,$model_1,0);
                        return parent::update($request, $id); // TODO: Change the autogenerated stub
                    }
                }

                $add_signers = json_decode($model->add_signers,true) ? json_decode($model->add_signers,true) : [];
                $add_signers = array_merge($add_signers,array($role->id));
                $json = json_encode($add_signers);
                $model->add_signers ? in_array($role->id,json_decode($model->add_signers,true)) ? :$model->add_signers = $json:$model->add_signers = $json;
                $model->save();
            }else{
                $signers = $model->signers ? array_diff(json_decode($model->signers),array($role->id)): [];
                $add_signers = $model->add_signers ? array_diff(json_decode($model->add_signers),array($role->id)): [];
                foreach ($signers as $a)
                {
                    $required[] = $a;
                }
                foreach ($add_signers as $b)
                {
                    $optional[] = $b;
                }
                isset($required) ? : $required = null;
                isset($optional) ? : $optional = null;
                $model->signers = $required;
                $model->add_signers = $optional;
                $model->save();
            }
        }
        return redirect()->route('voyager.roles.index');
    }

    public function update(Request $request, $id)
    {
        in_array(198,$request->permissions) ? $request->branch_id = Branch::pluck('id')->toArray(): [];
        $request->branch_id = array_map('strval', $request->branch_id);
        $role = Roles::find($id);
        $add_json = DB::table('branches')->whereRaw('json_contains(add_signers, \'['.$role->id.']\')')->pluck('add_signers','id');
        $json = DB::table('branches')->whereRaw('json_contains(signers, \'['.$role->id.']\')')->pluck('signers','id');
        $branch_id = $request->branch_id;
        $role->branch_id = json_encode($request->branch_id);
        $role->index == null ? $role->index = 1:[];
        $role->save();
        foreach ($add_json as $item => $value)
        {
            $signerssss = json_decode($value);
            $array_diff = array_diff($signerssss,array($role->id));
            $array_diff ? $add_s = $this->array_diff_array($array_diff):$add_s = null;
            $save = Branch::find($item);
            $save->add_signers = $add_s;
            $save->save();
        }
        foreach ($json as $item => $value)
        {
            $signerssss = json_decode($value);
            $array_diff = array_diff($signerssss,array($role->id));
            $array_diff ? $required_s = $this->array_diff_array($array_diff):$required_s = null;
            $save = Branch::find($item);
            $save->signers = $required_s;
            $save->save();
        }

        foreach ($request->branch_id as $branch)
        {

            $model = Branch::find($branch);
            if(in_array(165,$request->permissions)||in_array(168,$request->permissions))
            {
                if(isset($model->signers) && $model->add_signers != null)
                {
                    if(in_array($role->id,json_decode($model->add_signers)))
                    {
                        $role_1 = $role;
                        $model_1 = $model;
                        $this->changeTypeSigner($role_1,$model_1,1);
                        return parent::update($request, $id); // TODO: Change the autogenerated stub
                    }
                }

                $signers = json_decode($model->signers) ? json_decode($model->signers) : [];
                $signers[] = $role->id;
                $json = json_encode($signers);
                $model->signers ? in_array($role->id,json_decode($model->signers)) ? : $model->signers = $json: $model->signers = $json;
                $model->save();
            }elseif(in_array(166,$request->permissions)||in_array(167,$request->permissions)){
                if(isset($model->signers) && $model->signers != null)
                {
                    if(in_array($role->id,json_decode($model->signers)))
                    {
                        $role_1 = $role;
                        $model_1 = $model;
                        $this->changeTypeSigner($role_1,$model_1,0);
                        return parent::update($request, $id); // TODO: Change the autogenerated stub
                    }
                }

                $add_signers = json_decode($model->add_signers,true) ? json_decode($model->add_signers,true) : [];
                $add_signers = array_merge($add_signers,array($role->id));
                $json = json_encode($add_signers);
                $model->add_signers ? in_array($role->id,json_decode($model->add_signers,true)) ? :$model->add_signers = $json:$model->add_signers = $json;
                $model->save();
            }
        }

        return parent::update($request, $id); // TODO: Change the autogenerated stub
    }
    public function array_diff_array($array_diff)
    {
        foreach ($array_diff as $signer)
        {
            $signers[] = $signer;
        }
        return $signers;
    }
    public function changeTypeSigner($role_1,$model_1,int $number)
    {
        if ($number != 1)
        {
            $role = $role_1;
            $model = $model_1;
            $signer_0 = array($role->id);
            $signer_1 = json_decode($model->add_signers);
            $array_merge = $signer_1 ? array_merge($signer_0,$signer_1):$signer_0;
            $array_diff =  array_diff(json_decode($model->signers),array($role->id));
            $model->signers = null;
            if($array_diff == null)
            {
                foreach ($array_diff as $signer)
                {
                    $signers[] = $signer;
                    $model->signers = $signers;
                }
            }

            $model->add_signers = $array_merge;
            $model->save();
        }else{
            $role = $role_1;
            $model = $model_1;
            $signer_0 = array($role->id);
            $signer_1 = json_decode($model->signers);
            $array_merge = $signer_1 ? array_merge($signer_0,$signer_1):$signer_0;
            $array_diff =  array_diff(json_decode($model->add_signers),array($role->id));
            $model->add_signers = null;
            if($array_diff == null)
            {
                foreach ($array_diff as $signer)
                {
                    $signers[] = $signer;
                    $model->add_signers = $signers;
                }
            }

            $model->signers = $array_merge;
            $model->save();
        }


    }
}
