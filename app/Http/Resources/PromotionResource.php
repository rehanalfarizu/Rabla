<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PromotionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => (string) $this->_id,
            'name' => $this->name,
            'code' => $this->code,
            'type' => $this->type,
            'type_display' => $this->getTypeDisplayAttribute(),
            'discount_type' => $this->discount_type,
            'discount_value' => $this->discount_value ? (float) $this->discount_value : 0,
            'max_discount' => $this->max_discount ? (float) $this->max_discount : null,
            'min_purchase' => $this->min_purchase ? (float) $this->min_purchase : 0,
            'max_uses' => $this->max_uses,
            'used_count' => (int) ($this->used_count ?? 0),
            'remaining_uses' => $this->max_uses ? $this->max_uses - ($this->used_count ?? 0) : null,
            'per_user_limit' => $this->per_user_limit,
            'start_date' => $this->start_date?->toISOString(),
            'end_date' => $this->end_date?->toISOString(),
            'is_active' => (bool) ($this->is_active ?? true),
            'is_public' => (bool) ($this->is_public ?? true),
            'description' => $this->description,
            'terms' => $this->terms,
            'image' => $this->image,
            'priority' => (int) ($this->priority ?? 0),
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
            // Display helpers
            'status' => $this->getStatusAttribute(),
            'value_display' => $this->getValueDisplayAttribute(),
        ];
    }

    private function getStatusAttribute(): string
    {
        if (!$this->is_active) {
            return 'Inactive';
        }

        $now = now();

        if ($this->start_date && $now < $this->start_date) {
            return 'Scheduled';
        }

        if ($this->end_date && $now > $this->end_date) {
            return 'Expired';
        }

        if ($this->max_uses && $this->used_count >= $this->max_uses) {
            return 'Maxed Out';
        }

        return 'Active';
    }

    private function getTypeDisplayAttribute(): string
    {
        return match ($this->type) {
            'discount' => 'Discount',
            'cashback' => 'Cashback',
            'bundle' => 'Bundle',
            'free_shipping' => 'Free Shipping',
            'bogo' => 'Buy One Get One',
            default => ucfirst($this->type ?? 'Unknown'),
        };
    }

    private function getValueDisplayAttribute(): string
    {
        if ($this->type === 'free_shipping') {
            return 'Free Shipping';
        }

        if ($this->discount_type === 'percentage') {
            return $this->discount_value . '%';
        }

        return 'Rp ' . number_format($this->discount_value, 0, ',', '.');
    }
}