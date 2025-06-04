<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriterium extends Model
{
    use HasFactory;

    // Tabel yang digunakan
    protected $table = 'bobot_kriteria';

    // Kolom yang dapat diisi
    protected $fillable = [
        'kode',
        'nama',
        'bobot',
        'kriteria',
        'atribut',
        'status',
        
    ];

   public function getSubKriteria()
{
    return $this->hasMany(SubKriteria::class, 'kriteria_id');
}
    public static function getCountData()
    {
        return self::where('status', 1)->count();
    }

 
    public static function getNormalisasiBobot()
{


   $data = self::all();

    // Hitung total bobot
        $totalBobot = $data->sum('bobot');

    $data->transform(function ($item) use ($totalBobot) {
    // Hindari pembagian dengan 0
    $item->bobot_normalisasi = $totalBobot > 0 ? $item->bobot / $totalBobot : 0;
    return $item;
});

    return $data;
}


}
