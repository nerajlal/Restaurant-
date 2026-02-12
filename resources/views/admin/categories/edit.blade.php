@extends('admin.layouts.app')

@section('content')
<!-- Page Header -->
<div class="d-flex align-items-center mb-4">
    <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary me-3" style="border: 1px solid #babfc3; padding: 0.4rem 0.6rem;">
        <i class="fas fa-arrow-left"></i>
    </a>
    <h1 class="h2 mb-0">Edit Category</h1>
</div>

<form action="{{ route('admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="mb-3">
                        <label for="name" class="form-label fw-bold">Title</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}" required>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header bg-white">
                    <h6 class="mb-0 fw-bold">Visuals</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="image" class="form-label">Category Image</label>
                        @if($category->image)
                            <div class="mb-3 p-2 border rounded bg-light d-inline-block">
                                <img src="{{ asset('storage/' . $category->image) }}" alt="Current Image" width="100" class="d-block mb-1">
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
                    <h6 class="mb-0 fw-bold">Status</h6>
                </div>
                <div class="card-body">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active" {{ $category->is_active ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">Active</label>
                    </div>
                    <div class="form-text text-muted mt-2">
                        Display this category on the menu page.
                    </div>
                </div>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Update Category</button>
            </div>
        </div>
    </div>
</form>
@endsection
