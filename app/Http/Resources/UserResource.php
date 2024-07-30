<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\URL;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'name' => $this->name,
            'image' => $this->image ? URL::to($this->image) : null,
            'bio' => $this->bio,
            'isAdmin' => $this->isAdmin,
            'topics' => TopicResource::collection($this->topics),
            'posts' => PostResource::collection($this->posts),
            'notificationsCount' => $this->unreadNotifications()->count(),
            'notifications' => $this->notifications,
        ];
    }
}
