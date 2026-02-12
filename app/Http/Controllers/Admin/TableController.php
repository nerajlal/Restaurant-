<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Table;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TableController extends Controller
{
    public function index()
    {
        $tables = Table::all();
        return view('admin.tables.index', compact('tables'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Table::create([
            'name' => $request->name,
            'token' => Str::random(32),
            'status' => 'active',
        ]);

        return redirect()->route('admin.tables.index')->with('success', 'Table created successfully.');
    }

    public function destroy(Table $table)
    {
        $table->delete();
        return redirect()->route('admin.tables.index')->with('success', 'Table deleted successfully.');
    }

    public function downloadQr(Table $table)
    {
        $url = route('table.login', ['token' => $table->token]);
        $qrCode = QrCode::format('svg')->size(500)->generate($url);

        return response($qrCode)
            ->header('Content-Type', 'image/svg+xml')
            ->header('Content-Disposition', 'attachment; filename="table-' . $table->id . '-qr.svg"');
    }
}
