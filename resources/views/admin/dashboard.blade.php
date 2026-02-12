@extends('admin.layouts.app')

@section('content')
<!-- Header Section -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h2 mb-1">Dashboard</h1>
        <p class="text-muted mb-0">
            <i class="fas fa-calendar-day me-1"></i>
            {{ \Carbon\Carbon::now()->format('l, F j, Y') }}
        </p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.orders.live') }}" class="btn btn-danger">
            <i class="fas fa-satellite-dish me-1"></i> Live Orders
        </a>
        <a href="{{ route('admin.menu_items.index') }}" class="btn btn-primary">
            <i class="fas fa-utensils me-1"></i> Manage Menu
        </a>
    </div>
</div>

<!-- Key Metrics Row -->
<div class="row g-3 mb-4">
    <!-- Today's Revenue -->
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
            <div class="card-body text-white">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <h6 class="text-uppercase small fw-bold opacity-75 mb-0">Today's Revenue</h6>
                    <i class="fas fa-rupee-sign fa-2x opacity-50"></i>
                </div>
                <h2 class="mb-1 fw-bold">₹{{ number_format($todayRevenue, 2) }}</h2>
                <small class="opacity-75">
                    <i class="fas fa-chart-line me-1"></i>
                    Total: ₹{{ number_format($totalRevenue, 2) }}
                </small>
            </div>
        </div>
    </div>

    <!-- Today's Orders -->
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
            <div class="card-body text-white">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <h6 class="text-uppercase small fw-bold opacity-75 mb-0">Today's Orders</h6>
                    <i class="fas fa-shopping-bag fa-2x opacity-50"></i>
                </div>
                <h2 class="mb-1 fw-bold">{{ $todayOrders }}</h2>
                <small class="opacity-75">
                    <i class="fas fa-clock me-1"></i>
                    {{ $pendingOrders }} pending
                </small>
            </div>
        </div>
    </div>

    <!-- Active Tables -->
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
            <div class="card-body text-white">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <h6 class="text-uppercase small fw-bold opacity-75 mb-0">Active Tables</h6>
                    <i class="fas fa-chair fa-2x opacity-50"></i>
                </div>
                <h2 class="mb-1 fw-bold">{{ $activeTables }}/{{ $totalTables }}</h2>
                <small class="opacity-75">
                    <i class="fas fa-percentage me-1"></i>
                    {{ $tableUtilization }}% utilization
                </small>
            </div>
        </div>
    </div>

    <!-- Average Order Value -->
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
            <div class="card-body text-white">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <h6 class="text-uppercase small fw-bold opacity-75 mb-0">Avg Order Value</h6>
                    <i class="fas fa-receipt fa-2x opacity-50"></i>
                </div>
                <h2 class="mb-1 fw-bold">₹{{ number_format($averageOrderValue, 2) }}</h2>
                <small class="opacity-75">
                    <i class="fas fa-boxes me-1"></i>
                    {{ $totalOrders }} total orders
                </small>
            </div>
        </div>
    </div>
</div>

<!-- Charts Row -->
<div class="row g-3 mb-4">
    <!-- Revenue Trend Chart -->
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-0 py-3">
                <h5 class="mb-0 fw-bold">
                    <i class="fas fa-chart-line text-primary me-2"></i>
                    Revenue Trend (Last 7 Days)
                </h5>
            </div>
            <div class="card-body">
                <canvas id="revenueTrendChart" height="80"></canvas>
            </div>
        </div>
    </div>

    <!-- Order Status Distribution -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-0 py-3">
                <h5 class="mb-0 fw-bold">
                    <i class="fas fa-chart-pie text-success me-2"></i>
                    Order Status
                </h5>
            </div>
            <div class="card-body d-flex align-items-center justify-content-center" style="min-height: 300px; padding: 20px;">
                <div style="position: relative; width: 100%; max-width: 280px;">
                    <canvas id="orderStatusChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Top Selling Items Chart -->
<div class="row g-3 mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0 py-3">
                <h5 class="mb-0 fw-bold">
                    <i class="fas fa-fire text-danger me-2"></i>
                    Top Selling Items
                </h5>
            </div>
            <div class="card-body">
                <canvas id="topSellingChart" height="60"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Data Tables Row -->
<div class="row g-3 mb-4">
    <!-- Recent Orders -->
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0 py-3">
                <h5 class="mb-0 fw-bold">
                    <i class="fas fa-clock text-info me-2"></i>
                    Recent Orders
                </h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead style="background-color: #f8f9fa;">
                            <tr>
                                <th class="ps-4">Order ID</th>
                                <th>Table</th>
                                <th>Items</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentOrders as $order)
                            <tr>
                                <td class="ps-4 fw-bold">#{{ $order->id }}</td>
                                <td>{{ $order->table_name ?? 'Table ' . $order->table_id }}</td>
                                <td>{{ $order->items->count() }} items</td>
                                <td class="fw-bold">₹{{ number_format($order->total_amount, 2) }}</td>
                                <td>
                                    @if($order->status == 'pending')
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @elseif($order->status == 'confirmed')
                                        <span class="badge bg-primary">Confirmed</span>
                                    @elseif($order->status == 'preparing')
                                        <span class="badge bg-info text-dark">Preparing</span>
                                    @elseif($order->status == 'ready')
                                        <span class="badge bg-success">Ready</span>
                                    @elseif($order->status == 'served')
                                        <span class="badge bg-secondary">Served</span>
                                    @else
                                        <span class="badge bg-danger">{{ ucfirst($order->status) }}</span>
                                    @endif
                                </td>
                                <td class="text-muted small">{{ $order->created_at->diffForHumans() }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">No orders yet</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm mb-3">
            <div class="card-header bg-white border-0 py-3">
                <h5 class="mb-0 fw-bold">
                    <i class="fas fa-info-circle text-secondary me-2"></i>
                    Quick Stats
                </h5>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom">
                    <div>
                        <i class="fas fa-tags text-primary me-2"></i>
                        <span class="text-muted">Categories</span>
                    </div>
                    <h4 class="mb-0 fw-bold">{{ $totalCategories }}</h4>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom">
                    <div>
                        <i class="fas fa-utensils text-success me-2"></i>
                        <span class="text-muted">Menu Items</span>
                    </div>
                    <h4 class="mb-0 fw-bold">{{ $totalMenuItems }}</h4>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom">
                    <div>
                        <i class="fas fa-chair text-info me-2"></i>
                        <span class="text-muted">Total Tables</span>
                    </div>
                    <h4 class="mb-0 fw-bold">{{ $totalTables }}</h4>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fas fa-calendar-check text-warning me-2"></i>
                        <span class="text-muted">Reservations</span>
                    </div>
                    <h4 class="mb-0 fw-bold">{{ $totalReservations }}</h4>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js Scripts -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
    // Revenue Trend Chart
    const revenueTrendCtx = document.getElementById('revenueTrendChart').getContext('2d');
    new Chart(revenueTrendCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode(array_column($revenueTrend, 'date')) !!},
            datasets: [{
                label: 'Revenue (₹)',
                data: {!! json_encode(array_column($revenueTrend, 'revenue')) !!},
                borderColor: '#667eea',
                backgroundColor: 'rgba(102, 126, 234, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#667eea',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 5,
                pointHoverRadius: 7
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    padding: 12,
                    titleFont: {
                        size: 14
                    },
                    bodyFont: {
                        size: 13
                    },
                    callbacks: {
                        label: function(context) {
                            return 'Revenue: ₹' + context.parsed.y.toFixed(2);
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return '₹' + value;
                        }
                    },
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)'
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });

    // Order Status Distribution Chart
    const orderStatusCtx = document.getElementById('orderStatusChart').getContext('2d');
    new Chart(orderStatusCtx, {
        type: 'doughnut',
        data: {
            labels: ['Pending', 'Confirmed', 'Preparing', 'Ready', 'Served'],
            datasets: [{
                data: [
                    {{ $orderStatusDistribution['pending'] }},
                    {{ $orderStatusDistribution['confirmed'] }},
                    {{ $orderStatusDistribution['preparing'] }},
                    {{ $orderStatusDistribution['ready'] }},
                    {{ $orderStatusDistribution['served'] }}
                ],
                backgroundColor: [
                    '#ffc107',
                    '#0d6efd',
                    '#0dcaf0',
                    '#198754',
                    '#6c757d'
                ],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 15,
                        font: {
                            size: 11
                        },
                        boxWidth: 15
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    padding: 12,
                    callbacks: {
                        label: function(context) {
                            let label = context.label || '';
                            if (label) {
                                label += ': ';
                            }
                            label += context.parsed + ' orders';
                            return label;
                        }
                    }
                }
            }
        }
    });

    // Top Selling Items Chart
    const topSellingCtx = document.getElementById('topSellingChart').getContext('2d');
    new Chart(topSellingCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($topSellingItems->pluck('name')) !!},
            datasets: [{
                label: 'Quantity Sold',
                data: {!! json_encode($topSellingItems->pluck('total_quantity')) !!},
                backgroundColor: [
                    'rgba(255, 99, 132, 0.8)',
                    'rgba(54, 162, 235, 0.8)',
                    'rgba(255, 206, 86, 0.8)',
                    'rgba(75, 192, 192, 0.8)',
                    'rgba(153, 102, 255, 0.8)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)'
                ],
                borderWidth: 2,
                borderRadius: 8
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    padding: 12
                }
            },
            scales: {
                x: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    },
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)'
                    }
                },
                y: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });
</script>

<style>
    .card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    
    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    }
    
    .table tbody tr {
        transition: background-color 0.2s ease;
    }
    
    .table tbody tr:hover {
        background-color: rgba(0, 0, 0, 0.02);
    }
</style>
@endsection
