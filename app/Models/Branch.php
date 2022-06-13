<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Models\Role;

class Branch extends Model
{
    use HasFactory;
    protected $table = 'branches';
}
