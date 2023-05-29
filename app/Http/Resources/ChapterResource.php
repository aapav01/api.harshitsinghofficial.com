<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChapterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'lessons' => PublicLessonResource::collection($this->lessons), //TODO: ->where('public', true)
            'course' => $this->course,
            'author' => $this->author, // 'user_id'
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
