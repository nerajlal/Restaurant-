@extends('admin.layouts.app')

@section('content')
<div class="row mb-4">
    <div class="col-md-6">
        <h1 class="h2 mb-0">Detailed Analytics</h1>
        <p class="text-muted small">Analyze performance for {{ $rangeLabel }}</p>
    </div>
    <div class="col-md-6 text-md-end">
        <form action="{{ route('admin.analytics.index') }}" method="GET" class="d-inline-flex gap-2">
            <select name="range" class="form-select w-auto" onchange="this.form.submit()">
                <option value="today" {{ $range == 'today' ? 'selected' : '' }}>Today</option>
                <option value="this_week" {{ $range == 'this_week' ? 'selected' : '' }}>This Week</option>
                <option value="this_month" {{ $range == 'this_month' ? 'selected' : '' }}>This Month</option>
                <option value="6_months" {{ $range == '6_months' ? 'selected' : '' }}>Last 6 Months</option>
                <option value="1_year" {{ $range == '1_year' ? 'selected' : '' }}>Last 1 Year</option>
            </select>
        </form>
    </div>
</div>

<!-- Key Metrics Row 1 -->
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card h-100 border-0 shadow-sm">
            <div class="card-body">
                <h6 class="text-muted text-uppercase small fw-bold">Total Revenue</h6>
                <div class="d-flex align-items-center justify-content-between mt-2">
                    <h2 class="mb-0 fw-bold">₹{{ number_format($totalRevenue) }}</h2>
                    <div class="icon-shape bg-success bg-opacity-10 text-success rounded-circle p-3">
                        <i class="fas fa-rupee-sign fa-lg"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card h-100 border-0 shadow-sm">
            <div class="card-body">
                <h6 class="text-muted text-uppercase small fw-bold">Total Orders</h6>
                <div class="d-flex align-items-center justify-content-between mt-2">
                    <h2 class="mb-0 fw-bold">{{ number_format($totalOrders) }}</h2>
                    <div class="icon-shape bg-primary bg-opacity-10 text-primary rounded-circle p-3">
                        <i class="fas fa-shopping-bag fa-lg"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card h-100 border-0 shadow-sm">
            <div class="card-body">
                <h6 class="text-muted text-uppercase small fw-bold">Avg. Order Value</h6>
                <div class="d-flex align-items-center justify-content-between mt-2">
                    <h2 class="mb-0 fw-bold">₹{{ number_format($averageOrderValue, 0) }}</h2>
                    <div class="icon-shape bg-info bg-opacity-10 text-info rounded-circle p-3">
                        <i class="fas fa-chart-line fa-lg"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card h-100 border-0 shadow-sm">
            <div class="card-body">
                <h6 class="text-muted text-uppercase small fw-bold">Items Sold</h6>
                <div class="d-flex align-items-center justify-content-between mt-2">
                    <h2 class="mb-0 fw-bold">{{ number_format($totalItemsSold) }}</h2>
                    <div class="icon-shape bg-warning bg-opacity-10 text-warning rounded-circle p-3">
                        <i class="fas fa-box fa-lg"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Key Metrics Row 2 -->
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card h-100 border-0 shadow-sm">
            <div class="card-body">
                <h6 class="text-muted text-uppercase small fw-bold">Active Tables</h6>
                <div class="d-flex align-items-center justify-content-between mt-2">
                    <h2 class="mb-0 fw-bold">{{ $activeTables }}</h2>
                    <div class="icon-shape bg-secondary bg-opacity-10 text-secondary rounded-circle p-3">
                        <i class="fas fa-chair fa-lg"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card h-100 border-0 shadow-sm">
            <div class="card-body">
                <h6 class="text-muted text-uppercase small fw-bold">Peak Hour</h6>
                <div class="d-flex align-items-center justify-content-between mt-2">
                    <h3 class="mb-0 fw-bold" style="font-size: 1.5rem;">{{ $peakHourLabel }}</h3>
                    <div class="icon-shape bg-danger bg-opacity-10 text-danger rounded-circle p-3">
                        <i class="fas fa-clock fa-lg"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card h-100 border-0 shadow-sm">
            <div class="card-body">
                <h6 class="text-muted text-uppercase small fw-bold">Completion Rate</h6>
                <div class="d-flex align-items-center justify-content-between mt-2">
                    <h2 class="mb-0 fw-bold">{{ $completionRate }}%</h2>
                    <div class="icon-shape bg-success bg-opacity-10 text-success rounded-circle p-3">
                        <i class="fas fa-check-circle fa-lg"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card h-100 border-0 shadow-sm">
            <div class="card-body">
                <h6 class="text-muted text-uppercase small fw-bold">Total Transactions</h6>
                <div class="d-flex align-items-center justify-content-between mt-2">
                    <h2 class="mb-0 fw-bold">{{ array_sum($orderStatusCounts) }}</h2>
                    <div class="icon-shape bg-primary bg-opacity-10 text-primary rounded-circle p-3">
                        <i class="fas fa-receipt fa-lg"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Charts Row 1 -->
<div class="row mb-4">
    <div class="col-lg-8 mb-4 mb-lg-0">
        <div class="card h-100 border-0 shadow-sm">
            <div class="card-header bg-transparent border-0">
                <h5 class="mb-0">Revenue & Order Trends</h5>
            </div>
            <div class="card-body">
                <canvas id="revenueChart" style="max-height: 350px;"></canvas>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="card h-100 border-0 shadow-sm">
            <div class="card-header bg-transparent border-0">
                <h5 class="mb-0">Order Status</h5>
            </div>
            <div class="card-body d-flex align-items-center justify-content-center">
                <div style="width: 100%; max-width: 280px;">
                    <canvas id="orderStatusChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Charts Row 2 -->
<div class="row mb-4">
    <div class="col-lg-8 mb-4 mb-lg-0">
        <div class="card h-100 border-0 shadow-sm">
            <div class="card-header bg-transparent border-0">
                <h5 class="mb-0">Hourly Order Distribution</h5>
            </div>
            <div class="card-body">
                <canvas id="hourlyChart" style="max-height: 300px;"></canvas>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="card h-100 border-0 shadow-sm">
            <div class="card-header bg-transparent border-0">
                <h5 class="mb-0">Category Revenue</h5>
            </div>
            <div class="card-body">
                <canvas id="categoryRevenueChart" style="max-height: 300px;"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Tables Row -->
<div class="row mb-4">
    <div class="col-lg-6 mb-4 mb-lg-0">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-transparent border-0">
                <h5 class="mb-0">Top Selling Items</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4">Rank</th>
                            <th>Item Name</th>
                            <th class="text-center">Qty</th>
                            <th class="text-end pe-4">Revenue</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($topItems as $index => $item)
                        <tr>
                            <td class="ps-4 text-muted">#{{ $index + 1 }}</td>
                            <td class="fw-bold">{{ $item->name }}</td>
                            <td class="text-center">{{ $item->total_qty }}</td>
                            <td class="text-end pe-4">₹{{ number_format($item->total_revenue) }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-muted">No data available</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-transparent border-0">
                <h5 class="mb-0">Table Performance</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4">Table</th>
                            <th class="text-center">Orders</th>
                            <th class="text-end pe-4">Revenue</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tablePerformance as $table)
                        <tr>
                            <td class="ps-4 fw-bold">{{ $table->table_name }}</td>
                            <td class="text-center">{{ $table->order_count }}</td>
                            <td class="text-end pe-4">₹{{ number_format($table->revenue) }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center py-4 text-muted">No data available</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Revenue & Order Count Chart (Dual Axis)
    const revenueCtx = document.getElementById('revenueChart').getContext('2d');
    new Chart(revenueCtx, {
        type: 'line',
        data: {
            labels: @json(array_column($revenueTrend, 'date')),
            datasets: [{
                label: 'Revenue (₹)',
                data: @json(array_column($revenueTrend, 'revenue')),
                borderColor: '#008060',
                backgroundColor: 'rgba(0, 128, 96, 0.1)',
                tension: 0.3,
                fill: true,
                yAxisID: 'y',
            }, {
                label: 'Order Count',
                data: @json(array_column($orderCountTrend, 'count')),
                borderColor: '#5c6ac4',
                backgroundColor: 'rgba(92, 106, 196, 0.1)',
                tension: 0.3,
                fill: true,
                yAxisID: 'y1',
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: { mode: 'index', intersect: false },
            plugins: {
                legend: { display: true, position: 'top' }
            },
            scales: {
                y: {
                    type: 'linear',
                    display: true,
                    position: 'left',
                    beginAtZero: true,
                    title: { display: true, text: 'Revenue (₹)' }
                },
                y1: {
                    type: 'linear',
                    display: true,
                    position: 'right',
                    beginAtZero: true,
                    title: { display: true, text: 'Orders' },
                    grid: { drawOnChartArea: false }
                }
            }
        }
    });

    // Order Status Pie Chart
    const statusCtx = document.getElementById('orderStatusChart').getContext('2d');
    new Chart(statusCtx, {
        type: 'doughnut',
        data: {
            labels: ['Pending', 'Confirmed', 'Preparing', 'Ready', 'Served'],
            datasets: [{
                data: @json(array_values($orderStatusCounts)),
                backgroundColor: ['#fbbf24', '#3b82f6', '#f59e0b', '#8b5cf6', '#10b981'],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'bottom', labels: { boxWidth: 12, padding: 10 } }
            },
            cutout: '65%'
        }
    });

    // Hourly Distribution Bar Chart
    const hourlyCtx = document.getElementById('hourlyChart').getContext('2d');
    new Chart(hourlyCtx, {
        type: 'bar',
        data: {
            labels: @json(array_column($hourlyData, 'hour')),
            datasets: [{
                label: 'Orders',
                data: @json(array_column($hourlyData, 'count')),
                backgroundColor: '#008060',
                borderRadius: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, ticks: { stepSize: 1 } },
                x: { grid: { display: false } }
            }
        }
    });

    // Category Revenue Bar Chart
    const catRevCtx = document.getElementById('categoryRevenueChart').getContext('2d');
    new Chart(catRevCtx, {
        type: 'bar',
        data: {
            labels: @json($categoryRevenueLabels),
            datasets: [{
                label: 'Revenue (₹)',
                data: @json($categoryRevenueData),
                backgroundColor: ['#008060', '#5c6ac4', '#f49342', '#de3618', '#ecc94b'],
                borderRadius: 4
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                x: { beginAtZero: true },
                y: { grid: { display: false } }
            }
        }
    });
</script>
@endsection
