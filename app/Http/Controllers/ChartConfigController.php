<?php
// app/Http/Controllers/ChartConfigController.php
namespace App\Http\Controllers;

use App\Models\ChartConfig;
use Illuminate\Http\Request;

class ChartConfigController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kelompok' => 'required|string',
            'module' => 'required|string',
            'data' => 'required|string',
            // 'data' => 'required|exists:data,id', // Sesuaikan dengan nama tabel data Anda
            'operasi' => 'required|string',
            'datasets' => 'required|array|min:1',
            'datasets.*.label' => 'required|string',
            'datasets.*.backgroundColor' => 'required|string',
            'datasets.*.borderColor' => 'required|string'
        ]);
dd($validated);
        $config = ChartConfig::create([
            'kelompok' => $validated['kelompok'],
            'data_id' => $validated['data'],
            'operasi' => $validated['operasi'],
            'datasets' => $validated['datasets']
        ]);

        return response()->json([
            'status' => 'success',
            'id' => $config->id,
            'message' => 'Konfigurasi berhasil disimpan'
        ]);
    }
}