<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Chart Builder Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-5">
    <h4 class="mb-4">Chart Builder - Transaksi</h4>

    <form id="chartForm" class="mb-4">
    <div class="col-md-3">
    <label>Sumber Data</label>
    <select name="sumber_data" class="form-control">
        <option value="transaksis">Transaksi</option>
        <option value="penjualans">Penjualan</option>
        <option value="pembelians">Pembelian</option>
        <!-- Tambahkan tabel lain jika ada -->
    </select>
</div>

        <div class="row g-3">
            <div class="col-md-3">
                <label>Sumbu X</label>
                <select name="x_axis" class="form-control">
                    <option value="tanggal">Tanggal</option>
                    <option value="kategori">Kategori</option>
                </select>
            </div>
            <div class="col-md-3">
                <label>Sumbu Y</label>
                <select name="y_axis" class="form-control">
                    <option value="jumlah">Jumlah</option>
                    <option value="total">Total</option>
                </select>
            </div>
            <div class="col-md-3">
                <label>Jenis Chart</label>
                <select name="chart_type" class="form-control">
                    <option value="bar">Bar</option>
                    <option value="line">Line</option>
                    <option value="pie">Pie</option>
                </select>
            </div>
            <div class="col-md-3">
                <label>Rentang Tanggal</label>
                <input type="date" name="start_date" class="form-control mb-1">
                <input type="date" name="end_date" class="form-control">
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Tampilkan Chart</button>
    </form>

    <canvas id="chartCanvas" height="100"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const form = document.getElementById('chartForm');
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(form);

        fetch('/chart-data', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            const ctx = document.getElementById('chartCanvas').getContext('2d');
            if (window.myChart) window.myChart.destroy();

            window.myChart = new Chart(ctx, {
                type: data.type,
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: data.label,
                        data: data.data,
                        backgroundColor: 'rgba(54, 162, 235, 0.4)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 2
                    }]
                }
            });
        });
    });
</script>
</body>
</html>
