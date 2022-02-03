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
    public function scopeUser(){
//        $user = auth()->user();
//        switch ($user->role_id) {
//            case 1: {
//
//            } break;
//        }
    }
}
