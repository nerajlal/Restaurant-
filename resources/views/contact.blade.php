@extends('layouts.public')

@section('title', 'Contact')

@section('content')
<!-- Hero Section -->
<section class="position-relative d-flex align-items-center justify-content-center overflow-hidden" style="height: 40vh; margin-top: -100px; padding-top: 100px;">
    <div class="position-absolute w-100 h-100 top-0 start-0" style="background: url('https://images.unsplash.com/photo-1559339352-11d035aa65de?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80') center/cover fixed; opacity: 0.8;"></div>
    <div class="position-absolute w-100 h-100 top-0 start-0 bg-white opacity-70"></div>
    <div class="text-center position-relative z-1" data-aos="fade-up">
        <h1 class="display-3 text-dark fw-bold mb-0 font-cinzel">Get in Touch</h1>
    </div>
</section>

<!-- Contact Content -->
<section class="section-padding py-5">
    <div class="container py-5">
        <div class="row g-5">
            <!-- Info -->
            <div class="col-lg-5" data-aos="fade-right">
                <div class="pe-lg-5">
                    <h3 class="font-cinzel text-dark mb-5">Visit Us</h3>
                    
                    <div class="mb-5">
                        <h6 class="text-uppercase letter-spacing-2 text-muted small mb-2">Address</h6>
                        <p class="font-lato lead text-dark">123 Luxury Avenue<br>New York, NY 10012</p>
                    </div>

                    <div class="mb-5">
                        <h6 class="text-uppercase letter-spacing-2 text-muted small mb-2">Concierge</h6>
                        <p class="font-lato lead text-dark">+1 234 567 8900<br>concierge@thewhitelotus.com</p>
                    </div>

                    <div class="mb-5">
                        <h6 class="text-uppercase letter-spacing-2 text-muted small mb-2">Hours</h6>
                        <p class="font-lato text-dark">Mon-Sun: 11:00 AM - 11:00 PM</p>
                    </div>
                </div>
            </div>

            <!-- Form -->
            <div class="col-lg-7" data-aos="fade-left">
                <h3 class="font-cinzel text-dark mb-5">Inquiries</h3>
                <form>
                    <div class="mb-4">
                        <input type="text" class="form-control border-0 border-bottom rounded-0 px-0 py-3 bg-transparent" placeholder="Name" style="border-color: #ddd;">
                    </div>
                    <div class="mb-4">
                        <input type="email" class="form-control border-0 border-bottom rounded-0 px-0 py-3 bg-transparent" placeholder="Email" style="border-color: #ddd;">
                    </div>
                    <div class="mb-5">
                        <textarea class="form-control border-0 border-bottom rounded-0 px-0 py-3 bg-transparent" rows="3" placeholder="Message" style="border-color: #ddd;"></textarea>
                    </div>
                    <button type="submit" class="btn btn-outline-dark rounded-0 px-5 py-3 font-cinzel text-uppercase letter-spacing-1">Send Message</button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Minimal Map -->
<section class="w-100">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d193595.15830869428!2d-74.11976373946229!3d40.69766374874431!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew%20York%2C%20NY%2C%20USA!5e0!3m2!1sen!2sin!4v1645516956976!5m2!1sen!2sin" width="100%" height="400" style="border:0; filter: grayscale(100%) opacity(0.8);" allowfullscreen="" loading="lazy"></iframe>
</section>
@endsection
