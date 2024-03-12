<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    protected $appends = ['avatar'];
    private string $avatar_path = '';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'full_name',
        'avatar_path',
        'student_id',
        'banned',
        'banned_until',
        'banned_reason',
    ];

    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'lnk_user_role', 'user_id', 'role_id')->withTimestamps();
    }
    // AppModelsUser.php

    public function hasRole($role)
    {
        return $this->roles()->where('name', $role)->exists(); // 'name' là cột bạn dùng để định danh role
    }
    public function getAvatarAttribute()
    {
        return $this->avatar_path ? asset($this->avatar_path) : asset('defaultAvatar.png');
    }

}
