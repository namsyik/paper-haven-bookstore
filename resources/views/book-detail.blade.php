@extends('layouts.app')

@section('title', $book->title . ' - Paper Haven')

@push('styles')
<style>
    .product-section {
        padding: 3rem 0;
    }

    .product-image {
        width: 100%;
        max-width: 400px;
        height: auto;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }

    .product-info {
        padding: 2rem;
    }

    .product-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 1rem;
    }

    .product-author {
        font-size: 1.2rem;
        color: var(--text-gray);
        margin-bottom: 1.5rem;
    }

    .product-rating {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 1.5rem;
    }

    .product-rating i {
        color: #FFD700;
    }

    .product-price {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--primary-color);
        margin-bottom: 1.5rem;
    }

    .product-meta {
        background: #f8f9fa;
        padding: 1.5rem;
        border-radius: 10px;
        margin-bottom: 1.5rem;
    }

    .product-meta-item {
        display: flex;
        justify-content: space-between;
        margin-bottom: 0.5rem;
    }

    .quantity-selector {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 2rem;
    }

    .quantity-btn {
        width: 40px;
        height: 40px;
        border: 1px solid #ddd;
        background: white;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s;
    }

    .quantity-btn:hover {
        background: var(--primary-color);
        color: white;
        border-color: var(--primary-color);
    }

    .quantity-input {
        width: 60px;
        text-align: center;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 0.5rem;
    }

    .tabs-section {
        margin-top: 4rem;
    }

    .nav-tabs {
        border-bottom: 2px solid #dee2e6;
    }

    .nav-tabs .nav-link {
        color: var(--text-gray);
        border: none;
        padding: 1rem 2rem;
        font-weight: 500;
    }

    .nav-tabs .nav-link.active {
        color: var(--primary-color);
        border-bottom: 3px solid var(--primary-color);
    }

    .related-section {
        margin-top: 4rem;
    }

    .wishlist-toggle i {
        font-size: 1.5rem;
        transition: all 0.3s ease;
    }

    .wishlist-toggle.active {
        background: linear-gradient(135deg, #E74C3C 0%, #C0392B 100%);
        border-color: #E74C3C;
        color: white;
    }

    .wishlist-toggle.active i {
        animation: heartBeat 0.5s ease;
    }

    @keyframes heartBeat {
        0%, 100% { transform: scale(1); }
        25% { transform: scale(1.3); }
        50% { transform: scale(1.1); }
    }
</style>
@endpush

@section('content')

<div class="container product-section">
    <div class="row">
        <!-- Product Image -->
        <div class="col-lg-5">
            <img src="{{ asset('images/books/' . $book->image) }}" alt="{{ $book->title }}" class="product-image" data-isbn="{{ $book->isbn }}" data-title="{{ $book->title }}" onerror="this.src='https://placehold.co/400x600/8B6F47/ffffff?text=Book+Cover'">
        </div>
        
        <!-- Product Info -->
        <div class="col-lg-7">
            <div class="product-info">
                <h1 class="product-title">{{ $book->title }}</h1>
                <p class="product-author">By {{ $book->author }}</p>
                
                <div class="product-rating">
                    <i class="fas fa-star"></i>
                    <span><strong>{{ number_format($book->rating, 1) }}</strong> (125 reviews)</span>
                </div>
                
                <h2 class="product-price">${{ number_format($book->price, 2) }}</h2>
                
                <div class="product-meta">
                    <div class="product-meta-item">
                        <span><strong>ISBN:</strong></span>
                        <span>{{ $book->isbn }}</span>
                    </div>
                    <div class="product-meta-item">
                        <span><strong>Category:</strong></span>
                        <span>{{ $book->category }}</span>
                    </div>
                    <div class="product-meta-item">
                        <span><strong>Availability:</strong></span>
                        <span class="{{ $book->stock > 0 ? 'text-success' : 'text-danger' }}">
                            {{ $book->stock > 0 ? 'In Stock (' . $book->stock . ' available)' : 'Out of Stock' }}
                        </span>
                    </div>
                </div>
                
                @if($book->stock > 0)
                <form action="{{ route('cart.add', $book->id) }}" method="POST">
                    @csrf
                    <div class="quantity-selector">
                        <label>Quantity:</label>
                        <button type="button" class="quantity-btn" onclick="decrementQty()">
                            <i class="fas fa-minus"></i>
                        </button>
                        <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $book->stock }}" class="quantity-input">
                        <button type="button" class="quantity-btn" onclick="incrementQty()">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                    
                    <div class="d-flex gap-3">
                        <button type="submit" class="btn btn-primary-custom btn-lg flex-fill">
                            <i class="fas fa-shopping-cart me-2"></i> Add to Cart
                        </button>
                        <button type="button" class="btn btn-outline-custom btn-lg wishlist-toggle" onclick="toggleWishlist({{ $book->id }}, this)">
                            <i class="far fa-heart"></i>
                        </button>
                    </div>
                </form>
                @else
                <button class="btn btn-secondary btn-lg w-100" disabled>
                    Out of Stock
                </button>
                @endif
            </div>
        </div>
    </div>
    
    <!-- Tabs Section -->
    <div class="tabs-section">
        <ul class="nav nav-tabs" id="productTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button">
                    Description
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button">
                    Reviews
                </button>
            </li>
        </ul>
        <div class="tab-content pt-4" id="productTabsContent">
            <div class="tab-pane fade show active" id="description">
                <h4>About this book</h4>
                <p>{{ $book->description }}</p>
            </div>
            <div class="tab-pane fade" id="reviews">
                <h4>Customer Reviews</h4>
                <p class="text-muted">Reviews feature coming soon...</p>
            </div>
        </div>
    </div>
    
    <!-- Related Books -->
    @if($relatedBooks->count() > 0)
    <div class="related-section">
        <h3 class="section-title">Related Books</h3>
        <div class="row">
            @foreach($relatedBooks as $relatedBook)
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="book-card">
                    <a href="{{ route('books.show', $relatedBook->id) }}">
                        <img src="{{ asset('images/books/' . $relatedBook->image) }}" alt="{{ $relatedBook->title }}" class="book-image">
                    </a>
                    <h5 class="book-title">{{ $relatedBook->title }}</h5>
                    <p class="book-author">By : {{ $relatedBook->author }}</p>
                    <div class="book-rating">
                        <i class="fas fa-star"></i>
                        <span>{{ number_format($relatedBook->rating, 1) }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-auto">
                        <span class="book-price">${{ number_format($relatedBook->price, 2) }}</span>
                        <form action="{{ route('cart.add', $relatedBook->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-outline-custom btn-sm">Add to cart</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>

@endsection

@push('scripts')
<script>
    function incrementQty() {
        const input = document.getElementById('quantity');
        const max = parseInt(input.max);
        const current = parseInt(input.value);
        if (current < max) {
            input.value = current + 1;
        }
    }
    
    function decrementQty() {
        const input = document.getElementById('quantity');
        const min = parseInt(input.min);
        const current = parseInt(input.value);
        if (current > min) {
            input.value = current - 1;
        }
    }
</script>
@endpush
