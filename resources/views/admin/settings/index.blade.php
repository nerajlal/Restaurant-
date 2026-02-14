@extends('admin.layouts.app')

@section('content')
<div class="row mb-4">
    <div class="col-md-6">
        <h1 class="h2 mb-0">Restaurant Settings</h1>
        <p class="text-muted small">Manage your restaurant configuration</p>
    </div>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<form action="{{ route('admin.settings.update') }}" method="POST">
    @csrf
    
    <!-- Restaurant Information -->
    <div class="card mb-4">
        <div class="card-header bg-white">
            <h5 class="mb-0"><i class="fas fa-store me-2"></i>Restaurant Information</h5>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Restaurant Name <span class="text-danger">*</span></label>
                    <input type="text" name="restaurant_name" class="form-control @error('restaurant_name') is-invalid @enderror" value="{{ old('restaurant_name', $settings['restaurant_name'] ?? '') }}" required>
                    @error('restaurant_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="email" name="restaurant_email" class="form-control @error('restaurant_email') is-invalid @enderror" value="{{ old('restaurant_email', $settings['restaurant_email'] ?? '') }}">
                    @error('restaurant_email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Phone</label>
                    <input type="text" name="restaurant_phone" class="form-control @error('restaurant_phone') is-invalid @enderror" value="{{ old('restaurant_phone', $settings['restaurant_phone'] ?? '') }}">
                    @error('restaurant_phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-12">
                    <label class="form-label">Address</label>
                    <textarea name="restaurant_address" class="form-control" rows="2">{{ old('restaurant_address', $settings['restaurant_address'] ?? '') }}</textarea>
                </div>
            </div>
        </div>
    </div>

    <!-- Business Hours -->
    <div class="card mb-4">
        <div class="card-header bg-white">
            <h5 class="mb-0"><i class="fas fa-clock me-2"></i>Business Hours</h5>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Opening Time</label>
                    <input type="time" name="opening_time" class="form-control" value="{{ old('opening_time', $settings['opening_time'] ?? '09:00') }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Closing Time</label>
                    <input type="time" name="closing_time" class="form-control" value="{{ old('closing_time', $settings['closing_time'] ?? '22:00') }}">
                </div>
            </div>
        </div>
    </div>

    <!-- Financial Settings -->
    <!-- <div class="card mb-4">
        <div class="card-header bg-white">
            <h5 class="mb-0"><i class="fas fa-rupee-sign me-2"></i>Financial Settings</h5>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Tax Rate (%)</label>
                    <input type="number" name="tax_rate" class="form-control @error('tax_rate') is-invalid @enderror" value="{{ old('tax_rate', $settings['tax_rate'] ?? '0') }}" min="0" max="100" step="0.01">
                    @error('tax_rate')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Enter 0 for no tax</small>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Currency</label>
                    <select name="currency" class="form-select">
                        <option value="INR" {{ ($settings['currency'] ?? 'INR') == 'INR' ? 'selected' : '' }}>INR (₹)</option>
                        <option value="USD" {{ ($settings['currency'] ?? 'INR') == 'USD' ? 'selected' : '' }}>USD ($)</option>
                        <option value="EUR" {{ ($settings['currency'] ?? 'INR') == 'EUR' ? 'selected' : '' }}>EUR (€)</option>
                    </select>
                </div>
            </div>
        </div>
    </div> -->

    <!-- Save Button -->
    <div class="text-end">
        <button type="submit" class="btn btn-primary px-4">
            <i class="fas fa-save me-2"></i>Save Settings
        </button>
    </div>
</form>
@endsection
