<?php

namespace App\Http\Resources;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderhistoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'order_date' => $this->order_date ? \Carbon\Carbon::parse($this->order_date)->format('Y-m-d H:i:s') : null,
            'total_price' => $this->total_price,
            'products' => OrderDetailResource::collection($this->orderDetails),
        ];
    }
}
