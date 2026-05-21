<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => (string) $this->_id,
            'order_number' => $this->order_number,
            'user_id' => (string) $this->user_id,
            'customer' => $this->whenLoaded('user', function () {
                return [
                    'id' => (string) $this->user->_id,
                    'name' => $this->user->name,
                    'email' => $this->user->email,
                    'phone' => $this->user->phone,
                ];
            }),
            'customer_name' => $this->when(!$this->relationLoaded('user'), $this->customer_name ?? $this->user?->name),
            'customer_email' => $this->when(!$this->relationLoaded('user'), $this->customer_email ?? $this->user?->email),
            'items' => $this->whenLoaded('items'),
            'item_count' => $this->item_count ?? $this->items?->count() ?? 0,
            'subtotal' => (float) ($this->subtotal ?? 0),
            'shipping_cost' => (float) ($this->shipping_cost ?? 0),
            'discount' => (float) ($this->discount ?? 0),
            'total' => (float) $this->total,
            'payment_method' => $this->payment_method,
            'payment_status' => $this->payment_status ?? 'pending',
            'status' => $this->status ?? 'pending',
            'shipping_address' => $this->shipping_address,
            'billing_address' => $this->billing_address,
            'notes' => $this->notes,
            'coupon_code' => $this->coupon_code,
            'confirmed_at' => $this->confirmed_at?->toISOString(),
            'shipped_at' => $this->shipped_at?->toISOString(),
            'delivered_at' => $this->delivered_at?->toISOString(),
            'cancelled_at' => $this->cancelled_at?->toISOString(),
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
            // Formatted values
            'formatted_total' => 'Rp ' . number_format($this->total, 0, ',', '.'),
        ];
    }
}