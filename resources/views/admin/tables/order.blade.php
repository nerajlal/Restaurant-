@extends('admin.layouts.app')

@section('content')
<div class="container-fluid px-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center my-4">
        <div>
            <h1 class="h3 mb-0">Taking Order for <span class="text-primary">{{ $table->name }}</span></h1>
            <p class="text-muted small mb-0">Select items to add to the order</p>
        </div>
        <a href="{{ route('admin.tables.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i> Back to Tables
        </a>
    </div>

    <div class="row g-4">
        <!-- Menu Section -->
        <div class="col-lg-8">
            <!-- Category Navigation (Optional implementation for scrolling) -->
            <div class="d-flex overflow-auto pb-3 mb-2 sticky-top bg-white pt-2" style="z-index: 10;">
                @foreach($categories as $category)
                <a href="#category-{{ $category->id }}" class="btn btn-outline-dark rounded-pill me-2 text-nowrap">
                    {{ $category->name }}
                </a>
                @endforeach
            </div>

            @foreach($categories as $category)
            @php
                $categoryItems = $items->where('category_id', $category->id);
            @endphp
            @if($categoryItems->count() > 0)
            <div id="category-{{ $category->id }}" class="mb-5">
                <h3 class="fw-bold mb-3 border-bottom pb-2">{{ $category->name }}</h3>
                
                <div class="row g-3">
                    @foreach($categoryItems as $item)
                    <div class="col-md-6">
                        <div class="card h-100 border-0 shadow-sm item-card">
                            <div class="card-body d-flex p-3">
                                <div class="flex-grow-1 pe-3">
                                    {{-- Veg/Non-Veg Indicator (Optional, assuming standard or icon) --}}
                                    {{-- <i class="fas fa-circle text-success small mb-1"></i> --}}
                                    
                                    <h5 class="card-title fw-bold mb-1">{{ $item->name }}</h5>
                                    <div class="card-text small text-muted text-truncate-2 mb-2" style="min-height: 2.5em;">
                                        {{ $item->description }}
                                    </div>
                                    <div class="fw-bold">₹{{ number_format($item->price, 2) }}</div>
                                </div>
                                <div class="d-flex flex-column align-items-center" style="width: 120px;">
                                    @if($item->image)
                                    <img src="{{ asset('storage/' . $item->image) }}" class="img-fluid rounded mb-2" style="height: 80px; width: 100px; object-fit: cover;" alt="{{ $item->name }}">
                                    @else
                                    <div class="bg-light rounded mb-2 d-flex align-items-center justify-content-center" style="height: 80px; width: 100px;">
                                        <i class="fas fa-utensils text-muted"></i>
                                    </div>
                                    @endif
                                    
                                    <!-- Add Button / Qty Control -->
                                    <div class="w-100 btn-container" data-id="{{ $item->id }}" data-name="{{ $item->name }}" data-price="{{ $item->price }}">
                                        <button class="btn btn-outline-success btn-sm w-100 fw-bold btn-add" onclick="cart.add({{ $item->id }})">ADD</button>
                                        
                                        <div class="qty-control input-group input-group-sm d-none">
                                            <button class="btn btn-outline-success" onclick="cart.decrease({{ $item->id }})">-</button>
                                            <span class="input-group-text bg-white text-success fw-bold px-2 qty-display">1</span>
                                            <button class="btn btn-outline-success" onclick="cart.increase({{ $item->id }})">+</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
            @endforeach
        </div>

        <!-- Cart Section -->
        <div class="col-lg-4">
            <div class="card shadow border-0 position-sticky" style="top: 20px;">
                <div class="card-header bg-white py-3">
                    <h4 class="mb-0 fw-bold">Cart <span class="badge bg-success rounded-pill align-top fs-6 ms-1" id="cart-count">0</span></h4>
                </div>
                <div class="card-body p-0">
                    <div id="cart-empty" class="text-center py-5">
                        <i class="fas fa-shopping-basket fa-3x text-muted mb-3 opacity-50"></i>
                        <p class="text-muted fw-medium">Cart is empty</p>
                    </div>

                    <div id="cart-items" class="d-none" style="max-height: 50vh; overflow-y: auto;">
                        <!-- Cart items injected here via JS -->
                    </div>

                    <div id="cart-footer" class="p-3 border-top bg-light d-none">
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted text-uppercase">Ordering Notes</label>
                            <textarea id="order-notes" class="form-control form-control-sm" rows="2" placeholder="Any special requests?"></textarea>
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="h6 mb-0 text-muted">Total Amount</span>
                            <span class="h4 mb-0 fw-bold">₹<span id="cart-total">0.00</span></span>
                        </div>
                        
                        <button onclick="cart.placeOrder()" id="btn-place-order" class="btn btn-success w-100 py-2 fw-bold shadow-sm">
                            PLACE ORDER
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    const TABLE_ID = {{ $table->id }};
    const ITEMS_DATA = @json($items);
    
    // Map items for easy access
    const itemsMap = {};
    ITEMS_DATA.forEach(item => itemsMap[item.id] = item);

    const cart = {
        items: {}, // key: itemId, value: {id, quantity, notes}

        init: function() {
            this.render();
        },

        add: function(id) {
            if (!this.items[id]) {
                this.items[id] = { id: id, quantity: 1, notes: '' };
            } else {
                this.items[id].quantity++;
            }
            this.render();
        },

        increase: function(id) {
            if (this.items[id]) {
                this.items[id].quantity++;
                this.render();
            }
        },

        decrease: function(id) {
            if (this.items[id]) {
                this.items[id].quantity--;
                if (this.items[id].quantity <= 0) {
                    delete this.items[id];
                }
                this.render();
            }
        },

        render: function() {
            const container = document.getElementById('cart-items');
            const emptyState = document.getElementById('cart-empty');
            const footer = document.getElementById('cart-footer');
            const countBadge = document.getElementById('cart-count');
            const totalSpan = document.getElementById('cart-total');
            
            container.innerHTML = '';
            let total = 0;
            let count = 0;
            const itemIds = Object.keys(this.items);

            if (itemIds.length === 0) {
                emptyState.classList.remove('d-none');
                container.classList.add('d-none');
                footer.classList.add('d-none');
                countBadge.textContent = '0';
                
                // Reset standard buttons
                document.querySelectorAll('.btn-add').forEach(btn => btn.classList.remove('d-none'));
                document.querySelectorAll('.qty-control').forEach(div => div.classList.add('d-none'));
                
                return;
            }

            emptyState.classList.add('d-none');
            container.classList.remove('d-none');
            footer.classList.remove('d-none');

            // Reset all buttons first (brute force or optimized)
            document.querySelectorAll('.btn-add').forEach(btn => btn.classList.remove('d-none'));
            document.querySelectorAll('.qty-control').forEach(div => div.classList.add('d-none'));

            itemIds.forEach(id => {
                const cartItem = this.items[id];
                const product = itemsMap[id];
                const itemTotal = product.price * cartItem.quantity;
                
                total += itemTotal;
                count += cartItem.quantity;

                // Update Menu Card UI
                const btnContainer = document.querySelector(`.btn-container[data-id="${id}"]`);
                if (btnContainer) {
                    btnContainer.querySelector('.btn-add').classList.add('d-none');
                    const qtyControl = btnContainer.querySelector('.qty-control');
                    qtyControl.classList.remove('d-none');
                    qtyControl.querySelector('.qty-display').textContent = cartItem.quantity;
                }

                // Append to Cart List
                const html = `
                    <div class="p-3 border-bottom">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <span class="fw-bold text-dark small">
                                <i class="fas fa-circle text-success mx-1" style="font-size: 8px;"></i>
                                ${product.name}
                            </span>
                            <span class="fw-bold small">₹${product.price}</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="input-group input-group-sm" style="width: 90px;">
                                <button class="btn btn-outline-secondary py-0 px-2" onclick="cart.decrease(${id})">-</button>
                                <span class="input-group-text bg-white py-0 px-2 fw-bold border-secondary border-start-0 border-end-0">${cartItem.quantity}</span>
                                <button class="btn btn-outline-secondary py-0 px-2" onclick="cart.increase(${id})">+</button>
                            </div>
                            <span class="fw-bold small">₹${itemTotal.toFixed(2)}</span>
                        </div>
                    </div>
                `;
                container.insertAdjacentHTML('beforeend', html);
            });

            countBadge.textContent = count;
            totalSpan.textContent = total.toFixed(2);
        },

        placeOrder: function() {
            const btn = document.getElementById('btn-place-order');
            const items = Object.values(this.items);
            const notes = document.getElementById('order-notes').value;

            if (items.length === 0) return;

            if(!confirm(`Place order for ${items.length} items? Total: ₹${document.getElementById('cart-total').textContent}`)) return;

            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Placing...';

            fetch("{{ route('admin.orders.store') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    table_id: TABLE_ID,
                    items: items,
                    notes: notes
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    alert('Order Placed Successfully!');
                    window.location.href = "{{ route('admin.orders.live') }}"; // Redirect to live orders
                } else {
                    alert('Error placing order: ' + (data.error || 'Unknown error'));
                    btn.disabled = false;
                    btn.textContent = 'PLACE ORDER';
                }
            })
            .catch(err => {
                console.error(err);
                alert('Network error occurred.');
                btn.disabled = false;
                btn.textContent = 'PLACE ORDER';
            });
        }
    };

    // Initialize
    document.addEventListener('DOMContentLoaded', () => {
        cart.init();
    });
</script>

<style>
    /* Swiggy-like smooth scroll offset for sticky header */
    html {
        scroll-behavior: smooth;
    }
    .text-truncate-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    /* Hide scrollbar for category nav */
    .overflow-auto::-webkit-scrollbar {
        height: 5px;
    }
    .overflow-auto::-webkit-scrollbar-thumb {
        background: #ddd;
        border-radius: 10px;
    }
</style>
@endpush
@endsection
