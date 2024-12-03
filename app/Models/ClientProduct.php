<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientProduct extends Model
{
    use HasFactory;

    // Tabel yang digunakan
    protected $table = 'client_products';

    // Kolom yang dapat diisi
    protected $fillable = [
        'pt_id',
        'pic_id',
        'direktur',
        'product',
        'jenis',
        'spesifikasi',
        'sut',
        'merk',
        'code_hs',
        'status',
    ];
}
