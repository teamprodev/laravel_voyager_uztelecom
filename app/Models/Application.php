<?php

namespace App\Models;

use App\Enums\ApplicationStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property $id
 */
class Application extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];


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
    public function performer_leader()
    {
        return $this->belongsTo(User::class,'performer_leader_user_id','id');
    }
    public function branch_leader()
    {
        return $this->belongsTo(User::class,'branch_leader_user_id','id');
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
                    $result = $query->where('status', ApplicationStatusEnum::Accepted);
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

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_produced_id', 'country_alpha3_code');
    }
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }
    public function branch_signers()
    {
        return $this->belongsTo(Branch::class, 'branch_initiator_id', 'id');
    }
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_initiator_id', 'id')->withDefault(['name' => '']);
    }
    public function purchase()
    {
        return $this->belongsTo(Purchase::class, 'type_of_purchase_id', 'id')->withDefault(['name' => '']);
    }
    public function subjects()
    {
        return $this->belongsTo(Subject::class, 'subject', 'id')->withDefault(['name' => '']);
    }
    public function signedDocs()
    {
        return $this->hasMany(SignedDocs::class);
    }
}
