<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\MenuGroup;
use App\Models\Combo;

class CRUDService
{
  public function create(Request $request, $tblMaster, $dataForm, $mdl)
  {
       $data = []; 
  foreach ($dataForm as $fieldData) {
    if (isset($fieldData['field']) && $fieldData['show']) {
        $value = $request->input($fieldData['field'], null);

        // Jika input bertipe "rupiah", ubah ke format desimal
        if (isset($fieldData['input']) && $fieldData['input'] === 'rupiah') {
            $value = str_replace(['.', ','], ['', '.'], $value);
            $value = is_numeric($value) ? (float) $value : 0; 
        }

        // Jika input bertipe "file"
        if (isset($fieldData['input']) && $fieldData['input'] === 'file') { 
            if ($request->hasFile($fieldData['field'])) {
                $file = $request->file($fieldData['field']);

                // Ambil ekstensi yang diizinkan dari rules
                $allowedExtensions = $fieldData['rules']['ekstensi'] ?? ['png', 'jpg', 'pdf', 'JPG'];
                $allowedMimeTypes = [
                    'png'  => 'image/png',
                    'JPG'  => 'image/jpeg',
                    'jpg'  => 'image/jpeg',
                    'jpeg' => 'image/jpeg',
                    'pdf'  => 'application/pdf'
                ]; 

                $maxSize = 2 * 1024 * 1024; // Maksimum 2MB

                $fileExtension = $file->getClientOriginalExtension();
                $fileMimeType = $file->getMimeType();
                $fileSize = $file->getSize();

                // Validasi ekstensi file
                if (!in_array($fileExtension, $allowedExtensions)) {
                    return redirect()->back()->withErrors([
                        $fieldData['field'] => 'Format file tidak diizinkan. Hanya: ' . implode(', ', $allowedExtensions),
                    ]);
                }

                // Validasi MIME type
                if (!in_array($fileMimeType, array_values($allowedMimeTypes))) {
                    return redirect()->back()->withErrors([
                        $fieldData['field'] => 'Tipe file tidak valid.',
                    ]);
                }

                // Validasi ukuran file
                if ($fileSize > $maxSize) {
                    return redirect()->back()->withErrors([
                        $fieldData['field'] => 'Ukuran file maksimum adalah 2MB.',
                    ]);
                }

                // Simpan file
                $path = public_path('assets/upload/lampiran');
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                } 

                $originalName = $file->getClientOriginalName();
                $randomName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move($path, $randomName);

                // Simpan dalam format JSON
                $value = json_encode([
                    'original_name' => $originalName,
                    'random_name' => $randomName
                ]);
            } else {
                $value = null; // Jika tidak ada file yang diunggah
            }
        }

        $data[$fieldData['field']] = $value;
    }
}

// Simpan ke database
$tblMaster::create($data);

return redirect()->route($mdl . '.index')->with('success', 'Data Created successfully!');
  }
  

  public function update($id, Request $request, $tblMaster, $dataForm, $mdl)
  {
       $record = $tblMaster::find($id);
       if (!$record) {
          return back()->with('failed', 'Data not found');
      }
      $data = [];
       foreach ($dataForm as $fieldData) {
        if (isset($fieldData['field']) && $fieldData['show'] ) {
          $data[$fieldData['field']] = $request->input($fieldData['field'], null);
          }
      }
      $record->update($data);
      return redirect()->route($mdl . '.index')->with('success', 'Data updated successfully!');
  }

  public function delete($id, $tblMaster, $mdl)
  {
       $record = $tblMaster::find($id);
       if (!$record) {
          return back()->with('failed', 'Data not found');
      }
      
      $record->delete();
      return redirect()->route($mdl . '.index')->with('success', 'Data deleted successfully!');
  }
  
}
