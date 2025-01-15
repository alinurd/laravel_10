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
        return $this->chart->barChart() 
            ->addData('Approved', [6, 9, 3, 4, 10, 8])
            ->addData('Reject', [7, 3, 8, 2, 6, 4])
            ->setColors(['#0ab39c', '#f06548'])
            ->setXAxis(['January', 'February', 'March', 'April', 'May', 'June']);
    }
}
