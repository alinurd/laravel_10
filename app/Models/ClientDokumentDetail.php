<?php

namespace App\Models;

use App\Models\ClientDokument;
use Illuminate\Database\Eloquent\Model;

class ClientDokumentDetail extends Model
{
    protected $table = 'client_dokument_details';
    protected $primaryKey = 'id';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'id', 'id_doc_ferify', 'pid', 'uraian', 'dos', 'ket', 'dov',
        'status', 'review', 'ket_review', 'created_at', 'updated_at'
    ];

    public function dokument()
    {
        return $this->belongsTo(ClientDokument::class, 'id_doc_ferify', 'id');
    }
}
