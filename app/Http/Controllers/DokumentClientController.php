<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DokumentClientController extends Controller
{
    public function index()
    {
        // dd("JALAN");

        $token = '123456';

        $response = Http::withHeaders([
            'x-api-key' => '123456',
        ])->get('https://apps.banyushandanaabhipraya.co.id/api/dokument');

        if ($response->successful()) {
            $data = $response->json();
            
            return view('pages.document.integrasi.index', ['dokuments' => $data]);
        } else {
            dd($response);
            // Kalau error
            return redirect()->back()->with('error', 'Gagal mengambil data dari API');
        }
    }
}
