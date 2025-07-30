<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if ($this->resource instanceof \Illuminate\Support\Collection && $this->resource->isEmpty()) {
            return [];
        }

        return [
            'id' => $this->id,
            'customer_name' => $this->customer_name,
            'item_name' => $this->item_name,
            'price' => $this->price,
            'status' => Str::ucfirst($this->status),
            'created_at' => $this->created_at->toDateTimeString(),
        ];
    }
}
