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
    <div class="value">Rp {{ number_format($TotalPiutangVendor, 0, ',', '.') }}</div>
    <div class="icon" data-lucide="hand-coins"></div>
  </div>
  <div class="card">
    <h4>Total Ops Eksternal</h4>
    <div class="value">Rp 45 Juta</div>
    <div class="icon" data-lucide="activity"></div>

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
</div>

<!-- Bottom cards -->
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
    <canvas id="opsEksternalChartx"></canvas>
  </div>
  <div class="card">
    <h4>Pinjaman Vendor</h4>
    <canvas id="pinjamanVendorChart" height="100"></canvas>
  </div>
  <div class="card">
    <h4>Profit</h4>
    <canvas id="profitChart"></canvas>
  </div>
</div>
<script>
  const ctxSlope = document.getElementById('opsEksternalChartx').getContext('2d');
  new Chart(ctxSlope, {
    type: 'line',
    data: {
      labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
      datasets: [{
          label: '2023',
          data: [10, 15, 20, 18, 25, 22, 28, 26, 12, 32, 35, 40],
          borderColor: '#3b82f6',
          backgroundColor: 'transparent',
          tension: 0.4
        },
        {
          label: '2024',
          data: [80, 25, 27, 35, 40, 42, 38, 36, 80, 48, 50, 55],
          borderColor: '#10b981',
          backgroundColor: 'transparent',
          tension: 0.4
        },
        {
          label: '2025',
          data: [30, 32, 35, 37, 43, 10, 50, 52, 55, 60, 62, 65],
          borderColor: '#f59e0b',
          backgroundColor: 'transparent',
          tension: 0.4
        }
      ]
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          position: 'bottom',
          labels: {
            usePointStyle: true
          }
        },
        tooltip: {
          mode: 'index',
          intersect: false
        },
        title: {
          display: false
        }
      },
      interaction: {
        mode: 'nearest',
        axis: 'x',
        intersect: false
      },
      scales: {
        y: {
          beginAtZero: true,
          title: {
            display: true,
            text: 'Jumlah Ops Eks (juta)'
          }
        },
        x: {
          title: {
            display: true,
            text: 'Bulan'
          }
        }
      }
    }
  });
</script>

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
      plugins: {
        legend: {
          display: false
        }
      },
      scales: {
        y: {
          beginAtZero: true
        }
      }
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
      plugins: {
        legend: {
          display: false
        }
      },
      scales: {
        y: {
          beginAtZero: true
        }
      }
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
      plugins: {
        legend: {
          display: false
        }
      },
      scales: {
        y: {
          beginAtZero: true
        }
      }
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
        legend: {
          display: false
        }
      },
      scales: {
        y: {
          beginAtZero: true
        }
      }
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
      plugins: {
        legend: {
          position: 'bottom'
        }
      }
    }
  });
  const piutangVendorChart = @json($piutangVendor);

  const labels = piutangVendorChart.map(item => item.stackholder);
  const data = piutangVendorChart.map(item => item.total_nominal);

  new Chart(document.getElementById('pinjamanVendorChart'), {
    type: 'polarArea',
    data: {
      labels: labels,
      datasets: [{
        label: 'Pinjaman',
        data: data,
        backgroundColor: ['#6366f1', '#10b981', '#f59e0b', '#f87171']
      }]
    },
    options: {
      plugins: {
        legend: {
          position: 'bottom'
        }
      }
    }
  });

  lucide.createIcons();
</script>
@endsection