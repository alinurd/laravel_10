<?php

namespace App\Http\Controllers;

use App\Charts\MonthlyUsersChart;
use App\Charts\SertifikatNominalChartline;
use App\Charts\SertifikatTahunanChartBar;
use App\Models\Chanel;
use App\Models\Chart;
use App\Models\ChartConfig;
use App\Models\DocFerifyDetail;
use App\Models\DocFerifyHeader;
use App\Models\Jawaban;
use App\Models\Kriterium;
use App\Models\Piutang;
use Illuminate\Http\Request;

 use App\Models\SawModel;

use Illuminate\Support\Facades\DB;
class DashboardController extends Controller
{ 
      public function index(SertifikatTahunanChartBar $chartBar, SertifikatNominalChartline $chartLine)
      {
          // Ambil APP_NAME dari config
          $appName = config('app.name'); // Pastikan APP_NAME diset di config/app.php atau di .env
           $data['kriteria']['count'] = Kriterium::getCountData();
           $kriteria = Kriterium::all(); 
            $data['kriteria']['data'] = $this->getNormalisasiBobot($kriteria);  

          $data['chanel'] = Chanel::where('status',1)->get(); 
          $data['jawaban']=Jawaban::all(); 

      
              return view('pages.dashboard.index', $data);
          
      }
      
     function getNormalisasiBobot($kriteria)
{
    // contoh normalisasi: total bobot jadi 1
    $total = $kriteria->sum('bobot');

    return $kriteria->map(function ($item) use ($total) {
        $item->bobot_normalisasi = $total > 0 ? $item->bobot / $total : 0;
        return $item;
    });
}


public function showForm()
{
    $alternatif = Chanel::where('status',1)->get()->toArray();
$kriteria = Kriterium::with('getSubKriteria')->where('status', 1)->get()->toArray();

    return view('pages.dashboard.saw.landing.index', compact('alternatif', 'kriteria'));
}

public function prosesForm(Request $request)
{
    $nilaiInput = $request->input('nilai');
    // Format jawaban
    $jawaban = [];
    foreach ($nilaiInput as $altId => $kriteriaList) {
        foreach ($kriteriaList as $kritId => $nilai) {
            $jawaban[] = [
                'user' => $request->user_name,
                'chanel_id' => $altId,
                'kriteria_id' => $kritId,
                'nilai' => intval($nilai),
            ];
        }
    }
    DB::table('jawaban')->insert($jawaban); 
    $alternatif = Chanel::all()->toArray();
    $kriteria = Kriterium::whit('getSubKirteria')->all()->map(function ($k) {
        $k['bobot_normalisasi'] = $k->bobot / Kriterium::sum('bobot');
        return $k;
    })->toArray();
 
    $hasil = SawModel::hitungRanking($alternatif, $kriteria, $jawaban);

    return redirect()->back()->with('hasil', $hasil);
}

public function hasil()
{
     $alternatif = Chanel::all()->toArray();
    $kriteria = Kriterium::all()->map(function ($k) {
        $k['bobot_normalisasi'] = $k->bobot / Kriterium::sum('bobot');
        return $k;
    })->toArray();
    
    $jawaban = Jawaban::all()->toArray();

    $hasil = SawModel::hitungRanking($alternatif, $kriteria, $jawaban);

    return view('saw.hasil', compact('hasil', 'kriteria'));
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
