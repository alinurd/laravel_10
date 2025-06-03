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
            $nilaiKriteria = collect($jawaban)
                ->where('kriteria_id', $k['id'])
                ->pluck('nilai')
                ->filter();

            $pembagiKriteria[$k['id']] = $nilaiKriteria->isNotEmpty()
                ? ($k['atribut'] == 1 ? $nilaiKriteria->min() : $nilaiKriteria->max())
                : 1; // fallback 1 jika tidak ada data
        }

        $normalisasi = [];
        foreach ($chanel as $c) {
            foreach ($kriteria['data'] as $k) {
                $nilai = collect($jawaban)->firstWhere(fn($j) => $j['chanel_id'] == $c['id'] && $j['kriteria_id'] == $k['id'])['nilai'] ?? 0;
                $pembagi = $pembagiKriteria[$k['id']] ?? 1;

                if ($k['atribut'] == 1) { // Cost
                    $nilaiNormalisasi = $nilai != 0 ? $pembagi / $nilai : 0;
                } else { // Benefit
                    $nilaiNormalisasi = $pembagi != 0 ? $nilai / $pembagi : 0;
                }

                $normalisasi[$c['id']][$k['id']] = $nilaiNormalisasi;
            }
        }

        $hasilSkor = [];
        foreach ($chanel as $c) {
            $totalSkor = 0;
            foreach ($kriteria['data'] as $k) {
                $nilaiNormalisasi = $normalisasi[$c['id']][$k['id']] ?? 0;
                $totalSkor += $nilaiNormalisasi * $k['bobot_normalisasi'];
            }
            $hasilSkor[] = [
                'nama' => $c['nama'],
                'skor' => round($totalSkor, 4),
            ];
        }

        $ranking = collect($hasilSkor)->sortByDesc('skor')->values()->all();
    @endphp

    {{-- Komponen --}}
    @include('pages.dashboard.saw._tabel_nilai')
    @include('pages.dashboard.saw._tabel_normalisasi')
    @include('pages.dashboard.saw._tabel_ranking')
    @include('pages.dashboard.saw._penjelasan')

</div>
@endsection
