@extends('admin.layouts.app')

@section('content')
<div class="mb-4">
    <h1 class="h2">Home</h1>
    <p class="text-muted">Here's what's happening with your restaurant today.</p>
</div>

<div class="row">
    <!-- Quick Stats Cards (Polaris Style) -->
    <div class="col-md-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <h6 class="card-subtitle text-muted text-uppercase small fw-bold">Total Reservations</h6>
                    <i class="fas fa-calendar-check text-muted"></i>
                </div>
                <h3 class="card-title mb-0">{{ $totalReservations }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <h6 class="card-subtitle text-muted text-uppercase small fw-bold">Menu Items</h6>
                    <i class="fas fa-utensils text-muted"></i>
                </div>
                <h3 class="card-title mb-0">{{ $totalMenuItems }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <h6 class="card-subtitle text-muted text-uppercase small fw-bold">Categories</h6>
                    <i class="fas fa-tags text-muted"></i>
                </div>
                <h3 class="card-title mb-0">{{ $totalCategories }}</h3>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0 fs-6">Recent Reservations</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr style="background-color: #f9fafb;">
                                <th class="ps-4">Guest</th>
                                <th>Date & Time</th>
                                <th>Guests</th>
                                <th>Status</th>
                                <th class="text-end pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentReservations as $reservation)
                            <tr>
                                <td class="ps-4 fw-medium">{{ $reservation->name }}</td>
                                <td>
                                    {{ \Carbon\Carbon::parse($reservation->reservation_date)->format('M d') }},
                                    {{ \Carbon\Carbon::parse($reservation->reservation_time)->format('h:i A') }}
                                </td>
                                <td>{{ $reservation->guests }} people</td>
                                <td>
                                    @if($reservation->status == 'confirmed')
                                        <span class="badge bg-success">Confirmed</span>
                                    @elseif($reservation->status == 'pending')
                                        <span class="badge" style="background-color: #ffea8a !important; color: #5c4300;">Pending</span>
                                    @else
                                        <span class="badge bg-secondary">{{ $reservation->status }}</span>
                                    @endif
                                </td>
                                <td class="text-end pe-4">
                                    <a href="{{ route('admin.reservations.index') }}" class="btn btn-sm btn-outline-secondary">View</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">No recent reservations found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
