@extends('layouts.app')

@section('title', 'My Wishlist - Paper Haven')

@push('styles')
<style>
    .wishlist-header {
        background: linear-gradient(135deg, #E74C3C 0%, #C0392B 100%);
        padding: 3rem 0;
        color: white;
        margin-bottom: 3rem;
    }

    .wishlist-header h1 {
        font-size: 2.5rem;
        margin-bottom: 0.5rem;
    }

    .wishlist-item {
        background: white;
        border-radius: 15px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
    }

    .wishlist-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.12);
    }

    .wishlist-image {
        width: 120px;
        height: 160px;
        object-fit: cover;
        border-radius: 10px;
    }

    .wishlist-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .empty-wishlist {
        text-align: center;
        padding: 5rem 0;
    }

    .empty-wishlist i {
        font-size: 5rem;
        color: #E74C3C;
        margin-bottom: 2rem;
    }

    .wishlist-stats {
        background: white;
        border-radius: 15px;
        padding: 2rem;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        position: sticky;
        top: 100px;
    }

    .heart-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        background: white;
        border: none;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .heart-btn:hover {
        transform: scale(1.1);
    }

    .heart-btn i {
        font-size: 1.2rem;
        color: #E74C3C;
    }
</style>
@endpush

@section('content')

<!-- Wishlist Header -->
<div class="wishlist-header">
    <div class="container">
        <h1><i class="fas fa-heart me-2"></i> My Wishlist</h1>
        <p class="mb-0">Save your favorite books for later</p>
    </div>
</div>

<!-- Wishlist Content -->
<div class="container mb-5">
    @if($wishlistItems->count() > 0)
        <div class="row">
            <!-- Wishlist Items -->
            <div class="col-lg-8">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5>{{ $wishlistItems->count() }} {{ Str::plural('item', $wishlistItems->count()) }}</h5>
                    <div>
                        <form action="{{ route('wishlist.moveToCart') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-custom btn-sm">
                                <i class="fas fa-shopping-cart me-1"></i> Move All to Cart
                            </button>
                        </form>
                        <form action="{{ route('wishlist.clear') }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Clear entire wishlist?')">
                                <i class="fas fa-trash me-1"></i> Clear All
                            </button>
                        </form>
                    </div>
                </div>

                @foreach($wishlistItems as $item)
                <div class="wishlist-item">
                    <div class="row align-items-center">
                        <div class="col-md-2">
                            <img src="{{ asset('images/books/' . $item->book->image) }}" 
                                 alt="{{ $item->book->title }}" 
                                 class="wishlist-image"
                                 data-isbn="{{ $item->book->isbn }}"
                                 data-title="{{ $item->book->title }}"
                                 onerror="this.src='https://placehold.co/120x160/E74C3C/ffffff?text=Book'">
                        </div>
                        
                        <div class="col-md-5">
                            <h5 class="mb-2">{{ $item->book->title }}</h5>
                            <p class="text-muted mb-1">By {{ $item->book->author }}</p>
                            <p class="text-muted mb-1"><small>ISBN: {{ $item->book->isbn }}</small></p>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-star text-warning"></i>
                                <span class="ms-1">{{ number_format($item->book->rating, 1) }}</span>
                            </div>
                        </div>
                        
                        <div class="col-md-2">
                            <p class="mb-0 fw-bold text-primary-custom">${{ number_format($item->book->price, 2) }}</p>
                            @if($item->book->stock > 0)
                                <small class="text-success">
                                    <i class="fas fa-check-circle"></i> In Stock
                                </small>
                            @else
                                <small class="text-danger">
                                    <i class="fas fa-times-circle"></i> Out of Stock
                                </small>
                            @endif
                        </div>
                        
                        <div class="col-md-3">
                            <div class="wishlist-actions">
                                @if($item->book->stock > 0)
                                <form action="{{ route('cart.add', $item->book->id) }}" method="POST" class="w-100 mb-2">
                                    @csrf
                                    <button type="submit" class="btn btn-primary-custom btn-sm w-100">
                                        <i class="fas fa-shopping-cart me-1"></i> Add to Cart
                                    </button>
                                </form>
                                @endif
                                
                                <form action="{{ route('wishlist.remove', $item->id) }}" method="POST" class="w-100">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm w-100">
                                        <i class="fas fa-trash me-1"></i> Remove
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <!-- Wishlist Stats -->
            <div class="col-lg-4">
                <div class="wishlist-stats">
                    <h4 class="mb-4">Wishlist Summary</h4>
                    
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Total Items:</span>
                            <strong>{{ $wishlistItems->count() }}</strong>
                        </div>
                        
                        <div class="d-flex justify-content-between mb-2">
                            <span>In Stock:</span>
                            <strong class="text-success">{{ $wishlistItems->where('book.stock', '>', 0)->count() }}</strong>
                        </div>
                        
                        <div class="d-flex justify-content-between mb-2">
                            <span>Total Value:</span>
                            <strong class="text-primary-custom">
                                ${{ number_format($wishlistItems->sum(function($item) { return $item->book->price; }), 2) }}
                            </strong>
                        </div>
                    </div>
                    
                    <hr>
                    
                    <div class="alert alert-info">
                        <small>
                            <i class="fas fa-info-circle me-1"></i>
                            Items in your wishlist are saved for 30 days
                        </small>
                    </div>
                    
                    <form action="{{ route('wishlist.moveToCart') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary-custom btn-lg w-100 mb-2">
                            <i class="fas fa-shopping-cart me-2"></i> Add All to Cart
                        </button>
                    </form>
                    
                    <a href="{{ route('shop') }}" class="btn btn-outline-custom btn-lg w-100">
                        <i class="fas fa-book me-2"></i> Continue Shopping
                    </a>
                </div>
            </div>
        </div>
    @else
        <div class="empty-wishlist">
            <i class="fas fa-heart-broken"></i>
            <h2>Your Wishlist is Empty</h2>
            <p class="text-muted mb-4">Save your favorite books to your wishlist and buy them later!</p>
            <a href="{{ route('shop') }}" class="btn btn-primary-custom btn-lg">
                <i class="fas fa-book me-3"></i> Browse Books
            </a>
        </div>
    @endif
</div>

@endsection
