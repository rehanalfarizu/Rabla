<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Wishlist extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'wishlists';

    protected $fillable = [
        'user_id',
        'product_id',
        'notes',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    // Scopes
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    // Helpers
    public static function toggle(int $userId, int $productId): bool
    {
        $existing = self::where('user_id', $userId)
                        ->where('product_id', $productId)
                        ->first();

        if ($existing) {
            $existing->delete();
            return false; // Removed from wishlist
        }

        self::create([
            'user_id' => $userId,
            'product_id' => $productId,
        ]);

        return true; // Added to wishlist
    }

    public static function isInWishlist(int $userId, int $productId): bool
    {
        return self::where('user_id', $userId)
                  ->where('product_id', $productId)
                  ->exists();
    }
}