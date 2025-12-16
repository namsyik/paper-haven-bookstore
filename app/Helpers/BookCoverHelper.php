<?php

namespace App\Helpers;

class BookCoverHelper
{
    /**
     * Get book cover URL from Google Books API
     * 
     * @param string $isbn
     * @param string $size (thumbnail, small, medium, large)
     * @return string
     */
    public static function getCoverUrl($isbn, $size = 'large')
    {
        // Use Google Books API - no authentication needed
        return "https://books.google.com/books/publisher/content/images/frontcover/" . 
               self::getGoogleBooksId($isbn) . 
               "?fife=w400-h600&source=gbs_api";
    }
    
    /**
     * Get alternative cover URL
     */
    public static function getAlternativeCover($isbn)
    {
        // Fallback to Open Library
        return "https://covers.openlibrary.org/b/isbn/{$isbn}-L.jpg";
    }
    
    /**
     * Generate a beautiful fallback cover with book title
     */
    public static function generateFallbackUrl($title, $author = '')
    {
        $colors = [
            '#2C3E50', '#E74C3C', '#3498DB', '#9B59B6', 
            '#F39C12', '#16A085', '#C0392B', '#D35400'
        ];
        
        $color = $colors[abs(crc32($title)) % count($colors)];
        $color = substr($color, 1); // Remove #
        
        $text = urlencode(substr($title, 0, 30));
        
        return "https://placehold.co/400x600/{$color}/ffffff?text=" . $text . "&font=playfair-display";
    }
    
    /**
     * Get Google Books ID from ISBN (simplified)
     */
    private static function getGoogleBooksId($isbn)
    {
        // This would typically involve an API call, but for now we'll use ISBN
        return $isbn;
    }
}
