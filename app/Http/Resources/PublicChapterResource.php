<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PublicChapterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=> $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'lessons' => PublicLessonResource::collection($this->lessons), //TODO: ->where('public', true)
            'course' => $this->course,
        ];
    }
}
