<?php
// app/Models/ChartConfig.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChartConfig extends Model
{
    use HasFactory;
    protected $table = 'chart_configs';  
    protected $keyType = 'int'; 

    
    protected $fillable = [
        'kelompok',
        'data_id',
        'operasi',
        'datasets'
    ];

    protected $casts = [
        'datasets' => 'array'
    ];
}