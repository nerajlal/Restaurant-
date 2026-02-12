@extends('admin.layouts.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Menu Item</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('admin.menu_items.index') }}" class="btn btn-sm btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <form action="{{ route('admin.menu_items.update', $menuItem) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">Item Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $menuItem->name }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="category_id" class="form-label">Category</label>
                    <select class="form-select" id="category_id" name="category_id" required>
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $menuItem->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3">{{ $menuItem->description }}</textarea>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="price" class="form-label">Price</label>
                    <div class="input-group">
                        <span class="input-group-text">$</span>
                        <input type="number" class="form-control" id="price" name="price" value="{{ $menuItem->price }}" step="0.01" min="0" required>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="image" class="form-label">Item Image</label>
                    @if($menuItem->image)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $menuItem->image) }}" alt="Current Image" width="100">
                        </div>
                    @endif
                    <input type="file" class="form-control" id="image" name="image">
                </div>
            </div>

            <div class="mb-3">
                <div class="form-check form-check-inline">
                    <input type="checkbox" class="form-check-input" id="is_vegetarian" name="is_vegetarian" {{ $menuItem->is_vegetarian ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_vegetarian">Vegetarian</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="checkbox" class="form-check-input" id="is_active" name="is_active" {{ $menuItem->is_active ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">Active</label>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Update Menu Item</button>
        </form>
    </div>
</div>
@endsection
