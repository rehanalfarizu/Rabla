<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Support\Str;

class Promotion extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'promotions';

    const TYPE_DISCOUNT = 'discount';
    const TYPE_CASHBACK = 'cashback';
    const TYPE_BUNDLE = 'bundle';
    const TYPE_FREE_SHIPPING = 'free_shipping';
    const TYPE_BUY_ONE_GET_ONE = 'bogo';

    const DISCOUNT_TYPE_PERCENTAGE = 'percentage';
    const DISCOUNT_TYPE_FIXED = 'fixed';
    const DISCOUNT_TYPE_FREESHIP = 'freeship';

    protected $fillable = [
        'name',
        'code',
        'type',
        'discount_type',
        'discount_value',
        'max_discount',
        'min_purchase',
        'max_uses',
        'used_count',
        'per_user_limit',
        'start_date',
        'end_date',
        'is_active',
        'is_public',
        'applicable_products',
        'applicable_categories',
        'excluded_products',
        'user_ids',
        'description',
        'terms',
        'image',
        'priority',
    ];

    protected $casts = [
        'discount_value' => 'decimal:2',
        'max_discount' => 'decimal:2',
        'min_purchase' => 'decimal:2',
        'max_uses' => 'integer',
        'used_count' => 'integer',
        'per_user_limit' => 'integer',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'is_active' => 'boolean',
        'is_public' => 'boolean',
        'priority' => 'integer',
        'applicable_products' => 'array',
        'applicable_categories' => 'array',
        'excluded_products' => 'array',
        'user_ids' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($promotion) {
            if (empty($promotion->code)) {
                $promotion->code = strtoupper(Str::random(10));
            }
        });
    }

    // Relationships
    public function coupons()
    {
        return $this->hasMany(Coupon::class, 'promotion_id');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeCurrent($query)
    {
        $now = now();
        return $query->where('start_date', '<=', $now)
                     ->where('end_date', '>=', $now);
    }

    public function scopeAvailable($query)
    {
        return $query->active()->current()
            ->where(function ($q) {
                $q->whereNull('max_uses')
                  ->orWhere('used_count', '<', '$max_uses');
            });
    }

    // Helpers
    public function isValid(): bool
    {
        if (!$this->is_active) return false;

        $now = now();
        if ($this->start_date && $now < $this->start_date) return false;
        if ($this->end_date && $now > $this->end_date) return false;

        if ($this->max_uses && $this->used_count >= $this->max_uses) return false;

        return true;
    }

    public function calculateDiscount(float $subtotal): float
    {
        if ($subtotal < $this->min_purchase) return 0;

        $discount = 0;
        switch ($this->discount_type) {
            case self::DISCOUNT_TYPE_PERCENTAGE:
                $discount = ($subtotal * $this->discount_value) / 100;
                if ($this->max_discount && $discount > $this->max_discount) {
                    $discount = $this->max_discount;
                }
                break;
            case self::DISCOUNT_TYPE_FIXED:
                $discount = $this->discount_value;
                break;
            case self::DISCOUNT_TYPE_FREESHIP:
                $discount = 0; // Handle di shipping cost
                break;
        }

        return $discount;
    }

    public static function getTypeOptions(): array
    {
        return [
            self::TYPE_DISCOUNT => 'Discount',
            self::TYPE_CASHBACK => 'Cashback',
            self::TYPE_BUNDLE => 'Bundle',
            self::TYPE_FREE_SHIPPING => 'Free Shipping',
            self::TYPE_BUY_ONE_GET_ONE => 'Buy One Get One',
        ];
    }
}