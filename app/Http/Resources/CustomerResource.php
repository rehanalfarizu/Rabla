<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => (string) $this->_id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'avatar' => $this->avatar,
            'is_verified' => (bool) ($this->is_verified ?? false),
            'is_admin' => (bool) ($this->is_admin ?? false),
            'is_active' => (bool) ($this->is_active ?? true),
            'total_orders' => (int) ($this->total_orders ?? $this->orders()?->count() ?? 0),
            'total_spend' => (float) ($this->total_spend ?? $this->orders()?->where('payment_status', 'paid')->sum('total') ?? 0),
            'last_login_at' => $this->last_login_at?->toISOString(),
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
            // Computed fields for admin display
            'status' => ($this->is_active ?? true) ? 'Active' : 'Inactive',
            'segment' => $this->getSegmentAttribute(),
        ];
    }

    private function getSegmentAttribute(): string
    {
        $orderCount = $this->total_orders ?? $this->orders()?->count() ?? 0;

        if ($orderCount === 0) {
            return 'New';
        } elseif ($orderCount <= 3) {
            return 'Regular';
        } else {
            return 'VIP';
        }
    }
}