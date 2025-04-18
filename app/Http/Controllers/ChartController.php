<?php
namespace App\Http\Controllers;

use App\Models\Chart;
use Illuminate\Support\Facades\DB;
use App\Models\ChartConfig;
use App\Traits\ChartTrait;

class ChartController extends Controller
{
    use ChartTrait;
    public function index()
    {
        $configs = ChartConfig::all();
        $defaultCharts = ChartConfig::getDefaultCharts();
        return view('pages.dashboard.chart.index', compact('configs', 'defaultCharts'));
    }



    public function chartBuilderData($id)
        {
            $chartConfig = ChartConfig::find($id);
            if (!$chartConfig) {
                abort(404, "Chart config tidak ditemukan");
            } 
     
            $chartData = $this->getTraitChartId($chartConfig);           
            return response()->json($chartData);
        }


    public function chartBuilderData_($id)
    {
        $chartConfig = ChartConfig::find($id);
        if (!$chartConfig) {
            abort(404, "Chart config tidak ditemukan");
        }

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

        return response()->json($chartData);
    }



    public function getData(Request $request)
    {
        $x = $request->x_axis;
        $y = $request->y_axis;
        $start = $request->start_date;
        $end = $request->end_date;

        $query = DB::table('transaksis')
            ->select($x, DB::raw("SUM($y) as total"))
            ->groupBy($x)
            ->orderBy($x);

        if ($start && $end) {
            $query->whereBetween('tanggal', [$start, $end]);
        }

        $data = $query->get();

        return response()->json([
            'type' => $request->chart_type,
            'label' => "Total " . ucfirst($y),
            'labels' => $data->pluck($x),
            'data' => $data->pluck('total'),
        ]);
    }
}
