@extends('layouts.app')

@section('title', 'Order Confirmation - Paper Haven')

@push('styles')
<style>
    .confirmation-section {
        padding: 3rem 0;
        min-height: 60vh;
    }

    .confirmation-card {
        background: white;
        border-radius: 20px;
        padding: 3rem;
        box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        text-align: center;
        margin-bottom: 3rem;
    }

    .success-icon {
        width: 100px;
        height: 100px;
        background: linear-gradient(135deg, #8B6F47 0%, #D4A574 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 2rem;
        font-size: 3rem;
        color: white;
    }

    .order-details-card {
        background: white;
        border-radius: 15px;
        padding: 2rem;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        margin-bottom: 2rem;
    }

    .detail-row {
        display: flex;
        justify-content: space-between;
        padding: 1rem 0;
        border-bottom: 1px solid #f0f0f0;
    }

    .detail-row:last-child {
        border-bottom: none;
    }

    .order-item-card {
        background: #f8f9fa;
        border-radius: 10px;
        padding: 1rem;
        margin-bottom: 1rem;
    }

    .order-item-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .total-row {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--primary-color);
        padding-top: 1.5rem;
        margin-top: 1.5rem;
        border-top: 2px solid var(--secondary-color);
    }
</style>
@endpush

@section('content')

<div class="container confirmation-section">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Success Message -->
            <div class="confirmation-card">
                <div class="success-icon">
                    <i class="fas fa-check"></i>
                </div>
                <h1 class="mb-3">Order Placed Successfully!</h1>
                <p class="text-muted mb-4">Thank you for your order. We've received your order and will start processing it soon.</p>
                <p class="mb-0">
                    <strong>Order Number:</strong> 
                    <span class="text-primary-custom">#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</span>
                </p>
            </div>
            
            <!-- Customer Details -->
            <div class="order-details-card">
                <h4 class="mb-4"><i class="fas fa-user me-2"></i> Customer Information</h4>
                
                <div class="detail-row">
                    <span class="text-muted">Name:</span>
                    <strong>{{ $order->customer_name }}</strong>
                </div>
                
                <div class="detail-row">
                    <span class="text-muted">Email:</span>
                    <strong>{{ $order->customer_email }}</strong>
                </div>
                
                <div class="detail-row">
                    <span class="text-muted">Phone:</span>
                    <strong>{{ $order->customer_phone }}</strong>
                </div>
                
                <div class="detail-row">
                    <span class="text-muted">Shipping Address:</span>
                    <strong>{{ $order->customer_address }}</strong>
                </div>
            </div>
            
            <!-- Order Items -->
            <div class="order-details-card">
                <h4 class="mb-4"><i class="fas fa-box me-2"></i> Order Items</h4>
                
                @foreach($order->orderItems as $item)
                <div class="order-item-card">
                    <div class="order-item-row">
                        <div>
                            <h6 class="mb-1">{{ $item->book->title }}</h6>
                            <p class="text-muted mb-0">
                                <small>by {{ $item->book->author }}</small>
                            </p>
                            <p class="text-muted mb-0">
                                <small>Qty: {{ $item->quantity }} × ${{ number_format($item->price, 2) }}</small>
                            </p>
                        </div>
                        <div>
                            <strong>${{ number_format($item->subtotal, 2) }}</strong>
                        </div>
                    </div>
                </div>
                @endforeach
                
                <div class="detail-row total-row">
                    <span>Total Amount:</span>
                    <span>${{ number_format($order->total, 2) }}</span>
                </div>
            </div>
            
            <!-- Order Status -->
            <div class="order-details-card">
                <h4 class="mb-4"><i class="fas fa-info-circle me-2"></i> Order Status</h4>
                
                <div class="detail-row">
                    <span class="text-muted">Status:</span>
                    <strong>
                        <span class="badge bg-warning text-dark">{{ ucfirst($order->status) }}</span>
                    </strong>
                </div>
                
                <div class="detail-row">
                    <span class="text-muted">Order Date:</span>
                    <strong>{{ $order->created_at->format('F d, Y - h:i A') }}</strong>
                </div>
                
                <div class="detail-row">
                    <span class="text-muted">Payment Method:</span>
                    <strong>Cash on Delivery</strong>
                </div>
            </div>
            
            <!-- Next Steps -->
            <div class="alert alert-info">
                <h5><i class="fas fa-lightbulb me-2"></i> What's Next?</h5>
                <ul class="mb-0">
                    <li>You will receive an order confirmation email at <strong>{{ $order->customer_email }}</strong></li>
                    <li>We will notify you when your order is shipped</li>
                    <li>Estimated delivery time is 3-5 business days</li>
                </ul>
            </div>
            
            <!-- Action Buttons -->
            <div class="text-center mt-4">
                <a href="{{ route('home') }}" class="btn btn-primary-custom btn-lg me-2">
                    <i class="fas fa-home me-2"></i> Back to Home
                </a>
                <a href="{{ route('shop') }}" class="btn btn-outline-custom btn-lg">
                    <i class="fas fa-shopping-bag me-2"></i> Continue Shopping
                </a>
            </div>
        </div>
    </div>
</div>

@endsection
