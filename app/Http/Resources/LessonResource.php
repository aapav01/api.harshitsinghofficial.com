<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LessonResource extends JsonResource
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
            'thumbUrl' => $this->thumbUrl,
            'length' => $this->length,
            'url' => $this->url,
            'type' => $this->type,
            'status' => $this->status,
            'position' => $this->position,
            'platform' => $this->platform,
            'public' => $this->public,
            'author' => $this->author, // 'user_id'
            'chapter' => new ChapterResource($this->chapter), // 'chapter_id'
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
