 @if (session('hasil'))
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('rankingChart').getContext('2d');

            const dataLabels = @json(array_column(session('hasil'), 'nama'));
            const dataScores = @json(array_map(fn($r) => $r['skor'], session('hasil')));

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: dataLabels,
                    datasets: [{
                        label: 'Skor Alternatif',
                        data: dataScores,
                        backgroundColor: 'rgba(54, 162, 235, 0.6)',
                        borderColor: 'rgba(54, 162, 235, 1)',
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