@extends('layouts.app')

@section('title', 'Paper Haven - Find Your Next Book')

@push('styles')
<style>
    /* Hero Section */
    .hero-section {
        background: linear-gradient(135deg, #F5DEB3 0%, #FFF8E7 100%);
        padding: 5rem 0;
        position: relative;
        overflow: hidden;
    }

    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 50%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(212, 165, 116, 0.1));
        z-index: 1;
    }

    .hero-content {
        position: relative;
        z-index: 2;
    }

    .hero-title {
        font-size: 3.5rem;
        font-weight: 700;
        color: var(--text-dark);
        line-height: 1.2;
        margin-bottom: 1.5rem;
    }

    .hero-subtitle {
        font-size: 1.1rem;
        color: var(--text-gray);
        margin-bottom: 2rem;
    }

    .hero-books {
        position: relative;
        z-index: 2;
    }

    .book-card-hero {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        transform: translateY(0);
        transition: all 0.3s;
    }

    .book-card-hero:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.15);
    }

    .book-card-hero img {
        width: 100%;
        height: 300px;
        object-fit: cover;
        border-radius: 10px;
        margin-bottom: 1rem;
    }

    .carousel-indicators button {
        background-color: var(--primary-color) !important;
        width: 10px;
        height: 10px;
        border-radius: 50%;
        margin: 0 5px;
    }

    /* Author Section */
    .author-section {
        background-color: white;
        padding: 3rem 0;
        border-radius: 20px;
        margin: 3rem 0;
    }

    .author-card {
        text-align: center;
        padding: 1rem;
        transition: all 0.3s;
        cursor: pointer;
    }

    .author-card:hover {
        transform: scale(1.05);
    }

    .author-avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 1rem;
        border: 3px solid var(--secondary-color);
    }

    .author-name {
        font-size: 1rem;
        font-weight: 600;
        color: var(--text-dark);
    }

    /* Book Section */
    .book-section {
        padding: 3rem 0;
    }

    .section-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 3rem;
    }

    .book-card {
        background: white;
        border-radius: 15px;
        padding: 1.5rem;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        transition: all 0.3s;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .book-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.12);
    }

    .book-image {
        width: 100%;
        height: 280px;
        object-fit: cover;
        border-radius: 10px;
        margin-bottom: 1rem;
    }

    .book-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 0.5rem;
        min-height: 50px;
    }

    .book-author {
        font-size: 0.9rem;
        color: var(--text-gray);
        margin-bottom: 1rem;
    }

    .book-rating {
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
    }

    .book-rating i {
        color: #FFD700;
        font-size: 0.9rem;
        margin-right: 5px;
    }

    .book-rating span {
        font-weight: 600;
        margin-left: 5px;
    }

    .book-price {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--primary-color);
        margin-bottom: 1rem;
    }

    .explore-btn {
        background-color: var(--primary-color);
        color: white;
        padding: 0.8rem 2rem;
        border-radius: 8px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        font-weight: 500;
        transition: all 0.3s;
    }

    .explore-btn:hover {
        background-color: #6D5638;
        color: white;
        transform: translateX(5px);
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
        z-index: 10;
    }

    .heart-btn:hover {
        transform: scale(1.1);
        box-shadow: 0 4px 15px rgba(231, 76, 60, 0.3);
    }

    .heart-btn i {
        font-size: 1.2rem;
        color: #E74C3C;
        transition: all 0.3s ease;
    }

    .heart-btn.active i {
        animation: heartBeat 0.5s ease;
    }

    @keyframes heartBeat {
        0%, 100% { transform: scale(1); }
        25% { transform: scale(1.3); }
        50% { transform: scale(1.1); }
    }

    /* Responsive */
    @media (max-width: 768px) {
        .hero-title {
            font-size: 2.5rem;
        }
    }
</style>
@endpush

@section('content')

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 hero-content">
                <h1 class="hero-title">Find Your<br>Next Book</h1>
                <p class="hero-subtitle">Discover a world where every page brings a new adventure.<br>At Paper Haven, we curate a diverse collection of books.</p>
                <a href="{{ route('shop') }}" class="explore-btn">
                    Explore Now <i class="fas fa-arrow-right"></i>
                </a>
            </div>
            
            <div class="col-lg-6 hero-books">
                <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach($featuredBooks->chunk(3) as $index => $bookChunk)
                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                <div class="row">
                                    @foreach($bookChunk as $book)
                                        <div class="col-4">
                                            <div class="book-card-hero">
                                                <img src="{{ asset('images/books/' . $book->image) }}" 
                                                     alt="{{ $book->title }}"
                                                     data-isbn="{{ $book->isbn }}"
                                                     data-title="{{ $book->title }}"
                                                     onerror="this.src='https://placehold.co/200x300/8B6F47/ffffff?text=Book+Cover'">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="carousel-indicators">
                        @foreach($featuredBooks->chunk(3) as $index => $chunk)
                            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}"></button>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Authors Section -->
<section class="container my-5">
    <div class="author-section">
        <div class="row justify-content-center">
            @if($jamesClearBooks->count() > 0)
            <div class="col-lg-3 col-md-6">
                <div class="author-card">
                    <img src="https://ui-avatars.com/api/?name=James+Clear&size=100&background=8B6F47&color=fff" alt="James Clear" class="author-avatar">
                    <p class="author-name">Latest form James clear <i class="fas fa-chevron-right"></i></p>
                </div>
            </div>
            @endif
            
            @if($napoleonHillBooks->count() > 0)
            <div class="col-lg-3 col-md-6">
                <div class="author-card">
                    <img src="https://ui-avatars.com/api/?name=Napoleon+Hill&size=100&background=8B6F47&color=fff" alt="Napoleon Hill" class="author-avatar">
                    <p class="author-name">Latest form Napoleon Hill <i class="fas fa-chevron-right"></i></p>
                </div>
            </div>
            @endif
            
            @if($robertKiyosakiBooks->count() > 0)
            <div class="col-lg-3 col-md-6">
                <div class="author-card">
                    <img src="https://ui-avatars.com/api/?name=Robert+Kiyosaki&size=100&background=8B6F47&color=fff" alt="Robert Kiyosaki" class="author-avatar">
                    <p class="author-name">Latest form Robert Kiyosaki <i class="fas fa-chevron-right"></i></p>
                </div>
            </div>
            @endif
            
            @if($brianTracyBooks->count() > 0)
            <div class="col-lg-3 col-md-6">
                <div class="author-card">
                    <img src="https://ui-avatars.com/api/?name=Brian+Tracy&size=100&background=8B6F47&color=fff" alt="Brian Tracy" class="author-avatar">
                    <p class="author-name">Latest form Brian Tracy <i class="fas fa-chevron-right"></i></p>
                </div>
            </div>
            @endif
        </div>
    </div>
</section>

<!-- Recommended Books Section -->
<section class="book-section">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="section-title mb-0">Recommended For You</h2>
            <a href="{{ route('shop') }}" class="text-decoration-none">
                See all <i class="fas fa-chevron-right"></i>
            </a>
        </div>
        
        <div class="row">
            @foreach($recommendedBooks as $book)
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="book-card position-relative">
                    <button type="button" class="heart-btn" onclick="toggleWishlist({{ $book->id }}, this)" title="Add to wishlist">
                        <i class="far fa-heart"></i>
                    </button>
                    
                    <a href="{{ route('books.show', $book->id) }}">
                        <img src="{{ asset('images/books/' . $book->image) }}" 
                             alt="{{ $book->title }}" 
                             class="book-image"
                             data-isbn="{{ $book->isbn }}"
                             data-title="{{ $book->title }}"
                             onerror="this.src='https://placehold.co/300x400/8B6F47/ffffff?text=Book+Cover'">
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
    </div>
</section>

<!-- Newsletter Section -->
<section class="py-5" style="background: linear-gradient(135deg, #8B6F47 0%, #D4A574 100%);">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-6">
                <h2 class="text-white mb-3">Subscribe to Our Newsletter</h2>
                <p class="text-white mb-4">Get the latest updates on new arrivals and special offers</p>
                <form class="d-flex gap-2">
                    <input type="email" class="form-control" placeholder="Enter your email" required>
                    <button type="submit" class="btn btn-light px-4">Subscribe</button>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection
