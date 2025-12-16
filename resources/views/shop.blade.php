@extends('layouts.app')

@section('title', 'Shop - Paper Haven')

@push('styles')
<style>
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
        z-index: 10;
    }
    .heart-btn:hover {
        transform: scale(1.1);
        box-shadow: 0 4px 15px rgba(231, 76, 60, 0.3);
    }
    .heart-btn i {
        font-size: 1.2rem;
        color: #E74C3C;
    }
    .shop-header {
        background: linear-gradient(135deg, #F5DEB3 0%, #FFF8E7 100%);
        padding: 3rem 0;
        margin-bottom: 3rem;
    }

    .shop-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--text-dark);
    }

    .filter-section {
        background: white;
        padding: 1.5rem;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        margin-bottom: 2rem;
    }

    .sort-dropdown select {
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 0.5rem 1rem;
    }
</style>
@endpush

@section('content')

<!-- Shop Header -->
<section class="shop-header">
    <div class="container">
        <h1 class="shop-title">Our Book Collection</h1>
        <p class="text-muted">Browse through our extensive collection of books</p>
    </div>
</section>

<!-- Shop Content -->
<div class="container">
    <div class="row">
        <!-- Filters Sidebar -->
        <div class="col-lg-3">
            <div class="filter-section">
                <h5 class="mb-3">Filters</h5>
                
                <form action="{{ route('shop') }}" method="GET">
                    <!-- Search -->
                    <div class="mb-3">
                        <label class="form-label">Search</label>
                        <input type="text" name="search" class="form-control" placeholder="Search books..." value="{{ request('search') }}">
                    </div>
                    
                    <!-- Category Filter -->
                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <select name="category" class="form-select">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                                    {{ $category }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <!-- Sort -->
                    <div class="mb-3">
                        <label class="form-label">Sort By</label>
                        <select name="sort" class="form-select">
                            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest</option>
                            <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                            <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                            <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Highest Rated</option>
                            <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name A-Z</option>
                        </select>
                    </div>
                    
                    <button type="submit" class="btn btn-primary-custom w-100">Apply Filters</button>
                    <a href="{{ route('shop') }}" class="btn btn-outline-custom w-100 mt-2">Clear Filters</a>
                </form>
            </div>
        </div>
        
        <!-- Books Grid -->
        <div class="col-lg-9">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <p class="text-muted mb-0">Showing {{ $books->count() }} of {{ $books->total() }} books</p>
            </div>
            
            @if($books->count() > 0)
                <div class="row">
                    @foreach($books as $book)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="book-card position-relative">
                    <button type="button" class="heart-btn" onclick="toggleWishlist({{ $book->id }}, this)" title="Add to wishlist">
                        <i class="far fa-heart"></i>
                    </button>
                            <a href="{{ route('books.show', $book->id) }}">
                                <img src="{{ asset('images/books/' . $book->image) }}" alt="{{ $book->title }}" class="book-image" data-isbn="{{ $book->isbn }}" data-title="{{ $book->title }}" onerror="this.src='https://placehold.co/300x400/8B6F47/ffffff?text=Book+Cover'">
                            </a>
                            
                            <h5 class="book-title">{{ $book->title }}</h5>
                            <p class="book-author">By : {{ $book->author }}</p>
                            
                            <div class="book-rating">
                                <i class="fas fa-star"></i>
                                <span>{{ number_format($book->rating, 1) }}</span>
                            </div>
                            
                            <div class="d-flex justify-content-between align-items-center mt-auto">
                                <span class="book-price">${{ number_format($book->price, 2) }}</span>
                                <form action="{{ route('cart.add', $book->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-custom btn-sm">Add to cart</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $books->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-book-open fa-3x text-muted mb-3"></i>
                    <h4>No books found</h4>
                    <p class="text-muted">Try adjusting your filters</p>
                </div>
            @endif
        </div>
    </div>
</div>

@endsection
