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
 <!-- Control spans -->
 @php
 $cbo=$costum[2]['form'];
 $chartGenerate=$costum[1]['chartGenerate'];
 $kelompok=$chartGenerate['transaksi']['kelompok'];
 $data=$chartGenerate['transaksi']['data'];
 @endphp
 <!-- Control spans dan Dropdown -->
 <div class="mb-5">
   <span class="btn btn-primary me-2" id="showChartBtn">Lihat Chart</span>
   <span class="btn btn-success me-2" id="simpanBtn">Simpan Konfigurasi</span>
   <span class="btn btn-secondary" id="sumberData">Sumber Data</span>
 </div>


 <div class="row mb-2">
   <div class="col-md-6">
     <label for="">Judul</label>
     <input type="text" name="Judul" id="Judul" class="form-control" placeholder="Judul  Chart" aria-label="Judul  Chart">
   </div>
   <div class="col-md-6">
     <label for="">Label </label>
     <input type="text" name="Label " id="Label " class="form-control" placeholder="Label   Chart" aria-label="Label   Chart">
   </div>
 </div>
 </div>

 <div class="row mb-3">
   <div class="col-md-4">
     <span>Parent</span>
     <select class="form-control select2">
       <option selected disabled>Pilih Parent</option>
       @foreach($cbo['cboType'] as $k => $items)
       <option value="{{ $items['id'] }}">{{ strtoupper($items['value']) }}</option>
       @endforeach
     </select>
   </div>
   <div class="col-md-4">
     <span>Jenis Chart</span>
     <select class="form-control select2">
       <option selected disabled>Pilih Jenis</option>
       @foreach($cbo['cboJenis'] as $k => $items)
       <option value="{{ $items['id'] }}">{{ strtoupper($items['value']) }}</option>
       @endforeach
     </select>
   </div>
   <div class="col-md-4">
     <span>Status</span>
     <select class="form-control select2">
       <option selected disabled>Pilih Module</option>
       @foreach($cbo['cboJenis'] as $k => $items)
       <option value="{{ $items['id'] }}">{{ strtoupper($items['value']) }}</option>
       @endforeach
     </select>
   </div>
 </div>



<hr>
<h4>Configurasi Data</h4>


 <div class="row mb-4">
   <div class="col-md-3">
     <span>Module</span>
     <select class="form-select" id="modueSelector">
       <option selected disabled>Pilih Module</option>
       @foreach($chartGenerate as $k => $items)
       <option value="{{ $k }}">{{ strtoupper($k) }}</option>
       @endforeach
     </select>
   </div>
   <div class="col-md-3">
     <span>Kelompok</span>
     <select class="form-select" id="kelompokSelector">
       <option selected disabled>Pilih Kelompok</option>
     </select>
   </div>
   <div class="col-md-3">
     <span>Data</span>

     <select class="form-select" id="dataSelector">
       <option selected disabled>Pilih Data</option>
       @foreach($data as $item)
       <option value="{{ $item['id'] }}">{{ strtoupper($item['val']) }}</option>
       @endforeach
     </select>
   </div>
   <div class="col-md-3">
     <span>Opration</span>

     <select class="form-select" id="dataLabelSelector">
       <option selected disabled>Pilih Operasi dari data</option>
     </select>
   </div>
 </div>

 <!-- Tabel Konfigurasi Chart -->
 <div class="table-responsive">
   <table id="chartAddTable" class="table table-bordered table-striped">
     <thead class="table-dark">
       <tr>
         <th>Labels</th>
         <th>Color</th>
         <th>Border Color</th>
         <th>Aksi</th>
       </tr>
     </thead>
     <tbody id="chartAdd">
       <tr>
         <td>
           <select class="form-select label-select">
             <option selected disabled>Pilih label dari kelompok</option>
           </select>
         </td>
         <td><input type="color" class="form-control form-control-color" data-type="background"></td>
         <td><input type="color" class="form-control form-control-color" data-type="border"></td>
         <td>
           <span class="btn btn-danger btn-sm hapus-row">Hapus</span>
           <span class="btn btn-outline-secondary btn-sm tambah-row">Tambah</span>
         </td>
       </tr>
     </tbody>
   </table>

 </div>


 <script>
   // Ambil semua data chart dari PHP ke JS
   const chartGenerate = @json($chartGenerate);

   // Inisialisasi variabel global (akan diisi saat module dipilih)
   let kelompokData = {};
   let dataData = [];

   // Saat module berubah
   document.getElementById('modueSelector').addEventListener('change', function() {
     const selectedModule = this.value;
     const kelompokSelect = document.getElementById('kelompokSelector');
     const dataSelect = document.getElementById('dataSelector');
     const dataLabelSelect = document.getElementById('dataLabelSelector');

     // Kosongkan dropdown
     kelompokSelect.innerHTML = '<option selected disabled>Pilih Kelompok</option>';
     dataSelect.innerHTML = '<option selected disabled>Pilih Data</option>';
     dataLabelSelect.innerHTML = '<option selected disabled>Pilih Operasi dari data</option>';

     // Update data kelompok dan data data
     kelompokData = chartGenerate[selectedModule]['kelompok'] ?? {};
     dataData = chartGenerate[selectedModule]['data'] ?? [];

     // Isi dropdown kelompok berdasarkan key-nya (bulan, tahun, jenis, kategori)
     Object.keys(kelompokData).forEach(k => {
       kelompokSelect.add(new Option(k, k));
     });

     // Isi dropdown data berdasarkan item
     dataData.forEach(item => {
       dataSelect.add(new Option(item.val.toUpperCase(), item.id));
     });

     // Reset semua label select di tabel
     updateAllLabelSelects();
   });

   // Saat kelompok berubah, update semua label select
   document.getElementById('kelompokSelector').addEventListener('change', function() {
     updateAllLabelSelects();
   });

   // Saat data berubah, isi dropdown operasi
   document.getElementById('dataSelector').addEventListener('change', function() {
     const selectedItem = dataData.find(item => item.id === this.value);
     const dataLabelSelect = document.getElementById('dataLabelSelector');

     dataLabelSelect.innerHTML = '<option selected disabled>Pilih Operasi dari data</option>';

     if (selectedItem?.opration) {
       selectedItem.opration.forEach(op => {
         dataLabelSelect.add(new Option(op, op));
       });
     }
   });

   // Ambil label terpilih di baris lain untuk hindari duplikat
   function getSelectedLabels(excludeRow) {
     const selected = [];
     document.querySelectorAll('#chartAdd tr').forEach(row => {
       if (row !== excludeRow) {
         const select = row.querySelector('.label-select');
         if (select.value && select.value !== 'Pilih label dari kelompok') {
           selected.push(select.value);
         }
       }
     });
     return selected;
   }

   // Update label select di satu baris
   function updateRowLabelSelect(row) {
     const kelompok = document.getElementById('kelompokSelector').value;
     const select = row.querySelector('.label-select');
     const currentValue = select.value;

     const availableLabels = kelompokData[kelompok] ?
       kelompokData[kelompok].map(item => item.val) : [];
     const excludedLabels = getSelectedLabels(row);

     select.innerHTML = '<option selected disabled>Pilih label dari kelompok</option>';

     availableLabels.forEach(label => {
       if (!excludedLabels.includes(label)) {
         select.add(new Option(label, label));
       }
     });

     // Pilih kembali nilai sebelumnya jika masih valid
     if (currentValue && availableLabels.includes(currentValue) && !excludedLabels.includes(currentValue)) {
       select.value = currentValue;
     } else {
       select.value = 'Pilih label dari kelompok';
     }
   }

   // Update semua label select
   function updateAllLabelSelects() {
     document.querySelectorAll('#chartAdd tr').forEach(row => {
       updateRowLabelSelect(row);
     });
   }

   // Tambah atau hapus baris
   document.getElementById('chartAdd').addEventListener('click', function(e) {
     const target = e.target;
     const row = target.closest('tr');

     if (target.classList.contains('hapus-row')) {
       if (document.querySelectorAll('#chartAdd tr').length > 1) {
         row.remove();
         updateAllLabelSelects();
       } else {
         alert('Minimal harus ada satu baris!');
       }
     } else if (target.classList.contains('tambah-row')) {
       const newRow = row.cloneNode(true);
       newRow.querySelector('.label-select').value = 'Pilih label dari kelompok';
       newRow.querySelectorAll('.form-control-color').forEach(input => input.value = '#000000');
       row.after(newRow);
       updateAllLabelSelects();
     }
   });

   // Jika label select berubah, update ulang semua
   document.getElementById('chartAdd').addEventListener('change', function(e) {
     if (e.target.classList.contains('label-select')) {
       updateAllLabelSelects();
     }
   });

   // Fungsi ambil konfigurasi chart
   function getChartConfig() {
     const config = {
       module: document.getElementById('modueSelector').value,
       kelompok: document.getElementById('kelompokSelector').value,
       data: document.getElementById('dataSelector').value,
       operasi: document.getElementById('dataLabelSelector').value,
       datasets: []
     };

     document.querySelectorAll('#chartAdd tr').forEach(row => {
       const labelSelect = row.querySelector('.label-select');
       const colorInput = row.querySelector('input[type="color"][data-type="background"]');
       const borderColorInput = row.querySelector('input[type="color"][data-type="border"]');

       if (labelSelect.value && labelSelect.value !== 'Pilih label dari kelompok') {
         config.datasets.push({
           label: labelSelect.value,
           backgroundColor: colorInput?.value || '#000000',
           borderColor: borderColorInput?.value || '#000000'
         });
       }
     });

     return config;
   }

   // Validasi konfigurasi
   function validateConfig(config) {
     if (!config.kelompok) return 'Kelompok belum dipilih!';
     if (!config.data) return 'Data belum dipilih!';
     if (!config.operasi) return 'Operasi belum dipilih!';
     if (config.datasets.length === 0) return 'Belum ada dataset yang ditambahkan!';
     return true;
   }

   // Tombol Simpan
   document.getElementById('simpanBtn').addEventListener('click', async () => {
     const simpanBtn = document.getElementById('simpanBtn');
     const originalText = simpanBtn.innerHTML;

     try {
       // Tampilkan loading
       simpanBtn.innerHTML = `<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span> Menyimpan...`;
       simpanBtn.disabled = true;

       const config = getChartConfig();
       const validation = validateConfig(config);

       if (validation !== true) {
         alert(validation);
         return;
       }

       const response = await window.axios.post('/simpan-chart-config', config);
       alert('Berhasil disimpan! ID: ' + response.data.id);

     } catch (error) {
       console.error('Error:', error);
       alert('Error: ' + (error.response?.data?.message || error.message));
     } finally {
       // Kembalikan tombol ke keadaan semula
       simpanBtn.innerHTML = originalText;
       simpanBtn.disabled = false;
     }
   });
 </script>
















 <style>
   #chartAddTable th,
   #chartAddTable td {
     vertical-align: middle;
     text-align: center;
   }

   .form-control-color {
     height: 38px;
     padding: 3px;
   }

   .btn-sm {
     padding: 5px 10px;
     margin: 2px;
   }
 </style>


 <div id="sumberDataModal" style="z-index: 9999;" class="modal">
   <div class="modal-content">
     <div class="modal-header">
       <h3>Sumber Data</h3>
       <span class="close" onclick="closeModal()">&times;</span>
     </div>
     <p>
       <a class="btn btn-primary" data-bs-toggle="collapse" href="#Trnasaksi" role="span" aria-expanded="false" aria-controls="Trnasaksi">
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