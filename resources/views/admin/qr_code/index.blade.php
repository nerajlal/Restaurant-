@extends('admin.layouts.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">QR Code Management</h1>
</div>

<div class="row justify-content-center">
    <div class="col-md-6 text-center">
        <div class="card shadow">
            <div class="card-body">
                <h5 class="card-title mb-4">Scan to View Menu</h5>
                <div class="mb-4">
                    {!! $qrCode !!}
                </div>
                <div class="alert alert-info" role="alert">
                    <i class="fas fa-info-circle me-2"></i>
                    This QR code points to: <strong>{{ $url }}</strong>
                </div>
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.qr_code.download') }}" class="btn btn-primary">
                        <i class="fas fa-download me-2"></i> Download SVG
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
