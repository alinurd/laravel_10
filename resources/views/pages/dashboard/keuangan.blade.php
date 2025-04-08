@extends('components.layouts.app')

@section('title', 'Dashboard')
 

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://unpkg.com/lucide@latest"></script> 
@section('content')

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
    .top-cards, .bottom-cards {
      display: grid;
      gap: 20px;
    }
    .top-cards {
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      margin-bottom: 30px;
    }
    .bottom-cards {
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
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
</head>
<body>

  <h2>📊 Dashboard Keuangan</h2>

  <!-- Top 4 cards -->
  <div class="top-cards">
    <div class="card">
      <h4>P.O</h4>
      <div class="value">Rp 150 Juta</div>
      <div class="icon" data-lucide="clipboard-list"></div>
    </div>
    <div class="card">
      <h4>Kontrak BSA</h4>
      <div class="value">Rp 120 Juta</div>
      <div class="icon" data-lucide="file-signature"></div>
    </div>
    <div class="card">
      <h4>Kontrak SI</h4>
      <div class="value">Rp 90 Juta</div>
      <div class="icon" data-lucide="file-text"></div>
    </div>
    <div class="card">
      <h4>Pinjaman Vendor</h4>
      <div class="value">Rp 30 Juta</div>
      <div class="icon" data-lucide="hand-coins"></div>
    </div>
  </div>

  <!-- Sisanya -->
  <div class="bottom-cards">
    <div class="card">
      <h4>Invoice BSA</h4>
      <canvas id="invoiceChart"></canvas>
    </div>
    <div class="card">
      <h4>Cash In</h4>
      <canvas id="cashInChart"></canvas>
    </div>
    <div class="card">
      <h4>Pengeluaran SI</h4>
      <canvas id="pengeluaranChart"></canvas>
    </div>
    <div class="card">
  <h4>Total Ops Eksternal</h4>
  <div class="value">Rp 45 Juta</div>
  <div class="icon" data-lucide="activity"></div>
  <canvas id="opsEksternalChart" height="100"></canvas>
</div>

    <div class="card">
      <h4>Gaji Karyawan</h4>
      <div class="value">Rp 25 Juta</div>
      <div class="icon" data-lucide="users"></div>
    </div>
    <div class="card">
      <h4>Honor Assessor</h4>
      <div class="value">Rp 15 Juta</div>
      <div class="icon" data-lucide="award"></div>
    </div>
    <div class="card">
      <h4>Profit</h4>
      <canvas id="profitChart"></canvas>
    </div>
  </div>

  <!-- Chart.js Scripts -->
  <script>
    new Chart(document.getElementById('invoiceChart'), {
      type: 'bar',
      data: {
        labels: ['Jan', 'Feb', 'Mar'],
        datasets: [{
          label: 'Invoice BSA (juta)',
          data: [30, 45, 50],
          backgroundColor: '#6366f1'
        }]
      },
      options: {
        plugins: { legend: { display: false } },
        scales: { y: { beginAtZero: true } }
      }
    });

    new Chart(document.getElementById('cashInChart'), {
      type: 'bar',
      data: {
        labels: ['Jan', 'Feb', 'Mar'],
        datasets: [{
          label: 'Cash In (juta)',
          data: [40, 35, 60],
          backgroundColor: '#10b981'
        }]
      },
      options: {
        plugins: { legend: { display: false } },
        scales: { y: { beginAtZero: true } }
      }
    });

    new Chart(document.getElementById('pengeluaranChart'), {
      type: 'bar',
      data: {
        labels: ['Jan', 'Feb', 'Mar'],
        datasets: [{
          label: 'Pengeluaran (juta)',
          data: [20, 25, 30],
          backgroundColor: '#f87171'
        }]
      },
      options: {
        plugins: { legend: { display: false } },
        scales: { y: { beginAtZero: true } }
      }
    });

    new Chart(document.getElementById('profitChart'), {
      type: 'doughnut',
      data: {
        labels: ['Profit', 'Biaya'],
        datasets: [{
          data: [55, 45],
          backgroundColor: ['#10b981', '#f87171'],
          hoverOffset: 4
        }]
      },
      options: {
        plugins: { legend: { position: 'bottom' } }
      }
    });

    new Chart(document.getElementById('opsEksternalChart'), {
  type: 'line',
  data: {
    labels: ['Jan', 'Feb', 'Mar', 'Apr'],
    datasets: [{
      label: 'Pengeluaran Ops (juta)',
      data: [10, 15, 12, 20],
      borderColor: '#3b82f6',
      backgroundColor: 'rgba(59, 130, 246, 0.1)',
      tension: 0.4,
      fill: true,
      pointRadius: 4,
      pointHoverRadius: 6
    }]
  },
  options: {
    plugins: {
      legend: { display: false }
    },
    scales: {
      y: { beginAtZero: true }
    }
  }
});



    lucide.createIcons();
  </script>

@endsection
