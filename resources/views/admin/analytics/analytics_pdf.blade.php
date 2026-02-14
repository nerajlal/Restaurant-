<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Analytics Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
        }
        h1 {
            color: #2c3e50;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
        }
        h2 {
            color: #34495e;
            margin-top: 20px;
            border-bottom: 1px solid #bdc3c7;
            padding-bottom: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
        }
        th {
            background-color: #3498db;
            color: white;
            padding: 10px;
            text-align: left;
        }
        td {
            padding: 8px;
            border-bottom: 1px solid #ecf0f1;
        }
        tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        .metrics {
            display: table;
            width: 100%;
            margin: 20px 0;
        }
        .metric-box {
            display: table-cell;
            width: 20%;
            padding: 15px;
            text-align: center;
            background-color: #ecf0f1;
            margin: 5px;
        }
        .metric-value {
            font-size: 24px;
            font-weight: bold;
            color: #2c3e50;
        }
        .metric-label {
            font-size: 11px;
            color: #7f8c8d;
            text-transform: uppercase;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .date-range {
            color: #7f8c8d;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ \App\Models\Setting::get('restaurant_name', 'Restaurant') }}</h1>
        <h2>Analytics Report</h2>
        <p class="date-range">{{ $rangeLabel }}</p>
        <p class="date-range">Generated on {{ now()->format('M d, Y h:i A') }}</p>
    </div>

    <h2>Key Metrics</h2>
    <div class="metrics">
        <div class="metric-box">
            <div class="metric-value">₹{{ number_format($totalRevenue) }}</div>
            <div class="metric-label">Total Revenue</div>
        </div>
        <div class="metric-box">
            <div class="metric-value">{{ $totalOrders }}</div>
            <div class="metric-label">Total Orders</div>
        </div>
        <div class="metric-box">
            <div class="metric-value">₹{{ number_format($averageOrderValue) }}</div>
            <div class="metric-label">Avg Order Value</div>
        </div>
        <div class="metric-box">
            <div class="metric-value">{{ $totalItemsSold }}</div>
            <div class="metric-label">Items Sold</div>
        </div>
        <div class="metric-box">
            <div class="metric-value">{{ number_format($completionRate, 1) }}%</div>
            <div class="metric-label">Completion Rate</div>
        </div>
    </div>

    <h2>Top Selling Items</h2>
    <table>
        <thead>
            <tr>
                <th>Item</th>
                <th>Quantity Sold</th>
                <th>Revenue</th>
            </tr>
        </thead>
        <tbody>
            @forelse($topItems as $item)
            <tr>
                <td>{{ $item->name }}</td>
                <td>{{ $item->total_quantity }}</td>
                <td>₹{{ number_format($item->total_revenue) }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="3" style="text-align: center;">No data available</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <h2>Table Performance</h2>
    <table>
        <thead>
            <tr>
                <th>Table</th>
                <th>Orders</th>
                <th>Revenue</th>
                <th>Avg Order</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tablePerformance as $table)
            <tr>
                <td>{{ $table->table_name }}</td>
                <td>{{ $table->order_count }}</td>
                <td>₹{{ number_format($table->total_revenue) }}</td>
                <td>₹{{ number_format($table->avg_order) }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4" style="text-align: center;">No data available</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
