<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ChartDetail extends Model
{
    use HasFactory;

    protected $table = 'chart_details';

    protected $fillable = [
        'chart_id',
        'judul',
        'type',
        'labels',
        'data_chart',
        'label',
        'color',
        'border_color',
        'fill',
        'tension',
    ];

    protected $casts = [
        'labels' => 'array',
        'data_chart' => 'array',
        'color' => 'array',
        'border_color' => 'array',
        'fill' => 'boolean',
        'tension' => 'float',
    ];

    public function chart()
    {
        return $this->belongsTo(Chart::class, 'chart_id');
    }
}
