<?php
namespace App\Services;

use App\Models\Post;
use App\Models\Thread;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class HomeService {
    public function getLatestThreads(int $limit): Builder
    {
        return Post::query()->select('thread_id', DB::raw('MAX(created_at) as recent_post'))
            ->groupBy('thread_id')
            ->orderBy('recent_post', 'desc')
            ->limit($limit);
    }
    public function getInformationOfLatestThreads(Builder $subQuery): Collection
    {
        return Thread::query()->joinSub($subQuery, 'sub', function ($join) {
            $join->on('threads.id', '=', 'sub.thread_id');
        })
            ->join('posts', function ($join) {
                $join->on('threads.id', '=', 'posts.thread_id')
                    ->on('posts.created_at', '=', 'sub.recent_post');
            })
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->orderBy('posts.created_at', 'desc')
            ->get(['threads.id as thread_id','threads.title as thread_name', 'users.id as user_id', 'users.full_name as user_full_name', 'posts.created_at']);
    }
}
