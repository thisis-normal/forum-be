<?php

namespace App\Http\Controllers;

use App\Models\ForumGroup;
use Illuminate\Http\JsonResponse;

class HomeController extends Controller
{
    /**
     * Get the forum list for the client homepage
     * Return a JSON response with the forum list nested under forum groups
     */
    public function forumList(): JsonResponse
    {
        $forumGroups = ForumGroup::with('forums')->get();
        $data = $forumGroups->map(function ($forumGroup) {
            return [
                'root' => $forumGroup->name,
                'children' => $forumGroup->forums
            ];
        });
        return response()->json($data);
    }
    public function latestPosts()
    {
        //get  5 latest posts

    }
}
