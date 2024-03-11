<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
    ];
    public function users()
    {
        return $this->belongsToMany(User::class, 'lnk_user_role', 'role_id', 'user_id')->withTimestamps();
    }
}
