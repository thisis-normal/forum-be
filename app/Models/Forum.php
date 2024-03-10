<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    protected $table = 'forums';
    use HasFactory;
    protected $fillable = [
        'forum_group_id',
        'name',
        'description',
        'slug',
        'user_id',
        'created_at',
        'updated_at'
    ];
    public function forumGroup()
    {
        return $this->belongsTo(ForumGroup::class);
    }
}
