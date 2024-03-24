<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreThreadRequest;
use App\Http\Requests\UpdateThreadRequest;
use App\Models\Thread;
use App\Services\ImageService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ThreadController extends Controller
{
    private ImageService $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        //show all threads
        $allThreads = Thread::all()->get(['id', 'title', 'content', 'slug', 'created_at']);
        return response()->json($allThreads);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreThreadRequest $request): JsonResponse
    {
        $validatedData = $request->validated();
        $userID = Auth::id();
        if ($userID === null) {
            return response()->json(['message' => 'Không tìm thấy người dùng'], 404);
        }
        $validatedData['user_id'] = $userID;
        //save thread
        try {
            $thread = Thread::query()->create($validatedData);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Lỗi khi lưu chủ đề: '.$e->getMessage()], 500);
        }
        if ($request->hasFile('image')) {
            //save image
            try {
                $this->imageService->saveImages($request->file('image'), $thread);
            } catch (\Exception $e) {
                return response()->json(['message' => 'Lỗi khi lưu ảnh: '.$e->getMessage()], 500);
            }
        }
        return response()->json([
            'message' => 'Thread đã được tạo',
            'thread' => $thread
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function showThread(Thread $thread): JsonResponse
    {
        $thread->load([
            'images' => function ($query) {
                $query->select(['id', 'path', 'imageable_id', 'imageable_type']);
            }
        ]);
        $thread = $this->imageService->removePathString($thread);
        return response()->json($thread);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateThreadRequest $request, Thread $thread)
    {
        dd($request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Thread $thread)
    {
        //
    }
}
