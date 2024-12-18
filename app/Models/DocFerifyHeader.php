<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocFerifyHeader extends Model
{
    use HasFactory;

    protected $table = "doc_ferify_headers";

    protected $fillable = ['pic', 'jenis_product', 'nilai', 'status'];
    public $incrementing = true; // Pastikan ini true untuk auto-increment integer
    protected $keyType = 'int'; // Set tipe data primary key ke integer

    public function getDetails()
    { 
        return $this->hasMany(DocFerifyDetail::class, 'id_doc_ferify', 'id');
    }


}
