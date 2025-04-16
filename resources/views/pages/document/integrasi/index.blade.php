@extends('components.layouts.app')

@section('title', 'Monitoring Termin')

@section('breadcrumb')
<x-dashboard.breadcrumb title="CEK API" page="API" active="GET" route="#" />
@endsection
 
@section('content')
    <div class="container">
        <h2>Daftar Dokument</h2>

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>KODE</th>
                    <th>NAMA</th>
                    <th>NILAI</th>
                </tr>
            </thead>
            <tbody>
                @foreach($dokuments as $d)
                    <tr>
                        <td>{{ $d['id'] }}</td>
                        <td>{{ $d['kode'] }}</td>
                        <td>{{ $d['jenis_product'] ?? '-' }}</td>
                        <td>{{ $d['nilai'] ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
