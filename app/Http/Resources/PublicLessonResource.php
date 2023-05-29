<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PublicLessonResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
            'position' => $this->position,
            'type' => $this->type,
            'public' => $this->public,
            'chapter' => $this->chapter,
            'updated_at' => $this->updated_at,
        ];
    }
}
