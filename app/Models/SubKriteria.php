<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubKriteria extends Model
{
    use HasFactory;

    // Tabel yang digunakan
    protected $table = 'subkriterias';

    // Kolom yang dapat diisi
    protected $fillable = ['kriteria_id', 'nama', 'ket', 'nilai'];
}
