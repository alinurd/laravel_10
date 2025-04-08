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
<span class="btn btn-primary" id="showChartBtn">Lihat Chart</span>
<span class="btn btn-secondary" id="sumberData">Sumber Data</span>
 @php
$kelompok=$costum[1]['kelompok'];
$data=$costum[1]['data'];    

@endphp

<select class="form-select" id="kelompokSelector">
  <option selected disabled>Pilih Kelompok</option>
  @foreach($kelompok as $key => $items)
    <option value="{{ $key }}">{{ strtoupper($key) }}</option>
  @endforeach
</select>
<select class="form-select" id="dataSelector">
  <option selected disabled>Pilih Data</option>
  @foreach($data as $item)
    <option value="{{ $item['id'] }}">{{ strtoupper($item['val']) }}</option>
  @endforeach
</select>

opration
<table id="chartAddTable">
  <thead>
    <tr>
      <th>Labels</th>
      <th>Data</th>
      <th>Color</th>
      <th>Border Color</th>
    </tr>
  </thead>
  <tbody id="chartAdd">
    <tr>
      <td>
        <select class="form-select" id="labelSelector">
          <option selected disabled>Pilih label dari kelompok</option>
        </select>
      </td>
      <td>
        <select class="form-select" id="dataLabelSelector">
          <option selected disabled>Pilih Opration dari data</option>
        </select>
      </td>
      <td><input type="text" class="form-control"></td>
      <td><input type="color" class="form-control"></td>
      <td><input type="color" class="form-control"></td>
    </tr>
  </tbody>
</table>
<script>
  const kelompokData = @json($kelompok);
  const dataData = @json($data);

  document.getElementById('kelompokSelector').addEventListener('change', function() {
    const selectedKelompok = this.value;
    const labelSelect = document.getElementById('labelSelector');
    
    // Kosongkan dulu
    labelSelect.innerHTML = '<option selected disabled>Pilih label dari kelompok</option>';

    // Isi dengan data yang sesuai
    if (kelompokData[selectedKelompok]) {
      kelompokData[selectedKelompok].forEach(item => {
        const option = document.createElement('option');
        option.value = item.val;
        option.text = item.val;
        labelSelect.appendChild(option);
      });
    }
  });
  document.getElementById('dataSelector').addEventListener('change', function() {
  const selecteddata = this.value;
  const labelSelect = document.getElementById('dataLabelSelector');
  
  // Kosongkan dulu
  labelSelect.innerHTML = '<option selected disabled>Pilih Opration dari data</option>';

  // Cari data yang dipilih
  const selectedItem = dataData.find(item => item.id === selecteddata);

  if (selectedItem && selectedItem.opration) {
    selectedItem.opration.forEach(opration => {
      const option = document.createElement('option');
      option.value = opration;
      option.text = opration;
      labelSelect.appendChild(option);
    });
  }
});

</script>


  </tbody>
</table>


<div id="sumberDataModal" style="z-index: 9999;" class="modal">
  <div class="modal-content">
    <div class="modal-header">
      <h3>Sumber Data</h3>
      <span class="close" onclick="closeModal()">&times;</span>
    </div>
    <p>
      <a class="btn btn-primary" data-bs-toggle="collapse" href="#Trnasaksi" role="button" aria-expanded="false" aria-controls="Trnasaksi">
        Transaksi
      </a>
    </p>
    <div class="collapse" id="Trnasaksi">
      <div class="card card-body">
        <table>
          <tr>
            <th>Sumbu Y</th>
            <th>Sumbu X</th>
            <th>Data</th>
            <th>Konversi</th>
          </tr>
          <tr>
            <td>
              <select class="form-select" aria-label="Default select example">
                <option selected>Open this select menu</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
              </select>
            </td>
            <td>
              <select class="form-select" aria-label="Default select example">
                <option selected>Open this select menu</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
              </select>
            </td>
            <td>
              <select class="form-select" aria-label="Default select example">
                <option selected>Open this select menu</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
              </select>
            </td>
            <td>
              <select class="form-select" aria-label="Default select example">
                <option selected>Open this select menu</option>
                <option value="1">Sum</option>
                <option value="2">Average</option>
                <option value="3">MAX</option>
                <option value="3">Min</option>
              </select>
            </td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</div>


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
  document.getElementById('sumberData').addEventListener('click', sumberDataModal);

  function sumberDataModal() {
    document.getElementById('sumberDataModal').style.display = 'flex';
  }

  function showModal() {
    document.getElementById('chartModal').style.display = 'flex';
  }

  function closeModal() {
    document.getElementById('chartModal').style.display = 'none';
    document.getElementById('sumberDataModal').style.display = 'none';
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