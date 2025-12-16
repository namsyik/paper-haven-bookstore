<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class WishlistController extends Controller
{
    /**
     * Display the wishlist page
     */
    public function index(): View
    {
        $sessionId = session()->getId();
        
        $wishlistItems = Wishlist::where('session_id', $sessionId)
            ->with('book')
            ->get();

        return view('wishlist', compact('wishlistItems'));
    }

    /**
     * Add a book to the wishlist
     */
    public function add(Book $book): RedirectResponse
    {
        $sessionId = session()->getId();

        // Check if book is already in wishlist
        $exists = Wishlist::where('session_id', $sessionId)
            ->where('book_id', $book->id)
            ->exists();

        if ($exists) {
            return back()->with('info', 'This book is already in your wishlist!');
        }

        Wishlist::create([
            'session_id' => $sessionId,
            'book_id' => $book->id
        ]);

        return back()->with('success', 'Book added to wishlist!');
    }

    /**
     * Remove item from wishlist
     */
    public function remove(Wishlist $wishlist): RedirectResponse
    {
        $wishlist->delete();

        return back()->with('success', 'Item removed from wishlist!');
    }

    /**
     * Toggle wishlist (AJAX endpoint)
     */
    public function toggle(Request $request, Book $book): JsonResponse
    {
        $sessionId = session()->getId();

        $wishlistItem = Wishlist::where('session_id', $sessionId)
            ->where('book_id', $book->id)
            ->first();

        if ($wishlistItem) {
            // Remove from wishlist
            $wishlistItem->delete();
            return response()->json([
                'status' => 'removed',
                'message' => 'Removed from wishlist',
                'inWishlist' => false
            ]);
        } else {
            // Add to wishlist
            Wishlist::create([
                'session_id' => $sessionId,
                'book_id' => $book->id
            ]);
            return response()->json([
                'status' => 'added',
                'message' => 'Added to wishlist',
                'inWishlist' => true
            ]);
        }
    }

    /**
     * Move all items from wishlist to cart
     */
    public function moveAllToCart(): RedirectResponse
    {
        $sessionId = session()->getId();
        
        $wishlistItems = Wishlist::where('session_id', $sessionId)
            ->with('book')
            ->get();

        if ($wishlistItems->isEmpty()) {
            return back()->with('error', 'Your wishlist is empty!');
        }

        foreach ($wishlistItems as $item) {
            // Add to cart (use CartController logic)
            $cartItem = \App\Models\CartItem::where('session_id', $sessionId)
                ->where('book_id', $item->book_id)
                ->first();

            if ($cartItem) {
                $cartItem->increment('quantity');
            } else {
                \App\Models\CartItem::create([
                    'session_id' => $sessionId,
                    'book_id' => $item->book_id,
                    'quantity' => 1
                ]);
            }

            // Remove from wishlist
            $item->delete();
        }

        return redirect()->route('cart.index')
            ->with('success', 'All items moved to cart!');
    }

    /**
     * Get wishlist count (AJAX endpoint)
     */
    public function getWishlistCount(): JsonResponse
    {
        $sessionId = session()->getId();
        
        $count = Wishlist::where('session_id', $sessionId)->count();

        return response()->json(['count' => $count]);
    }

    /**
     * Check if book is in wishlist (AJAX endpoint)
     */
    public function checkBook(Book $book): JsonResponse
    {
        $sessionId = session()->getId();
        
        $inWishlist = Wishlist::where('session_id', $sessionId)
            ->where('book_id', $book->id)
            ->exists();

        return response()->json(['inWishlist' => $inWishlist]);
    }

    /**
     * Clear entire wishlist
     */
    public function clear(): RedirectResponse
    {
        $sessionId = session()->getId();
        
        Wishlist::where('session_id', $sessionId)->delete();

        return back()->with('success', 'Wishlist cleared!');
    }
}
