 @if (session('hasil'))
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('rankingChart').getContext('2d');

    const dataLabels = @json(array_column(session('hasil'), 'nama'));
    const dataScores = @json(array_map(fn($r) => $r['skor'], session('hasil')));

    const backgroundColors = [
        'rgba(255, 99, 132, 0.6)',
        'rgba(54, 162, 235, 0.6)',
        'rgba(255, 206, 86, 0.6)',
        'rgba(75, 192, 192, 0.6)',
        'rgba(153, 102, 255, 0.6)',
        'rgba(255, 159, 64, 0.6)',
        'rgba(199, 199, 199, 0.6)'
    ];

    const borderColors = [
        'rgba(255, 99, 132, 1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)',
        'rgba(199, 199, 199, 1)'
    ];

    const colorCount = dataLabels.length;
    const repeatedBackgroundColors = Array.from({ length: colorCount }, (_, i) => backgroundColors[i % backgroundColors.length]);
    const repeatedBorderColors = Array.from({ length: colorCount }, (_, i) => borderColors[i % borderColors.length]);

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: dataLabels,
            datasets: [{
                label: 'Skor Alternatif',
                data: dataScores,
                backgroundColor: repeatedBackgroundColors,
                borderColor: repeatedBorderColors,
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
});

    </script>
@endif

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Tangani pengiriman identitas
            document.getElementById('btnSubmitIdentitas').addEventListener('click', function() {
                const userName = document.getElementById('userName').value.trim();
                const userInstitution = document.getElementById('userInstitution').value.trim();

                if (!userName) {
                    alert('Nama lengkap wajib diisi!');
                    return;
                }

                // Simpan data ke form evaluasi
                document.getElementById('formUserName').value = userName;
                document.getElementById('formUserInstitution').value = userInstitution;
                document.getElementById('userNameBadge').textContent = userName;

                // Tampilkan form evaluasi dan sembunyikan card identitas
                document.getElementById('evaluationForm').style.display = 'block';
                document.getElementById('crdIdentitas').style.display = 'none';

                this.innerHTML = '<i class="fas fa-check-circle me-1"></i> Identitas Tersimpan';
                this.classList.add('btn-success');
                this.classList.remove('btn-primary');


                // document.getElementById('evaluationForm').scrollIntoView({
                //     behavior: 'smooth'
                // });
            });


            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });

        @if (session('hasil'))
            window.onload = function() {
                document.getElementById('resultsSection').scrollIntoView({
                    behavior: 'smooth'
                });
            };
        @endif
    </script>