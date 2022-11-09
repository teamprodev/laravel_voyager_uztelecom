<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];

    public function application()
    {
        return $this->belongsTo(Application::class)->has('need_to_sign');
    }
}
