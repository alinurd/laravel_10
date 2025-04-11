<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenTermin extends Model
{
    use HasFactory;

    protected $fillable = ['id_df', 'termin_id', 'data', 'status', 'key1', 'key2', 'key3'];
    public $incrementing = true; // Pastikan ini true untuk auto-increment integer

    protected $table = 'dokumen_termins';
}
