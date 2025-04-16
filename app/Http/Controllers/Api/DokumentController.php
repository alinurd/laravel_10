<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DocFerifyHeader;
use Illuminate\Http\Request;

class DokumentController extends Controller
{
    // Menampilkan daftar produk
    public function index()
    {
        $products = DocFerifyHeader::with('getDetails', 'getDokumentTermin')->get();
        return response()->json($products);
    }

    // Menampilkan satu produk berdasarkan ID
    public function show($id)
    {
        $product = DocFerifyHeader::find($id);

        if ($product) {
            return response()->json($product);
        }

        return response()->json(['message' => 'Product not found'], 404);
    }

    // Menambah produk baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
        ]);

        $product = DocFerifyHeader::create($request->all());
        return response()->json($product, 201);
    }

    // Mengupdate produk berdasarkan ID
    public function update(Request $request, $id)
    {
        $product = DocFerifyHeader::find($id);

        if ($product) {
            $product->update($request->all());
            return response()->json($product);
        }

        return response()->json(['message' => 'Product not found'], 404);
    }

    // Menghapus produk berdasarkan ID
    public function destroy($id)
    {
        $product = DocFerifyHeader::find($id);

        if ($product) {
            $product->delete();
            return response()->json(['message' => 'Product deleted']);
        }

        return response()->json(['message' => 'Product not found'], 404);
    }
}
