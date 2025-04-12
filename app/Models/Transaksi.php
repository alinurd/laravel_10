<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Traits\GlobalDataTrait;

class Transaksi extends Model
{
    use HasFactory, GlobalDataTrait;

    protected $table = 'transaksi';
    protected $fillable = ['tgl', 'jenis', 'kategori', 'nominal', 'deks', 'file', 'rekening'];
    public $timestamps = true;
    protected $keyType = 'int';
    
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
