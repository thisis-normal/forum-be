<?php

namespace App\Http\Controllers;

use App\Models\ForumGroup;
use App\Services\HomeService;
use Illuminate\Http\JsonResponse;

class HomeController extends Controller
{
    protected HomeService $homeService;
    public function __construct(HomeService $homeService)
    {
        $this->homeService = $homeService;
    }
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
    public function latestThreads(): JsonResponse
    {
        // Sub-query để lấy thread_id của 5 bài post mới nhất với thread_id khác nhau
        $subQuery = $this->homeService->getLatestThreads(5);
        // Truy vấn chính để lấy thông tin cần thiết
        $latestThreadsInformation = $this->homeService->getInformationOfLatestThreads($subQuery);
        return response()->json($latestThreadsInformation);
    }
    public function latestPosts()
    {
        //get  5 latest posts
    }

}
