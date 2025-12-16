@extends('layouts.app')

@section('title', 'Checkout - Paper Haven')

@push('styles')
<style>
    .checkout-section {
        padding: 3rem 0;
    }

    .checkout-header {
        background: linear-gradient(135deg, #F5DEB3 0%, #FFF8E7 100%);
        padding: 2rem 0;
        margin-bottom: 3rem;
    }

    .checkout-form {
        background: white;
        border-radius: 15px;
        padding: 2rem;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    }

    .form-section {
        margin-bottom: 2rem;
    }

    .form-section h5 {
        color: var(--primary-color);
        margin-bottom: 1.5rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid var(--secondary-color);
    }

    .order-summary-card {
        background: white;
        border-radius: 15px;
        padding: 2rem;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        position: sticky;
        top: 100px;
    }

    .order-item {
        display: flex;
        gap: 15px;
        padding: 1rem 0;
        border-bottom: 1px solid #f0f0f0;
    }

    .order-item:last-child {
        border-bottom: none;
    }

    .order-item-image {
        width: 60px;
        height: 80px;
        object-fit: cover;
        border-radius: 5px;
    }

    .order-item-info {
        flex: 1;
    }

    .order-item-title {
        font-size: 0.9rem;
        font-weight: 600;
        margin-bottom: 0.3rem;
    }

    .order-item-qty {
        font-size: 0.8rem;
        color: var(--text-gray);
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 1rem;
        padding: 0.5rem 0;
    }

    .summary-row.total {
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--primary-color);
        border-top: 2px solid #f0f0f0;
        padding-top: 1rem;
        margin-top: 1rem;
    }
</style>
@endpush

@section('content')

<!-- Checkout Header -->
<div class="checkout-header">
    <div class="container">
        <h1 class="display-4 mb-0">Checkout</h1>
    </div>
</div>

<!-- Checkout Content -->
<div class="container checkout-section">
    <div class="row">
        <!-- Checkout Form -->
        <div class="col-lg-7">
            <div class="checkout-form">
                <form action="{{ route('checkout.store') }}" method="POST">
                    @csrf
                    
                    <!-- Customer Information -->
                    <div class="form-section">
                        <h5><i class="fas fa-user me-2"></i> Customer Information</h5>
                        
                        <div class="mb-3">
                            <label for="customer_name" class="form-label">Full Name *</label>
                            <input type="text" class="form-control @error('customer_name') is-invalid @enderror" 
                                   id="customer_name" name="customer_name" value="{{ old('customer_name') }}" required>
                            @error('customer_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="customer_email" class="form-label">Email Address *</label>
                            <input type="email" class="form-control @error('customer_email') is-invalid @enderror" 
                                   id="customer_email" name="customer_email" value="{{ old('customer_email') }}" required>
                            @error('customer_email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="customer_phone" class="form-label">Phone Number *</label>
                            <input type="tel" class="form-control @error('customer_phone') is-invalid @enderror" 
                                   id="customer_phone" name="customer_phone" value="{{ old('customer_phone') }}" required>
                            @error('customer_phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Shipping Address -->
                    <div class="form-section">
                        <h5><i class="fas fa-map-marker-alt me-2"></i> Shipping Address</h5>
                        
                        <div class="mb-3">
                            <label for="customer_address" class="form-label">Full Address *</label>
                            <textarea class="form-control @error('customer_address') is-invalid @enderror" 
                                      id="customer_address" name="customer_address" rows="4" required>{{ old('customer_address') }}</textarea>
                            @error('customer_address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Payment Method -->
                    <div class="form-section">
                        <h5><i class="fas fa-credit-card me-2"></i> Payment Method</h5>
                        
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="payment_method" id="payment_cod" value="cod" checked>
                            <label class="form-check-label" for="payment_cod">
                                <strong>Cash on Delivery</strong>
                                <p class="text-muted mb-0"><small>Pay when you receive your order</small></p>
                            </label>
                        </div>
                        
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="payment_method" id="payment_card" value="card" disabled>
                            <label class="form-check-label" for="payment_card">
                                <strong>Credit/Debit Card</strong>
                                <p class="text-muted mb-0"><small>Coming soon...</small></p>
                            </label>
                        </div>
                    </div>
                    
                    <div class="d-flex gap-3">
                        <a href="{{ route('cart.index') }}" class="btn btn-outline-custom btn-lg">
                            <i class="fas fa-arrow-left me-2"></i> Back to Cart
                        </a>
                        <button type="submit" class="btn btn-primary-custom btn-lg flex-fill">
                            <i class="fas fa-check me-2"></i> Place Order
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Order Summary -->
        <div class="col-lg-5">
            <div class="order-summary-card">
                <h4 class="mb-4">Order Summary</h4>
                
                <!-- Order Items -->
                <div class="mb-4">
                    @foreach($cartItems as $item)
                    <div class="order-item">
                        <img src="https://via.placeholder.com/60x80/8B6F47/FFFFFF?text={{ urlencode(substr($item->book->title, 0, 1)) }}" 
                             alt="{{ $item->book->title }}" class="order-item-image">
                        <div class="order-item-info">
                            <div class="order-item-title">{{ $item->book->title }}</div>
                            <div class="order-item-qty">Qty: {{ $item->quantity }} × ${{ number_format($item->book->price, 2) }}</div>
                        </div>
                        <div class="fw-bold">${{ number_format($item->quantity * $item->book->price, 2) }}</div>
                    </div>
                    @endforeach
                </div>
                
                <!-- Summary -->
                <div class="summary-row">
                    <span>Subtotal</span>
                    <span>${{ number_format($subtotal, 2) }}</span>
                </div>
                
                <div class="summary-row">
                    <span>Tax (10%)</span>
                    <span>${{ number_format($tax, 2) }}</span>
                </div>
                
                <div class="summary-row">
                    <span>Shipping</span>
                    <span>${{ number_format($shipping, 2) }}</span>
                </div>
                
                <div class="summary-row total">
                    <span>Total</span>
                    <span>${{ number_format($total, 2) }}</span>
                </div>
                
                <div class="alert alert-info mt-3">
                    <small>
                        <i class="fas fa-info-circle me-1"></i>
                        Your personal data will be used to process your order and for other purposes described in our privacy policy.
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
