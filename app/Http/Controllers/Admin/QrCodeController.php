<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrCodeController extends Controller
{
    public function index()
    {
        $url = route('menu.index');
        $qrCode = QrCode::size(300)->generate($url);
        
        return view('admin.qr_code.index', compact('qrCode', 'url'));
    }

    public function download()
    {
        $url = route('menu.index');
        // This is a simplified download. Real-world might need Imagick or similar to save as PNG.
        // For now, we'll just return the view with a print instruction or use SVG.
        
        $qrCode = QrCode::format('svg')->size(500)->generate($url);
        
        return response($qrCode)
            ->header('Content-Type', 'image/svg+xml')
            ->header('Content-Disposition', 'attachment; filename="menu-qr.svg"');
    }
}
