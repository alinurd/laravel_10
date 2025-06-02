<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriterium extends Model
{
    use HasFactory;

    // Tabel yang digunakan
    protected $table = 'bobot_kriteria';

    // Kolom yang dapat diisi
    protected $fillable = [
        'kode',
        'nama',
        'bobot',
        'kriteria',
        'atribut',
        'status',
        
    ];
}
