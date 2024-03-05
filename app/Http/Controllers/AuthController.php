<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function register(RegisterRequest $request): JsonResponse
    {
        try {
            User::query()->create($request->validated());
            return response()->json(['message' => 'Đăng ký thành công'], 201);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function login(LoginRequest $request): JsonResponse
    {
        try {
            $user = User::query()->where('username', $request['username'])->first();
            if (!$user || !password_verify($request['password'], $user->password)) {
                return response()->json(['message' => 'Sai tài khoản hoặc mật khẩu'], 401);
            }
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json(['message' => 'Đăng nhập thành công', 'token' => $token], 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
    public function logout(): JsonResponse
    {
        try {
            auth()->user()->tokens()->delete();
            return response()->json(['message' => 'Đăng xuất thành công'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
