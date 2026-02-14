@extends('layouts.public')

@section('title', 'Our Menu')

@section('content')

<!-- Table Session Banner -->
@if(session('table_id'))
<div class="bg-dark text-white text-center py-2 fixed-top" style="z-index: 1030; top: 0;">
    <small class="font-lato letter-spacing-1">Ordering for <strong>{{ session('table_name') }}</strong></small>
</div>
<div style="margin-top: 40px;"></div> <!-- Spacer -->
@endif

<!-- Hero Section -->
<section class="position-relative d-flex align-items-center justify-content-center overflow-hidden" style="height: 50vh; margin-top: -100px; padding-top: 100px;">
    <div class="position-absolute w-100 h-100 top-0 start-0" style="background: url('https://images.unsplash.com/photo-1559339352-11d035aa65de?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80') center/cover fixed; opacity: 0.8;"></div>
    <div class="position-absolute w-100 h-100 top-0 start-0 bg-white opacity-50"></div>
    
    <div class="text-center position-relative z-1" data-aos="fade-up">
        <h6 class="text-dark text-uppercase letter-spacing-3 mb-3 small fw-bold">Executive Selection</h6>
        <h1 class="display-3 text-dark fw-bold mb-3 font-cinzel">Fine Dining</h1>
    </div>
</section>

<!-- Menu Categories -->
<section class="section-padding bg-light-texture py-5">
    <div class="container">
        <!-- Categories Filter -->
        <div class="d-flex justify-content-center gap-4 flex-wrap pb-5" data-aos="fade-up" data-aos-delay="100">
            <a href="{{ route('menu.index') }}" 
               class="text-uppercase letter-spacing-2 text-decoration-none pb-2 {{ !request('category') ? 'text-gold border-bottom border-gold' : 'text-muted border-bottom border-transparent hover-border-dark' }}" style="font-size: 0.85rem; transition: all 0.3s;">
               All Items
            </a>
            @foreach($categories as $category)
            <a href="{{ route('menu.index', ['category' => $category->id]) }}" 
               class="text-uppercase letter-spacing-2 text-decoration-none pb-2 {{ request('category') == $category->id ? 'text-gold border-bottom border-gold' : 'text-muted border-bottom border-transparent hover-border-dark' }}" style="font-size: 0.85rem; transition: all 0.3s;">
               {{ $category->name }}
            </a>
            @endforeach
        </div>

        <!-- Menu List -->
        <div class="row g-5 justify-content-center">
            <div class="col-lg-10">
                @forelse($items as $index => $item)
                <div class="row align-items-center mb-5 pb-5 border-bottom border-light" data-aos="fade-up" data-aos-delay="{{ 100 + ($index * 50) }}">
                    <!-- Image -->
                    <div class="col-md-3">
                        @if($item->image)
                            <div class="overflow-hidden">
                                <img src="{{ asset('storage/' . $item->image) }}" class="img-fluid w-100 object-fit-cover" style="height: 150px; filter: grayscale(10%);" alt="{{ $item->name }}">
                            </div>
                        @else
                            <div class="bg-white w-100 d-flex align-items-center justify-content-center border border-light" style="height: 150px;">
                                <i class="fas fa-utensils fa-2x text-muted opacity-25"></i>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Content -->
                    <div class="col-md-7 ps-md-5">
                        <div class="d-flex align-items-baseline justify-content-between mb-2">
                            <h4 class="font-cinzel text-dark mb-0">{{ $item->name }}</h4>
                            @if($item->is_vegetarian)
                                <span class="text-success ms-2" title="Vegetarian"><i class="fas fa-leaf small"></i></span>
                            @endif
                        </div>
                        <p class="text-muted font-lato mb-0 leading-relaxed">{{ $item->description }}</p>
                    </div>

                    <!-- Price & Action -->
                    <div class="col-md-2 text-md-end mt-3 mt-md-0">
                        <h5 class="text-gold font-cinzel fw-bold mb-3">₹{{ number_format($item->price, 0) }}</h5>
                        @if(session('table_id'))
                            <button class="btn btn-outline-dark rounded-circle p-0 d-flex align-items-center justify-content-center ms-auto hover-bg-gold border-light text-muted" style="width: 40px; height: 40px; transition: all 0.3s;" onclick="addToCart({{ $item->id }})">
                                <i class="fas fa-plus"></i>
                            </button>
                        @endif
                    </div>
                </div>
                @empty
                <div class="text-center py-5">
                    <h4 class="font-cinzel text-muted">No items found in this collection.</h4>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</section>

<!-- Floating Cart Logic (Hidden or Minimalist) -->
@if(session('table_id'))
<div class="fixed-bottom p-4 d-flex justify-content-end pointer-events-none">
    <button class="btn-gold shadow-lg px-4 py-3 d-flex align-items-center gap-3 pointer-events-auto" data-bs-toggle="modal" data-bs-target="#cartModal" style="border-radius: 0;">
        <span class="font-cinzel text-uppercase letter-spacing-1">Your Order</span>
        <span class="bg-white text-gold d-flex align-items-center justify-content-center fw-bold rounded-circle" style="width: 25px; height: 25px; font-size: 0.8rem;" id="cart-count">0</span>
    </button>
</div>

<!-- Cart Modal -->
<div class="modal fade" id="cartModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 rounded-0 shadow-lg">
            <div class="modal-header border-bottom border-light bg-white">
                <h5 class="modal-title font-cinzel text-dark">Your Selection</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bg-white py-4" id="cart-items-container">
                <!-- Cart items will be injected here -->
            </div>
            <div class="modal-footer border-top border-light bg-white justify-content-between">
                <div>
                    <small class="text-muted text-uppercase letter-spacing-1 d-block mb-1">Total Amount</small>
                    <h4 class="text-gold mb-0 font-cinzel" id="cart-total">₹0.00</h4>
                </div>
                <button type="button" class="btn-gold" onclick="placeOrder()">Confirm Order</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Initial fetch
    document.addEventListener('DOMContentLoaded', function() {
        if(document.getElementById('cart-count')) fetchCart();
    });

    function fetchCart() {
        fetch('{{ route("cart.index") }}')
            .then(response => response.json())
            .then(data => {
                renderCart(data.cart, data.total);
            });
    }

    function addToCart(id) {
        fetch('{{ route("cart.add") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ id: id })
        })
        .then(response => response.json())
        .then(data => {
            fetchCart();
            // Show minimal toast notification if needed
        });
    }

    function updateQuantity(id, quantity) {
        fetch('{{ route("cart.update") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ id: id, quantity: quantity })
        })
        .then(response => response.json())
        .then(data => {
            fetchCart();
        });
    }

    function placeOrder() {
        if(!confirm('Confirm your order?')) return;

        fetch('{{ route("cart.placeOrder") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ notes: '' })
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                alert('Order Placed Successfully');
                window.location.reload();
            } else {
                alert(data.error || 'Something went wrong');
            }
        });
    }

    function renderCart(cart, total) {
        let count = 0;
        let html = '';
        
        if (Object.keys(cart).length === 0) {
            html = '<div class="text-center py-5 text-muted"><p class="font-lato">Your selection is empty.</p></div>';
        } else {
            html = '<ul class="list-group list-group-flush">';
            for (const [id, item] of Object.entries(cart)) {
                count += item.quantity;
                html += `
                    <li class="list-group-item border-bottom border-light px-0 py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1 text-dark font-cinzel">${item.name}</h6>
                                <small class="text-muted">₹${item.price}</small>
                            </div>
                            <div class="d-flex align-items-center gap-3">
                                <button class="btn btn-sm btn-outline-light text-dark border-0 p-0" onclick="updateQuantity(${item.id}, ${item.quantity - 1})"><i class="fas fa-minus small"></i></button>
                                <span class="font-lato">${item.quantity}</span>
                                <button class="btn btn-sm btn-outline-light text-dark border-0 p-0" onclick="updateQuantity(${item.id}, ${item.quantity + 1})"><i class="fas fa-plus small"></i></button>
                            </div>
                        </div>
                    </li>
                `;
            }
            html += '</ul>';
        }

        const container = document.getElementById('cart-items-container');
        if(container) container.innerHTML = html;
        
        const totalEl = document.getElementById('cart-total');
        if(totalEl) totalEl.innerText = '₹' + total.toFixed(2);
        
        const countEl = document.getElementById('cart-count');
        if(countEl) countEl.innerText = count;
    }
</script>
@endif
@endsection
