@extends('components.layouts.app')

@section('title', 'Dashboard')

@section('content')
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://unpkg.com/lucide@latest"></script>  

<style>
  :root {
    --primary: #4f46e5;
    --accent: #10b981;
    --bg: #f9fafb;
    --card-bg: #ffffff;
    --shadow: 0 4px 10px rgba(0,0,0,0.05);
    --border-radius: 16px;
  }
  body {
    font-family: 'Segoe UI', sans-serif;
    background-color: var(--bg);
  }
  h2 {
    color: #111827;
    margin-bottom: 20px;
  }
  .top-cards {
    display: flex;
    gap: 20px;
    overflow-x: auto;
    padding-bottom: 10px;
    margin-bottom: 30px;
    scroll-snap-type: x mandatory;
  }
  .top-cards .card {
    flex: 0 0 auto;
    min-width: 220px;
    scroll-snap-align: start;
  }
  .top-cards::-webkit-scrollbar {
    height: 8px;
  }
  .top-cards::-webkit-scrollbar-thumb {
    background-color: #cbd5e1;
    border-radius: 10px;
  }
  .top-cards::-webkit-scrollbar-track {
    background-color: transparent;
  }

  .bottom-cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
  }
  .card {
    background: var(--card-bg);
    border-radius: var(--border-radius);
    box-shadow: var(--shadow);
    padding: 20px;
    position: relative;
    transition: transform 0.2s ease;
  }
  .card:hover {
    transform: translateY(-4px);
  }
  .card h4 {
    margin: 0;
    font-size: 16px;
    color: #374151;
  }
  .value {
    font-size: 24px;
    font-weight: 600;
    margin-top: 5px;
    color: var(--primary);
  }
  .icon {
    position: absolute;
    top: 15px;
    right: 15px;
    color: #9ca3af;
  }
  canvas {
    margin-top: 10px;
  }
</style>

<h2>📊 Dashboard Keuangan</h2> 

<div class="bottom-cards"> 
 
@foreach ($charts as $chart)
    <h3>{{ $chart->name }} ({{ ucfirst($chart->jenis) }})</h3>
    @foreach ($chart->details as $detail)
    <div class="card">
        <h4>{{ $detail->judul }}</h4>
        <canvas id="chart_{{ $detail->id }}"></canvas>

        <script>
            new Chart(document.getElementById('chart_{{ $detail->id }}'), {
                type: '{{ $detail->type }}',
                data: {
                    labels: {!! json_encode($detail->labels) !!},
                    datasets: [{
                        label: '{{ $detail->label }}',
                        data: {!! json_encode($detail->data_chart) !!},
                        backgroundColor: {!! json_encode($detail->color) !!},
                        borderColor: {!! json_encode($detail->border_color) !!},
                        tension: {{ $detail->tension }},
                        fill: {{ $detail->fill ? 'true' : 'false' }},
                        pointRadius: 4,
                        pointHoverRadius: 6
                    }]
                },
                options: {
                    plugins: { legend: { display: true } },
                    scales: { y: { beginAtZero: true } }
                }
            });
        </script>
    </div> 
    @endforeach
    @endforeach
</div> 
 
@endsection
