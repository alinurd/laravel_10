<?php

namespace App\Models; 

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori'; // Pastikan sesuai dengan nama tabel di database
        protected $fillable = ['nama', 'status']; 
    public $timestamps = true;
    protected $keyType = 'int'; 

    // Event untuk mengisi created_by dan updated_by otomatis
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($kategori) {
            $kategori->created_by = Auth::id(); // Ambil ID user yang sedang login
        });

        static::updating(function ($kategori) {
            $kategori->updated_by = Auth::id(); // Ambil ID user yang mengupdate
        });
    }
}

