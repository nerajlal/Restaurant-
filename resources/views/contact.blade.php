@extends('layouts.public')

@section('content')
<div class="section-padding pt-5 mt-5">
    <div class="container mt-5">
        <div class="text-center mb-5">
            <h6 class="text-gold text-uppercase letter-spacing-2 mb-3">Get in Touch</h6>
            <h1 class="display-3 font-playfair text-dark">Contact Us</h1>
        </div>

        <div class="row g-5">
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm h-100 bg-white">
                    <div class="card-body p-5">
                        <h3 class="font-playfair mb-4 text-dark">Information</h3>
                        <p class="mb-4 text-muted">We look forward to hearing from you. Whether you have a question about our menu, want to book a private event, or just want to say hello.</p>
                        
                        <div class="d-flex align-items-center mb-4">
                            <div class="flex-shrink-0 btn-gold rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                <i class="fas fa-map-marker-alt text-white"></i>
                            </div>
                            <div class="ms-3">
                                <h5 class="mb-1 text-dark">Address</h5>
                                <p class="text-muted mb-0">123 Luxury Avenue, New York, NY 10012</p>
                            </div>
                        </div>

                        <div class="d-flex align-items-center mb-4">
                            <div class="flex-shrink-0 btn-gold rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                <i class="fas fa-phone text-white"></i>
                            </div>
                            <div class="ms-3">
                                <h5 class="mb-1 text-dark">Phone</h5>
                                <p class="text-muted mb-0">+1 234 567 8900</p>
                            </div>
                        </div>

                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 btn-gold rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                <i class="fas fa-envelope text-white"></i>
                            </div>
                            <div class="ms-3">
                                <h5 class="mb-1 text-dark">Email</h5>
                                <p class="text-muted mb-0">info@testresto.com</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card border-0 shadow-sm h-100 bg-white">
                     <div class="card-body p-5">
                        <h3 class="font-playfair mb-4 text-dark">Send a Message</h3>
                        <form>
                            <div class="mb-3">
                                <label for="name" class="form-label text-dark">Name</label>
                                <input type="text" class="form-control" id="name">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label text-dark">Email</label>
                                <input type="email" class="form-control" id="email">
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label text-dark">Message</label>
                                <textarea class="form-control" id="message" rows="5"></textarea>
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
