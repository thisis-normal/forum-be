<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePrefixRequest;
use App\Http\Requests\UpdatePrefixRequest;
use App\Models\Prefix;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PrefixController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
         return response()->json(Prefix::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePrefixRequest $request): JsonResponse
    {
        //create a new prefix
        $prefix = Prefix::query()->create($request->validated());
        return response()->json($prefix, 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePrefixRequest $request, Prefix $prefix): JsonResponse
    {
        //update the prefix
        $prefix->update($request->validated());
        return response()->json($prefix);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prefix $prefix): JsonResponse
    {
        try {
            $prefix->delete();
            return response()->json(['message' => 'Xoá prefix thành công']);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
