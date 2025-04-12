<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


trait ChartTrait
{

    public static function getTraitChartArr($chartConfigs = [], $val = [])
    {
        $chartData = [];
    
        foreach ($chartConfigs as $chartConfig) {
            $operasi = strtolower($chartConfig->operasi);
            $kelompok = $chartConfig->kelompok;
            $dataId = $chartConfig->data_id;
    
            $datasetConfig = is_string($chartConfig->datasets)
                ? json_decode($chartConfig->datasets, true)
                : $chartConfig->datasets;
    
            $labelData = collect($datasetConfig)->pluck('label')->toArray();
            $backgroundColors = collect($datasetConfig)->pluck('backgroundColor')->toArray();
    
            switch ($kelompok) {
                case 'bulan':
                    $labelFormat = 'DATE_FORMAT(tgl, "%M")';
                    $orderFormat = 'MONTH(tgl_urutan)';
                    break;
                case 'tahun':
                    $labelFormat = 'YEAR(tgl)';
                    $orderFormat = 'YEAR(tgl_urutan)';
                    break;
                default:
                    $labelFormat = $kelompok;
                    $orderFormat = $kelompok;
            }
    
            // Subquery utama
            $subQuery = DB::table('transaksi')
                ->select([
                    DB::raw("$labelFormat as label"),
                    DB::raw(strtoupper($operasi) . "($dataId) as value"),
                    DB::raw("MIN(tgl) as tgl_urutan")
                ])
                ->when(isset($val['year']), fn($q) => $q->whereYear('tgl', $val['year']))
                ->when(isset($val['category']), fn($q) => $q->where('kategori', $val['category']))
                ->groupBy(DB::raw($labelFormat));
    
            // Bungkus subquery
            $rawData = DB::table(DB::raw("({$subQuery->toSql()}) as sub"))
                ->mergeBindings($subQuery)
                ->orderByRaw($orderFormat)
                ->get()
                ->keyBy('label');
    
            // Susun data sesuai label dari dataset config
            $values = [];
            foreach ($labelData as $label) {
                $values[] = isset($rawData[$label]) ? $rawData[$label]->value : 0;
            }
    
            $chart = [
                'type' => $chartConfig->jenis,
                'data' => [
                    'labels' => $labelData,
                    'datasets' => [[
                        'label' => $chartConfig->label ?? 'Dataset',
                        'data' => $values,
                        'backgroundColor' => $backgroundColors,
                        'borderColor' => '#000',
                        'borderWidth' => 1,
                    ]]
                ],
                'options' => [
                    'responsive' => true,
                    'maintainAspectRatio' => false,
                    'layout' => [
                        'padding' => 30,
                    ],
                    'plugins' => [
                        'legend' => [
                            'position' => 'bottom',
                        ],
                        'title' => [
                            'display' => true,
                            'text' => $chartConfig->judul ?? 'Judul Grafik',
                        ],
                    ],
                    'scales' => in_array($chartConfig->jenis, ['bar', 'line']) ? [
                        'y' => ['beginAtZero' => true],
                        'x' => ['beginAtZero' => true],
                    ] : null,
                    'elements' => [
                        'arc' => in_array($chartConfig->jenis, ['doughnut', 'pie', 'polarArea']) ? [
                            'borderWidth' => 1,
                            'spacing' => 0,
                        ] : [],
                    ],
                    'rotation' => $chartConfig->jenis == 'polarArea' ? -0.5 * M_PI : 0,
                ]
            ];
    
            $key = $chartConfig->getparent
                ? $chartConfig->getparent->name . ' - ' . $chartConfig->getparent->jenis
                : 'Tanpa Parent';
    
            $chartData[$key][] = $chart;
        }
    
        return $chartData;
    }
    


    public static function getTraitChartId($chartConfig){


        $operasi = strtolower($chartConfig->operasi);
        $kelompok = $chartConfig->kelompok;
        $dataId = $chartConfig->data_id;

       
          // Ambil konfigurasi warna & label dari kolom datasets (json)
          $datasetConfig = is_string($chartConfig->datasets)
          ? json_decode($chartConfig->datasets, true)
          : $chartConfig->datasets;

      $labelData = collect($datasetConfig)->pluck('label')->toArray();
      $backgroundColors = collect($datasetConfig)->pluck('backgroundColor')->toArray();

      // Tentukan label dan groupBy berdasarkan kelompok
      switch ($kelompok) {
          case 'bulan':
              $labelFormat = 'DATE_FORMAT(tgl, "%M")';
              $orderFormat = 'MONTH(tgl_urutan)';
              break;
          case 'tahun':
              $labelFormat = 'YEAR(tgl)';
              $orderFormat = 'YEAR(tgl_urutan)';
              break;
          default:
              $labelFormat = $kelompok;
              $orderFormat = $kelompok;
      }

      // Query data transaksi dengan filter berdasarkan pilihan
      $rawData = DB::table('transaksi')
          ->select([
              DB::raw("$labelFormat as label"),
              DB::raw(strtoupper($operasi) . "($dataId) as value"),
              DB::raw("MIN(tgl) as tgl_urutan")
          ])
          ->groupBy(DB::raw($labelFormat))
          ->orderBy(DB::raw($orderFormat));

      // Jika ada parameter pilihan data (misalnya tahun atau kategori)
      if (isset($val['year'])) {
          $rawData->whereYear('tgl', $val['year']);  // Filter berdasarkan tahun
      }
      if (isset($val['category'])) {
          $rawData->where('kategori', $val['category']);  // Filter berdasarkan kategori
      }

      $rawData = $rawData->get()->keyBy('label');  // untuk matching dengan label dari config

      // Siapkan nilai chart berdasarkan urutan label dari config
      $values = [];
      foreach ($labelData as $label) {
          $values[] = isset($rawData[$label]) ? $rawData[$label]->value : 0;
      }
        $chartData = [
            'type' => $chartConfig->jenis,
            'data' => [
                'labels' => $labelData,
                'datasets' => [[
                    'label' => $chartConfig->label ?? 'Dataset',
                    'data' => $values,
                    'backgroundColor' => $backgroundColors,
                    'borderColor' => '#000',
                    'borderWidth' => 1,
                ]]
            ],
            'options' => [
                'responsive' => true,
                'maintainAspectRatio' => false,
                'layout' => [
                    'padding' => 15,
                ],
                'plugins' => [
                    'legend' => [
                        'position' => 'bottom',
                    ],
                    'title' => [
                        'display' => true,
                        'text' => $chartConfig->judul ?? 'Judul Grafik',
                    ],
                ],
                'scales' => in_array($chartConfig->jenis, ['bar', 'line']) ? [
                    'y' => [
                        'beginAtZero' => true,
                    ],
                    'x' => [
                        'beginAtZero' => true,
                    ],
                ] : null,
                'elements' => [
                    'arc' => in_array($chartConfig->jenis, ['doughnut', 'pie', 'polarArea']) ? [
                        'borderWidth' => 1,
                        'spacing' => 0,
                    ] : [],
                ],
                'rotation' => $chartConfig->jenis == 'polarArea' ? -0.5 * M_PI : 4,
            ]
        ]; 

        return $chartData;
    }
}
