<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct(AuthService $authService)
    {
        $this->middleware('auth:sanctum');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    //view image
    public function viewImage(Request $request): JsonResponse
    {
        dd($request->user()->tokenCan('client'));
        dd($request->user()->id);
        $user = Auth::user();
        // Kiểm tra xem người dùng có vai trò 'admin' hoặc 'view-image' không
        if ($user->roles()->whereIn('name', ['user', 'admin'])->exists()) {
            $image = asset('defaultAvatar.png');
            return response()->json(['image' => $image]);
        }
        return response()->json(['message' => 'Bạn không có quyền truy cập'], 403);
    }
}


