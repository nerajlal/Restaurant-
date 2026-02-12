@extends('admin.layouts.app')

@section('content')
<!-- Page Header -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h2 mb-0">Reservations</h1>
    <div>
        <!-- Potential filters or export buttons could go here -->
    </div>
</div>

<!-- Resource List -->
<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4">Guest</th>
                        <th>Contact info</th>
                        <th>Party Size</th>
                        <th>Date & Time</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reservations as $reservation)
                    <tr class="align-middle">
                        <td class="ps-4 fw-medium">{{ $reservation->name }}</td>
                        <td>
                            <div class="d-flex flex-column">
                                <span class="text-dark">{{ $reservation->email }}</span>
                                <span class="text-muted small">{{ $reservation->phone }}</span>
                            </div>
                        </td>
                        <td>{{ $reservation->guests }} people</td>
                        <td>
                            <div class="d-flex flex-column">
                                <span class="fw-medium">{{ \Carbon\Carbon::parse($reservation->reservation_date)->format('M d, Y') }}</span>
                                <span class="text-muted small">{{ \Carbon\Carbon::parse($reservation->reservation_time)->format('h:i A') }}</span>
                            </div>
                        </td>
                        <td>
                            @if($reservation->status == 'confirmed')
                                <span class="badge bg-success">Confirmed</span>
                            @elseif($reservation->status == 'pending')
                                <span class="badge" style="background-color: #ffea8a !important; color: #5c4300;">Pending</span>
                            @elseif($reservation->status == 'cancelled')
                                <span class="badge bg-danger">Cancelled</span>
                            @else
                                <span class="badge bg-secondary">{{ $reservation->status }}</span>
                            @endif
                        </td>
                        <td class="text-end pe-4">
                             <div class="dropdown">
                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Actions
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                                    <li>
                                        <form action="{{ route('admin.reservations.update', $reservation) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="confirmed">
                                            <button class="dropdown-item" type="submit">
                                                <i class="fas fa-check text-success me-2"></i> Confirm
                                            </button>
                                        </form>
                                    </li>
                                    <li>
                                        <form action="{{ route('admin.reservations.update', $reservation) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="completed">
                                            <button class="dropdown-item" type="submit">
                                                <i class="fas fa-flag-checkered text-primary me-2"></i> Mark Completed
                                            </button>
                                        </form>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form action="{{ route('admin.reservations.update', $reservation) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="cancelled">
                                            <button class="dropdown-item text-danger" type="submit">
                                                <i class="fas fa-times me-2"></i> Cancel
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <div class="mb-3">
                                <i class="fas fa-calendar-times fa-3x text-light"></i>
                            </div>
                            <p class="mb-0">No reservations found</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
