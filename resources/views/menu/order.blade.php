<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Menu - {{ $table->name }}</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary-color: #fc8019; /* Swiggy Orange */
            --secondary-text: #686b78;
            --main-text: #282c3f;
            --border-color: #e9e9eb;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: #fff;
            color: var(--main-text);
            padding-bottom: 80px; /* Space for sticky cart footer on mobile */
        }
        
        .navbar-brand {
            font-weight: 700;
            color: var(--main-text) !important;
        }
        
        /* Category Chips */
        .category-scroll {
            display: flex;
            overflow-x: auto;
            gap: 10px;
            padding: 10px 15px;
            background: #fff;
            position: sticky;
            top: 60px; /* Below navbar */
            z-index: 1020;
            border-bottom: 1px solid var(--border-color);
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        .category-scroll::-webkit-scrollbar {
            display: none;
        }
        .category-chip {
            white-space: nowrap;
            padding: 8px 16px;
            border-radius: 20px;
            background: #f0f0f5;
            color: var(--main-text);
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.2s;
        }
        .category-chip.active {
            background: var(--main-text);
            color: #fff;
        }

        /* Menu Item */
        .menu-item {
            padding: 20px 0;
            border-bottom: 0.5px solid var(--border-color);
        }
        .menu-item:last-child {
            border-bottom: none;
        }
        .item-name {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 4px;
        }
        .item-price {
            font-size: 0.9rem;
            color: var(--main-text);
            margin-bottom: 4px;
        }
        .item-desc {
            font-size: 0.85rem;
            color: var(--secondary-text);
            line-height: 1.3;
        }
        .item-img-container {
            position: relative;
            width: 110px;
            height: 96px;
            border-radius: 12px;
            overflow: hidden;
            background: #f8f8f8;
        }
        .item-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        /* Add Button */
        .add-btn-container {
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 90px;
            background: #fff;
            border: 1px solid #d4d5d9;
            box-shadow: 0 3px 8px rgba(0,0,0,.15);
            border-radius: 4px;
            text-align: center;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        .btn-add-main {
            border: none;
            background: transparent;
            color: #60b246; /* Green */
            font-weight: 700;
            font-size: 0.9rem;
            width: 100%;
            height: 100%;
            text-transform: uppercase;
        }
        .qty-controls {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            height: 100%;
            background: #fff;
        }
        .qty-btn {
            border: none;
            background: transparent;
            color: #60b246;
            font-weight: 700;
            padding: 0 8px;
            font-size: 1.1rem;
        }

        /* Cart Footer (Mobile Optimized) */
        .cart-footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background: #fff;
            padding: 15px;
            box-shadow: 0 -4px 12px rgba(0,0,0,0.1);
            z-index: 1040;
            display: none; /* Hidden by default */
        }
        .cart-preview-strip {
            background: #60b246;
            color: #fff;
            border-radius: 8px;
            padding: 12px 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            font-weight: 600;
        }

        /* Cart Modal */
        .modal-bottom-sheet .modal-dialog {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            margin: 0;
            max-width: 100%;
        }
        .modal-bottom-sheet .modal-content {
            border-radius: 16px 16px 0 0;
            border: none;
            height: 80vh; /* Max height */
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-light bg-white sticky-top shadow-sm px-3" style="height: 60px;">
        <div class="d-flex align-items-center w-100">
            <div class="flex-grow-1">
                <div class="fw-bold" style="font-size: 0.8rem; text-transform: uppercase; color: var(--secondary-text);">Table</div>
                <div class="fw-bold fs-5">{{ $table->name }}</div>
            </div>
            
            <button class="btn btn-outline-secondary btn-sm rounded-circle" data-bs-toggle="modal" data-bs-target="#searchModal">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </nav>

    <!-- Categories -->
    <div class="category-scroll">
        @foreach($categories as $category)
        <a href="#cat-{{ $category->id }}" class="category-chip">{{ $category->name }}</a>
        @endforeach
    </div>

    <!-- Menu Items -->
    <div class="container px-3 pb-5">
        @foreach($categories as $category)
            @php $catItems = $items->where('category_id', $category->id); @endphp
            @if($catItems->count() > 0)
                <div id="cat-{{ $category->id }}" class="pt-4">
                    <h2 class="h5 fw-bold mb-3">{{ $category->name }}</h2>
                    @foreach($catItems as $item)
                    <div class="menu-item d-flex justify-content-between">
                        <div class="flex-grow-1 pe-2">
                             {{-- Icon Veg/Non-Veg --}}
                            <div class="mb-1"><i class="fas fa-circle text-success" style="font-size: 0.6rem; padding: 2px; border: 1px solid #198754;"></i></div>
                            <div class="item-name">{{ $item->name }}</div>
                            <div class="item-price">₹{{ number_format($item->price) }}</div>
                            <div class="item-desc mt-2 text-truncate-2">{{Str::limit($item->description, 60)}}</div>
                        </div>
                        <div class="item-img-container shadow-sm">
                            @if($item->image)
                                <img src="{{ asset('storage/' . $item->image) }}" class="item-img" alt="{{ $item->name }}">
                            @else
                                <div class="d-flex align-items-center justify-content-center h-100 bg-light text-muted small">No Image</div>
                            @endif
                            
                            <!-- Add Button Container -->
                            <div class="add-btn-container" data-id="{{ $item->id }}">
                                <button class="btn-add-main" onclick="cart.add({{ $item->id }})">ADD</button>
                                <div class="qty-controls d-none">
                                    <button class="qty-btn" onclick="cart.decrease({{ $item->id }})">-</button>
                                    <span class="fw-bold text-success qty-text" style="font-size: 0.9rem;">1</span>
                                    <button class="qty-btn" onclick="cart.increase({{ $item->id }})">+</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @endif
        @endforeach
    </div>

    <!-- Cart Floating Footer -->
    <div id="cart-footer" class="cart-footer">
        <div class="cart-preview-strip" onclick="cart.openReview()">
            <div>
                <span id="cart-count">0</span> items | ₹<span id="cart-total">0</span>
            </div>
            <div>
                View Cart <i class="fas fa-shopping-bag ms-1"></i>
            </div>
        </div>
    </div>

    <!-- Cart Review Modal -->
    <div class="modal fade modal-bottom-sheet" id="cartModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content d-flex flex-column">
                <div class="modal-header border-bottom-0 pb-0">
                    <h5 class="modal-title fw-bold">Your Order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                
                <div class="modal-body flex-grow-1 overflow-auto" id="cart-modal-body">
                    <!-- Cart Items Injected Here -->
                </div>

                <div class="modal-footer border-top p-3 d-block bg-white">
                    <div class="mb-3">
                         <label class="small text-muted fw-bold mb-1">NOTES</label>
                         <textarea id="cart-notes" class="form-control form-control-sm bg-light border-0" placeholder="Any special cooking instructions?"></textarea>
                    </div>
                    
                    <button class="btn btn-success w-100 py-3 fw-bold shadow-sm d-flex justify-content-between align-items-center" onclick="cart.placeOrder()" id="btn-place-order">
                        <span class="text-uppercase">Place Order</span>
                        <span>₹<span id="modal-total">0</span></span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const ITEMS = @json($items);
        const TABLE_ID = {{ $table->id }};
        const itemsMap = {};
        ITEMS.forEach(i => itemsMap[i.id] = i);

        const cart = {
            data: {}, // id: {qty, notes}

            init() {
                // Restore logic if needed, simplify for now
            },

            add(id) {
                if(!this.data[id]) this.data[id] = {qty: 0};
                this.data[id].qty++;
                this.updateUI();
            },

            increase(id) {
                this.add(id);
            },

            decrease(id) {
                if(this.data[id]) {
                    this.data[id].qty--;
                    if(this.data[id].qty <= 0) delete this.data[id];
                    this.updateUI();
                }
            },

            updateUI() {
                let total = 0, count = 0;
                
                // Update Item Cards
                document.querySelectorAll('.add-btn-container').forEach(el => {
                    const id = el.dataset.id;
                    const btnMain = el.querySelector('.btn-add-main');
                    const controls = el.querySelector('.qty-controls');
                    const qtyText = el.querySelector('.qty-text');

                    if(this.data[id]) {
                        btnMain.classList.add('d-none');
                        controls.classList.remove('d-none');
                        qtyText.innerText = this.data[id].qty;
                        
                        total += itemsMap[id].price * this.data[id].qty;
                        count += this.data[id].qty;
                    } else {
                        btnMain.classList.remove('d-none');
                        controls.classList.add('d-none');
                    }
                });

                // Update Footer
                const footer = document.getElementById('cart-footer');
                if(count > 0) {
                    footer.style.display = 'block';
                    document.getElementById('cart-count').innerText = count;
                    document.getElementById('cart-total').innerText = total;
                    document.getElementById('modal-total').innerText = total;
                } else {
                    footer.style.display = 'none';
                    // clear modal logic if needed
                }
                
                this.renderModal();
            },

            openReview() {
                const modal = new bootstrap.Modal(document.getElementById('cartModal'));
                modal.show();
            },

            renderModal() {
                const container = document.getElementById('cart-modal-body');
                container.innerHTML = '';
                
                Object.keys(this.data).forEach(id => {
                    const item = itemsMap[id];
                    const qty = this.data[id].qty;
                    const price = item.price * qty;
                    
                    container.innerHTML += `
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="flex-grow-1">
                                <div class="small fw-bold border-1 border-success d-inline-block px-1 rounded text-success mb-1" style="font-size: 10px; border: 1px solid;">VEG</div>
                                <div class="fw-bold text-dark">${item.name}</div>
                                <div class="small text-muted">₹${item.price}</div>
                            </div>
                            
                            <div class="d-flex align-items-center bg-white border rounded shadow-sm" style="height: 32px;">
                                <button class="btn btn-sm btn-link text-success fw-bold text-decoration-none px-2" onclick="cart.decrease(${id})">-</button>
                                <span class="fw-bold small px-1">${qty}</span>
                                <button class="btn btn-sm btn-link text-success fw-bold text-decoration-none px-2" onclick="cart.increase(${id})">+</button>
                            </div>
                            
                            <div class="fw-bold ms-3" style="min-width: 60px; text-align: right;">₹${price}</div>
                        </div>
                    `;
                });
                
                if(Object.keys(this.data).length === 0) {
                    container.innerHTML = '<div class="text-center py-5 text-muted">Your cart is empty</div>';
                }
            },

            placeOrder() {
                const btn = document.getElementById('btn-place-order');
                const itemsPayload = Object.keys(this.data).map(id => ({
                    id: id,
                    quantity: this.data[id].qty
                }));
                const notes = document.getElementById('cart-notes').value;

                if(itemsPayload.length === 0) return;

                btn.disabled = true;
                btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> PROCESSING...';

                fetch('{{ route("cart.placeOrderDirect") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        items: itemsPayload,
                        notes: notes
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if(data.success) {
                        // Success State
                        document.body.innerHTML = `
                            <div class="d-flex flex-column align-items-center justify-content-center vh-100 bg-white text-center px-4">
                                <div class="mb-4 text-success display-1"><i class="fas fa-check-circle"></i></div>
                                <h1 class="h3 fw-bold mb-2">Order Placed!</h1>
                                <p class="text-muted mb-4">Your order #${data.order_id} has been sent to the kitchen.</p>
                                <a href="{{ route('menu.order') }}" class="btn btn-primary px-5 py-2 fw-bold text-uppercase rounded-pill">Order More</a>
                            </div>
                        `;
                    } else {
                        alert(data.error || 'Something went wrong');
                        btn.disabled = false;
                        btn.innerHTML = '<span class="text-uppercase">Place Order</span><span>₹<span id="modal-total">' + document.getElementById('cart-total').innerText + '</span></span>';
                    }
                })
                .catch(err => {
                    console.error(err);
                    alert('Network error');
                    btn.disabled = false;
                    btn.innerHTML = '<span class="text-uppercase">Place Order</span>';
                });
            }
        };
    </script>
</body>
</html>
