<?php
namespace App\Models;

use App\Models\ClientDokumentDetail;
use Illuminate\Database\Eloquent\Model;

class ClientDokument extends Model
{
    protected $table = 'client_dokuments';
    protected $primaryKey = 'id';
    public $incrementing = false; // karena ID berasal dari API
    public $timestamps = false;   // jika kamu tidak pakai timestamps otomatis

    protected $fillable = [
        'id', 'pic', 'kode', 'jenis_product', 'nilai', 'termin', 'status',
        'created_at', 'updated_at'
    ];

    // Relasi ke detail
    public function details()
    {
        return $this->hasMany(ClientDokumentDetail::class, 'id_doc_ferify', 'id');
    }

    // (Opsional) jika kamu punya model DokumentTermin
    public function termins()
    {
        return $this->hasMany(DokumentTermin::class, 'dokument_id', 'id');
    }
}
