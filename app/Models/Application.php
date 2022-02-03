<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;
    public function plan(){
        return $this->belongsTo(Plan::class);
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
}
