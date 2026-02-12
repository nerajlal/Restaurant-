@extends('layouts.public')

@section('content')
<div class="section-padding bg-dark text-white pt-5 mt-5">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card bg-card border-0 shadow-lg text-white" style="background-color: #1e1e1e;">
                    <div class="card-body p-5">
                        <div class="text-center mb-5">
                            <h6 class="text-gold text-uppercase letter-spacing-2 mb-3">Reservations</h6>
                            <h2 class="display-4 font-playfair">Book Your Table</h2>
                            <p class="text-muted">Reserve your spot for an unforgettable dining experience.</p>
                        </div>

                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('reservation.store') }}" method="POST">
                            @csrf
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="form-floating text-dark">
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Your Name" required>
                                        <label for="name">Name</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating text-dark">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Your Email" required>
                                        <label for="email">Email</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating text-dark">
                                        <input type="tel" class="form-control" id="phone" name="phone" placeholder="Phone Number" required>
                                        <label for="phone">Phone</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating text-dark">
                                        <select class="form-select" id="guests" name="guests" required>
                                            <option value="1">1 Guest</option>
                                            <option value="2" selected>2 Guests</option>
                                            <option value="3">3 Guests</option>
                                            <option value="4">4 Guests</option>
                                            <option value="5">5 Guests</option>
                                            <option value="6">6 Guests</option>
                                            <option value="8">8 Guests</option>
                                            <option value="10">10+ Guests</option>
                                        </select>
                                        <label for="guests">Guests</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating text-dark">
                                        <input type="date" class="form-control" id="reservation_date" name="reservation_date" required>
                                        <label for="reservation_date">Date</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating text-dark">
                                        <input type="time" class="form-control" id="reservation_time" name="reservation_time" required>
                                        <label for="reservation_time">Time</label>
                                    </div>
                                </div>
                                <div class="col-12 mt-4 text-center">
                                    <button class="btn btn-gold btn-lg w-100 py-3" type="submit">Confirm Reservation</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
