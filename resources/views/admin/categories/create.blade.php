@extends('admin.layouts.app')

@section('content')
<!-- Page Header -->
<div class="d-flex align-items-center mb-4">
    <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary me-3" style="border: 1px solid #babfc3; padding: 0.4rem 0.6rem;">
        <i class="fas fa-arrow-left"></i>
    </a>
    <h1 class="h2 mb-0">Create Category</h1>
</div>

<form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="mb-3">
                        <label for="name" class="form-label fw-bold">Title</label>
                        <input type="text" class="form-control" id="name" name="name" required>
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
                        <input type="file" class="form-control" id="image" name="image">
                        <div class="form-text text-muted">A high-quality image representing the category.</div>
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
                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active" checked>
                        <label class="form-check-label" for="is_active">Active</label>
                    </div>
                    <div class="form-text text-muted mt-2">
                        Display this category on the menu page.
                    </div>
                </div>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Save Category</button>
            </div>
        </div>
    </div>
</form>
@endsection
