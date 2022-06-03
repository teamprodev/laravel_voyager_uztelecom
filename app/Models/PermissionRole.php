<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Models\Role;

class PermissionRole extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'permission_role';
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
