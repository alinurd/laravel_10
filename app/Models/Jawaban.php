<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{
    use HasFactory;

    // Tabel yang digunakan
    protected $table = 'jawaban';

    // Kolom yang dapat diisi
    protected $fillable = [
        'kode',
        'nama',
        'status',
        
    ];
}
