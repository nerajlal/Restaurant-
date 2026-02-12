@extends('admin.layouts.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Dashboard</h1>
</div>

<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card text-white bg-primary mb-3 h-100 shadow">
            <div class="card-header">Categories</div>
            <div class="card-body">
                <h5 class="card-title display-4">{{ $categoryCount }}</h5>
                <p class="card-text">Total Menu Categories</p>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card text-white bg-success mb-3 h-100 shadow">
            <div class="card-header">Menu Items</div>
            <div class="card-body">
                <h5 class="card-title display-4">{{ $menuItemCount }}</h5>
                <p class="card-text">Total Active Dishes</p>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card text-white bg-warning mb-3 h-100 shadow">
            <div class="card-header text-dark">Pending Reservations</div>
            <div class="card-body text-dark">
                <h5 class="card-title display-4">{{ $reservationCount }}</h5>
                <p class="card-text">Reservations waiting for confirmation</p>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0">Quick Actions</h5>
            </div>
            <div class="card-body">
                <a href="{{ route('admin.menu_items.create') }}" class="btn btn-primary me-2">
                    <i class="fas fa-plus"></i> Add Menu Item
                </a>
                <a href="{{ route('admin.categories.create') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-folder-plus"></i> Add Category
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
