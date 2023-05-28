<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PublicCourseResource extends JsonResource
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
            'name' => $this->name,
            'short' => $this->short,
            'description' => $this->description,
            'slug' => $this->slug,
            'image' => $this->image,
            'latest_price' => $this->latest_price,
            'before_price' => $this->before_price,
            'public' => $this->public,
            'publish_at' => $this->publish_at,
            'author' => UserResource::collection($this->author), // 'user_id'
            'updated_at' => $this->updated_at,
        ];
    }
}
