@extends('admin.layouts.app')

@section('content')
<!-- Page Header -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h2 mb-0">Menu Items</h1>
    <a href="{{ route('admin.menu_items.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-1"></i> Add Menu Item
    </a>
</div>

<!-- Search & Filters -->
<div class="card mb-4">
    <div class="card-body">
        <form action="{{ route('admin.menu_items.index') }}" method="GET">
            <div class="row g-3">
                <div class="col-md-3">
                    <input type="text" name="search" class="form-control" placeholder="Search by name..." value="{{ request('search') }}">
                </div>
                <div class="col-md-2">
                    <select name="category" class="form-select">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="status" class="form-select">
                        <option value="">All Status</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="availability" class="form-select">
                        <option value="">All Availability</option>
                        <option value="available" {{ request('availability') == 'available' ? 'selected' : '' }}>Available</option>
                        <option value="unavailable" {{ request('availability') == 'unavailable' ? 'selected' : '' }}>Unavailable</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-secondary me-2">
                        <i class="fas fa-filter me-1"></i> Filter
                    </button>
                    <a href="{{ route('admin.menu_items.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-redo me-1"></i> Reset
                    </a>
                </div>
            </div>
        </form>
    </div>
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
                        <th>Availability</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($menuItems as $item)
                    <tr class="{{ !$item->is_available ? 'table-secondary' : '' }}">
                        <td class="ps-4 py-3">
                            @if($item->image)
                                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" class="rounded" width="40" height="40" style="object-fit: cover; border: 1px solid #e1e3e5; {{ !$item->is_available ? 'opacity: 0.5;' : '' }}">
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
                            @if(!$item->is_available)
                                <span class="badge bg-warning text-dark ms-1" style="font-size: 0.7rem;">Out of Stock</span>
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
                        <td>
                            <div class="form-check form-switch">
                                <input 
                                    class="form-check-input availability-toggle" 
                                    type="checkbox" 
                                    role="switch" 
                                    data-item-id="{{ $item->id }}"
                                    {{ $item->is_available ? 'checked' : '' }}
                                    style="cursor: pointer;">
                                <label class="form-check-label small text-muted">
                                    <span class="availability-label-{{ $item->id }}">{{ $item->is_available ? 'Available' : 'Unavailable' }}</span>
                                </label>
                            </div>
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
                        <td colspan="7" class="text-center py-5 text-muted">
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

<!-- AJAX Toggle Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const toggles = document.querySelectorAll('.availability-toggle');
    
    toggles.forEach(toggle => {
        toggle.addEventListener('change', function() {
            const itemId = this.dataset.itemId;
            const isChecked = this.checked;
            
            // Disable toggle during request
            this.disabled = true;
            
            fetch(`/admin/menu_items/${itemId}/toggle-availability`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update label
                    const label = document.querySelector(`.availability-label-${itemId}`);
                    label.textContent = data.is_available ? 'Available' : 'Unavailable';
                    
                    // Update row styling
                    const row = this.closest('tr');
                    if (data.is_available) {
                        row.classList.remove('table-secondary');
                    } else {
                        row.classList.add('table-secondary');
                    }
                    
                    // Show success message
                    console.log('Availability updated successfully');
                } else {
                    // Revert toggle if failed
                    this.checked = !isChecked;
                }
                this.disabled = false;
            })
            .catch(error => {
                console.error('Error:', error);
                // Revert toggle on error
                this.checked = !isChecked;
                this.disabled = false;
                alert('Failed to update availability. Please try again.');
            });
        });
    });
});
</script>
@endsection
