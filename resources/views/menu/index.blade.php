@extends('layouts.public')

@section('content')
<div class="section-padding bg-dark text-white pt-5 mt-5">
    <div class="container mt-5">
        <div class="text-center mb-5">
            <h6 class="text-gold text-uppercase letter-spacing-2 mb-3">Our Menu</h6>
            <h1 class="display-3 font-playfair">Exquisite Flavors</h1>
        </div>

        <!-- Category Filter -->
        <div class="d-flex justify-content-center flex-wrap mb-5">
            <a href="{{ route('menu.index') }}" class="btn {{ !request('category') ? 'btn-gold' : 'btn-outline-gold' }} m-2 rounded-pill px-4">All</a>
            @foreach($categories as $category)
                <a href="{{ route('menu.index', ['category' => $category->id]) }}" class="btn {{ request('category') == $category->id ? 'btn-gold' : 'btn-outline-gold' }} m-2 rounded-pill px-4">
                    {{ $category->name }}
                </a>
            @endforeach
        </div>

        <!-- Menu Grid -->
        <div class="row">
            @forelse($items as $item)
            <div class="col-md-6 col-lg-4 mb-4 animate__animated animate__fadeInUp">
                <div class="card bg-transparent border-0 h-100 text-white shadow-sm overflow-hidden" style="background-color: #1e1e1e;">
                    <div class="position-relative">
                        @if($item->image)
                            <img src="{{ asset('storage/' . $item->image) }}" class="card-img-top w-100" style="height: 250px; object-fit: cover;" alt="{{ $item->name }}">
                        @else
                            <div class="d-flex align-items-center justify-content-center bg-secondary" style="height: 250px;">
                                <i class="fas fa-utensils fa-3x text-muted"></i>
                            </div>
                        @endif
                        @if($item->is_vegetarian)
                            <span class="position-absolute top-0 end-0 bg-success text-white px-2 py-1 m-2 rounded-pill small">
                                <i class="fas fa-leaf me-1"></i> Veg
                            </span>
                        @endif
                        <div class="position-absolute bottom-0 start-0 w-100 p-3 bg-dark-overlay d-flex justify-content-between align-items-end">
                             <h4 class="font-playfair mb-0 text-white">{{ $item->name }}</h4>
                             <span class="text-gold fs-4 fw-bold">${{ number_format($item->price, 2) }}</span>
                        </div>
                    </div>
                    <div class="card-body">
                         <p class="card-text text-muted">{{ $item->description }}</p>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <h3 class="text-muted">No items found in this category.</h3>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
