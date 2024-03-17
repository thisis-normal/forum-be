<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @var mixed|string $path
 * @property string $path
 */
class Image extends Model
{

    use HasFactory;
    public $table = 'images';
    protected $appends = ['full_path'];
    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }
    protected $fillable = ['path'];

    public function getFullPathAttribute(): string
    {
        return asset('storage/' . $this->path);
    }
}
