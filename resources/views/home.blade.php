@extends('layouts.public')

@section('title', 'Welcome')

@section('content')
<!-- Hero Section -->
<section class="vh-100 d-flex align-items-center justify-content-center position-relative overflow-hidden" style="margin-top: -100px;">
    <!-- Background Video/Image -->
    <div class="position-absolute w-100 h-100" style="z-index: -1;">
        <video autoplay muted loop playsinline class="w-100 h-100 object-fit-cover">
            <source src="https://cdn.pixabay.com/video/2020/05/25/40139-424021239_large.mp4" type="video/mp4">
            <!-- Calm abstract water/nature video -->
            <img src="https://images.unsplash.com/photo-1549488391-5843c08cdde0?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80" alt="Serene Dining" class="w-100 h-100 object-fit-cover">
        </video>
        <div class="position-absolute top-0 start-0 w-100 h-100 bg-white" style="opacity: 0.1;"></div>
    </div>

    <!-- Hero Content -->
    <div class="text-center position-relative z-1" data-aos="fade-up" data-aos-duration="1500">
        <h6 class="text-uppercase letter-spacing-3 mb-4 small fw-bold text-white">Welcome to</h6>
        <h1 class="display-1 text-white fw-bold mb-4 font-cinzel" style="text-shadow: 0 4px 30px rgba(0,0,0,0.1);">The White Lotus</h1>
        <p class="lead text-white mb-5 mx-auto font-lato" style="max-width: 600px; letter-spacing: 0.1em;">
            A sanctuary of taste and tranquility.
        </p>
        <a href="{{ route('menu.index') }}" class="btn btn-outline-light rounded-0 px-5 py-3 font-cinzel text-uppercase letter-spacing-2">Explore Menu</a>
    </div>
</section>

<!-- Editorial Section 1: Culinary Artistry -->
<section class="section-padding py-5 my-5">
    <div class="container py-5">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="position-relative">
                    <img src="https://images.unsplash.com/photo-1559339352-11d035aa65de?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Culinary Art" class="img-fluid w-100 shadow-sm" style="filter: brightness(1.05);">
                    <div class="position-absolute top-0 start-0 w-100 h-100 border border-white opacity-50" style="transform: translate(20px, 20px); z-index: -1;"></div>
                </div>
            </div>
            <div class="col-lg-5 offset-lg-1" data-aos="fade-left">
                <h6 class="text-gold text-uppercase letter-spacing-2 mb-3">Our Philosophy</h6>
                <h2 class="display-4 font-cinzel text-dark mb-4">Culinary Artistry</h2>
                <div style="width: 50px; height: 1px; background: var(--primary-gold);" class="mb-4"></div>
                <p class="text-muted leading-loose mb-4">
                    We believe that dining is an art form. Every dish is a canvas, and every ingredient is a stroke of color. Our chefs curate flavors that dance on the palate, creating a symphony of taste that lingers long after the meal is over.
                </p>
                <a href="{{ route('about') }}" class="btn-link text-dark text-uppercase letter-spacing-1 text-decoration-none fw-bold border-bottom border-dark pb-1">Read Our Story</a>
            </div>
        </div>
    </div>
</section>

<!-- Editorial Section 2: Sustainable Luxury -->
<section class="section-padding py-5 bg-light-texture">
    <div class="container py-5">
        <div class="row align-items-center g-5">
            <div class="col-lg-5 order-2 order-lg-1" data-aos="fade-right">
                <h6 class="text-gold text-uppercase letter-spacing-2 mb-3">Sustainably Sourced</h6>
                <h2 class="display-4 font-cinzel text-dark mb-4">Nature's Finest</h2>
                <div style="width: 50px; height: 1px; background: var(--primary-gold);" class="mb-4"></div>
                <p class="text-muted leading-loose mb-4">
                    True luxury lies in purity. We partner with local artisans and farmers to bring you ingredients that are as kind to the earth as they are to your body. From farm to table, we ensure integrity in every bite.
                </p>
                <a href="{{ route('menu.index') }}" class="btn-link text-dark text-uppercase letter-spacing-1 text-decoration-none fw-bold border-bottom border-dark pb-1">View Seasonal Menu</a>
            </div>
            <div class="col-lg-6 offset-lg-1 order-1 order-lg-2" data-aos="fade-left">
                <div class="position-relative">
                    <img src="https://images.unsplash.com/photo-1466978913421-dad938661248?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Fresh Ingredients" class="img-fluid w-100 shadow-sm">
                    <div class="position-absolute top-0 start-0 w-100 h-100 border border-white opacity-50" style="transform: translate(-20px, -20px); z-index: -1;"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Signature Section -->
<section class="section-padding py-5 mb-5">
    <div class="container py-5 text-center">
        <h6 class="text-gold text-uppercase letter-spacing-2 mb-3" data-aos="fade-up">Curated for You</h6>
        <h2 class="display-4 font-cinzel text-dark mb-5" data-aos="fade-up" data-aos-delay="100">Signature Selections</h2>
        
        <div class="row g-4 justify-content-center">
            @foreach($featuredItems as $item)
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="card border-0 bg-transparent h-100">
                    <div class="position-relative mb-4 overflow-hidden">
                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" class="img-fluid w-100 object-fit-cover" style="height: 400px; filter: grayscale(20%); transition: all 0.5s ease;" onmouseover="this.style.filter='grayscale(0%)'; this.style.transform='scale(1.05)';" onmouseout="this.style.filter='grayscale(20%)'; this.style.transform='scale(1)';">
                    </div>
                    <h4 class="font-cinzel text-dark mb-2">{{ $item->name }}</h4>
                    <p class="text-muted small text-uppercase letter-spacing-1 mb-3">{{ $item->category->name ?? 'Special' }}</p>
                    <p class="text-gold font-cinzel fw-bold">₹{{ number_format($item->price, 0) }}</p>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="mt-5 pt-4" data-aos="fade-up">
            <a href="{{ route('menu.index') }}" class="btn-outline-gold">View Full Collection</a>
        </div>
    </div>
</section>
@endsection
