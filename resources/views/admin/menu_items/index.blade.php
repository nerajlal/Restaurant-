@extends('admin.layouts.app')

@section('content')
<!-- Page Header -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h2 mb-0">Menu Items</h1>
    <a href="{{ route('admin.menu_items.create') }}" class="btn btn-primary">
        Add Menu Item
    </a>
</div>

<!-- Resource List -->
<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4" style="width: 80px;">Image</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($menuItems as $item)
                    <tr>
                        <td class="ps-4 py-3">
                            @if($item->image)
                                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" class="rounded" width="40" height="40" style="object-fit: cover; border: 1px solid #e1e3e5;">
                            @else
                                <div class="bg-light rounded d-flex align-items-center justify-content-center text-muted" style="width: 40px; height: 40px; border: 1px solid #e1e3e5;">
                                    <i class="fas fa-image"></i>
                                </div>
                            @endif
                        </td>
                        <td class="fw-medium">
                            {{ $item->name }}
                            @if($item->is_vegetarian)
                                <span class="badge bg-success ms-1" style="font-size: 0.7rem;">Veg</span>
                            @endif
                        </td>
                        <td>{{ $item->category->name ?? 'Uncategorized' }}</td>
                        <td class="fw-bold">₹{{ number_format($item->price, 2) }}</td>
                        <td>
                            @if($item->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Inactive</span>
                            @endif
                        </td>
                        <td class="text-end pe-4">
                            <a href="{{ route('admin.menu_items.edit', $item) }}" class="btn btn-sm btn-outline-secondary me-2">Edit</a>
                            <form action="{{ route('admin.menu_items.destroy', $item) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure? This action cannot be undone.')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <div class="mb-3">
                                <i class="fas fa-utensils fa-3x text-light"></i>
                            </div>
                            <p class="mb-3">No menu items found</p>
                            <a href="{{ route('admin.menu_items.create') }}" class="btn btn-primary btn-sm">Create One</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
