<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumGroup extends Model
{
    use HasFactory;
    protected $table = 'forum_groups';
    protected $fillable = [
        'name',
        'description',
        'icon_name'
    ];
    public function forums()
    {
        return $this->hasMany(Forum::class);
    }
}
