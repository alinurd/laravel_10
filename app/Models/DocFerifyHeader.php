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

    public static function generateKode()
    {
        $datePart = date('dm-y');
        $prefix = 'DF-'.$datePart . '-';

        $last = self::where('kode', 'like', $prefix . '%')
            ->orderBy('kode', 'desc')
            ->first();

        if ($last) {
            $lastNumber = (int) substr($last->kode, -3);
            $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '001';
        }

        return $prefix . $newNumber;
    }

}
