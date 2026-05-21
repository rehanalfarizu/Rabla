<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => (string) $this->_id,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'short_description' => $this->short_description,
            'price' => (float) $this->price,
            'compare_price' => $this->compare_price ? (float) $this->compare_price : null,
            'cost_price' => $this->cost_price ? (float) $this->cost_price : null,
            'sku' => $this->sku,
            'stock' => (int) $this->stock,
            'low_stock_threshold' => (int) ($this->low_stock_threshold ?? 5),
            'category' => $this->whenLoaded('category', function () {
                return [
                    'id' => (string) $this->category->_id,
                    'name' => $this->category->name,
                ];
            }),
            'category_name' => $this->when(!$this->relationLoaded('category'), $this->category_name ?? null),
            'brand' => $this->brand,
            'images' => is_array($this->images) ? $this->images : [],
            'gallery' => is_array($this->images) && count($this->images) > 1 ? array_slice($this->images, 1) : [],
            'variants' => $this->variants ?? [],
            'sizes' => $this->sizes ?? [],
            'colors' => $this->colors ?? [],
            'weight' => $this->weight ? (float) $this->weight : null,
            'dimensions' => $this->dimensions ?? [],
            'is_active' => (bool) ($this->is_active ?? true),
            'is_featured' => (bool) ($this->is_featured ?? false),
            'is_new' => (bool) ($this->is_new ?? false),
            'tags' => $this->tags ?? [],
            'views_count' => (int) ($this->views_count ?? 0),
            'sold_count' => (int) ($this->sold_count ?? 0),
            'rating' => (float) ($this->rating ?? 0),
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
            // Admin-specific computed fields
            'status' => $this->getStatusAttribute(),
        ];
    }

    private function getStatusAttribute(): string
    {
        if (!$this->is_active) {
            return 'Draft';
        }

        if ($this->stock <= 0) {
            return 'Out of Stock';
        }

        return 'Active';
    }
}