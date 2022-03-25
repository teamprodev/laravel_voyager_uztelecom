<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Application extends Model
{
    use HasFactory;
    const NEW = 'new';
    const IN_PROCESS = 'in_process';
    const CANCELED = 'canceled';
    const ACCEPTED = 'accepted';
    const REFUSED = 'refused';
    const AGREED = 'agreed';
    const REJECTED = 'rejected';
    const DISTRIBUTED = 'distributed';
    const PERFORMED = 'performed';

    protected $table = "applications";
    protected $guarded = [];
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

    public function scopeSteps($query){
        $user = auth()->user();
        switch ($user->role_id) {
            // APPLICATION CREATOR
            case 1:
                {
                    $result = $query->where('user_id', auth()->id());
                }
                break;
            case 5: {
                $result = $query->where('status', Application::ACCEPTED);
            } break;
            //HEAD OF DEPARTMENT of user who created APPLICATION
            case -8: {
                // Get all workers id of his department as array
                $user_list = User::where('department_id', $user->department_id)->pluck('id')->toArray();
                $result = $query->whereIn('user_id', $user_list);
            } break;

            default:
                {
                    $result = Application::all();
                }
                break;
        }
        return $result;

    }
//    public function getStatusAttribute(){
//        switch (intval($this->attributes['status'])){
//            case 0: {
//                $status = "NEW";
//            } break;
//            case 1: {
//                $status = "STEP 2";
//            } break;
//            default: {
//                $status = "UNDEFINED";
//            } break;
//        }
//        return $status;
//    }
    public function country(){
        return $this->belongsTo(Country::class,  'country_produced_id','country_alpha3_code');
    }
    public function signedDocs(){
        return $this->hasMany(SignedDocs::class);
    }
}
