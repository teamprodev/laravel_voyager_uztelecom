<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SignedDocs extends Model
{
    use HasFactory;
    protected $with = 'application';
    public $timestamps = false;
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function application(){
        return $this->belongsTo(Application::class);
    }
    protected $fillable = [
        'pkcs',
        'text',
        'comment',
        'status',
        'user_id',
        'application_id',
        'data',
    ];

}
