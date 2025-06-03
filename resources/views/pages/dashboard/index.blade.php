@extends('components.layouts.app')

@section('title', 'Dashboard')
@section('breadcrumb')
    <x-dashboard.breadcrumb :title="'Dashboard'" :page="'Dashboard'" :active="'Dashboard'" :route="route('dashboard.index')" />
@endsection

@section('content')
    <div class="container">

        @php
            $pembagiKriteria = [];
            foreach ($kriteria['data'] as $k) {
                $nilaiKriteria = collect($jawaban)->where('kriteria_id', $k['id'])->pluck('nilai')->filter();

                $pembagiKriteria[$k['id']] = $nilaiKriteria->isNotEmpty()
                    ? ($k['atribut'] == 1
                        ? 1
                        : 3)
                    : // ? ($k['atribut'] == 1 ? $nilaiKriteria->min() : $nilaiKriteria->max())
                    1; // fallback 1 jika tidak ada data
            }

            $normalisasi = [];
            foreach ($chanel as $c) {
                foreach ($kriteria['data'] as $k) {
                    $nilai =
                        collect($jawaban)->firstWhere(
                            fn($j) => $j['chanel_id'] == $c['id'] && $j['kriteria_id'] == $k['id'],
                        )['nilai'] ?? 0;
                    $pembagi = $pembagiKriteria[$k['id']] ?? 1;
                    if ($k['atribut'] == 1) {
                        // Cost
                        $nilaiNormalisasi = $nilai != 0 ? $pembagi / $nilai : 0;
                        $rumus =
                            $nilai != 0
                                ? "$pembagi / $nilai = $nilaiNormalisasi"
                                : 'Nilai = 0, hasil normalisasi 0 (hindari pembagian nol)';
                    } else {
                        // Benefit
                        $nilaiNormalisasi = $pembagi != 0 ? $nilai / $pembagi : 0;
                        $rumus =
                            $pembagi != 0
                                ? "$nilai / $pembagi = $nilaiNormalisasi"
                                : 'Pembagi = 0, hasil normalisasi 0 (hindari pembagian nol)';
                    }

                    $normalisasi[$c['id']][$k['id']] = [
                        'val' => $nilaiNormalisasi,
                        'rumus' => $rumus,
                    ];
                }
            }
            

            $hasilSkor = [];

foreach ($chanel as $c) {
    $detailRumus = [];
    $totalSkor = 0;

    foreach ($kriteria['data'] as $k) {
        $nilaiNormalisasi = $normalisasi[$c['id']][$k['id']]['val'] ?? 0;
        $bobot = $k['bobot_normalisasi'];
        $hasil = $nilaiNormalisasi * $bobot;

        $totalSkor += $hasil;
        $detailRumus[] = "({$nilaiNormalisasi} × {$bobot}) = {$hasil}";
    }

    $hasilSkor[] = [
        'nama' => $c['nama'],
        'skor' => $totalSkor,
        'rumus' => implode('<br>', $detailRumus) . '<br><strong>Total Skor:</strong> ' . $totalSkor,
    ];
}





            $ranking = collect($hasilSkor)->sortByDesc('skor')->values()->all();
        @endphp

        {{-- Komponen --}}
        @include('pages.dashboard.saw._tabel_nilai')
        @include('pages.dashboard.saw._tabel_normalisasi')
        @include('pages.dashboard.saw._tabel_ranking')
        @include('pages.dashboard.saw._penjelasan')
        @include('pages.dashboard.saw.landing._css')

    </div>
@endsection
