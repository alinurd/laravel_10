<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\ChartConfig;

class ChartController extends Controller
{
    public function index()
    {
        $configs = ChartConfig::all();
        return view('pages.dashboard.chart.index', compact('configs'));
    }

    public function chartBuilderData($id)
    {
        $chartConfig = ChartConfig::find($id);
        if (!$chartConfig) {
            abort(404, "Chart config tidak ditemukan");
        }

        $operasi = strtolower($chartConfig->operasi);
        $kelompok = $chartConfig->kelompok;
        $dataId = $chartConfig->data_id;

        switch ($kelompok) {
            case 'bulan':
                $groupBy = DB::raw('DATE_FORMAT(tgl, "%m-%M")');
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
            ->groupBy(DB::raw($labelFormat))
            ->orderBy(DB::raw($labelFormat))
            ->get();

        $labels = $data->pluck('label');
        $values = $data->pluck('value');

        $chartData = [
            'type' => $chartConfig->jenis,
            'data' => [
                'labels' => $labels,
                'datasets' => [[
                    'label' => $chartConfig->label ?? 'Dataset',
                    'data' => $values,
                    'backgroundColor' => ['#f87171', '#60a5fa', '#34d399'],
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
