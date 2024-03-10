<?php
namespace App\Services;

use App\Models\Forum;
use Illuminate\Database\Eloquent\Collection;

class ForumService
{
    public function getAllForums(): array|Collection
    {
        return Forum::query()
            ->select('id', 'forum_group_id', 'name', 'description', 'created_at')
            ->orderBy('forum_group_id')
            ->get();
    }
}
