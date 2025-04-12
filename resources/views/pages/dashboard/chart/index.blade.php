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
    --shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    --border-radius: 16px;
  }

  body {
    background-color: var(--bg);
  }

  .dashboard-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 30px 20px;
  }

  h2 {
    color: #111827;
    font-size: 2rem;
    font-weight: bold;
    margin-bottom: 25px;
  }

  label, select {
    font-size: 1rem;
    margin-bottom: 15px;
  }

  select {
    padding: 10px;
    border-radius: 10px;
    border: 1px solid #ccc;
  }

  .chart-group {
    background: var(--card-bg);
    border-radius: var(--border-radius);
    box-shadow: var(--shadow);
    padding: 25px;
    margin-bottom: 30px;
  }

  .chart-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    gap: 20px;
  }

  .chart-card {
    background: var(--card-bg);
    border-radius: 12px;
    padding: 20px;
    box-shadow: var(--shadow);
    transition: transform 0.2s ease;
  }

  .chart-card:hover {
    transform: translateY(-3px);
  }

  .chart-card h4 {
    font-size: 1.2rem;
    margin-bottom: 10px;
  }

  /* Modal */
  .modal {
    display: none;
    position: fixed;
    z-index: 100;
    left: 0; top: 0;
    width: 100%; height: 100%;
    background: rgba(0, 0, 0, 0.4);
    justify-content: center;
    align-items: center;
  }

  .modal-content {
    background: #fff;
    border-radius: var(--border-radius);
    padding: 25px;
    width: 90%;
    max-width: 700px;
    box-shadow: var(--shadow);
    position: relative;
  }

  .modal-close {
    position: absolute;
    top: 15px;
    right: 20px;
    cursor: pointer;
    font-size: 24px;
    color: #6b7280;
  }

  canvas {
    max-width: 100% !important;
    height: auto !important;
  }
  #chartModal{
    z-index: 999;
  }
</style>

<div class="dashboard-container">
    <h2>📊 Dashboard Keuangan</h2>

    <label for="configSelect">Pilih Konfigurasi Chart:</label>
    <select id="configSelect">
        <option value="">-- Pilih --</option>
        @foreach ($configs as $config)
            <option value="{{ $config->id }}">{{ $config->judul }}</option>
        @endforeach
    </select>
 
    @foreach($defaultCharts as $parentName => $charts)
  <div class="chart-group">
    <div class="chart-header" onclick="toggleChartGroup(this)">
      <h3>
        {{ $parentName }}
      </h3>
      <i class="caret" data-lucide="chevron-down"></i>
    </div>

    <div class="chart-collapse">
      <div class="chart-container">
        @foreach($charts as $i => $chart)
          <div class="chart-card">
            <h4>{{ $chart['options']['plugins']['title']['text'] ?? 'Chart' }}</h4>
            <div class="chart-wrapper">
              <canvas id="chart-{{ $parentName }}-{{ $i }}"></canvas>
            </div>
          </div>

          <script>
            document.addEventListener('DOMContentLoaded', function () {
              const ctx = document.getElementById('chart-{{ $parentName }}-{{ $i }}');
              const chartType = '{{ $chart["type"] }}';
              const isCircular = ['doughnut', 'pie','line', 'bar','polarArea'].includes(chartType);

              new Chart(ctx, {
                type: chartType,
                data: {!! json_encode($chart['data'], JSON_HEX_TAG) !!},
                options: {!! json_encode($chart['options'], JSON_HEX_TAG) !!}
              });
            });
          </script>
        @endforeach
      </div>
    </div>
  </div>
@endforeach


<!-- Modal -->
<div class="modal" id="chartModal">
    <div class="modal-content">
        <span class="modal-close" onclick="closeModal()">×</span>
        <canvas id="popupChart" width="600" height="400"></canvas>
    </div>
</div>

<script>
    let popupChart;

    document.getElementById('configSelect').addEventListener('change', function () {
        const configId = this.value;
        if (!configId) return;

        fetch(`/chart/data/${configId}`)
            .then(res => res.json())
            .then(chartData => {
                const ctx = document.getElementById('popupChart').getContext('2d');
                if (popupChart) popupChart.destroy();
                popupChart = new Chart(ctx, chartData);
                openModal();
            })
            .catch(err => console.error("Chart load error:", err));
    });

    function openModal() {
        document.getElementById('chartModal').style.display = 'flex';
    }

    function closeModal() {
        document.getElementById('chartModal').style.display = 'none';
    }

    // Close modal jika klik di luar konten
    window.onclick = function (e) {
        const modal = document.getElementById('chartModal');
        if (e.target === modal) closeModal();
    };
</script>

@endsection
