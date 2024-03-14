<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';
    public function thread(): BelongsTo
    {
        return $this->belongsTo(Thread::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
