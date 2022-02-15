<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Application extends Model
{
    use HasFactory;
    const NEW_APP = 0;
    const PLANNER_AGREE = 1;
    const CANCELED_APP = -1;
    protected $table = "applications";
    public function plan(){
        return $this->belongsTo(Plan::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }


    public function scopeCurrentUser($query)
    {
        
        $user = Auth::user();
        switch ($user->id) {
            case 2: {
                return $query->where('status', "На согласование")->orWhere('status', "В исплонении")->orWhere('status', "Исполнено");
            } break;
            case 3: {
                return $query->where('user_id', Auth::user()->id);
            } break;
            case 9: {
                return $query->where('status', "В исплонении");
            } break;

        }

    }

    public function scopeUser($query){
        $user = auth()->user();
        switch ($user->role_id) {
            // APPLICATION CREATOR
            case 1: {
                return $query->where('user_id', $user->id);
            } break;
            //HEAD OF DEPARTMENT of user who created APPLICATION
            case 2: {
                // Get all workers id of his department as array
                $user_list = User::where('department_id', $user->department_id)->pluck('id')->toArray();
                return $query->whereIn('user_id', $user_list);
            } break;

        }
    }
    public function getStatusAttribute(){
        switch (intval($this->attributes['status'])){
            case 0: {
                $status = "NEW";
            } break;
            case 1: {
                $status = "STEP 2";
            } break;
            default: {
                $status = "UNDEFINED";
            } break;
        }
        return $status;
    }
}
