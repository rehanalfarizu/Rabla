<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'products';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'short_description',
        'price',
        'compare_price',
        'cost_price',
        'sku',
        'stock',
        'low_stock_threshold',
        'category_id',
        'brand',
        'images',
        'variants',
        'sizes',
        'colors',
        'weight',
        'dimensions',
        'is_active',
        'is_featured',
        'is_new',
        'tags',
        'seo_title',
        'seo_description',
        'meta_keywords',
        'views_count',
        'sold_count',
        'rating',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'compare_price' => 'decimal:2',
        'cost_price' => 'decimal:2',
        'stock' => 'integer',
        'low_stock_threshold' => 'integer',
        'weight' => 'decimal:2',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'is_new' => 'boolean',
        'views_count' => 'integer',
        'sold_count' => 'integer',
        'images' => 'array',
        'variants' => 'array',
        'sizes' => 'array',
        'colors' => 'array',
        'tags' => 'array',
        'dimensions' => 'array',
    ];

    protected $attributes = [
        'stock' => 0,
        'views_count' => 0,
        'sold_count' => 0,
    ];

    // Mutators to handle null values for decimal fields
    public function setPriceAttribute($value)
    {
        if ($value instanceof \MongoDB\BSON\Decimal128) {
            $value = (float) $value->__toString();
        }
        $this->attributes['price'] = $value === null || $value === '' ? 0 : (float) $value;
    }

    public function setComparePriceAttribute($value)
    {
        if ($value instanceof \MongoDB\BSON\Decimal128) {
            $value = (float) $value->__toString();
        }
        $this->attributes['compare_price'] = $value === null || $value === '' ? null : (float) $value;
    }

    public function setCostPriceAttribute($value)
    {
        if ($value instanceof \MongoDB\BSON\Decimal128) {
            $value = (float) $value->__toString();
        }
        $this->attributes['cost_price'] = $value === null || $value === '' ? null : (float) $value;
    }

    public function setWeightAttribute($value)
    {
        if ($value instanceof \MongoDB\BSON\Decimal128) {
            $value = (float) $value->__toString();
        }
        $this->attributes['weight'] = $value === null || $value === '' ? null : (float) $value;
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);
            }
        });
    }

    // Relationships
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'product_id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'product_id');
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class, 'product_id');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeInStock($query)
    {
        return $query->where('stock', '>', 0);
    }

    public function scopeLowStock($query)
    {
        return $query->whereRaw([
            '$expr' => [
                '$and' => [
                    ['$gt' => ['$stock', 0]],
                    ['$lte' => ['$stock', '$low_stock_threshold']],
                ],
            ],
        ]);
    }

    public function scopeOutOfStock($query)
    {
        return $query->where('stock', '<=', 0);
    }

    // Accessors
    public function getMainImageAttribute(): ?string
    {
        return $this->images[0] ?? null;
    }

    public function getFormattedPriceAttribute(): string
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    public function getDiscountPercentageAttribute(): ?int
    {
        if (!$this->compare_price || $this->compare_price <= $this->price) {
            return null;
        }

        return round((($this->compare_price - $this->price) / $this->compare_price) * 100);
    }

    public function getIsOnSaleAttribute(): bool
    {
        return $this->compare_price && $this->compare_price > $this->price;
    }

    public function getIsLowStockAttribute(): bool
    {
        return $this->stock > 0 && $this->stock <= $this->low_stock_threshold;
    }

    public function getAverageRatingAttribute(): float
    {
        return $this->reviews()->avg('rating') ?? 0;
    }

    public function getReviewCountAttribute(): int
    {
        return $this->reviews()->count();
    }
}