@extends('layouts.public')

@section('content')
<!-- Hero Section -->
<section class="hero-section d-flex align-items-center justify-content-center text-center text-white" style="background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80'); background-size: cover; background-position: center; height: 100vh;">
    <div class="container">
        <h1 class="display-1 fw-bold text-gold mb-4 animate__animated animate__fadeInUp">Test Resto</h1>
        <p class="lead mb-5 animate__animated animate__fadeInUp animate__delay-1s">A Culinary Journey of Exquisite Flavors & Elegant Ambiance</p>
        <a href="{{ route('menu.index') }}" class="btn btn-gold btn-lg me-3 animate__animated animate__fadeInUp animate__delay-2s">View Menu</a>
        <a href="{{ route('reservation.index') }}" class="btn btn-outline-light btn-lg animate__animated animate__fadeInUp animate__delay-2s">Book a Table</a>
    </div>
</section>

<!-- About Section -->
<section class="section-padding bg-dark text-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <img src="https://images.unsplash.com/photo-1559339352-11d035aa65de?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Chef" class="img-fluid rounded shadow-lg">
            </div>
            <div class="col-lg-6 ps-lg-5">
                <h6 class="text-gold text-uppercase letter-spacing-2 mb-3">Our Story</h6>
                <h2 class="display-4 mb-4 font-playfair">Tradition Meets Modernity</h2>
                <p class="lead text-muted mb-4">Founded in 2024, Test Resto brings together the finest ingredients and culinary expertise to create an unforgettable dining experience.</p>
                <p class="text-muted mb-5">Our chefs are dedicated to crafting dishes that not only taste exquisite but are also a feast for the eyes. Every plate is a masterpiece, designed to delight your senses.</p>
                <a href="{{ route('about') }}" class="btn btn-outline-gold">Learn More</a>
            </div>
        </div>
    </div>
</section>

<!-- Featured Menu -->
<section class="section-padding bg-black text-white">
    <div class="container">
        <div class="text-center mb-5">
            <h6 class="text-gold text-uppercase letter-spacing-2 mb-3">Discover</h6>
            <h2 class="display-4 font-playfair">Featured Delicacies</h2>
        </div>
        <div class="row">
            @forelse($featuredItems as $item)
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card bg-card border-0 h-100 shadow-sm text-white" style="background-color: #1e1e1e;">
                    <div style="height: 200px; overflow: hidden;">
                        @if($item->image)
                            <img src="{{ asset('storage/' . $item->image) }}" class="card-img-top h-100 w-100" style="object-fit: cover;" alt="{{ $item->name }}">
                        @else
                            <div class="d-flex align-items-center justify-content-center h-100 bg-secondary">
                                <i class="fas fa-utensils fa-3x text-muted"></i>
                            </div>
                        @endif
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title font-playfair">{{ $item->name }}</h5>
                        <p class="card-text text-muted small">{{ Str::limit($item->description, 50) }}</p>
                        <p class="text-gold fw-bold">${{ number_format($item->price, 2) }}</p>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center">
                <p class="text-muted">No featured items available yet.</p>
            </div>
            @endforelse
        </div>
        <div class="text-center mt-5">
            <a href="{{ route('menu.index') }}" class="btn btn-gold">View Full Menu</a>
        </div>
    </div>
</section>

<!-- Testimonials -->
<section class="section-padding bg-dark text-white">
    <div class="container">
        <div class="text-center mb-5">
            <h6 class="text-gold text-uppercase letter-spacing-2 mb-3">Testimonials</h6>
            <h2 class="display-4 font-playfair">What Our Guests Say</h2>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <p class="lead fst-italic mb-4">"The best dining experience I've had in years. The atmosphere is stunning and the food is simply out of this world."</p>
                            <h5 class="text-gold">Jonathan Doe</h5>
                            <small class="text-muted">Food Critic</small>
                        </div>
                        <div class="carousel-item">
                            <p class="lead fst-italic mb-4">"An absolute gem! Perfect for special occasions. The service was impeccable."</p>
                            <h5 class="text-gold">Sarah Smith</h5>
                            <small class="text-muted">Regular Guest</small>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
