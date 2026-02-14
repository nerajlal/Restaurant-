@extends('admin.layouts.app')

@section('content')
<div class="row mb-4">
    <div class="col-md-6">
        <h1 class="h2 mb-0">Order History</h1>
        <p class="text-muted small">View all past orders</p>
    </div>
</div>

<!-- Filters -->
<div class="card mb-4">
    <div class="card-body">
        <form action="{{ route('admin.orders.history') }}" method="GET">
            <div class="row g-3">
                <div class="col-md-2">
                    <input type="date" name="start_date" class="form-control" placeholder="Start Date" value="{{ request('start_date') }}">
                </div>
                <div class="col-md-2">
                    <input type="date" name="end_date" class="form-control" placeholder="End Date" value="{{ request('end_date') }}">
                </div>
                <div class="col-md-2">
                    <select name="status" class="form-select">
                        <option value="">All Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="preparing" {{ request('status') == 'preparing' ? 'selected' : '' }}>Preparing</option>
                        <option value="ready" {{ request('status') == 'ready' ? 'selected' : '' }}>Ready</option>
                        <option value="served" {{ request('status') == 'served' ? 'selected' : '' }}>Served</option>
                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="table" class="form-select">
                        <option value="">All Tables</option>
                        @foreach($tables as $table)
                            <option value="{{ $table }}" {{ request('table') == $table ? 'selected' : '' }}>{{ $table }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <input type="text" name="search" class="form-control" placeholder="Order ID" value="{{ request('search') }}">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-secondary w-100">
                        <i class="fas fa-filter me-1"></i> Filter
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Orders Table -->
<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4">Order ID</th>
                        <th>Table</th>
                        <th>Items</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Date & Time</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr>
                        <td class="ps-4 fw-bold">#{{ $order->id }}</td>
                        <td>{{ $order->table_name }}</td>
                        <td>{{ $order->items->count() }} items</td>
                        <td class="fw-bold">₹{{ number_format($order->total_amount) }}</td>
                        <td>
                            @if($order->status == 'pending')
                                <span class="badge bg-warning text-dark">Pending</span>
                            @elseif($order->status == 'confirmed')
                                <span class="badge bg-info">Confirmed</span>
                            @elseif($order->status == 'preparing')
                                <span class="badge bg-primary">Preparing</span>
                            @elseif($order->status == 'ready')
                                <span class="badge bg-success">Ready</span>
                            @elseif($order->status == 'served')
                                <span class="badge bg-secondary">Served</span>
                            @else
                                <span class="badge bg-danger">Cancelled</span>
                            @endif
                        </td>
                        <td>{{ $order->created_at->format('M d, Y h:i A') }}</td>
                        <td class="text-end pe-4">
                            <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#order-{{ $order->id }}">
                                <i class="fas fa-eye"></i> View Items
                            </button>
                        </td>
                    </tr>
                    <tr class="collapse" id="order-{{ $order->id }}">
                        <td colspan="7" class="bg-light">
                            <div class="p-3">
                                <h6 class="mb-3">Order Items:</h6>
                                <table class="table table-sm mb-0">
                                    <thead>
                                        <tr>
                                            <th>Item</th>
                                            <th>Price</th>
                                            <th>Qty</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order->items as $item)
                                        <tr>
                                            <td>{{ $item->name }}</td>
                                            <td>₹{{ number_format($item->price) }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>₹{{ number_format($item->price * $item->quantity) }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @if($order->customer_notes)
                                <div class="mt-3">
                                    <strong>Notes:</strong> {{ $order->customer_notes }}
                                </div>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">
                            <i class="fas fa-receipt fa-3x mb-3 text-light"></i>
                            <p>No orders found</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($orders->hasPages())
    <div class="card-footer bg-white">
        {{ $orders->links() }}
    </div>
    @endif
</div>
@endsection
