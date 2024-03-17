<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Thread extends Model
{
    use HasFactory;
    protected $table = 'threads';
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
    protected $fillable = [
        'user_id',
        'forum_id',
        'prefix_id',
        'title',
        'content',
        'slug'
    ];
    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
