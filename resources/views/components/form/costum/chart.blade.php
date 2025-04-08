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

  /* Modal styles */
  .modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    justify-content: center;
    align-items: center;
    z-index: 1000;
  }

  .modal-content {
    background: var(--card-bg);
    padding: 20px;
    border-radius: var(--border-radius);
    width: 90%;
    max-width: 800px;
    max-height: 90vh;
    overflow: auto;
  }

  .modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
  }

  .close {
    font-size: 24px;
    cursor: pointer;
  }

  /* Chart cards */
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
    margin-bottom: 20px;
  }

  canvas {
    margin-top: 15px;
  }
</style>

<!-- Control Buttons -->
<button class="btn btn-primary" id="showChartBtn">Lihat Chart</button>
<button class="btn btn-secondary" id="addDataBtn">Tambah Data</button>


<table id="chartAddTable">
  <thead>
    <tr>
      <th>labels</th>
      <th>Data</th>
      <th>Color</th>
      <th>border_color</th>
    </tr>
  </thead>
  <tbody id="chartAdd">
    <tr>
      <td><input type="text"></td>
      <td><input type="text"></td>
      <td><input type="color"></td>
      <td><input type="color"></td>
    </tr>
  </tbody>
</table>


<div id="chartModal" style="z-index: 9999;" class="modal">
  <div class="modal-content">
    <div class="modal-header">
      <h3>Data Chart</h3>
      <span class="close" onclick="closeModal()">&times;</span>
    </div>
    <div class="bottom-cards">
      <div class="card">
        <h4>B A R</h4>
        <canvas id="BAR"></canvas>
      </div>
      <div class="card">
        <h4>L I N E</h4>
        <canvas id="LINE"></canvas>
      </div>
      <div class="card">
        <h4>P O L A A R E A</h4>
        <canvas id="POLAAREA"></canvas>
      </div>
      <div class="card">
        <h4>D O U G H N U T</h4>
        <canvas id="Doughnut"></canvas>
      </div>
    </div>
  </div>
</div>

<script>
  // Modal control
  document.getElementById('addDataBtn').addEventListener('click', showModal);

  function showModal() {
    document.getElementById('chartModal').style.display = 'flex';
  }

  function closeModal() {
    document.getElementById('chartModal').style.display = 'none';
  }

  // Event listeners
  document.getElementById('showChartBtn').addEventListener('click', showModal);

  // Initialize charts
  const chartConfigs = {
    BAR: {
      type: 'bar',
      data: {
        labels: ['Jan', 'Feb', 'Mar'],
        datasets: [{
          label: 'Pengeluaran (juta)',
          data: [20, 25, 30],
          backgroundColor: '#f87171'
        }]
      }
    },
    LINE: {
      type: 'line',
      data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr'],
        datasets: [{
          label: 'Pengeluaran Ops (juta)',
          data: [10, 15, 12, 20],
          borderColor: '#3b82f6',
          tension: 0.4
        }]
      }
    },
    Doughnut: {
      type: 'doughnut',
      data: {
        labels: ['Profit', 'Biaya'],
        datasets: [{
          data: [55, 45],
          backgroundColor: ['#10b981', '#f87171']
        }]
      }
    },
    POLAAREA: {
      type: 'polarArea',
      data: {
        labels: ['Vendor A', 'Vendor B', 'Vendor C', 'Vendor D'],
        datasets: [{
          data: [10, 8, 6, 6],
          backgroundColor: ['#6366f1', '#10b981', '#f59e0b', '#f87171']
        }]
      }
    }
  };

  // Create chart instances
  const charts = {};
  Object.keys(chartConfigs).forEach(id => {
    charts[id] = new Chart(
      document.getElementById(id),
      chartConfigs[id]
    );
  });

  // Initialize icons
  lucide.createIcons();

  // Close modal when clicking outside
  window.onclick = function(event) {
    if (event.target.classList.contains('modal')) {
      closeModal();
    }
  }
</script>