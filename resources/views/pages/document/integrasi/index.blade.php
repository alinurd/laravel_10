@extends('layouts.app')

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
                    <th>Nama</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($dokuments as $d)
                    <tr>
                        <td>{{ $d['id'] }}</td>
                        <td>{{ $d['nama'] ?? '-' }}</td>
                        <td>{{ $d['keterangan'] ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
