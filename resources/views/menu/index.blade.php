@extends('layouts.public')

@section('title', 'Our Menu')

@section('content')

<!-- Table Session Banner -->
@if(session('table_id'))
<div class="bg-success text-white text-center py-2 fixed-top" style="z-index: 1030; top: 0;">
    <small>Ordering for <strong>{{ session('table_name') }}</strong></small>
</div>
<div style="margin-top: 40px;"></div> <!-- Spacer for fixed banner -->
@endif

<!-- Hero Section -->
<section class="page-hero d-flex align-items-center justify-content-center">
    <div class="text-center position-relative z-1">
        <h1 class="display-4 fw-bold text-white mb-3 animate-up">Our Menu</h1>
        <p class="lead text-white-50 mb-0 animate-up delay-100">Handcrafted detail in every dish</p>
    </div>
</section>

<!-- Menu Categories -->
<section class="py-5 bg-dark">
    <div class="container">
        <!-- Categories Filter -->
        <div class="scroll-wrapper mb-5 animate-up delay-200">
            <div class="d-flex gap-3 pb-3" style="overflow-x: auto; white-space: nowrap;">
                <a href="{{ route('menu.index') }}" 
                   class="btn btn-outline-gold rounded-pill px-4 {{ !request('category') ? 'active' : '' }}">
                   All Items
                </a>
                @foreach($categories as $category)
                <a href="{{ route('menu.index', ['category' => $category->id]) }}" 
                   class="btn btn-outline-gold rounded-pill px-4 {{ request('category') == $category->id ? 'active' : '' }}">
                   {{ $category->name }}
                </a>
                @endforeach
            </div>
        </div>

        <!-- Menu Grid -->
        <div class="row g-4">
            @forelse($items as $item)
            <div class="col-md-6 col-lg-4 animate-up delay-300">
                <div class="menu-item-card h-100 d-flex flex-column">
                    <div class="position-relative overflow-hidden rounded-top">
                        @if($item->image)
                            <img src="{{ asset('storage/' . $item->image) }}" class="img-fluid w-100" style="height: 250px; object-fit: cover;" alt="{{ $item->name }}">
                        @else
                            <div class="bg-secondary w-100 d-flex align-items-center justify-content-center" style="height: 250px;">
                                <i class="fas fa-utensils fa-3x text-white-50"></i>
                            </div>
                        @endif
                        
                        @if($item->is_vegetarian)
                        <span class="position-absolute top-0 end-0 m-3 badge bg-success rounded-pill">
                            <i class="fas fa-leaf me-1"></i> Veg
                        </span>
                        @endif
                    </div>
                    
                    <div class="card-body p-4 bg-secondary flex-grow-1 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h5 class="text-gold mb-0 playfair">{{ $item->name }}</h5>
                            <span class="h5 text-white mb-0">${{ number_format($item->price, 2) }}</span>
                        </div>
                        <p class="text-white-50 small mb-4 flex-grow-1">{{ $item->description }}</p>
                        
                        @if(session('table_id'))
                        <button class="btn btn-gold w-100 mt-auto" onclick="addToCart({{ $item->id }})">
                            <i class="fas fa-plus me-2"></i> Add to Order
                        </button>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <i class="fas fa-search fa-3x text-white-50 mb-3"></i>
                <h3 class="text-white">No items found</h3>
                <p class="text-white-50">Try selecting a different category</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Floating Cart Button -->
@if(session('table_id'))
<div class="fixed-bottom p-3 d-flex justify-content-center" style="z-index: 1040;">
    <button class="btn btn-gold rounded-pill shadow-lg px-4 py-3 fw-bold d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#cartModal">
        <i class="fas fa-shopping-basket"></i>
        <span>View Order</span>
        <span class="badge bg-dark rounded-pill ms-2" id="cart-count">0</span>
    </button>
</div>

<!-- Cart Modal -->
<div class="modal fade" id="cartModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content bg-dark text-white border-0">
            <div class="modal-header border-secondary">
                <h5 class="modal-title text-gold">Your Order</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="cart-items-container">
                <!-- Cart items will be injected here -->
                <div class="text-center py-4 text-white-50">
                    <i class="fas fa-spinner fa-spin fa-2x"></i>
                </div>
            </div>
            <div class="modal-footer border-secondary justify-content-between">
                <div>
                    <small class="text-white-50">Total</small>
                    <h4 class="text-gold mb-0" id="cart-total">$0.00</h4>
                </div>
                <button type="button" class="btn btn-gold" onclick="placeOrder()">Place Order</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Initial fetch
    document.addEventListener('DOMContentLoaded', function() {
        fetchCart();
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
            fetchCart(); // Refresh cart
            // Optional: Show toast
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
            body: JSON.stringify({ notes: '' }) // Can add notes input later
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                alert('Order Placed! Order ID: #' + data.order_id);
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
            html = '<div class="text-center py-5 text-white-50"><i class="fas fa-shopping-basket fa-3x mb-3"></i><p>Your cart is empty</p></div>';
        } else {
            html = '<ul class="list-group list-group-flush bg-transparent">';
            for (const [id, item] of Object.entries(cart)) {
                count += item.quantity;
                html += `
                    <li class="list-group-item bg-transparent border-secondary text-white d-flex justify-content-between align-items-center px-0">
                        <div>
                            <h6 class="mb-0">${item.name}</h6>
                            <small class="text-gold">$${item.price}</small>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <button class="btn btn-sm btn-outline-secondary text-white" onclick="updateQuantity(${item.id}, ${item.quantity - 1})">-</button>
                            <span>${item.quantity}</span>
                            <button class="btn btn-sm btn-outline-secondary text-white" onclick="updateQuantity(${item.id}, ${item.quantity + 1})">+</button>
                        </div>
                    </li>
                `;
            }
            html += '</ul>';
        }

        document.getElementById('cart-items-container').innerHTML = html;
        document.getElementById('cart-total').innerText = '$' + total.toFixed(2);
        document.getElementById('cart-count').innerText = count;
    }
</script>
@endif
@endsection
