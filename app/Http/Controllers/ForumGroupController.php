<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreForumGroupRequest;
use App\Http\Requests\UpdateForumGroupRequest;
use App\Models\ForumGroup;
use Exception;
use Illuminate\Http\JsonResponse;

class ForumGroupController extends Controller
{
    public function __construct()
    {

    }
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        //show all forum group
        try {
            $forumGroups = ForumGroup::query()->get();
            return response()->json($forumGroups);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreForumGroupRequest $request): JsonResponse
    {
        try {
            //create a new forum group
            $forumGroup = ForumGroup::query()->create($request->validated());
            return response()->json($forumGroup, 201);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
    /**
     * Display a listing of the forum based on forum group id.
     */
    public function show(ForumGroup $forumGroup): JsonResponse
    {
        try {
            $forumList = $forumGroup->load('forums');
            //hide the forum_group_id from the forum list
            $forum = $forumList->forums->transform(function ($forum) {
                return $forum->makeHidden('forum_group_id', 'created_at', 'updated_at');
            });
            // Manually build up the structure you want to return
            $forumGroupArray = $forumList->toArray();
            $forumGroupArray['forums'] = $forum;
            return response()->json($forumGroupArray);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateForumGroupRequest $request, $id): JsonResponse
    {
        //check if the forum group exists
        $forumGroup = ForumGroup::query()->find($id) ?? abort(404, 'Không tìm thấy nhóm forum');
        try {
            //update the forum group
            $forumGroup->update($request->validated());
            return response()->json($forumGroup);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($forumGroup): JsonResponse
    {
        //check if the forum group exists
        $forumGroup = ForumGroup::query()->find($forumGroup) ?? abort(404, 'Không tìm thấy nhóm forum');
        try {
            //delete the forum group
            $forumGroup->delete();
            return response()->json(['message' => 'Xóa nhóm forum thành công']);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
