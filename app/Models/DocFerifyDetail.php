<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocFerifyDetail extends Model
{
    use HasFactory;
     protected $table = "doc_ferify_details";

    protected $fillable = ['id_doc_ferify', 'pid', 'uraian', 'dos', 'ket', 'dov'. 'status', 'review', 'ket_review'];
    public $incrementing = true; // Pastikan ini true untuk auto-increment integer
    protected $keyType = 'int'; // Set tipe data primary key ke integer
}
