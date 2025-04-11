@extends('components.layouts.app')

@section('title', 'Dashboard')

@section('content')

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://unpkg.com/lucide@latest"></script>
<h2>Chart Builder Dinamis</h2>

    <label for="configSelect">Pilih Konfigurasi Chart:</label>
    <select id="configSelect">
        <option value="">-- Pilih --</option>
        @foreach ($configs as $config)
            <option value="{{ $config->id }}">{{ $config->judul }}</option>
        @endforeach
    </select>

    <br><br>
    <canvas id="myChart" width="400" height="200"></canvas>

    <script>
        let chart; // Global chart

        document.getElementById('configSelect').addEventListener('change', function () {
            const configId = this.value;
            if (!configId) return;
            fetch(`/chart/data/${configId}`)
                .then(response => response.json())
                .then(chartData => {
                    const ctx = document.getElementById('myChart').getContext('2d');

                    if (chart) chart.destroy(); // Hapus chart sebelumnya

                    chart = new Chart(ctx, chartData);
                })
                .catch(error => console.error("Error loading chart:", error));
        });
    </script>
    @endsection