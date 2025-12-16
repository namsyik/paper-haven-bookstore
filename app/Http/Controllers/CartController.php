<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CartController extends Controller
{
    /**
     * Display the shopping cart
     */
    public function index(): View
    {
        $sessionId = session()->getId();
        
        $cartItems = CartItem::where('session_id', $sessionId)
            ->with('book')
            ->get();

        $subtotal = $cartItems->sum(function ($item) {
            return $item->quantity * $item->book->price;
        });

        $tax = $subtotal * 0.10; // 10% tax
        $total = $subtotal + $tax;

        return view('cart', compact('cartItems', 'subtotal', 'tax', 'total'));
    }

    /**
     * Add a book to the cart
     */
    public function add(Request $request, Book $book): RedirectResponse
    {
        $sessionId = session()->getId();

        // Check if book is already in cart
        $cartItem = CartItem::where('session_id', $sessionId)
            ->where('book_id', $book->id)
            ->first();

        if ($cartItem) {
            // Update quantity if already in cart
            $newQuantity = $cartItem->quantity + ($request->input('quantity', 1));
            
            // Check stock availability
            if ($newQuantity > $book->stock) {
                return back()->with('error', 'Not enough stock available. Only ' . $book->stock . ' items left.');
            }
            
            $cartItem->update(['quantity' => $newQuantity]);
            return back()->with('success', 'Cart updated successfully!');
        } else {
            // Add new item to cart
            $quantity = $request->input('quantity', 1);
            
            // Check stock availability
            if ($quantity > $book->stock) {
                return back()->with('error', 'Not enough stock available. Only ' . $book->stock . ' items left.');
            }

            CartItem::create([
                'session_id' => $sessionId,
                'book_id' => $book->id,
                'quantity' => $quantity
            ]);

            return back()->with('success', 'Book added to cart successfully!');
        }
    }

    /**
     * Update cart item quantity
     */
    public function update(Request $request, CartItem $cartItem): RedirectResponse
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $quantity = $request->input('quantity');

        // Check stock availability
        if ($quantity > $cartItem->book->stock) {
            return back()->with('error', 'Not enough stock available. Only ' . $cartItem->book->stock . ' items left.');
        }

        $cartItem->update(['quantity' => $quantity]);

        return back()->with('success', 'Cart updated successfully!');
    }

    /**
     * Remove item from cart
     */
    public function remove(CartItem $cartItem): RedirectResponse
    {
        $cartItem->delete();

        return back()->with('success', 'Item removed from cart!');
    }

    /**
     * Get cart count (AJAX endpoint)
     */
    public function getCartCount()
    {
        $sessionId = session()->getId();
        
        $count = CartItem::where('session_id', $sessionId)->sum('quantity');

        return response()->json(['count' => $count]);
    }

    /**
     * Clear entire cart
     */
    public function clear(): RedirectResponse
    {
        $sessionId = session()->getId();
        
        CartItem::where('session_id', $sessionId)->delete();

        return back()->with('success', 'Cart cleared successfully!');
    }
}
