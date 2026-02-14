@extends('layouts.public')

@section('title', 'About Us')

@section('content')
<!-- Hero Section -->
<section class="position-relative d-flex align-items-center justify-content-center overflow-hidden" style="height: 50vh; margin-top: -100px; padding-top: 100px;">
    <div class="position-absolute w-100 h-100 top-0 start-0" style="background: url('https://images.unsplash.com/photo-1550966871-3ed3c47e2ce2?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80') center/cover fixed; opacity: 0.8;"></div>
    <div class="position-absolute w-100 h-100 top-0 start-0 bg-white opacity-60"></div>
    <div class="text-center position-relative z-1" data-aos="fade-up">
        <h6 class="text-dark text-uppercase letter-spacing-3 mb-3 small fw-bold">Our Heritage</h6>
        <h1 class="display-3 text-dark fw-bold mb-0 font-cinzel">The Story</h1>
    </div>
</section>

<!-- Content Section -->
<section class="section-padding py-5">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center" data-aos="fade-up" data-aos-delay="100">
                <i class="fas fa-quote-left fa-2x text-gold mb-4 opacity-50"></i>
                <h2 class="display-5 font-cinzel text-dark mb-5">"Simplicity is the ultimate sophistication."</h2>
                <div class="mx-auto mb-5" style="width: 1px; height: 100px; background: var(--primary-gold);"></div>
            </div>
        </div>

        <div class="row align-items-center g-5 mb-5 pb-5">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="position-relative p-4">
                    <img src="https://images.unsplash.com/photo-1600565193348-f74bd3c7ccdf?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Chef" class="img-fluid w-100 shadow-sm filter-sepia">
                </div>
            </div>
            <div class="col-lg-5 offset-lg-1" data-aos="fade-left">
                <h5 class="font-cinzel text-dark mb-3">The Beginning</h5>
                <p class="text-muted leading-loose font-lato">
                    Founded in 2010, The White Lotus was born from a desire to strip away the unnecessary and focus on what truly matters: the ingredient. Our journey began in a small kitchen with a big dream—to redefine luxury dining through the lens of simplicity.
                </p>
            </div>
        </div>

        <div class="row align-items-center g-5">
            <div class="col-lg-5 order-2 order-lg-1 text-lg-end" data-aos="fade-right">
                <h5 class="font-cinzel text-dark mb-3">The Philosophy</h5>
                <p class="text-muted leading-loose font-lato">
                    We believe in the power of time-honored traditions blended with modern innovation. Our chefs are not just cooks; they are artisans who respect the rhythm of nature. Every plate served is a testament to our commitment to excellence and sustainability.
                </p>
            </div>
            <div class="col-lg-6 offset-lg-1 order-1 order-lg-2" data-aos="fade-left">
                <div class="position-relative p-4">
                    <img src="https://images.unsplash.com/photo-1414235077428-338989a2e8c0?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Dish" class="img-fluid w-100 shadow-sm filter-sepia">
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .filter-sepia {
        filter: sepia(20%) contrast(90%);
        transition: filter 0.5s ease;
    }
    .filter-sepia:hover {
        filter: sepia(0%) contrast(100%);
    }
</style>
@endsection
