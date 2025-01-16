<?php

namespace App\Charts;

use App\Models\DocFerifyHeader;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class SertifikatNominalChartline
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\LineChart
    {
        $data = DocFerifyHeader::selectRaw('YEAR(created_at) as year, SUM(CAST(REPLACE(REPLACE(nilai, ".", ""), ",", ".") AS DECIMAL(10,2))) as total')
            ->groupBy('year')
            ->orderBy('year')
            ->get();
    
        $years = $data->pluck('year')->toArray();
        $totals = $data->pluck('total')->map(fn($value) => round($value, 2))->toArray();
    
        return $this->chart->lineChart() 
            ->addData('Total Nilai',  $totals)
            ->setXAxis($years)
            ->setOptions([
                'yaxis' => [
                    'labels' => [
                        'formatter' => function ($value) {
                            return number_format($value, 0, ',', '.'); // Format angka ribuan di Y-axis
                        },
                    ],
                ],
                'tooltip' => [
                    'y' => [
                        'formatter' => function ($value) {
                            return number_format($value, 0, ',', '.'); // Format angka di tooltip
                        },
                    ],
                ],
                'dataLabels' => [
                    'enabled' => true, // Menonaktifkan label data
                ],
                'chart' => [
                    'zoom' => [
                        'enabled' => true, // Nonaktifkan zoom jika tidak diperlukan
                    ],
                ],
            ]);
    }
    
}
