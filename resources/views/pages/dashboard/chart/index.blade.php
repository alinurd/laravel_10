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
  
<div class="container my-4">
  <h2 class="mb-4">📊 Dashboard Keuangan</h2>

  <!-- Dropdown untuk memilih konfigurasi chart -->
  <div class="mb-3">
    <label for="configSelect" class="form-label fw-semibold">Pilih Konfigurasi Chart:</label>
    <select id="configSelect" class="form-select">
      <option value="">-- Pilih --</option>
      @foreach ($configs as $config)
        <option value="{{ $config->id }}">{{ $config->judul }}</option>
      @endforeach
    </select>
  </div>

  <!-- Spinner untuk loading -->
  <div id="loadingSpinner" class="alert alert-primary d-flex align-items-center justify-content-center d-none" role="alert">
    <div class="spinner-border" style="width: 2rem; height: 2rem;" role="status">
      <span class="visually-hidden">Loading...</span>
    </div>
    <span class="ms-2">Memuat grafik...</span>
  </div> 
</div>


    
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
            <div class="chart-wrapper" style="width: 100%; height: 350px;"> 
              <canvas id="chart-{{ $parentName }}-{{ $i }}"></canvas>
            </div>
          </div>
          <script> 
            document.addEventListener('DOMContentLoaded', function () {
              @foreach($defaultCharts as $parentName => $charts)
                @foreach($charts as $i => $chart)
                  const ctx_{{ $loop->parent->index }}_{{ $loop->index }} = document.getElementById('chart-{{ $parentName }}-{{ $i }}');
                  if (ctx_{{ $loop->parent->index }}_{{ $loop->index }}) {
                  new Chart(ctx_{{ $loop->parent->index }}_{{ $loop->index }}, {
                  type: '{{ $chart["type"] }}',
                  data: {!! json_encode($chart['data'], JSON_HEX_TAG) !!},
                  options: {!! json_encode($chart['options'], JSON_HEX_TAG) !!}
                    });
                  }
                @endforeach
              @endforeach
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

    document.getElementById('configSelect').addEventListener('change', async function () {
    const configSelect = this;
    const configId = configSelect.value;
    const spinner = document.getElementById('loadingSpinner');

    if (!configId) return;

    configSelect.disabled = true;
    spinner.classList.remove('d-none'); // tampilkan spinner

    try {
        const response = await fetch(`/chart/data/${configId}`);
        const chartData = await response.json();

        const ctx = document.getElementById('popupChart').getContext('2d');
        if (popupChart) popupChart.destroy();
        popupChart = new Chart(ctx, chartData);

        openModal();
    } catch (err) {
        console.error("Chart load error:", err);
        alert("Gagal memuat chart.");
    } finally {
        spinner.classList.add('d-none'); // sembunyikan spinner
        configSelect.disabled = false;
    }
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
