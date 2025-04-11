<?php
// app/Http/Controllers/ChartConfigController.php
namespace App\Http\Controllers;

use App\Models\ChartConfig;
use App\Models\DocFerifyHeader;
use App\Models\DokumenTermin;
use Carbon\Carbon;
use Faker\Core\File;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class TerminController extends Controller
{
    public function store(Request $request) {}

    public function updateTermin(Request $request)
    {
        // dd($request); 

        $request->validate([
            'termin' => 'required',
            'kode' => 'required',
            'id' => 'required',
            'catatan' => 'nullable|string',
            // 'file.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048'
        ]);
        $terminId = (int) $request->termin;
         $id = $request->id;
         $kode = $request->kode;
        $catatan = $request->catatan;
        
        $df = DocFerifyHeader::findOrFail($id);
 
        // Decode ke object
        $termins = json_decode($df->termin);

        // Update elemen termin yang sesuai
        foreach ($termins as $item) {

            if ((int) $item->termin === $terminId) {
                $item->status = 1;
                $item->catatan = $catatan;
                $item->by = Auth::user()->id ?? 'Unknown'; 
                $item->at = Carbon::now();
            }
        }

        $df->termin = json_encode($termins);
        $df->save();
        $fieldData='ok';
        // Simpan file (jika ada)
        if ($request->hasFile('file')) {
            foreach ($request->file('file') as $uploadedFile) {
        
                     // Ambil ekstensi dan rules
                    $allowedExtensions = $fieldData['rules']['ekstensi'] ?? ['png', 'jpg', 'pdf'];
                    $allowedMimeTypes = [
                        'png'  => 'image/png',
                        'jpg'  => 'image/jpeg',
                        'jpeg' => 'image/jpeg',
                        'pdf'  => 'application/pdf'
                    ];
                    $maxSize = 2 * 1024 * 1024; // 2MB
        
                    $fileExtension = $uploadedFile->getClientOriginalExtension();
                    $fileMimeType = $uploadedFile->getMimeType();
                    $fileSize = $uploadedFile->getSize();
        
                    // Validasi ekstensi
                    // if (!in_array(strtolower($fileExtension), $allowedExtensions)) {
                    //     return redirect()->back()->withErrors([
                    //         $fieldData['field'] => 'Format file tidak diizinkan. Hanya: ' . implode(', ', $allowedExtensions),
                    //     ]);
                    // }
        
                    // // // Validasi mime
                    // if (!in_array($fileMimeType, array_values($allowedMimeTypes))) {
                    //     return redirect()->back()->withErrors([
                    //         $fieldData['field'] => 'Tipe file tidak valid.',
                    //     ]);
                    // }
        
                    // // Validasi ukuran
                    // if ($fileSize > $maxSize) {
                    //     return redirect()->back()->withErrors([
                    //         $fieldData['field'] => 'Ukuran file maksimum adalah 2MB.',
                    //     ]);
                    // }
        
                     $path = public_path('assets/upload/termin');
                        // Simpan file
                 if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                } 
                 
        
                    $originalName = $uploadedFile->getClientOriginalName();
                    $randomName = $id . '-' . $terminId . '_' . uniqid() . '.' . $fileExtension;
        
                    $uploadedFile->move($path, $randomName);
        
                    $value = json_encode([
                        'original_name' => $originalName,
                        'random_name'   => $randomName
                    ]);
        
                    // Simpan ke DB
                    DokumenTermin::create([
                        'id_df'     => $id,
                        'kode_df'   => $kode,
                        'termin'    => $terminId,
                        'file_path' => $path,
                        'file_name' => $value,
                    ]);
                }
            }
         

        return back()->with('success', 'Status termin berhasil diperbarui!');
    }
}
