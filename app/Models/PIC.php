<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PIC extends Model
{

    use HasFactory;
    protected $table = 'pics';

    protected $fillable = [
        'nama',          // Nama Penyedia Barang/Jasa
        'product',       // Jenis Product
        'nilai_project', // Nilai Project
        'status',        // Status
    ];
}
