<?php

namespace App\Http\Controllers;

use App\Charts\MonthlyUsersChart;
use App\Charts\SertifikatNominalChartline;
use App\Charts\SertifikatTahunanChartBar;
use App\Models\Chart;
use App\Models\ChartConfig;
use App\Models\DocFerifyDetail;
use App\Models\DocFerifyHeader;
use App\Models\Piutang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     /**
      * Undefined function
      * 
      * @return Type Returns data of type Type
      */

      public function index(SertifikatTahunanChartBar $chartBar, SertifikatNominalChartline $chartLine)
      {
          // Ambil APP_NAME dari config
          $appName = config('app.name'); // Pastikan APP_NAME diset di config/app.php atau di .env
      
          if ($appName === 'Keuangan') {
              $charts = Chart::with('details')
                  ->where('status', 1)
                  ->get();
      
              return view('pages.dashboard.chartDinamis', ['charts' => $charts]);
          } else {
              $year = request()->get('year', null);  
              $data['year'] = $year;
      
              $data['totalNilaiProduct'] = DocFerifyHeader::selectRaw("SUM(REPLACE(REPLACE(nilai, '.', ''), ',', '.')) as total")
                  ->when($year, function($query) use ($year) {
                      return $query->whereYear('created_at', $year);
                  })
                  ->value('total');
           
              $data['totalSerti'] = DocFerifyDetail::when($year, function($query) use ($year) {
                      return $query->whereYear('created_at', $year);
                  })->count(); 
      
              $data['totalReject'] = DocFerifyDetail::where('review', 3)
                  ->when($year, function($query) use ($year) {
                      return $query->whereYear('created_at', $year);
                  })->count(); 
      
              $data['totalApprv'] = DocFerifyDetail::where('review', 1)
                  ->when($year, function($query) use ($year) {
                      return $query->whereYear('created_at', $year);
                  })->count();
      
              $data['totalReview'] = DocFerifyDetail::where('review', 0)
                  ->when($year, function($query) use ($year) {
                      return $query->whereYear('created_at', $year);
                  })->count();
           
              $data['chartBar'] = $chartBar->build();
              $data['chartLine'] = $chartLine->build();
      
              return view('pages.dashboard.index', $data);
          }
      }
      


      /**
       * Undefined function
       * 
       * @return Type Returns data of type Type
       */
      public function chartBuilder()
      {
          $chartConfig = ChartConfig::where('module', 'transaksi')
              ->where('kelompok', 'bulan')
              ->first(); // anggap satu dulu
      
          if (!$chartConfig) {
              abort(404, "Chart config tidak ditemukan");
          }
      
          $operasi = strtolower($chartConfig->operasi); // SUM, AVG, COUNT, dll
          $kelompok = $chartConfig->kelompok; // 'bulan'
          $dataId = $chartConfig->data_id; // 'nominal'
      
          // Tentukan format label dan groupBy berdasarkan kelompok
          switch ($kelompok) {
              case 'bulan':
                  $groupBy = DB::raw('MONTH(tgl)');
                  $labelFormat = 'DATE_FORMAT(tgl, "%M")';
                  break;
              case 'tahun':
                  $groupBy = DB::raw('YEAR(tgl)');
                  $labelFormat = 'YEAR(tgl)';
                  break;
              default:
                  $groupBy = DB::raw($kelompok);
                  $labelFormat = $kelompok;
          }
       
        $data = DB::table('transaksi')
        ->select([
            DB::raw($labelFormat . ' as label'),
            DB::raw(strtoupper($operasi) . "($dataId) as value")
        ])
        ->groupBy(DB::raw($labelFormat)) // pakai labelFormat, bukan MONTH()
        ->orderBy(DB::raw($labelFormat))
        ->get();

      
          $labels = $data->pluck('label');
          $values = $data->pluck('value');
      
          $chartData = [
              'type' => $chartConfig->jenis, // 'bar', 'polarArea', etc
              'data' => [
                  'labels' => $labels,
                  'datasets' => [[
                      'label' => $chartConfig->label ?? 'Dataset',
                      'data' => $values,
                      'backgroundColor' => ['#f87171', '#60a5fa', '#34d399'], // contoh warna
                      'borderColor' => '#000',
                      'borderWidth' => 1,
                  ]]
              ],
              'options' => [
                  'responsive' => true,
                  'plugins' => [
                      'legend' => ['position' => 'top'],
                      'title' => [
                          'display' => true,
                          'text' => $chartConfig->judul ?? 'Judul Grafik',
                      ],
                  ],
              ]
          ];
      
          return response()->json($chartData);
      }
      
       
   
}
