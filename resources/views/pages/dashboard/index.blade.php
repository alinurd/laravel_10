@extends('components.layouts.app')

@section('title', 'Dashboard')
@section('breadcrumb')
    <x-dashboard.breadcrumb :title="'Dashboard'" :page="'Dashboard'" :active="'Dashboard'" :route="route('dashboard.index')" />
@endsection
@section('content')
    <div class="row">
        <div class="col-3 card ">
            <div class="card-body">
                <h5 class="card-title">Table Data Alternatif</h5>
                <table class="table table-hover table-nowrap mb-0">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Kode</th>
                            <th scope="col">Nama</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $n = 1; @endphp
                        @forelse ($chanel as $p)
                            <tr>
                                <td>{{ $n++ }}</td>
                                <td>{{ $p['kode'] }}</td>
                                <td>{{ $p['nama'] }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">Data kriteria tidak tersedia</td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>
        <div class="col-9 card ">
            <div class="card-body">
                <h5 class="card-title">Table Bobot Kriteria</h5>
                <table class="table table-hover table-nowrap mb-0">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Kode</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Atribut</th>
                            <th scope="col">Bobot</th>
                            <th scope="col">Bobot Normalisasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $n = 1; @endphp
                        @forelse ($kriteria['data'] as $p)
                            <tr>
                                <td>{{ $n++ }}</td>
                                <td>{{ $p['kode'] }}</td>
                                <td>{{ $p['nama'] }}</td>
                                <td>{{ $p['atribut'] }}</td>
                                <td>{{ $p['bobot'] }}</td>
                                <td>{{ $p['bobot_normalisasi'] }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Data kriteria tidak tersedia</td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <th scope="col" colspan="4" class="text-center">TOTAL : </th>
                        <th scope="col">{{ collect($kriteria['data'])->sum('bobot') }}</th>
                        <th scope="col">{{ collect($kriteria['data'])->sum('bobot_normalisasi') }}</th>

                    </tfoot>
                </table>
            </div>
        </div>
    </div>

     <div class="card ">
            <div class="card-body">
                <h5 class="card-title">Table Detail</h5>
               <table class="table table-hover table-nowrap mb-0">
    <thead>
        <tr>
            <th></th>
            @foreach ($kriteria['data'] as $p)
                <th>{{ number_format($p['bobot_normalisasi'], 4) }}</th>
            @endforeach
        </tr>
        <tr>
            <th>Nama Alternatif</th>
            @foreach ($kriteria['data'] as $p)
                <th>{{ $p['nama'] }} <br>({{ $p['atribut'] }})</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @forelse ($chanel as $c)
            <tr>
                <td>{{ $c['nama'] }}</td>
                @foreach ($kriteria['data'] as $p)
                    @php
                        $nilai = '-';
                        foreach ($jawaban as $j) {
                            if ($j['chanel_id'] == $c['id'] && $j['kriteria_id'] == $p['id']) {
                                $nilai = $j['nilai'];
                                break;
                            }
                        }
                    @endphp
                    <td>{{ $nilai }}</td>
                @endforeach
            </tr>
        @empty
            <tr>
                <td colspan="{{ count($kriteria['data']) + 1 }}" class="text-center">Data kriteria tidak tersedia</td>
            </tr>
        @endforelse
    </tbody>
</table>


            </div>
        </div>
@endsection
