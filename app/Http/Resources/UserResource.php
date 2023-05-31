<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'image' => $this->image,
            'roles' => $this->roles,
            'enrollments' => EnrollmentResource::collection($this->enrollments->where('status', 'paid')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
