<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\EimzoSignController;
use App\Http\Requests\SignRequest;

class ImzoController extends EimzoSignController
{
   public function verifyPks(SignRequest $request)
   {
       return parent::verifyPks($request); // TODO: Change the autogenerated stub
   }
}
