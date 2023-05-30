<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EnrollmentResource extends JsonResource
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
            'bought_price' => $this->bought_price,
            'payment_method' => $this->payment_method,
            'description' => $this->description,
            'status' => $this->status,
            'course' => $this->course,
            'user' => $this->user,
        ];
    }
}
