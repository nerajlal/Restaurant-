@extends('layouts.public')

@section('content')
<div class="section-padding bg-dark text-white pt-5 mt-5">
    <div class="container mt-5">
        <div class="row align-items-center mb-5">
            <div class="col-lg-6">
                <h6 class="text-gold text-uppercase letter-spacing-2 mb-3">About Us</h6>
                <h1 class="display-3 font-playfair mb-4">A Legacy of Taste</h1>
                <p class="lead text-muted mb-4">We believe that food is not just about sustenance, but an experience that brings people together.</p>
                <p class="text-muted">Since our inception, Test Resto has been dedicated to serving dishes that are both authentic and innovative. Our chefs travel the world to find inspiration, bringing back techniques and flavors that they weave into every plate.</p>
            </div>
            <div class="col-lg-6">
                <img src="https://images.unsplash.com/photo-1550966871-3ed3c47e2ce2?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" class="img-fluid rounded shadow-lg" alt="Interior">
            </div>
        </div>
        
        <div class="row mt-5 pt-5">
            <div class="col-lg-4 text-center mb-5 mb-lg-0">
                <i class="fas fa-seedling fa-3x text-gold mb-3"></i>
                <h4 class="font-playfair">Fresh Ingredients</h4>
                <p class="text-muted">We source our ingredients from local farmers and markets to ensure freshness and quality.</p>
            </div>
            <div class="col-lg-4 text-center mb-5 mb-lg-0">
                <i class="fas fa-glass-cheers fa-3x text-gold mb-3"></i>
                <h4 class="font-playfair">Exquisite Drinks</h4>
                <p class="text-muted">Our curated wine list and signature cocktails are the perfect accompaniment to your meal.</p>
            </div>
            <div class="col-lg-4 text-center">
                <i class="fas fa-users fa-3x text-gold mb-3"></i>
                <h4 class="font-playfair">Expert Staff</h4>
                <p class="text-muted">Our team is trained to provide attentive and personalized service to make your visit memorable.</p>
            </div>
        </div>
    </div>
</div>
@endsection
