<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;

class SertifikatTahunanChartBar
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
         $approvedCounts = \App\Models\DocFerifyDetail::selectRaw('YEAR(created_at) as year, COUNT(*) as total')
            ->where('review', '=', 1)
            ->groupBy('year')
            ->orderBy('year', 'asc')
            ->pluck('total', 'year')
            ->toArray();
    
         $rejectCounts = \App\Models\DocFerifyDetail::selectRaw('YEAR(created_at) as year, COUNT(*) as total')
            ->where('review', '=', 0)
            ->groupBy('year')
            ->orderBy('year', 'asc')
            ->pluck('total', 'year')
            ->toArray();
    
         $currentYear = date('Y');
        $years = range(2020, $currentYear);
    
         $approvedData = array_replace(array_fill_keys($years, 0), $approvedCounts);
        $rejectData = array_replace(array_fill_keys($years, 0), $rejectCounts);
    
         return $this->chart->barChart()
            ->addData('Approved', array_values($approvedData))
            ->addData('Reject', array_values($rejectData))
            ->setXAxis($years) 
            ->setColors(['#0ab39c', '#f06548'])
            ->setTitle('Data Sertifikat Tahunan')
            ->setSubtitle('Approved vs Reject dari tahun 2020 hingga sekarang');
    }
    
}
 