@extends('layouts.app')

@section('title', 'About Us - Paper Haven')

@push('styles')
<style>
    .about-header {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        padding: 5rem 0;
        color: white;
        margin-bottom: 3rem;
    }

    .about-title {
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: 1rem;
    }

    .story-section {
        padding: 3rem 0;
    }

    .story-image {
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        width: 100%;
        height: auto;
    }

    .mission-card {
        background: white;
        border-radius: 20px;
        padding: 3rem;
        box-shadow: 0 10px 40px rgba(0,0,0,0.08);
        margin: 3rem 0;
    }

    .mission-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        color: white;
        margin-bottom: 2rem;
    }

    .value-card {
        background: white;
        border-radius: 15px;
        padding: 2rem;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        height: 100%;
        transition: all 0.3s;
    }

    .value-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.12);
    }

    .value-icon {
        font-size: 3rem;
        color: var(--primary-color);
        margin-bottom: 1.5rem;
    }

    .stat-box {
        text-align: center;
        padding: 2rem;
    }

    .stat-number {
        font-size: 3rem;
        font-weight: 700;
        color: var(--primary-color);
        display: block;
    }

    .stat-label {
        font-size: 1.1rem;
        color: var(--text-gray);
        margin-top: 0.5rem;
    }

    .team-card {
        background: white;
        border-radius: 15px;
        padding: 2rem;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        text-align: center;
        transition: all 0.3s;
    }

    .team-card:hover {
        transform: translateY(-10px);
    }

    .team-avatar {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        margin: 0 auto 1.5rem;
        object-fit: cover;
        border: 5px solid var(--bg-beige);
    }

    .team-name {
        font-size: 1.3rem;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 0.5rem;
    }

    .team-role {
        color: var(--primary-color);
        font-weight: 500;
        margin-bottom: 1rem;
    }

    .timeline {
        position: relative;
        padding: 3rem 0;
    }

    .timeline-item {
        position: relative;
        padding-left: 4rem;
        margin-bottom: 3rem;
    }

    .timeline-item::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        width: 20px;
        height: 20px;
        background: var(--primary-color);
        border-radius: 50%;
        border: 4px solid white;
        box-shadow: 0 0 0 3px var(--bg-beige);
    }

    .timeline-item::after {
        content: '';
        position: absolute;
        left: 9px;
        top: 20px;
        width: 2px;
        height: calc(100% + 30px);
        background: var(--bg-beige);
    }

    .timeline-item:last-child::after {
        display: none;
    }

    .timeline-year {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--primary-color);
        margin-bottom: 0.5rem;
    }

    .cta-section {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        padding: 5rem 0;
        color: white;
        text-align: center;
        border-radius: 20px;
        margin: 4rem 0;
    }
</style>
@endpush

@section('content')

<!-- About Header -->
<section class="about-header text-center">
    <div class="container">
        <h1 class="about-title">About Paper Haven</h1>
        <p class="lead" style="max-width: 800px; margin: 0 auto;">
            Your trusted literary companion, bringing the joy of reading to thousands of book lovers since 2020.
        </p>
    </div>
</section>

<!-- Our Story -->
<section class="story-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <img src="https://images.unsplash.com/photo-1521587760476-6c12a4b040da?w=800&h=600&fit=crop" 
                     alt="Bookstore" 
                     class="story-image"
                     onerror="this.src='https://via.placeholder.com/800x600/8B6F47/FFFFFF?text=Our+Story'">
            </div>
            <div class="col-lg-6">
                <h2 class="display-5 mb-4">Our Story</h2>
                <p class="lead mb-3">
                    Founded in 2020, Paper Haven began with a simple mission: to make quality literature accessible to everyone.
                </p>
                <p class="mb-3">
                    What started as a small online bookstore has grown into a thriving community of book lovers. We believe that every book has the power to transform lives, spark imagination, and open new worlds of possibility.
                </p>
                <p class="mb-3">
                    Today, we serve thousands of customers worldwide, offering both physical books and e-books across all genres. Our carefully curated collection ensures that whether you're looking for the latest bestseller or a timeless classic, you'll find it at Paper Haven.
                </p>
                <p>
                    We're more than just a bookstore – we're a community dedicated to fostering the love of reading and supporting authors who inspire us.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Mission, Vision, Values -->
<section class="container">
    <div class="row">
        <div class="col-lg-4 mb-4">
            <div class="mission-card">
                <div class="mission-icon mx-auto">
                    <i class="fas fa-bullseye"></i>
                </div>
                <h3 class="text-center mb-3">Our Mission</h3>
                <p class="text-center">
                    To inspire and empower readers worldwide by providing access to diverse, high-quality literature that enriches lives and expands horizons.
                </p>
            </div>
        </div>
        
        <div class="col-lg-4 mb-4">
            <div class="mission-card">
                <div class="mission-icon mx-auto">
                    <i class="fas fa-eye"></i>
                </div>
                <h3 class="text-center mb-3">Our Vision</h3>
                <p class="text-center">
                    To become the world's most beloved online bookstore, where every reader finds their next great adventure and every book finds its perfect reader.
                </p>
            </div>
        </div>
        
        <div class="col-lg-4 mb-4">
            <div class="mission-card">
                <div class="mission-icon mx-auto">
                    <i class="fas fa-heart"></i>
                </div>
                <h3 class="text-center mb-3">Our Values</h3>
                <p class="text-center">
                    Quality, accessibility, community, and sustainability guide everything we do. We're committed to ethical practices and environmental responsibility.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Statistics -->
<section class="container my-5">
    <div class="row">
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="stat-box">
                <span class="stat-number" data-target="50000">0</span>
                <div class="stat-label">Books Sold</div>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="stat-box">
                <span class="stat-number" data-target="15000">0</span>
                <div class="stat-label">Happy Customers</div>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="stat-box">
                <span class="stat-number" data-target="5000">0</span>
                <div class="stat-label">Titles Available</div>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="stat-box">
                <span class="stat-number" data-target="98">0</span>
                <div class="stat-label">Customer Satisfaction</div>
            </div>
        </div>
    </div>
</section>

<!-- Core Values -->
<section class="container my-5">
    <h2 class="text-center mb-5">What Makes Us Different</h2>
    <div class="row">
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="value-card text-center">
                <div class="value-icon">
                    <i class="fas fa-hand-holding-heart"></i>
                </div>
                <h4>Customer First</h4>
                <p class="text-muted">Your satisfaction is our top priority. We go above and beyond to ensure your reading experience is exceptional.</p>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="value-card text-center">
                <div class="value-icon">
                    <i class="fas fa-book-open"></i>
                </div>
                <h4>Curated Selection</h4>
                <p class="text-muted">Every book in our collection is carefully selected to ensure quality and relevance for our diverse readership.</p>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="value-card text-center">
                <div class="value-icon">
                    <i class="fas fa-shipping-fast"></i>
                </div>
                <h4>Fast Delivery</h4>
                <p class="text-muted">Quick shipping for physical books and instant access for e-books. Your next great read is just clicks away.</p>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="value-card text-center">
                <div class="value-icon">
                    <i class="fas fa-leaf"></i>
                </div>
                <h4>Sustainable</h4>
                <p class="text-muted">We're committed to eco-friendly practices, from sustainable packaging to promoting digital reading.</p>
            </div>
        </div>
    </div>
</section>

<!-- Timeline -->
<section class="container my-5">
    <h2 class="text-center mb-5">Our Journey</h2>
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="timeline">
                <div class="timeline-item">
                    <div class="timeline-year">2020</div>
                    <h4>The Beginning</h4>
                    <p>Paper Haven was founded with a vision to revolutionize online book shopping and make literature accessible to all.</p>
                </div>
                
                <div class="timeline-item">
                    <div class="timeline-year">2021</div>
                    <h4>Expansion</h4>
                    <p>Expanded our collection to over 5,000 titles and introduced our e-book platform, reaching readers worldwide.</p>
                </div>
                
                <div class="timeline-item">
                    <div class="timeline-year">2022</div>
                    <h4>Community Growth</h4>
                    <p>Launched our book club program and author events, building a vibrant community of 10,000+ active readers.</p>
                </div>
                
                <div class="timeline-item">
                    <div class="timeline-year">2023</div>
                    <h4>Innovation</h4>
                    <p>Introduced AI-powered book recommendations and mobile apps, making book discovery easier than ever.</p>
                </div>
                
                <div class="timeline-item">
                    <div class="timeline-year">2024</div>
                    <h4>Looking Forward</h4>
                    <p>Continuing to innovate and expand, with plans for international shipping and exclusive author collaborations.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Team Section -->
<section class="container my-5">
    <h2 class="text-center mb-5">Meet Our Team</h2>
    <div class="row">
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="team-card">
                <img src="https://ui-avatars.com/api/?name=Sarah+Johnson&size=150&background=8B6F47&color=fff&bold=true" 
                     alt="Sarah Johnson" 
                     class="team-avatar">
                <div class="team-name">Sarah Johnson</div>
                <div class="team-role">Founder & CEO</div>
                <p class="text-muted small">Passionate about connecting readers with their perfect books.</p>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="team-card">
                <img src="https://ui-avatars.com/api/?name=Michael+Chen&size=150&background=8B6F47&color=fff&bold=true" 
                     alt="Michael Chen" 
                     class="team-avatar">
                <div class="team-name">Michael Chen</div>
                <div class="team-role">Head of Curation</div>
                <p class="text-muted small">Curating the finest selection of books across all genres.</p>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="team-card">
                <img src="https://ui-avatars.com/api/?name=Emily+Rodriguez&size=150&background=8B6F47&color=fff&bold=true" 
                     alt="Emily Rodriguez" 
                     class="team-avatar">
                <div class="team-name">Emily Rodriguez</div>
                <div class="team-role">Customer Experience</div>
                <p class="text-muted small">Ensuring every customer has an amazing experience.</p>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="team-card">
                <img src="https://ui-avatars.com/api/?name=David+Kim&size=150&background=8B6F47&color=fff&bold=true" 
                     alt="David Kim" 
                     class="team-avatar">
                <div class="team-name">David Kim</div>
                <div class="team-role">Technology Lead</div>
                <p class="text-muted small">Building the best online bookstore experience.</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="container">
    <div class="cta-section">
        <h2 class="mb-3">Join Our Reading Community</h2>
        <p class="mb-4" style="font-size: 1.2rem;">
            Discover your next favorite book and connect with fellow readers.
        </p>
        <a href="{{ route('shop') }}" class="btn btn-light btn-lg me-3">
            <i class="fas fa-book me-2"></i> Browse Books
        </a>
        <a href="#" class="btn btn-outline-light btn-lg">
            <i class="fas fa-envelope me-2"></i> Contact Us
        </a>
    </div>
</section>

@endsection

@push('scripts')
<script>
// Animate statistics counter
function animateCounter(element) {
    const target = parseInt(element.getAttribute('data-target'));
    const duration = 2000;
    const increment = target / (duration / 16);
    let current = 0;
    
    const timer = setInterval(() => {
        current += increment;
        if (current >= target) {
            element.textContent = target.toLocaleString() + (element.parentElement.querySelector('.stat-label').textContent.includes('Satisfaction') ? '%' : '+');
            clearInterval(timer);
        } else {
            element.textContent = Math.floor(current).toLocaleString();
        }
    }, 16);
}

// Trigger animation when element is visible
const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            animateCounter(entry.target);
            observer.unobserve(entry.target);
        }
    });
});

document.querySelectorAll('.stat-number').forEach(stat => {
    observer.observe(stat);
});
</script>
@endpush
