<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class AuthService
{
    public function getLoginUser(Request $request): Model|Builder
    {
        return User::query()
            ->select('id', 'username','full_name', 'password', 'avatar_path','banned')
            ->where('email', $request['email'])
            ->firstOrFail();
    }
    public function getRoleByUserId(int $userId): Builder
    {
        return User::query()
            ->select('roles.name')
            ->join('lnk_user_role', 'users.id', '=', 'lnk_user_role.user_id')
            ->join('roles', 'lnk_user_role.role_id', '=', 'roles.id')
            ->where('users.id', $userId);
    }
}
