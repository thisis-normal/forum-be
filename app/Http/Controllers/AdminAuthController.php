<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminLoginRequest;
use App\Services\AuthService;
use Exception;
use Illuminate\Http\JsonResponse;

class AdminAuthController extends Controller
{
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(AdminLoginRequest $request): JsonResponse
    {
        try {
            $admin = $this->authService->getLoginUser($request);
            if (!password_verify($request['password'], $admin->password)) {
                return response()->json(['message' => 'Sai mật khẩu'], 401);
            }
            if (!$admin->hasRole('admin')) {
                return response()->json(['message' => 'Bạn không có quyền truy cập'], 403);
            }
            $token = $admin->createToken('admin_access_token', ['admin'])->plainTextToken;
            return response()->json(
                [
                    'message' => 'Đăng nhập thành công',
                    'admin' => $admin,
                    'token' => $token
                ]
            );
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
    public function me(): JsonResponse
    {
        return response()->json(['admin' => auth()->user()]);
    }
}
