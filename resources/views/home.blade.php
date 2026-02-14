@extends('layouts.public')

@section('content')
<!-- Hero Section -->
<section class="hero-section d-flex align-items-center justify-content-center text-center" style="background: url('https://images.unsplash.com/photo-1414235077428-338989a2e8c0?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80'); background-size: cover; background-position: center; height: 100vh; position: relative;">
    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(255, 255, 255, 0.2);"></div> <!-- Light overlay -->
    <div class="container position-relative">
        <p class="text-uppercase letter-spacing-2 mb-3 fw-bold text-dark animate__animated animate__fadeInUp">Fine Dining Experience</p>
        <h1 class="display-1 fw-bold text-dark mb-4 animate__animated animate__fadeInUp font-playfair">Test <span class="text-gold">Resto</span></h1>
        <p class="lead mb-5 px-lg-5 mx-lg-5 text-dark animate__animated animate__fadeInUp animate__delay-1s fw-medium">Where culinary artistry meets timeless elegance. Every dish tells a story of passion and precision.</p>
        <div class="d-flex justify-content-center gap-3 animate__animated animate__fadeInUp animate__delay-2s">
            <a href="{{ route('menu.index') }}" class="btn btn-gold btn-lg">Explore Menu</a>
            <a href="{{ route('menu.index') }}" class="btn btn-outline-gold btn-lg text-dark border-dark hover-gold">Order Now</a>
        </div>
    </div>
</section>

<!-- Signature Dishes (formerly Featured Menu) -->
<section class="section-padding bg-white">
    <div class="container">
        <div class="text-center mb-5">
            <h6 class="text-gold text-uppercase letter-spacing-2 mb-3">Chef's Selection</h6>
            <h2 class="display-4 font-playfair text-dark">Signature Dishes</h2>
        </div>
        <div class="row g-4">
            @forelse($featuredItems as $item)
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 shadow-sm border-0 rounded-3 overflow-hidden bg-white">
                     <div style="height: 250px; overflow: hidden;">
                        @if($item->image)
                            <img src="{{ asset('storage/' . $item->image) }}" class="card-img-top h-100 w-100" style="object-fit: cover; transition: transform 0.5s ease;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'" alt="{{ $item->name }}">
                        @else
                            <div class="d-flex align-items-center justify-content-center h-100 bg-light">
                                <i class="fas fa-utensils fa-3x text-muted"></i>
                            </div>
                        @endif
                    </div>
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h5 class="card-title font-playfair mb-0 text-dark">{{ $item->name }}</h5>
                            <span class="text-gold fw-bold">₹{{ number_format($item->price, 2) }}</span>
                        </div>
                        <p class="card-text text-muted small mb-0">{{ Str::limit($item->description, 60) }}</p>
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
            <a href="{{ route('menu.index') }}" class="btn text-gold fw-bold text-uppercase" style="letter-spacing: 1px;">View Full Menu <i class="fas fa-arrow-right ms-2"></i></a>
        </div>
    </div>
</section>

<!-- Testimonials -->
<section class="section-padding" style="background-color: #fdfbf7;">
    <div class="container">
        <div class="text-center mb-5">
            <h6 class="text-gold text-uppercase letter-spacing-2 mb-3">Testimonials</h6>
            <h2 class="display-4 font-playfair text-dark">What Our Guests Say</h2>
        </div>
        <div class="row g-4">
            <!-- Testimonial 1 -->
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm p-4 text-center bg-white">
                    <div class="mb-3 text-gold">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                    <p class="text-muted fst-italic mb-4">"An unforgettable dining experience. Every dish was a masterpiece."</p>
                    <h5 class="font-playfair text-dark mb-0">Sarah Mitchell</h5>
                </div>
            </div>
             <!-- Testimonial 2 -->
             <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm p-4 text-center bg-white">
                    <div class="mb-3 text-gold">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                    <p class="text-muted fst-italic mb-4">"The attention to detail and warmth of service is truly exceptional."</p>
                    <h5 class="font-playfair text-dark mb-0">James Rivera</h5>
                </div>
            </div>
             <!-- Testimonial 3 -->
             <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm p-4 text-center bg-white">
                    <div class="mb-3 text-gold">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                    <p class="text-muted fst-italic mb-4">"Test Resto has become our family's favorite for special occasions."</p>
                    <h5 class="font-playfair text-dark mb-0">Emily Chen</h5>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Reservation / CTA -->
<!-- <section class="section-padding bg-white text-center">
    <div class="container">
        <h2 class="display-4 font-playfair text-dark mb-3">Reserve Your Table</h2>
        <p class="lead text-muted mb-5">Experience culinary excellence. Book your table today or scan the QR code at your seat to order.</p>
        <div class="d-flex justify-content-center gap-3">
             <button class="btn btn-gold btn-lg px-5">Make a Reservation</button>
             <a href="{{ route('menu.index') }}" class="btn btn-outline-gold btn-lg px-5 text-dark">QR Order</a>
        </div>
    </div>
</section> -->
@endsection
