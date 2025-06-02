<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chanel extends Model
{
    use HasFactory;

    // Tabel yang digunakan
    protected $table = 'data_alternatif';

    // Kolom yang dapat diisi
    protected $fillable = [
        'kode',
        'nama',
        'status',
        
    ];
}
