<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreForumGroupRequest;
use App\Http\Requests\UpdateForumGroupRequest;
use App\Models\ForumGroup;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ForumGroupController extends Controller
{
    public function __construct()
    {

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //show all forum groups
        $forumGroups = ForumGroup::all();
        return response()->json($forumGroups);
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
     * Display the specified resource.
     */
    public function show(ForumGroup $forumGroup)
    {
        return response()->json($forumGroup);
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
            return response()->json($forumGroup, 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ForumGroup $forumGroup)
    {
        //
    }
}
