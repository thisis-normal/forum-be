<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'post_id' => $this->id,
            'thread_id' => $this->thread_id,
            'full_name' => $this->user->full_name,
            'user_avatar' => $this->user->avatar,
            'content' => $this->content,
            'images' => $this->images,
            'reply_id' => $this->replied_to === 0 ? null : $this->replied_to,
            'reply_to' => $this->when($this->replied_to, function () {
                return [
                    'user_id' => $this->repliedTo->user->id,
                    'username' => $this->repliedTo->user ? $this->repliedTo->user->full_name : null,
                    'content' => $this->repliedTo->content,
                ];
            }),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
