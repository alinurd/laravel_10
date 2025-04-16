<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DokumentClientController extends Controller
{
    public function index()
    {
        
        $token = '123456';

        $response = Http::withToken($token)->get('http://127.0.0.1:8000/api/dokument');

        if ($response->successful()) {
            $data = $response->json();

            return view('document.integrasi.index', ['dokuments' => $data]);
        } else {
            // Kalau error
            return redirect()->back()->with('error', 'Gagal mengambil data dari API');
        }
    }
}
