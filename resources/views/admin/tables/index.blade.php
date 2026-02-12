@extends('admin.layouts.app')

@section('content')
<!-- Page Header -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h2 mb-0">Tables & QR Codes</h1>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createTableModal">
        Add Table
    </button>
</div>

<!-- Tables List -->
<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4">Name</th>
                        <th>Table URL</th>
                        <th>QR Code</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tables as $table)
                    <tr class="align-middle">
                        <td class="ps-4 fw-medium">{{ $table->name }}</td>
                        <td>
                            <a href="{{ route('table.login', $table->token) }}" target="_blank" class="text-decoration-none small text-muted">
                                {{ route('table.login', $table->token) }} <i class="fas fa-external-link-alt ms-1"></i>
                            </a>
                        </td>
                        <td>
                            <div class="bg-light rounded p-2 d-inline-block border">
                                {!! SimpleSoftwareIO\QrCode\Facades\QrCode::size(50)->generate(route('table.login', $table->token)) !!}
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-success">Active</span>
                        </td>
                        <td class="text-end pe-4">
                            <a href="{{ route('admin.tables.download_qr', $table) }}" class="btn btn-sm btn-outline-secondary me-2">
                                <i class="fas fa-download"></i> SVG
                            </a>
                            <form action="{{ route('admin.tables.destroy', $table) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this table?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">
                            <i class="fas fa-chair fa-3x mb-3 text-light"></i>
                            <p>No tables found. Add one to get started.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Create Modal -->
<div class="modal fade" id="createTableModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('admin.tables.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Table</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Table Name</label>
                        <input type="text" name="name" class="form-control" placeholder="e.g. Table 1, Patio 5" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Create Table</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
