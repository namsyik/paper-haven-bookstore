<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    /**
     * Display the checkout page
     */
    public function index(): View
    {
        $sessionId = session()->getId();
        
        $cartItems = CartItem::where('session_id', $sessionId)
            ->with('book')
            ->get();

        // Redirect to cart if empty
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Your cart is empty!');
        }

        $subtotal = $cartItems->sum(function ($item) {
            return $item->quantity * $item->book->price;
        });

        $tax = $subtotal * 0.10; // 10% tax
        $shipping = 5.00; // Flat shipping rate
        $total = $subtotal + $tax + $shipping;

        return view('checkout', compact('cartItems', 'subtotal', 'tax', 'shipping', 'total'));
    }

    /**
     * Process the order
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate the request
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_address' => 'required|string|max:500',
        ]);

        $sessionId = session()->getId();
        
        $cartItems = CartItem::where('session_id', $sessionId)
            ->with('book')
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Your cart is empty!');
        }

        // Calculate total
        $subtotal = $cartItems->sum(function ($item) {
            return $item->quantity * $item->book->price;
        });
        $tax = $subtotal * 0.10;
        $shipping = 5.00;
        $total = $subtotal + $tax + $shipping;

        // Create order within a transaction
        try {
            DB::beginTransaction();

            // Create the order
            $order = Order::create([
                'customer_name' => $validated['customer_name'],
                'customer_email' => $validated['customer_email'],
                'customer_phone' => $validated['customer_phone'],
                'customer_address' => $validated['customer_address'],
                'total' => $total,
                'status' => 'pending'
            ]);

            // Create order items and update stock
            foreach ($cartItems as $cartItem) {
                // Check if enough stock
                if ($cartItem->book->stock < $cartItem->quantity) {
                    DB::rollBack();
                    return back()->with('error', 'Not enough stock for ' . $cartItem->book->title);
                }

                // Create order item
                OrderItem::create([
                    'order_id' => $order->id,
                    'book_id' => $cartItem->book->id,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->book->price
                ]);

                // Update book stock
                $cartItem->book->decrement('stock', $cartItem->quantity);
            }

            // Clear the cart
            CartItem::where('session_id', $sessionId)->delete();

            DB::commit();

            // Redirect to confirmation page
            return redirect()->route('order.confirmation', $order->id)
                ->with('success', 'Order placed successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'An error occurred while processing your order. Please try again.');
        }
    }

    /**
     * Display order confirmation page
     */
    public function confirmation(Order $order): View
    {
        $order->load('orderItems.book');

        return view('order-confirmation', compact('order'));
    }
}
