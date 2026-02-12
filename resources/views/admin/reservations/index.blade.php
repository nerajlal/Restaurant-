@extends('admin.layouts.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Reservations</h1>
</div>

<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Contact</th>
                <th scope="col">Guests</th>
                <th scope="col">Date & Time</th>
                <th scope="col">Status</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reservations as $reservation)
            <tr>
                <td>{{ $reservation->id }}</td>
                <td>{{ $reservation->name }}</td>
                <td>
                    {{ $reservation->email }}<br>
                    <small>{{ $reservation->phone }}</small>
                </td>
                <td>{{ $reservation->guests }}</td>
                <td>
                    {{ \Carbon\Carbon::parse($reservation->reservation_date)->format('M d, Y') }}<br>
                    {{ \Carbon\Carbon::parse($reservation->reservation_time)->format('h:i A') }}
                </td>
                <td>
                    @if($reservation->status == 'confirmed')
                        <span class="badge bg-success">Confirmed</span>
                    @elseif($reservation->status == 'pending')
                        <span class="badge bg-warning text-dark">Pending</span>
                    @elseif($reservation->status == 'cancelled')
                        <span class="badge bg-danger">Cancelled</span>
                    @else
                        <span class="badge bg-secondary">{{ ucfirst($reservation->status) }}</span>
                    @endif
                </td>
                <td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            Update Status
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <form action="{{ route('admin.reservations.update', $reservation) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="confirmed">
                                    <button class="dropdown-item" type="submit">Confirm</button>
                                </form>
                            </li>
                            <li>
                                <form action="{{ route('admin.reservations.update', $reservation) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="completed">
                                    <button class="dropdown-item" type="submit">Completed</button>
                                </form>
                            </li>
                            <li>
                                <form action="{{ route('admin.reservations.update', $reservation) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="cancelled">
                                    <button class="dropdown-item text-danger" type="submit">Cancel</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
