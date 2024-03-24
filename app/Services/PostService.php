<?php

namespace App\Services;

use App\Models\Image;
use App\Models\Post;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PostService
{
    public function getPosts(Thread $thread, int $page): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return $thread->posts()->paginate(2, ['*'], 'page', $page);
    }
}
