<?php

namespace App\Http\Controllers;

use App\Models\ClientDokument;
use App\Models\ClientDokumentDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

 class DokumentClientController extends Controller
{

public function index()
{
    $response = Http::withHeaders([
        'x-api-key' => '123456',
    ])->get('https://apps.banyushandanaabhipraya.co.id/api/dokument');

    if ($response->successful()) {
        $data = $response->json();
            foreach ($data as $item) {
                // Simpan data utama
                ClientDokument::updateOrCreate(
                    ['id' => $item['id']],
                    [
                        'pic' => $item['pic'],
                        'kode' => $item['kode'],
                        'jenis_product' => $item['jenis_product'],
                        'nilai' => $item['nilai'],
                        'termin' => json_encode($item['termin']),
                        'status' => $item['status'],
                        'created_at' => Carbon::parse($item['created_at'])->toDateTimeString(),
                        'updated_at' => Carbon::parse($item['updated_at'])->toDateTimeString(),
                    ]
                ); 
                if (isset($item['get_details'])) {
                    foreach ($item['get_details'] as $detail) {
                        ClientDokumentDetail::updateOrCreate(
                            ['id' => $detail['id']],
                            [
                                'id_doc_ferify' => $detail['id_doc_ferify'],
                                'pid' => $detail['pid'],
                                'uraian' => $detail['uraian'],
                                'dos' => $detail['dos'],
                                'ket' => $detail['ket'],
                                'dov' => $detail['dov'],
                                'status' => $detail['status'],
                                'review' => $detail['review'],
                                'ket_review' => $detail['ket_review'],
                                'created_at' => Carbon::parse($detail['created_at'])->toDateTimeString(),
                                'updated_at' => Carbon::parse($detail['updated_at'])->toDateTimeString(),
                            ]
                        );
                    }
                }
            }
            
 
        

        return redirect()->back()->with('success', 'Data berhasil disimpan!');
    } else {
        return redirect()->back()->with('error', 'Gagal mengambil data dari API');
    }
}

}
