<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocFerifyHeader extends Model
{
    use HasFactory;

    protected $table = "doc_ferify_headers";

    protected $fillable = ['pic', 'jenis_product', 'nilai', 'status', 'termin', 'kode'];
    public $incrementing = true; // Pastikan ini true untuk auto-increment integer
    protected $keyType = 'int'; // Set tipe data primary key ke integer

    public function getDetails()
    { 
        return $this->hasMany(DocFerifyDetail::class, 'id_doc_ferify', 'id');
    }
    public function getDokumentTermin()
    { 
        return $this->hasMany(DokumenTermin::class, 'id_df', 'id');
    }


    public static function generateKode()
{
    $datePart = date('dm');
    $yearPart = date('y');
    $prefix = 'DF-' . $datePart . '-' . $yearPart . '-';

 
    $lastDaily = self::where('kode', 'like', $prefix . '%')
        ->orderBy('kode', 'desc')
        ->first();

    if ($lastDaily) {
        $lastDailyNumber = (int) substr($lastDaily->kode, -7, 3);
        $newDailyNumber = str_pad($lastDailyNumber + 1, 3, '0', STR_PAD_LEFT);
    } else {
        $newDailyNumber = '001';
    }
 
    $lastGlobal = self::orderBy('kode', 'desc')->first();

    if ($lastGlobal) {
        $lastGlobalNumber = (int) substr($lastGlobal->kode, -3); 
        $newGlobalNumber = str_pad($lastGlobalNumber + 1, 3, '0', STR_PAD_LEFT);
    } else {
        $newGlobalNumber = '001';
    }

    return $prefix . $newDailyNumber . '-' . $newGlobalNumber;
}


}
