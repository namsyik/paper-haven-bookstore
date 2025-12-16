@extends('layouts.app')

@section('title', 'Shopping Cart - Paper Haven')

@push('styles')
<style>
    .cart-section {
        padding: 3rem 0;
    }

    .cart-header {
        background: linear-gradient(135deg, #F5DEB3 0%, #FFF8E7 100%);
        padding: 2rem 0;
        margin-bottom: 3rem;
    }

    .cart-item {
        background: white;
        border-radius: 15px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    }

    .cart-item-image {
        width: 120px;
        height: 160px;
        object-fit: cover;
        border-radius: 10px;
    }

    .cart-summary {
        background: white;
        border-radius: 15px;
        padding: 2rem;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        position: sticky;
        top: 100px;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 1rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid #f0f0f0;
    }

    .summary-row.total {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--primary-color);
        border-bottom: none;
    }

    .quantity-control {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .quantity-control button {
        width: 35px;
        height: 35px;
        border: 1px solid #ddd;
        background: white;
        border-radius: 5px;
        cursor: pointer;
    }

    .quantity-control button:hover {
        background: var(--primary-color);
        color: white;
        border-color: var(--primary-color);
    }

    .quantity-control input {
        width: 50px;
        text-align: center;
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 0.3rem;
    }

    .empty-cart {
        text-align: center;
        padding: 5rem 0;
    }

    .empty-cart i {
        font-size: 5rem;
        color: var(--text-gray);
        margin-bottom: 2rem;
    }
</style>
@endpush

@section('content')

<!-- Cart Header -->
<div class="cart-header">
    <div class="container">
        <h1 class="display-4 mb-0">Shopping Cart</h1>
    </div>
</div>

<!-- Cart Content -->
<div class="container cart-section">
    @if($cartItems->count() > 0)
        <div class="row">
            <!-- Cart Items -->
            <div class="col-lg-8">
                @foreach($cartItems as $item)
                <div class="cart-item">
                    <div class="row align-items-center">
                        <div class="col-md-2">
                            <img src="{{ asset('images/books/' . $item->book->image) }}" alt="{{ $item->book->title }}" class="cart-item-image">
                        </div>
                        
                        <div class="col-md-4">
                            <h5 class="mb-2">{{ $item->book->title }}</h5>
                            <p class="text-muted mb-1">By {{ $item->book->author }}</p>
                            <p class="text-muted mb-0"><small>ISBN: {{ $item->book->isbn }}</small></p>
                        </div>
                        
                        <div class="col-md-2">
                            <p class="mb-0 fw-bold">${{ number_format($item->book->price, 2) }}</p>
                        </div>
                        
                        <div class="col-md-3">
                            <form action="{{ route('cart.update', $item->id) }}" method="POST" class="quantity-form">
                                @csrf
                                @method('PATCH')
                                <div class="quantity-control">
                                    <button type="button" onclick="updateQuantity({{ $item->id }}, -1, {{ $item->book->stock }})">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <input type="number" name="quantity" id="qty-{{ $item->id }}" value="{{ $item->quantity }}" min="1" max="{{ $item->book->stock }}" readonly>
                                    <button type="button" onclick="updateQuantity({{ $item->id }}, 1, {{ $item->book->stock }})">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                        
                        <div class="col-md-1">
                            <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-link text-danger" onclick="return confirm('Remove this item from cart?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
                
                <div class="mt-3">
                    <form action="{{ route('cart.clear') }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Clear all items from cart?')">
                            <i class="fas fa-trash me-2"></i> Clear Cart
                        </button>
                    </form>
                    <a href="{{ route('shop') }}" class="btn btn-primary-custom ms-2">
                        <i class="fas fa-book-open me-2"></i> Continue Shopping
                    </a>
                </div>
            </div>
            
            <!-- Cart Summary -->
            <div class="col-lg-4">
                <div class="cart-summary">
                    <h4 class="mb-4">Order Summary</h4>
                    
                    <div class="summary-row">
                        <span>Subtotal</span>
                        <span>${{ number_format($subtotal, 2) }}</span>
                    </div>
                    
                    <div class="summary-row">
                        <span>Tax (10%)</span>
                        <span>${{ number_format($tax, 2) }}</span>
                    </div>
                    
                    <div class="summary-row total">
                        <span>Total</span>
                        <span>${{ number_format($total, 2) }}</span>
                    </div>
                    
                    <a href="{{ route('checkout.index') }}" class="btn btn-primary-custom btn-lg w-100 mt-3">
                        <i class="fas fa-lock me-2"></i> Proceed to Checkout
                    </a>
                    
                    <div class="text-center mt-3">
                        <small class="text-muted">
                            <i class="fas fa-shield-alt me-1"></i> Secure Checkout
                        </small>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="empty-cart">
            <i class="fas fa-shopping-cart"></i>
            <h2>Your Cart is Empty</h2>
            <p class="text-muted mb-4">Looks like you haven't added any books to your cart yet.</p>
            <a href="{{ route('shop') }}" class="btn btn-primary-custom btn-lg">
                <i class="fas fa-book me-3 "></i> Browse Books
            </a>
        </div>
    @endif
</div>

@endsection

@push('scripts')
<script>
function updateQuantity(itemId, change, maxStock) {
    const input = document.getElementById('qty-' + itemId);
    let currentValue = parseInt(input.value);
    let newValue = currentValue + change;
    
    if (newValue >= 1 && newValue <= maxStock) {
        input.value = newValue;
        
        // Submit the form
        const form = input.closest('form');
        form.submit();
    }
}
</script>
@endpush
