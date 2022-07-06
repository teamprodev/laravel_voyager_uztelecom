<?php

namespace App\Models;

use App\Http\Controllers\TypeOfPurchase;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Resource;
use Illuminate\Database\Eloquent\SoftDeletes;

class Application extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    const NEW = 'new';
    const DRAFT = 'draft';
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

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function performer()
    {
        return $this->belongsTo(User::class,'performer_user_id','id');
    }
    public function performer_role()
    {
        return $this->belongsTo(Roles::class,'performer_role_id','id');
    }
    public function branch_leader()
    {
        return $this->belongsTo(User::class,'branch_leader_user_id','id');
    }
    public function performer_leader()
    {
        return $this->belongsTo(User::class,'performer_leader_user_id','id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function scopeCurrentUser($query)
    {

        $user = Auth::user();
        switch ($user->id) {
            case 2:
                {
                    return $query->where('status', "На согласование")->orWhere('status', "В исплонении")->orWhere('status', "Исполнено");
                }
                break;
            case 3:
                {
                    return $query->where('user_id', Auth::user()->id);
                }
                break;
            case 9:
                {
                    return $query->where('status', "В исплонении");
                }
                break;

        }

    }

    public function scopeSteps($query)
    {
        $user = auth()->user();
        switch ($user->role_id) {
            // APPLICATION CREATOR
            case 1:
                {
                    $result = $query->where('user_id', auth()->id());
                }
                break;
            case 5:
                {
                    $result = $query->where('status', Application::ACCEPTED);
                }
                break;
            //HEAD OF DEPARTMENT of user who created APPLICATION
            case -8:
                {
                    // Get all workers id of his department as array
                    $user_list = User::where('department_id', $user->department_id)->pluck('id')->toArray();
                    $result = $query->whereIn('user_id', $user_list);
                }
                break;

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
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_produced_id', 'country_alpha3_code');
    }
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_initiator_id', 'id');
    }
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_initiator_id', 'id')->withDefault(['name' => '']);
    }
    public function purchase()
    {
        return $this->belongsTo(Purchase::class, 'type_of_purchase_id', 'id');
    }
    public function subjects()
    {
        return $this->belongsTo(Subject::class, 'subject', 'id');
    }
    public function signedDocs()
    {
        return $this->hasMany(SignedDocs::class);
    }
    public function resource()
    {
        return $this->hasMany(Resource::class);
    }
    public function index_table($user)
    {
        $application = new Application;
        if($user->hasPermission('ЦУЗ'))
        {
            $a = 'branch_initiator_id';
            $b = [9,13];
        }else{
            $a = 'branch_initiator_id';
            $b = [$user->branch_id];

            $c = 'department_initiator_id';
            $d = [$user->department_id];
        }

        if($user->hasPermission('Add_Company_Signer') && $user->hasPermission('Add_Branch_Signer'))
        {

            return $query = $application->query()
                ->where('draft','!=',1)->whereIn($a,$b)->orWhere('signers','like',"%{$user->role_id}%")->orWhere('performer_role_id', $user->role->id)->where('draft','!=',1)->orWhere('user_id',auth()->user()->id)->where('draft','!=',1)->get();
        }
        elseif($user->hasPermission('Warehouse'))
        {
            $status_0 = 'Принята';
            $status_1 = 'товар';
            return $query = $application->query()->where('draft','!=',1)->whereIn($a,$b)->where('status','like',"%{$status_0}%")->OrwhereIn($a,$b)->where('status','like',"%{$status_1}%")->orWhere('user_id',auth()->user()->id)->get();
        }
        elseif($user->hasPermission('Company_Leader') && $user->hasPermission('Branch_Leader'))
        {
            return $query = $application->query()->whereIn($a,$b)->where('draft','!=',1)->orWhere('user_id',auth()->user()->id)->where('draft','!=',1)->get();
        }
        elseif($user->role_id == 7)
        {
            return $query = $application->query()->whereIn($a,$b)->where('draft','!=',1)->where('signers','LIKE','%7%')->get();
        }
        elseif ($user->hasPermission('Company_Signer') || $user->hasPermission('Add_Company_Signer')||$user->hasPermission('Branch_Signer') || $user->hasPermission('Add_Branch_Signer'))
        {
            return $query = $application->query()
                ->where('draft','!=',1)
                ->where('signers','like',"%{$user->role_id}%")
                ->orWhere('performer_role_id', $user->role->id)
                ->where('draft','!=',1)
                ->orWhere('user_id',auth()->user()->id)
                ->where('draft','!=',1)->get();
        }
        elseif($user->hasPermission('Company_Leader'))
        {
            return $query = $application->query()->whereIn($a,$b)->where('draft','!=',1)->where('status','agreed')->orWhere('status','distributed')->whereIn($a,$b)->where('draft','!=',1)->orWhere('user_id',auth()->user()->id)->where('draft','!=',1)->get();
        }
        elseif($user->hasPermission('Branch_Leader'))
        {
            return $query = $application->query()->whereIn($a,$b)->where('draft','!=',1)->where('is_more_than_limit', 0)->where('show_leader',1)->orWhere('is_more_than_limit', 0)->whereIn($a,$b)->where('status', 'new')->orWhere('is_more_than_limit', 0)->where('draft','!=',1)->whereIn($a,$b)->where('status', 'distributed')->orWhere('user_id',auth()->user()->id)->where('draft','!=',1)->get();
        }
        elseif($user->hasPermission('Company_Performer')||$user->hasPermission('Branch_Performer'))
        {
            return $query = $application->query()->where('performer_role_id',auth()->user()->role_id)->orWhere('user_id',auth()->user()->id)->where('draft','!=',1)->get();
        }
        else {
            return $query = $application->query()->whereIn($a,$b)->where('draft','!=',1)->get();
        }
    }
}
