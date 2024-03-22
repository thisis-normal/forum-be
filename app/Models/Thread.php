<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Thread extends Model
{
    use HasFactory;

    protected $table = 'threads';
    protected $with = ['prefix'];
    protected $fillable = [
        'user_id',
        'forum_id',
        'prefix_id',
        'title',
        'content',
        'slug'
    ];

    public function forum(): BelongsTo
    {
        return $this->belongsTo(Forum::class);
    }

    public function prefix(): BelongsTo
    {
        return $this->belongsTo(Prefix::class);
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function toArray(): array
    {
        $array = parent::toArray();

        // Remove the forum_id from the array
        unset($array['user_id'], $array['forum_id'],$array['prefix_id'] ,$array['created_at'], $array['updated_at']);
        //remove the prefix node from the array
        unset($array['prefix']);
        // Add prefix details
        if ($this->prefix) {
            $array['prefix_name'] = $this->prefix->name;
            $array['prefix_color'] = $this->prefix->color;
        }
        return $array;
    }
}
