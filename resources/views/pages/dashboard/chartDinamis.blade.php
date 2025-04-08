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
 

  .dashboard-container {
    max-width: 1400px;
    margin: 0 auto;
  }

  h2 {
    color: #111827;
    margin-bottom: 30px;
    font-size: 1.8rem;
  }

  .chart-group {
    background: var(--card-bg);
    border-radius: var(--border-radius);
    box-shadow: var(--shadow);
    padding: 25px;
    margin-bottom: 30px;
  }

  .chart-group h3 {
    font-size: 1.4rem;
    color: #1f2937;
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .chart-group h3 small {
    font-size: 0.9rem;
    color: #6b7280;
  }

  .chart-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
  }

  .chart-card {
    background: var(--card-bg);
    border-radius: calc(var(--border-radius) - 4px);
    padding: 20px;
    transition: transform 0.2s ease;
    position: relative;
  }

  .chart-card:hover {
    transform: translateY(-3px);
  }

  .chart-card h4 {
    margin: 0 0 15px 0;
    font-size: 1.1rem;
    color: #374151;
  }

  .chart-wrapper {
    position: relative;
    min-height: 300px;
  }
</style>

<h2>📊 Dashboard Keuangan</h2>

<div class="dashboard-container">
  @foreach($charts as $chart)
  <div class="chart-group">
  <div class="chart-header" onclick="toggleChartGroup(this)">
    <h3>
      <span class="chart-icon">{!! getChartIcon($chart->jenis) !!}</span>
      {{ $chart->name }}
      <small>({{ ucfirst($chart->jenis) }})</small>
    </h3>
    <i class="caret" data-lucide="chevron-down"></i>
  </div>

  <div class="chart-collapse">
    <div class="chart-container">
      @foreach($chart->details as $detail)
        <div class="chart-card">
          <h4>{{ $detail->judul }}</h4>
          <div class="chart-wrapper">
            <canvas id="chart-{{ $detail->id }}"></canvas>
          </div>
        </div>

        <script>
          document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('chart-{{ $detail->id }}');
            const chartType = '{{ $detail->type }}';
            const isCircular = ['doughnut', 'pie', 'polarArea'].includes(chartType);
            
            new Chart(ctx, {
              type: chartType,
              data: {
                labels: {!! json_encode($detail->labels, JSON_HEX_TAG) !!},
                datasets: [{
                  label: '{{ $detail->label }}',
                  data: {!! json_encode($detail->data_chart, JSON_HEX_TAG) !!},
                  backgroundColor: {!! json_encode($detail->color, JSON_HEX_TAG) !!},
                  borderColor: {!! json_encode($detail->border_color, JSON_HEX_TAG) !!},
                  borderWidth: 1,
                  tension: {{ $detail->tension }},
                  fill: {{ $detail->fill ? 'true' : 'false' }}
                }]
              },
              options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                  legend: {
                    position: isCircular ? 'bottom' : 'top',
                    labels: {
                      boxWidth: 12,
                      padding: 20
                    }
                  },
                  tooltip: {
                    enabled: !['polarArea'].includes(chartType)
                  }
                },
                scales: {
                  y: {
                    beginAtZero: true,
                    display: !isCircular,
                    grid: {
                      drawTicks: false
                    }
                  },
                  x: {
                    display: !isCircular,
                    grid: {
                      display: false
                    }
                  }
                }
              }
            });
          });
        </script>      @endforeach
    </div>
  </div>
</div>

<style>
  .chart-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    cursor: pointer;
    padding: 15px 20px;
    transition: background-color 0.2s;
  }

  .chart-header:hover {
    background-color: rgba(0,0,0,0.03);
  }

  .chart-collapse {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.3s ease-out;
  }

  .chart-group.expanded .chart-collapse {
    max-height: 2000px; /* Sesuaikan dengan kebutuhan */
  }

  .caret {
    transition: transform 0.3s ease;
  } 

  .chart-group.expanded .caret {
    transform: rotate(180deg);
  }
</style>

<script>
  function toggleChartGroup(header) {
    const group = header.closest('.chart-group');
    const isExpanded = group.classList.contains('expanded');
    
    // Toggle class expanded
    group.classList.toggle('expanded');
    
    // Update icon
    const icon = header.querySelector('.caret');
    icon.style.transform = isExpanded ? 'rotate(0deg)' : 'rotate(180deg)';
    
    // Update charts saat di-expand
    if (!isExpanded) {
      setTimeout(() => {
        group.querySelectorAll('canvas').forEach(chart => {
          chart._chart?.resize();
        });
      }, 300);
    }
  }

  // Initial state: semua chart group collapsed
  document.querySelectorAll('.chart-group').forEach(group => {
    group.classList.add('expanded'); // Untuk default expanded, hapus baris ini
  });
</script>
  @endforeach
</div>

<script>
  lucide.createIcons();
</script>

@php
  function getChartIcon($jenis) {
    $icons = [
      'keuangan' => '<i data-lucide="wallet" class="text-primary"></i>',
      'operasional' => '<i data-lucide="activity" class="text-accent"></i>',
      'investasi' => '<i data-lucide="trending-up" class="text-amber-500"></i>'
    ];
    return $icons[strtolower($jenis)] ?? '<i data-lucide="chart"></i>';
  }
@endphp
@endsection