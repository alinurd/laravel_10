@extends('components.layouts.app')

@section('title', 'Dashboard')
@section('breadcrumb')
    <x-dashboard.breadcrumb :title="'Dashboard'" :page="'Dashboard'" :active="'Dashboard'" :route="route('dashboard.index')" />
@endsection
@section('content')
    <div class="row">
        <div class="col-3 card">
            <div class="card-body">
                <h5 class="card-title">Table Data Alternatif</h5>
                <table class="table table-hover table-bordered table-sm">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Kode</th>
                            <th scope="col">Nama</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($chanel as $index => $p)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $p['kode'] }}</td>
                                <td>{{ $p['nama'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-9 card">
            <div class="card-body">
                <h5 class="card-title">Table Bobot Kriteria</h5>
                <table class="table table-hover table-bordered table-sm">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Atribut</th>
                            <th>Bobot</th>
                            <th>Bobot Normalisasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kriteria['data'] as $index => $p)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $p['kode'] }}</td>
                                <td>{{ $p['nama'] }}</td>
                                <td>{{ $p['atribut'] == 1 ? 'Cost' : 'Benefit' }}</td>
                                <td>{{ $p['bobot'] }}</td>
                                <td>{{ $p['bobot_normalisasi'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="table-light">
                        <tr>
                            <th colspan="4" class="text-center">TOTAL</th>
                            <th>{{ collect($kriteria['data'])->sum('bobot') }}</th>
                            <th>{{ $p['bobot_normalisasi'] }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    {{-- Tabel Detail --}}
    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title">Table Nilai Alternatif per Kriteria</h5>
            <table class="table table-hover table-bordered table-sm">
                <thead class="table-light">
                    <tr>
                        <th>Alternatif</th>
                        @foreach ($kriteria['data'] as $p)
                            <th class="text-center">{{ $p['nama'] }}<br>
                            <i>({{ $p['atribut'] == 1 ? 'Cost' : 'Benefit' }})</i></th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($chanel as $c)
                        <tr>
                            <td>{{ $c['nama'] }}</td>
                            @foreach ($kriteria['data'] as $p)
                                <td>
                                    @php
                                        $nilai = collect($jawaban)->firstWhere(fn($j) => $j['chanel_id'] == $c['id'] && $j['kriteria_id'] == $p['id'])['nilai'] ?? '-';
                                    @endphp
                                    {{ $nilai }}
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="table-light">
                    <tr>
                        <th>Pembagi</th>
                        @foreach ($kriteria['data'] as $p)
                            @php
                                $nilaiKriteria = collect($jawaban)->where('kriteria_id', $p['id'])->pluck('nilai')->filter();
                                // $pembagi = $p['atribut'] == 1 ? $nilaiKriteria->min() : $nilaiKriteria->max();
                                $pembagi = $p['atribut'] == 1 ? 1 : 3;
                            @endphp
                            <th>{{ $pembagi }}</th>
                        @endforeach
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    {{-- Tabel Normalisasi --}}
    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title">Table Normalisasi</h5>
            <table class="table table-hover table-bordered table-sm">
                <thead class="table-light">
                    <tr>
                        <th>Alternatif</th>
                        @foreach ($kriteria['data'] as $p)
                            <th class="text-center">{{ $p['nama'] }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($chanel as $c)
                        <tr>
                            <td>{{ $c['nama'] }}</td>
                            @foreach ($kriteria['data'] as $p)
                                @php
                                    $nilai = collect($jawaban)->firstWhere(fn($j) => $j['chanel_id'] == $c['id'] && $j['kriteria_id'] == $p['id'])['nilai'] ?? 0;
                                    $nilaiKriteria = collect($jawaban)->where('kriteria_id', $p['id'])->pluck('nilai')->filter();
                                    $pembagi = $p['atribut'] == 1 ? 1 : 3;
                                    $normalisasi = $pembagi ? ($p['atribut'] == 1 ? $pembagi / $nilai : $nilai / $pembagi) : 0;
                                @endphp
                                <td>{{ $normalisasi }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@php
    $pembagiKriteria = [];
    foreach ($kriteria['data'] as $p) {
        $nilaiKriteria = collect($jawaban)
            ->where('kriteria_id', $p['id'])
            ->pluck('nilai')
            ->filter()
            ->all();

        $pembagiKriteria[$p['id']] = !empty($nilaiKriteria)
            ? ($p['atribut'] == 1 ?1 : 3)
            : 1; // fallback
        // $pembagiKriteria[$p['id']] = !empty($nilaiKriteria)
        //     ? ($p['atribut'] == 1 ? min($nilaiKriteria) : max($nilaiKriteria))
        //     : 1; // fallback
    }

    $hasilSkor = [];
    foreach ($chanel as $c) {
        $totalSkor = 0;
        foreach ($kriteria['data'] as $p) {
            $nilai = collect($jawaban)->first(function ($j) use ($c, $p) {
                return $j['chanel_id'] == $c['id'] && $j['kriteria_id'] == $p['id'];
            })['nilai'] ?? 0;

            $normalisasi = $p['atribut'] == 1
                ? ($pembagiKriteria[$p['id']] != 0 ? $pembagiKriteria[$p['id']] / $nilai : 0)
                : ($pembagiKriteria[$p['id']] != 0 ? $nilai / $pembagiKriteria[$p['id']] : 0);

            $totalSkor += $normalisasi * $p['bobot_normalisasi'];
        }
        $hasilSkor[] = [
            'nama' => $c['nama'],
            'skor' => round($totalSkor, 4),
        ];
    }

    $ranking = collect($hasilSkor)->sortByDesc('skor')->values()->all();
@endphp

<div class="card mt-4">
    <div class="card-body">
        <h5 class="card-title">Tabel Ranking Hasil SAW</h5>
        <table class="table table-bordered table-hover mb-0">
            <thead class="thead-dark">
                <tr>
                    <th>Ranking</th>
                    <th>Nama Alternatif</th>
                    <th>Skor Akhir</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ranking as $i => $r)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $r['nama'] }}</td>
                        <td>{{ $r['skor'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

    {{-- Penjelasan Metode --}}
    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title">Penjelasan Metode dan Rumus SAW</h5>
            <p><strong>1. Bobot Normalisasi:</strong> <br>
                <code>bobot_normalisasi = bobot_kriteria / total_bobot</code>
            </p>
            <p><strong>2. Normalisasi Nilai Alternatif:</strong><br>
                Jika Atribut <code>Benefit</code>: <code>nilai_normalisasi = nilai / nilai_terbesar</code><br>
                Jika Atribut <code>Cost</code>: <code>nilai_normalisasi = nilai_terkecil / nilai</code>
            </p>
            <p><strong>3. Skor Akhir:</strong><br>
                <code>skor = Σ (nilai_normalisasi × bobot_normalisasi)</code>
            </p>
            <p><strong>4. Ranking:</strong> <br>
                Urutkan skor dari terbesar ke terkecil untuk menentukan alternatif terbaik.
            </p>
        </div>
    </div>
@endsection