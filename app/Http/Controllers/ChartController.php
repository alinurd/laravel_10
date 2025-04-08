<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    public function index()
    {
        return view('chart-builder');
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

