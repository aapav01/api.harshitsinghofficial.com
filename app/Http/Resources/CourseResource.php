<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
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
            'author' => $this->author, // 'user_id'
            'chapters' => PublicChapterResource::collection($this->chapters),
            'enrollments' => EnrollmentResource::collection($this->enrollments->where('status', 'paid')),
            'created_at' => $this->created_at,
            'publish_at' => $this->publish_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
