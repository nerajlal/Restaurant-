@extends('admin.layouts.app')

@section('content')
<!-- Page Header -->
<div class="d-flex align-items-center mb-4">
    <a href="{{ route('admin.menu_items.index') }}" class="btn btn-outline-secondary me-3" style="border: 1px solid #babfc3; padding: 0.4rem 0.6rem;">
        <i class="fas fa-arrow-left"></i>
    </a>
    <h1 class="h2 mb-0">Edit Menu Item</h1>
</div>

<form action="{{ route('admin.menu_items.update', $menuItem) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="mb-3">
                        <label for="name" class="form-label fw-bold">Item Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $menuItem->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label fw-bold">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="4">{{ $menuItem->description }}</textarea>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header bg-white">
                    <h6 class="mb-0 fw-bold">Visuals</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="image" class="form-label">Item Image</label>
                        @if($menuItem->image)
                            <div class="mb-3 p-2 border rounded bg-light d-inline-block">
                                <img src="{{ asset('storage/' . $menuItem->image) }}" alt="Current Image" width="100" class="d-block mb-1">
                                <small class="text-muted">Current Image</small>
                            </div>
                        @endif
                        <input type="file" class="form-control" id="image" name="image">
                        <div class="form-text text-muted">Upload a new image to replace the existing one.</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header bg-white">
                    <h6 class="mb-0 fw-bold">Organization</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="category_id" class="form-label fw-bold">Category</label>
                        <select class="form-select" id="category_id" name="category_id" required>
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $menuItem->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label fw-bold">Price</label>
                        <div class="input-group">
                            <span class="input-group-text">₹</span>
                            <input type="number" class="form-control" id="price" name="price" value="{{ $menuItem->price }}" step="0.01" min="0" required>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header bg-white">
                    <h6 class="mb-0 fw-bold">Options</h6>
                </div>
                <div class="card-body">
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active" {{ $menuItem->is_active ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">Active</label>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="is_vegetarian" name="is_vegetarian" {{ $menuItem->is_vegetarian ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_vegetarian">Vegetarian</label>
                    </div>
                </div>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Update Menu Item</button>
            </div>
        </div>
    </div>
</form>
@endsection
