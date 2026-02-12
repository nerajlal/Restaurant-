@extends('layouts.public')

@section('content')
<div class="section-padding bg-dark text-white pt-5 mt-5">
    <div class="container mt-5">
        <div class="text-center mb-5">
            <h6 class="text-gold text-uppercase letter-spacing-2 mb-3">Get in Touch</h6>
            <h1 class="display-3 font-playfair">Contact Us</h1>
        </div>

        <div class="row g-5">
            <div class="col-lg-6">
                <div class="card bg-card border-0 shadow h-100" style="background-color: #1e1e1e;">
                    <div class="card-body p-5 text-white">
                        <h3 class="font-playfair mb-4">Information</h3>
                        <p class="mb-4 text-muted">We look forward to hearing from you. Whether you have a question about our menu, want to book a private event, or just want to say hello.</p>
                        
                        <div class="d-flex align-items-center mb-4">
                            <div class="flex-shrink-0 btn-gold rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="ms-3">
                                <h5 class="mb-1">Address</h5>
                                <p class="text-muted mb-0">123 Luxury Avenue, New York, NY 10012</p>
                            </div>
                        </div>

                        <div class="d-flex align-items-center mb-4">
                            <div class="flex-shrink-0 btn-gold rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="ms-3">
                                <h5 class="mb-1">Phone</h5>
                                <p class="text-muted mb-0">+1 234 567 8900</p>
                            </div>
                        </div>

                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 btn-gold rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="ms-3">
                                <h5 class="mb-1">Email</h5>
                                <p class="text-muted mb-0">info@testresto.com</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card bg-card border-0 shadow h-100" style="background-color: #1e1e1e;">
                     <div class="card-body p-5 text-white">
                        <h3 class="font-playfair mb-4">Send a Message</h3>
                        <form>
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control bg-dark border-secondary text-white" id="name">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control bg-dark border-secondary text-white" id="email">
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">Message</label>
                                <textarea class="form-control bg-dark border-secondary text-white" id="message" rows="5"></textarea>
                            </div>
                            <button type="submit" class="btn btn-gold w-100">Send Message</button>
                        </form>
                     </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
