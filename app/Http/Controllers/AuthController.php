<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use App\Services\AuthService;

class AuthController extends Controller
{
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }
    public function register(RegisterRequest $request): JsonResponse
    {
        try {
            $user = User::query()->create($request->validated());
            // Bạn có thể đặt một quyền mặc định cho người dùng mới, ví dụ như 'user'
            $defaultRole = Role::query()->where('name', 'user')->first();
            $user->roles()->attach($defaultRole);
            return response()->json(['message' => 'Đăng ký thành công'], 201);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function login(LoginRequest $request): JsonResponse
    {
        try {
            $user = $this->authService->getLoginUser($request);
            if (!password_verify($request['password'], $user->password)) {
                return response()->json(['message' => 'Sai mật khẩu'], 401);
            }
            //check if user is banned or not
            if ($user->banned) {
                return response()->json(['message' => 'Tài khoản của bạn đã bị khóa'], 403);
            }
            if (!$user->hasRole('user')) {
                return response()->json(['message' => 'Bạn không có quyền truy cập'], 403);
            }
            $token = $user->createToken('user_access_token', ['user'])->plainTextToken;
            return response()->json(
                [
                    'message' => 'Đăng nhập thành công',
                    'user' => $user,
                    'token' => $token
                ]
            );
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
    public function logout(): JsonResponse
    {
        /** @var User $user */
        $user = auth()->user();
        $user->tokens()->delete();
        return response()->json(['message' => 'Đăng xuất thành công']);
    }
    public function me(): JsonResponse
    {
        return response()->json(auth()->user());
    }
}
