<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Traits\GlobalDataTrait;

class Transaksi extends Model
{
    use HasFactory, GlobalDataTrait;

    protected $table = 'Transaksi';
    protected $fillable = ['tgl', 'jenis', 'kategori', 'nominal', 'deks', 'file', 'rekening'];
    public $timestamps = true;
    protected $keyType = 'int';



    public static function generateChrat()
    {
        return [
            'kelompok' => [
                'bulan' =>self::getDataBulan(),
                'tahun' =>self::getDataTahun(2020, 2025),
                'jenis' => [['id' => 1, 'val' => 'Pengeluaran'], ['id' => 2, 'val' => 'Pemasukan']],
                'kategori' => [['id' => 1, 'val' => 'pembayaran karyawan'], ['id' => 2, 'val' => 'tambah 1-edit menjadi aktif']]
            ],

            'data' => [
                        ['id' => 'nominal', 'val' => 'nominal', 'opration' => ['SUM', 'MAX', 'MIN', 'AVERAGE', 'COUNT']],
        
                        ['id' => 'jumlah_ransaksi', 'val' => 'Jumlah Transaksi', 'opration' => ['COUNT']]]
        ];
    }


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($kategori) {
            $kategori->created_by = Auth::id();
        });

        static::updating(function ($kategori) {
            $kategori->updated_by = Auth::id();
        });
    }
}
