<?php

namespace App\Models; 

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Chart extends Model
{
    use HasFactory;

    protected $table = 'charts';  
    protected $fillable = ['name', 'jenis', 'status', 'jenis']; 
    public $timestamps = true;
    protected $keyType = 'int'; 
 


// app/Models/Stakeholder.php

public function jenisCombo()
{
    return $this->belongsTo(Combo::class, 'jenis');
}
 
public function details()
    {
        return $this->hasMany(ChartDetail::class, 'chart_id');
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

