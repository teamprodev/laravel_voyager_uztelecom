<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class SignedDocs extends Model
{
    use HasFactory;
    protected $with = 'application';
    protected $table = "signed_docs";

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function application()
    {
        return $this->belongsTo(Application::class);
    }
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

}
