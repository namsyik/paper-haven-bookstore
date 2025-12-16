<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Paper Haven - Your Literary Journey')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #8B6F47;
            --primary-hover: #6D5638;
            --secondary-color: #D4A574;
            --bg-beige: #F5DEB3;
            --bg-light-beige: #FFF8E7;
            --text-dark: #2C2416;
            --text-gray: #6C757D;
            --shadow-sm: 0 2px 8px rgba(0,0,0,0.08);
            --shadow-md: 0 5px 20px rgba(0,0,0,0.1);
            --shadow-lg: 0 10px 40px rgba(0,0,0,0.15);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-light-beige);
            color: var(--text-dark);
            line-height: 1.6;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
        }

        /* Navbar Styles - Enhanced */
        .navbar {
            background-color: #FFFFFF;
            box-shadow: var(--shadow-sm);
            padding: 1rem 0;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        .navbar.scrolled {
            padding: 0.5rem 0;
            box-shadow: var(--shadow-md);
        }

        .navbar-brand {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary-color) !important;
            transition: all 0.3s ease;
        }

        .navbar-brand:hover {
            transform: scale(1.05);
        }

        .nav-link {
            color: var(--text-gray) !important;
            font-weight: 500;
            padding: 0.5rem 1rem !important;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 2px;
            background: var(--primary-color);
            transition: width 0.3s ease;
        }

        .nav-link:hover::after,
        .nav-link.active::after {
            width: 70%;
        }

        .nav-link:hover {
            color: var(--primary-color) !important;
            transform: translateY(-2px);
        }

        .nav-link.active {
            color: var(--primary-color) !important;
            font-weight: 600;
        }

        .search-box {
            position: relative;
            max-width: 300px;
        }

        .search-box input {
            border-radius: 25px;
            padding-left: 40px;
            border: 1px solid #ddd;
            transition: all 0.3s ease;
        }

        .search-box input:focus {
            box-shadow: 0 0 0 3px rgba(139, 111, 71, 0.1);
            border-color: var(--primary-color);
        }

        .search-box i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-gray);
        }

        .cart-icon {
            position: relative;
            color: var(--primary-color);
            font-size: 1.3rem;
            transition: all 0.3s ease;
        }

        .cart-icon:hover {
            transform: scale(1.1);
        }

        .cart-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background: linear-gradient(135deg, #E74C3C 0%, #C0392B 100%);
            color: white;
            border-radius: 50%;
            padding: 2px 6px;
            font-size: 0.7rem;
            font-weight: bold;
            animation: pulse 2s infinite;
        }

        .wishlist-badge {
            background: linear-gradient(135deg, #E74C3C 0%, #C0392B 100%);
            color: white;
            border-radius: 10px;
            padding: 2px 8px;
            font-size: 0.65rem;
            font-weight: bold;
            margin-left: 5px;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--bg-beige);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .user-avatar:hover {
            border-color: var(--primary-color);
            transform: scale(1.1);
        }

        /* Button Styles - Enhanced */
        .btn-primary-custom {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-hover) 100%);
            border: none;
            color: white;
            padding: 0.6rem 1.8rem;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-primary-custom::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .btn-primary-custom:hover::before {
            left: 100%;
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(139, 111, 71, 0.4);
        }

        .btn-outline-custom {
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
            padding: 0.6rem 1.8rem;
            border-radius: 8px;
            font-weight: 500;
            background-color: transparent;
            transition: all 0.3s ease;
        }

        .btn-outline-custom:hover {
            background-color: var(--primary-color);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(139, 111, 71, 0.3);
        }

        /* Book Card Styles - Polished */
        .book-card {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: var(--shadow-sm);
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .book-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: var(--shadow-lg);
        }

        .book-image {
            width: 100%;
            height: 300px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 1rem;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-sm);
        }

        .book-card:hover .book-image {
            transform: scale(1.05);
            box-shadow: var(--shadow-md);
        }

        /* Alert Messages - Enhanced */
        .alert {
            border-radius: 12px;
            border: none;
            margin-top: 20px;
            box-shadow: var(--shadow-sm);
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Footer - Enhanced */
        .footer {
            background: linear-gradient(135deg, var(--text-dark) 0%, #1a1410 100%);
            color: white;
            padding: 3rem 0 1rem;
            margin-top: 5rem;
        }

        .footer h5 {
            color: var(--secondary-color);
            margin-bottom: 1.5rem;
            font-weight: 600;
        }

        .footer a {
            color: #ccc;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .footer a:hover {
            color: var(--secondary-color);
            padding-left: 5px;
        }

        .social-icons a {
            display: inline-block;
            width: 40px;
            height: 40px;
            line-height: 40px;
            text-align: center;
            border-radius: 50%;
            background-color: rgba(212, 165, 116, 0.2);
            margin-right: 10px;
            transition: all 0.3s ease;
        }

        .social-icons a:hover {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            transform: translateY(-5px) rotate(360deg);
        }

        /* Loading Spinner */
        .spinner {
            width: 40px;
            height: 40px;
            border: 4px solid var(--bg-beige);
            border-top: 4px solid var(--primary-color);
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 2rem auto;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Utility Classes */
        .section-padding {
            padding: 5rem 0;
        }

        .text-primary-custom {
            color: var(--primary-color);
        }

        /* Scrollbar Styling */
        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: var(--bg-light-beige);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--primary-color);
            border-radius: 5px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary-hover);
        }

        /* Custom Pagination Styling */
        .pagination {
            display: flex;
            gap: 8px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .pagination .page-item {
            margin: 0;
        }

        .pagination .page-link {
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
            background: white;
            border-radius: 8px;
            padding: 0.5rem 1rem;
            font-weight: 500;
            transition: all 0.3s ease;
            min-width: 45px;
            text-align: center;
        }

        .pagination .page-link:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(139, 111, 71, 0.3);
        }

        .pagination .page-item.active .page-link {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-hover) 100%);
            color: white;
            border-color: var(--primary-color);
            box-shadow: 0 4px 12px rgba(139, 111, 71, 0.4);
        }

        .pagination .page-item.disabled .page-link {
            border-color: #ddd;
            color: #999;
            background: #f8f9fa;
            cursor: not-allowed;
        }

        .pagination .page-item.disabled .page-link:hover {
            transform: none;
            box-shadow: none;
        }

        .pagination .page-link:focus {
            box-shadow: 0 0 0 3px rgba(139, 111, 71, 0.2);
        }

        /* Image Loading Animation */
        .book-image {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
        }

        .book-image[src] {
            animation: none;
            background: none;
        }

        @keyframes loading {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .navbar-brand {
                font-size: 1.5rem;
            }

            .search-box {
                max-width: 100%;
                margin: 1rem 0;
            }
        }
    </style>

    @stack('styles')
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">Paper Haven</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('shop') ? 'active' : '' }}" href="{{ route('shop') }}">Shop</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('ebook') ? 'active' : '' }}" href="{{ route('ebook') }}">E-book</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('wishlist.index') ? 'active' : '' }}" href="{{ route('wishlist.index') }}">
                            Wishlist
                            <span class="wishlist-badge" id="wishlistCount" style="display: none;">0</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('cart.index') ? 'active' : '' }}" href="{{ route('cart.index') }}">My cart</a>
                    </li>

                    <!-- Search Icon -->
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#searchModal">
                            <i class="fas fa-search"></i>
                        </a>
                    </li>

                    <!-- Language Selector -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            EN
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">English</a></li>
                            <li><a class="dropdown-item" href="#">Indonesian</a></li>
                        </ul>
                    </li>

                    <!-- Cart Icon -->
                    <li class="nav-item ms-2">
                        <a href="{{ route('cart.index') }}" class="cart-icon">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="cart-badge" id="cartCount">0</span>
                        </a>
                    </li>

                    <!-- User Avatar -->
                    <li class="nav-item ms-2">
                        <img src="https://ui-avatars.com/api/?name=User&background=8B6F47&color=fff" alt="User" class="user-avatar">
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Search Modal -->
    <div class="modal fade" id="searchModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <form action="{{ route('shop') }}" method="GET">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Search for books, authors...">
                            <button class="btn btn-primary-custom" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
        <div class="container mt-3">
            <div class="alert alert-success alert-dismissible fade show">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="container mt-3">
            <div class="alert alert-danger alert-dismissible fade show">
                <i class="fas fa-exclamation-circle me-2"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h5>Paper Haven</h5>
                    <p>Discover a world where every page brings a new adventure. At Paper Haven, we curate a diverse collection of books.</p>
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6 mb-4">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ route('home') }}">Home</a></li>
                        <li class="mb-2"><a href="{{ route('shop') }}">Shop</a></li>
                        <li class="mb-2"><a href="{{ route('ebook') }}">E-Books</a></li>
                        <li class="mb-2"><a href="{{ route('about') }}">About Us</a></li>
                        <li class="mb-2"><a href="#">Contact</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 mb-4">
                    <h5>Categories</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#">Self-Help</a></li>
                        <li class="mb-2"><a href="#">Business</a></li>
                        <li class="mb-2"><a href="#">Fiction</a></li>
                        <li class="mb-2"><a href="#">Biography</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 mb-4">
                    <h5>Contact Info</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="fas fa-map-marker-alt me-2"></i>123 Book Street, City</li>
                        <li class="mb-2"><i class="fas fa-phone me-2"></i>+1 234 567 890</li>
                        <li class="mb-2"><i class="fas fa-envelope me-2"></i><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="99f0f7fff6d9e9f8e9fcebf1f8effcf7b7faf6f4">[email&#160;protected]</a></li>
                    </ul>
                </div>
            </div>

            <hr style="border-color: rgba(255,255,255,0.1);">

            <div class="row">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-0">&copy; 2024 Paper Haven. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <a href="#" class="me-3">Privacy Policy</a>
                    <a href="#">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Custom JS -->
    <script>
        // Update cart count on page load
        function updateCartCount() {
            fetch('{{ route("cart.count") }}')
                .then(response => response.json())
                .then(data => {
                    document.getElementById('cartCount').textContent = data.count;
                });
        }

        // Call on page load
        updateCartCount();

        // Auto-hide alerts after 5 seconds
        setTimeout(function() {
            $('.alert').fadeOut('slow');
        }, 5000);

        // Advanced Image Loading with Multiple Fallbacks
        document.addEventListener('DOMContentLoaded', function() {
            const images = document.querySelectorAll('img[data-isbn]');

            images.forEach(img => {
                const isbn = img.dataset.isbn;
                const title = img.dataset.title || '';

                // Try multiple sources in order
                const sources = [
                    `https://covers.openlibrary.org/b/isbn/${isbn}-L.jpg`,
                    generateFallbackUrl(title, isbn)
                ];

                tryLoadImage(img, sources, 0);
            });
        });

        function tryLoadImage(img, sources, index) {
            if (index >= sources.length) {
                img.src = generateFallbackUrl(img.dataset.title, img.dataset.isbn);
                return;
            }

            const tempImg = new Image();
            tempImg.onload = function() {
                if (this.width > 100 && this.height > 100) {
                    img.src = sources[index];
                    img.classList.add('loaded');
                } else {
                    tryLoadImage(img, sources, index + 1);
                }
            };
            tempImg.onerror = function() {
                tryLoadImage(img, sources, index + 1);
            };
            tempImg.src = sources[index];
        }

        function generateFallbackUrl(title, isbn) {
            const colors = ['2C3E50', 'E74C3C', '3498DB', '9B59B6', 'F39C12', '16A085', 'C0392B', 'D35400'];
            const colorIndex = Math.abs(hashCode(title || isbn)) % colors.length;
            const color = colors[colorIndex];
            const shortTitle = encodeURIComponent((title || 'Book').substring(0, 25));
            return `https://placehold.co/400x600/${color}/ffffff?text=${shortTitle}&font=playfair-display`;
        }

        function hashCode(str) {
            let hash = 0;
            for (let i = 0; i < str.length; i++) {
                const char = str.charCodeAt(i);
                hash = ((hash << 5) - hash) + char;
                hash = hash & hash;
            }
            return hash;
        }

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    </script>

    @stack('scripts')

</body>
</html>
    <script>
        // Update wishlist count
        function updateWishlistCount() {
            fetch('{{ route("wishlist.count") }}')
                .then(response => response.json())
                .then(data => {
                    const badge = document.getElementById('wishlistCount');
                    if (data.count > 0) {
                        badge.textContent = data.count;
                        badge.style.display = 'inline';
                    } else {
                        badge.style.display = 'none';
                    }
                });
        }

        // Call on page load
        updateWishlistCount();

        // Wishlist toggle functionality
        function toggleWishlist(bookId, button) {
            fetch(`/wishlist/toggle/${bookId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(data => {
                // Update button appearance
                const icon = button.querySelector('i');
                if (data.inWishlist) {
                    icon.classList.remove('far');
                    icon.classList.add('fas');
                    button.classList.add('active');
                } else {
                    icon.classList.remove('fas');
                    icon.classList.add('far');
                    button.classList.remove('active');
                }

                // Update wishlist count
                updateWishlistCount();

                // Show feedback
                showToast(data.message);
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('An error occurred');
            });
        }

        // Simple toast notification
        function showToast(message) {
            const toast = document.createElement('div');
            toast.className = 'toast-notification';
            toast.textContent = message;
            toast.style.cssText = `
                position: fixed;
                bottom: 30px;
                right: 30px;
                background: var(--primary-color);
                color: white;
                padding: 1rem 2rem;
                border-radius: 8px;
                box-shadow: 0 5px 20px rgba(0,0,0,0.2);
                z-index: 9999;
                animation: slideUp 0.3s ease;
            `;
            document.body.appendChild(toast);

            setTimeout(() => {
                toast.style.animation = 'slideDown 0.3s ease';
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }

        // Add animation keyframes
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideUp {
                from { transform: translateY(100px); opacity: 0; }
                to { transform: translateY(0); opacity: 1; }
            }
            @keyframes slideDown {
                from { transform: translateY(0); opacity: 1; }
                to { transform: translateY(100px); opacity: 0; }
            }
        `;
        document.head.appendChild(style);
    </script>

    @stack('scripts')

</body>
</html>
