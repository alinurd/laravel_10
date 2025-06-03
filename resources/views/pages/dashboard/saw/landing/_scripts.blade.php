 @if (session('hasil'))
        @push('scripts')
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const ctx = document.getElementById('rankingChart').getContext('2d');
                    const rankingData = @json($ranking);

                    const labels = rankingData.map(item => item.nama);
                    const scores = rankingData.map(item => item.skor);
                    const backgroundColors = [];

                    for (let i = 0; i < rankingData.length; i++) {
                        if (i === 0) {
                            backgroundColors.push('rgba(40, 167, 69, 0.8)');
                        } else if (i === 1) {
                            backgroundColors.push('rgba(23, 162, 184, 0.8)');
                        } else if (i === 2) {
                            backgroundColors.push('rgba(255, 193, 7, 0.8)');
                        } else {
                            backgroundColors.push('rgba(108, 117, 125, 0.8)');
                        }
                    }

                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Skor SAW',
                                data: scores,
                                backgroundColor: backgroundColors,
                                borderColor: backgroundColors.map(color => color.replace('0.8', '1')),
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    title: {
                                        display: true,
                                        text: 'Skor'
                                    }
                                },
                                x: {
                                    title: {
                                        display: true,
                                        text: 'Alternatif'
                                    }
                                }
                            },
                            plugins: {
                                legend: {
                                    display: false
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(context) {
                                            return 'Skor: ' + context.raw.toFixed(3);
                                        }
                                    }
                                }
                            }
                        }
                    });
                });
            </script>
        @endpush
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