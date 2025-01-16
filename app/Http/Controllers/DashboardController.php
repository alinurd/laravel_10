<?php

namespace App\Http\Controllers;

use App\Charts\MonthlyUsersChart;
use App\Charts\SertifikatNominalChartline;
use App\Charts\SertifikatTahunanChartBar;
use App\Models\DocFerifyDetail;
use App\Models\DocFerifyHeader;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SertifikatTahunanChartBar $chartBar, SertifikatNominalChartline $chartLine)
    {
        $data['totalNilaiProduct'] = DocFerifyHeader::selectRaw("SUM(REPLACE(REPLACE(nilai, '.', ''), ',', '.')) as total")
        ->value('total');
            $data['totalSerti'] = DocFerifyDetail::count();
        $data['totalReject'] = DocFerifyDetail::where('review',3)->count();
        $data['totalApprv'] = DocFerifyDetail::where('review',1)->count();
        $data['totalReview'] = DocFerifyDetail::where('review',0)->count();
        $data['chartBar']= $chartBar->build();
        $data['chartLine']= $chartLine->build();
        return view('pages.dashboard.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
