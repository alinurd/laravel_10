<?php

namespace App\Models; 

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Stakeholder extends Model
{
    use HasFactory;

    protected $table = 'Stakeholder';  
    protected $fillable = ['name', 'pic', 'status', 'jenis']; 
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

