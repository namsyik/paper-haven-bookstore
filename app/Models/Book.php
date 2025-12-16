<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'author',
        'description',
        'price',
        'image',
        'stock',
        'isbn',
        'rating',
        'category'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'price' => 'decimal:2',
        'rating' => 'decimal:1',
        'stock' => 'integer',
    ];

    /**
     * Get the cart items for the book.
     */
    public function cartItems(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    /**
     * Get the order items for the book.
     */
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Get the wishlist items for the book.
     */
    public function wishlists(): HasMany
    {
        return $this->hasMany(Wishlist::class);
    }

    /**
     * Check if book is in stock
     */
    public function isInStock(): bool
    {
        return $this->stock > 0;
    }

    /**
     * Get formatted price
     */
    public function getFormattedPriceAttribute(): string
    {
        return '$' . number_format($this->price, 2);
    }

    public function getImageUrlAttribute(): string
    {
        if ($this->image) {
            // // If image path starts with 'http', it's an external URL
            // if (str_starts_with($this->image, 'http')) {
            //     return $this->image;
            // }

            // If image path starts with 'images/', it's already a path
            if (str_starts_with($this->image, 'images/')) {
                return asset($this->image);
            }

            // Otherwise, assume it's just a filename in public/images/
            return asset('images/' . $this->image);
        }

        // Fallback to placeholder with book title
        return 'https://via.placeholder.com/300x450/8B6F47/FFFFFF?text=' . urlencode(substr($this->title, 0, 20));
    }
}
