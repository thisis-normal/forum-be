<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForumRequest;
use App\Models\Forum;
use App\Services\ForumService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{
    protected ForumService $forumService;


    public function __construct()
    {
        $this->forumService = new ForumService();
    }


    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        //show all forum group by forum group id
        try {
            $forums = $this->forumService->getAllForums();
            return response()->json($forums);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($forumID): JsonResponse
    {
        // Find the forum with the given id or abort if not found
        $forum = Forum::with('threads.prefix')->find($forumID) ?? abort(404, 'Không tìm thấy nhóm forum');
        // Hide attributes in the Forum
        $forum->load('threads')->makeHidden('user_id', 'created_at', 'updated_at', 'forum_group_id');
        //convert to array to remove thread's property
        $forum = $forum->toArray();
        return response()->json($forum);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ForumRequest $request): JsonResponse
    {
        try {
            $userID = Auth::id();
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
        try {
            $request->merge(['user_id' => $userID]);
            //create a new forum with user id also
            $forum = Forum::query()->create($request->validated());
            return response()->json($forum, 201);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(ForumRequest $request, $id): JsonResponse
    {
        //check if the forum group exists
        $forum = Forum::query()->find($id) ?? abort(404, 'Không tìm thấy nhóm forum');
        try {
            $forum->update($request->validated());
            return response()->json($forum);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($forum): JsonResponse
    {
        //check if the forum group exists
        $forum = Forum::query()->find($forum) ?? abort(404, 'Không tìm thấy nhóm forum');
        try {
            $forum->delete();
            return response()->json(['message' => 'Xóa forum thành công']);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
