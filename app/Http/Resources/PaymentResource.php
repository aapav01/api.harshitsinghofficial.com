<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
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
            'payment_gateway_id' => $this->payment_gateway_id,
            'gateway' => $this->gateway,
            'method' => $this->method,
            'currency' => $this->currency,
            'user_email' => $this->user_email,
            'amount' => $this->amount,
            'enrollment' => new EnrollmentResource($this->enrollment),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
