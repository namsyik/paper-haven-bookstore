<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Wishlist extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'session_id',
        'book_id'
    ];

    /**
     * Get the book associated with the wishlist item.
     */
    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }
}
