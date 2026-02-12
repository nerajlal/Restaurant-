@extends('admin.layouts.app')

@section('content')
<!-- Page Header -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h2 mb-0">QR Codes</h1>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-bold mb-3">Menu QR Code</h5>
                <p class="text-muted mb-4">Scan this code to instantly access the full digital menu on any mobile device.</p>
                
                <div class="text-center mb-4 p-4 bg-light rounded border">
                    {!! $qrCode !!}
                </div>
                
                 <div class="alert alert-success d-flex align-items-start border-0" role="alert" style="background-color: #f0fdf4; color: #166534;">
                    <i class="fas fa-link me-2 mt-1"></i>
                    <div class="fs-small text-break">
                        <strong>Target URL:</strong><br>
                        {{ $url }}
                    </div>
                </div>

                <div class="d-grid mt-3">
                    <a href="{{ route('admin.qr_code.download') }}" class="btn btn-primary">
                        <i class="fas fa-download me-2"></i> Download SVG
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-bold mb-3">Instructions</h5>
                <p class="text-muted">How to use QR codes effectively in your restaurant:</p>
                
                <ol class="list-group list-group-numbered border-0">
                  <li class="list-group-item border-0 px-0 text-muted">Print the QR code on table tents or menu stands.</li>
                  <li class="list-group-item border-0 px-0 text-muted">Place stickers with the QR code near the entrance for waiting guests.</li>
                  <li class="list-group-item border-0 px-0 text-muted">Include the QR code in your takeout bags for easy re-ordering.</li>
                </ol>
            </div>
        </div>
    </div>
</div>
@endsection
