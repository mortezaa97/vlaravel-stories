<?php

declare(strict_types=1);

namespace Mortezaa97\Stories\Http\Resources;

use App\Enums\Status;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Mortezaa97\Reviews\Http\Resources\ReviewResource;

class StoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'status' => Status::from((int) $this->status)?->label(),
            'url' => $this->url,
            'cover' => $this->cover ? url($this->cover) : null,
            'image' => $this->image ? url($this->image) : null,
            'video' => $this->video ? url($this->video) : null,
            'is_liked' => $this->is_liked,
            'likes_count' => $this->likes_count,
            'user' => UserResource::make($this->user),
            'created_by' => UserResource::make($this->createdBy),
            'children' => StoryChildrenResource::collection($this->children),
            'reviews' => ReviewResource::collection($this->reviews),
            'created_at' => $this->created_at,
        ];
    }
}
