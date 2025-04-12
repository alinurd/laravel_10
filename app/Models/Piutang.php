<?php

namespace App\Models; 

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Piutang extends Model
{
    use HasFactory;

    protected $table = 'piutang';  
        protected $fillable = ['tgl', 'jenis', 'kategori', 'nominal', 'deks', 'file', 'rekening', 'stackholder']; 
    public $timestamps = true;
    protected $keyType = 'int'; 
 

    public function stackholder()
{
    return $this->belongsTo(Stakeholder::class, 'stackholder');
}


public static function getChartDataForPolarArea()
{
    return self::where('piutang.jenis', 45)
        ->join('stakeholders', 'piutang.stackholder', '=', 'stakeholders.id')
        ->select(
            DB::raw('stakeholders.name as stakeholder_name'),
            DB::raw('stakeholders.pic as stakeholder_pic'),
            DB::raw('SUM(nominal) as total_nominal')
        )
        ->groupBy('piutang.stackholder', 'stakeholders.name', 'stakeholders.pic')
        ->get()
        ->map(function ($item) {
            return [
                'stackholder' => $item->stakeholder_name ?? $item->stakeholder_pic ?? 'Unknown',
                'total_nominal' => (int) $item->total_nominal,
            ];
        });
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

