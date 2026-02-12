@extends('admin.layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h2 mb-0">
        <i class="fas fa-satellite-dish text-danger me-2 animate-pulse"></i>
        Live Orders
    </h1>
    <div class="d-flex align-items-center">
        <div class="form-check form-switch me-3">
            <input class="form-check-input" type="checkbox" id="soundToggle" checked>
            <label class="form-check-label" for="soundToggle">Sound</label>
        </div>
        <span class="badge bg-primary rounded-pill px-3 py-2" id="connection-status">Live</span>
    </div>
</div>

<div class="row" id="orders-container">
    <!-- Orders will be injected here via JS -->
    <div class="col-12 text-center py-5">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <p class="mt-2 text-muted">Connecting to kitchen...</p>
    </div>
</div>

<!-- Audio for Alerts -->
<audio id="order-alarm" src="{{ asset('sounds/alarm.mp3') }}" preload="auto" loop></audio>

<script>
    let lastOrderCount = 0;
    let isPlaying = false;
    const alarm = document.getElementById('order-alarm');
    const container = document.getElementById('orders-container');

    // Poll every 5 seconds
    setInterval(fetchOrders, 5000);
    fetchOrders(); // Initial call

    function fetchOrders() {
        fetch('{{ route("admin.orders.fetch") }}')
            .then(response => response.json())
            .then(data => {
                renderOrders(data.orders);
                handleAlerts(data.pending_count);
            })
            .catch(err => console.error('Polling error:', err));
    }

    function handleAlerts(pendingCount) {
        const soundEnabled = document.getElementById('soundToggle').checked;
        
        if (pendingCount > 0 && soundEnabled && !isPlaying) {
             // Only play if there are pending orders
             alarm.play().catch(e => console.log('Audio play failed (interaction needed first)'));
             isPlaying = true;
        } else if (pendingCount === 0 && isPlaying) {
             alarm.pause();
             alarm.currentTime = 0;
             isPlaying = false;
        }
    }

    function updateStatus(id, status) {
        fetch(`/admin/orders/${id}/status`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ status: status })
        })
        .then(response => response.json())
        .then(data => {
            fetchOrders(); // Refresh immediately
        });
    }

    function renderOrders(orders) {
        if (orders.length === 0) {
            container.innerHTML = `
                <div class="col-12 text-center py-5 text-muted">
                    <i class="fas fa-mug-hot fa-3x mb-3"></i>
                    <p>No active orders. Kitchen is quiet.</p>
                </div>
            `;
            return;
        }

        let html = '';
        orders.forEach(order => {
            let statusBadge = getStatusBadge(order.status);
            let actionButtons = getActionButtons(order);
            let created = new Date(order.created_at).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});

            html += `
            <div class="col-md-4 mb-4">
                <div class="card h-100 border-${order.status === 'pending' ? 'warning' : 'light'} shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center ${order.status === 'pending' ? 'bg-warning-subtle' : 'bg-white'}">
                        <h5 class="mb-0 fw-bold">
                            <i class="fas fa-utensils me-2"></i> ${order.table_name || 'Table ' + order.table_id}
                        </h5>
                        <small class="text-muted">${created}</small>
                    </div>
                    <div class="card-body">
                        <div class="mb-3 d-flex justify-content-between align-items-center">
                            ${statusBadge}
                            <span class="fw-bold">$${Number(order.total_amount).toFixed(2)}</span>
                        </div>
                        
                        <ul class="list-group list-group-flush mb-3">
                            ${order.items.map(item => `
                                <li class="list-group-item px-0 d-flex justify-content-between bg-transparent">
                                    <div>
                                        <span class="fw-bold text-dark">${item.quantity}x</span> ${item.name}
                                    </div>
                                    ${item.notes ? `<small class="text-danger d-block ms-3">Note: ${item.notes}</small>` : ''}
                                </li>
                            `).join('')}
                        </ul>
                        
                        ${order.customer_notes ? `
                            <div class="alert alert-info py-2 px-3 small mb-3">
                                <i class="fas fa-comment-alt me-1"></i> "${order.customer_notes}"
                            </div>
                        ` : ''}
                    </div>
                    <div class="card-footer bg-white border-top-0 pt-0 pb-3">
                        <div class="d-grid gap-2">
                            ${actionButtons}
                        </div>
                    </div>
                </div>
            </div>
            `;
        });
        
        container.innerHTML = html;
    }

    function getStatusBadge(status) {
        const colors = {
            'pending': 'bg-warning text-dark',
            'confirmed': 'bg-primary',
            'preparing': 'bg-info text-dark',
            'ready': 'bg-success',
            'served': 'bg-secondary',
            'cancelled': 'bg-danger'
        };
        return `<span class="badge ${colors[status] || 'bg-secondary'} px-3 py-2 rounded-pill text-uppercase" style="font-size: 0.75rem;">${status}</span>`;
    }

    function getActionButtons(order) {
        if (order.status === 'pending') {
            return `
                <button class="btn btn-success" onclick="updateStatus(${order.id}, 'confirmed')">Accept Order</button>
                <button class="btn btn-outline-danger" onclick="updateStatus(${order.id}, 'cancelled')">Reject</button>
            `;
        } else if (order.status === 'confirmed') {
             return `<button class="btn btn-info" onclick="updateStatus(${order.id}, 'preparing')">Start Preparing</button>`;
        } else if (order.status === 'preparing') {
             return `<button class="btn btn-warning text-white" onclick="updateStatus(${order.id}, 'ready')">Mark Ready</button>`;
        } else if (order.status === 'ready') {
             return `<button class="btn btn-secondary" onclick="updateStatus(${order.id}, 'served')">Complete & Serve</button>`;
        }
        return '';
    }
</script>

<style>
    .animate-pulse {
        animation: pulse 2s infinite;
    }
    @keyframes pulse {
        0% { opacity: 1; }
        50% { opacity: 0.5; }
        100% { opacity: 1; }
    }
</style>
@endsection
