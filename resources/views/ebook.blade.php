@extends('layouts.app')

@section('title', 'E-Books - Paper Haven')

@push('styles')
<style>
    .book-image {
            width: 100%;
            height: 400px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 1rem;
        }

    .ebook-header {
        background: linear-gradient(135deg, #2C3E50 0%, #3498DB 100%);
        padding: 5rem 0;
        color: white;
        margin-bottom: 3rem;
    }

    .ebook-title {
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: 1rem;
    }

    .ebook-subtitle {
        font-size: 1.2rem;
        opacity: 0.9;
        max-width: 700px;
        margin: 0 auto;
    }

    .feature-card {
        background: white;
        border-radius: 15px;
        padding: 2.5rem;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        text-align: center;
        height: 100%;
        transition: all 0.3s;
    }

    .feature-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    }

    .feature-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        font-size: 2rem;
        color: white;
    }

    .ebook-card {
        background: white;
        border-radius: 15px;
        padding: 1.5rem;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        transition: all 0.3s;
        height: 100%;
    }

    .ebook-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.12);
    }

    .ebook-badge {
        position: absolute;
        top: 15px;
        right: 55px;
        background: linear-gradient(135deg, #3498DB 0%, #2980B9 100%);
        color: white;
        padding: 0.4rem 1rem;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
    }

    .format-tags {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
        margin-top: 1rem;
    }

    .format-tag {
        background: #f8f9fa;
        padding: 0.3rem 0.8rem;
        border-radius: 15px;
        font-size: 0.85rem;
        color: var(--text-gray);
    }

    .price-section {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: auto;
        padding-top: 1rem;
        border-top: 1px solid #f0f0f0;
    }

    .original-price {
        text-decoration: line-through;
        color: #999;
        font-size: 0.9rem;
    }

    .ebook-price {
        font-size: 1.5rem;
        font-weight: 700;
        color: #3498DB;
    }

    .discount-badge {
        background: #E74C3C;
        color: white;
        padding: 0.2rem 0.6rem;
        border-radius: 5px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .cta-section {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        padding: 4rem 0;
        margin-top: 4rem;
        color: white;
        text-align: center;
        border-radius: 20px;
    }

    .device-icons {
        display: flex;
        justify-content: center;
        gap: 2rem;
        margin-top: 2rem;
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
    }

    .device-icon {
        font-size: 3rem;
        opacity: 0.8;
    }
</style>
@endpush

@section('content')

<!-- E-book Header -->
<section class="ebook-header text-center">
    <div class="container">
        <h1 class="ebook-title">Digital Library</h1>
        <p class="ebook-subtitle">
            Access thousands of e-books instantly. Read anywhere, anytime on any device.
            Your complete digital reading experience awaits.
        </p>
        <div class="device-icons mt-4">
            <i class="fas fa-laptop device-icon"></i>
            <i class="fas fa-tablet-alt device-icon"></i>
            <i class="fas fa-mobile-alt device-icon"></i>
            <i class="fas fa-book-reader device-icon"></i>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="container mb-5">
    <div class="row">
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-bolt"></i>
                </div>
                <h4>Instant Access</h4>
                <p class="text-muted">Download immediately after purchase. No waiting, no shipping.</p>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-sync"></i>
                </div>
                <h4>Cloud Sync</h4>
                <p class="text-muted">Your library syncs across all your devices automatically.</p>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-search-plus"></i>
                </div>
                <h4>Smart Features</h4>
                <p class="text-muted">Highlight, annotate, and search within your e-books.</p>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-leaf"></i>
                </div>
                <h4>Eco-Friendly</h4>
                <p class="text-muted">Save trees and reduce your carbon footprint.</p>
            </div>
        </div>
    </div>
</section>

<!-- E-books Grid -->
<section class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="section-title mb-0">Featured E-Books</h2>
        <div class="d-flex gap-2">
            <select class="form-select" style="width: 200px;">
                <option>All Categories</option>
                <option>Business</option>
                <option>Self-Help</option>
                <option>Fiction</option>
                <option>Biography</option>
            </select>
            <select class="form-select" style="width: 200px;">
                <option>Sort by: Popular</option>
                <option>Price: Low to High</option>
                <option>Price: High to Low</option>
                <option>Newest First</option>
            </select>
        </div>
    </div>

    <div class="row">
        @foreach($books as $book)
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="ebook-card position-relative">
                <button type="button" class="heart-btn" onclick="toggleWishlist({{ $book->id }}, this)" title="Add to wishlist">
                    <i class="far fa-heart"></i>
                </button>
                <span class="ebook-badge">E-BOOK</span>

                <a href="{{ route('books.show', $book->id) }}">
                    <img src="{{ $book->image_url }}"
                         alt="{{ $book->title }}"
                         class="book-image"
                         onerror="this.src='https://via.placeholder.com/300x400/3498DB/FFFFFF?text=E-Book'">
                </a>

                <h5 class="book-title mt-3">{{ $book->title }}</h5>
                <p class="book-author">By: {{ $book->author }}</p>

                <div class="book-rating">
                    <i class="fas fa-star"></i>
                    <span>{{ number_format($book->rating, 1) }}</span>
                    <span class="text-muted ms-2">({{ rand(50, 500) }} reviews)</span>
                </div>

                <div class="format-tags">
                    <span class="format-tag"><i class="fas fa-file-pdf"></i> PDF</span>
                    <span class="format-tag"><i class="fas fa-book"></i> EPUB</span>
                    <span class="format-tag"><i class="fab fa-amazon"></i> MOBI</span>
                </div>

                <div class="price-section mt-3">
                    <div>
                        <div class="ebook-price">
                            ${{ $book->price * 0.7, 2}}
                        </div>
                    </div>
                    <form action="{{ route('cart.add', $book->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="format" value="ebook">
                        <button type="submit" class="btn btn-primary-custom btn-sm">
                            <i class="fas fa-download me-1"></i> Buy
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $books->links('pagination::bootstrap-4') }}
    </div>
</section>

<!-- CTA Section -->
<section class="container">
    <div class="cta-section">
        <h2 class="mb-3">Start Your Digital Reading Journey Today</h2>
        <p class="mb-4">Join thousands of readers who have gone digital. Get 30% off on all e-books.</p>
        <a href="{{ route('shop') }}" class="btn btn-light btn-lg">
            <i class="fas fa-book-open me-2"></i> Browse E-Book Collection
        </a>
    </div>
</section>

<!-- FAQ Section -->
<section class="container my-5">
    <h2 class="text-center mb-5">Frequently Asked Questions</h2>
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="accordion" id="faqAccordion">
                <div class="accordion-item mb-3" style="border: none; border-radius: 10px;">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                            What formats are available?
                        </button>
                    </h2>
                    <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            All our e-books are available in PDF, EPUB, and MOBI formats, compatible with all major e-readers and devices including Kindle, iPad, and smartphones.
                        </div>
                    </div>
                </div>

                <div class="accordion-item mb-3" style="border: none; border-radius: 10px;">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                            Can I read on multiple devices?
                        </button>
                    </h2>
                    <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Yes! Once purchased, you can download and read your e-books on up to 5 devices. Your library automatically syncs across all devices.
                        </div>
                    </div>
                </div>

                <div class="accordion-item mb-3" style="border: none; border-radius: 10px;">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                            Do I need an internet connection to read?
                        </button>
                    </h2>
                    <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            No, once downloaded, you can read your e-books offline anytime. Internet is only needed for the initial download and syncing.
                        </div>
                    </div>
                </div>

                <div class="accordion-item" style="border: none; border-radius: 10px;">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                            What if I'm not satisfied with my purchase?
                        </button>
                    </h2>
                    <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            We offer a 30-day money-back guarantee on all e-book purchases. If you're not satisfied, contact our support team for a full refund.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
