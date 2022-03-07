<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationSigners extends Model
{
    use HasFactory;
    protected $table = "application_signers";
    public $timestamps = false;
}
