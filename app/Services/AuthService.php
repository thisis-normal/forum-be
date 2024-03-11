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
            ->where('username', $request['username'])
            ->firstOrFail();
    }
}
