<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Roles;
use Illuminate\Http\Request;
use TCG\Voyager\Http\Controllers\VoyagerRoleController;
use TCG\Voyager\Models\Role;

class RoleController extends VoyagerRoleController
{
    public function update(Request $request, $id)
    {
        $role = Roles::find($id);
        foreach ($request->branch_id as $branch)
        {
            $model = Branch::find($branch);
            if(in_array(165,$request->permissions)||in_array(168,$request->permissions))
            {
                if(isset($model->signers))
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
                in_array($role->id,json_decode($model->signers)) ? : $model->signers = $json;
                $model->save();
            }elseif(in_array(166,$request->permissions)||in_array(167,$request->permissions)){
                if(isset($model->signers))
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
                in_array($role->id,json_decode($model->add_signers,true)) ? :$model->add_signers = $json;
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
        $role->branch_id = json_encode($request->branch_id);
        $role->save();
        return parent::update($request, $id); // TODO: Change the autogenerated stub
    }
    public function changeTypeSigner($role_1,$model_1,int $number)
    {
        if ($number != 1)
        {
            $role = $role_1;
            $model = $model_1;
            $signer_0 = array($role->id);
            $signer_1 = json_decode($model->add_signers);
            $array_merge = array_merge($signer_0,$signer_1);
            $array_diff =  array_diff(json_decode($model->signers),array($role->id));
            foreach ($array_diff as $signer)
            {
                $signers[] = $signer;
            }
            $model->add_signers = $array_merge;
            $model->signers = $signers;
            $model->save();
        }else{
            $role = $role_1;
            $model = $model_1;
            $signer_0 = array($role->id);
            $signer_1 = json_decode($model->signers);
            $array_merge = array_merge($signer_0,$signer_1);
            $array_diff =  array_diff(json_decode($model->add_signers),array($role->id));
            foreach ($array_diff as $signer)
            {
                $signers[] = $signer;
            }
            $model->signers = $array_merge;
            $model->add_signers = $signers;
            $model->save();
        }


    }
}
