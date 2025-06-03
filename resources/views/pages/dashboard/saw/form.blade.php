@extends('components.layouts.auth.app')

@section('title', 'SAW Method - Penilaian Alternatif')

@section('content')
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- Header Card -->
                <div class="card bg-gradient-primary shadow-lg mb-4">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h2 class="text-dark mb-1">📊 Metode SAW (Simple Additive Weighting)</h2>
                                <p class="text-dark opacity-8 mb-0">Sistem Pendukung Keputusan Pemilihan Alternatif Terbaik
                                </p>
                            </div>
                            <div class="d-flex">
                                <button class="btn btn-light btn-sm me-2" data-bs-toggle="modal"
                                    data-bs-target="#tutorialModal">
                                    <i class="fas fa-question-circle me-1"></i> Panduan
                                </button>
                                <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#formulaModal">
                                    <i class="fas fa-square-root-variable me-1"></i> Rumus
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- User Info Section -->
                <div class="card shadow-lg mb-4" id="crdIdentitas">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 text-primary"><i class="fas fa-user-circle me-2"></i>Identitas Pengguna</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="userName" class="form-label">Nama Lengkap <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="userName" required
                                        placeholder="Masukkan nama Anda">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="userInstitution" class="form-label">Instansi/Perusahaan</label>
                                    <input type="text" class="form-control" id="userInstitution" placeholder="Opsional">
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <div class="mt-3">
                                <button id="btnSubmitIdentitas" class="btn btn-primary">
                                    <i class="fas fa-check-circle me-1"></i> Simpan Identitas
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Evaluation Form Card (Initially Hidden) -->
                <div class="card shadow-lg mb-4" id="evaluationForm">
                    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 text-primary">📝 Penilaian Alternatif Berdasarkan Kriteria</h5>
                        <span class="badge bg-info">
                            <i class="fas fa-user me-1"></i>
                            <span id="userNameBadge"></span>
                        </span>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('saw.proses') }}" method="POST" id="sawForm">
                            @csrf
                            <input type="hidden" name="user_name" id="formUserName">
                            <input type="hidden" name="user_institution" id="formUserInstitution">

                            @foreach ($kriteria as $index => $k)
                                <div class="mb-4 pb-3 border-bottom">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="badge bg-primary rounded-circle me-3"
                                            style="width: 30px; height: 30px; line-height: 30px;">
                                            {{ $loop->iteration }}
                                        </div>
                                        <h6 class="fw-bold mb-0 text-dark">{{ $k['nama'] }}</h6>
                                        <span
                                            class="badge bg-{{ $k['atribut'] == 'benefit' ? 'success' : 'danger' }} ms-auto">
                                            {{ $k['atribut'] == 'benefit' ? 'Benefit' : 'Cost' }}
                                        </span>
                                        <button type="button" class="btn btn-sm btn-link ms-2" data-bs-toggle="tooltip"
                                            title="{{ $k['deskripsi'] ?? 'Tidak ada deskripsi' }}">
                                            <i class="fas fa-info-circle"></i>
                                        </button>
                                    </div>

                                    <div class="row g-3">
                                        @foreach ($alternatif as $a)
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label
                                                        class="form-label fw-semibold text-muted">{{ $a['nama'] }}</label>
                                                    <select name="nilai[{{ $a['id'] }}][{{ $k['id'] }}]"
                                                        class="form-select border-2" required>
                                                        <option value="">-- Pilih Nilai --</option>
                                                        @if ($k['atribut'] == 'benefit')
                                                            <option value="1">Mudah (1)</option>
                                                            <option value="2">Sedang (2)</option>
                                                            <option value="3">Sulit (3)</option>
                                                        @else
                                                            <option value="1">Murah (1)</option>
                                                            <option value="2">Sedang (2)</option>
                                                            <option value="3">Mahal (3)</option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                                <button type="reset" class="btn btn-outline-secondary me-md-2">
                                    <i class="fas fa-undo me-1"></i> Reset
                                </button>
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-calculator me-1"></i> Proses & Lihat Hasil
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Results Section -->
                @if (session('hasil'))
                    @php $ranking = session('hasil'); @endphp
                    <div class="card shadow-lg mt-4 border-0" id="resultsSection">
                        <div class="card-header bg-white py-3">
                            <h5 class="mb-0 text-primary">🏆 Hasil Perhitungan & Ranking</h5>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle me-2"></i>
                                Berikut adalah hasil perhitungan menggunakan metode SAW. Alternatif dengan skor tertinggi
                                merupakan rekomendasi terbaik.
                            </div>

                            <div class="row">
                                @foreach ($ranking as $i => $r)
                                    <div class="col-md-4 mb-4">
                                        <div class="card border-0 shadow-sm h-100 hover-scale">
                                            <div class="card-body text-center py-4">
                                                <div class="position-relative">
                                                    @if ($i == 0)
                                                        <div class="ribbon ribbon-top-right"><span>TERBAIK</span></div>
                                                    @endif
                                                    <span
                                                        class="badge bg-{{ $i < 3 ? 'primary' : 'secondary' }} mb-2 fs-6 px-3 py-2 rounded-pill">
                                                        Ranking #{{ $i + 1 }}
                                                    </span>
                                                </div>
                                                <h4 class="fw-bold mt-2">{{ $r['nama'] }}</h4>
                                                <div class="progress-wrapper w-75 mx-auto my-3">
                                                    <div class="progress-info">
                                                        <span>Skor:</span>
                                                        <span class="fw-bold">{{ number_format($r['skor'], 3) }}</span>
                                                    </div>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-{{ $i < 3 ? 'gradient-' : '' }}{{ $i < 3 ? ($i == 0 ? 'success' : ($i == 1 ? 'info' : 'warning')) : 'secondary' }}"
                                                            role="progressbar"
                                                            style="width: {{ ($r['skor'] / $ranking[0]['skor']) * 100 }}%">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-center mt-2">
                                                    @for ($star = 0; $star < 5 - $i; $star++)
                                                        <i class="fas fa-star text-warning mx-1"></i>
                                                    @endfor
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="mt-4">
                                <h6 class="fw-bold text-dark mb-3">📈 Grafik Perbandingan Alternatif</h6>
                                <div class="chart-container" style="height: 300px;">
                                    <canvas id="rankingChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Tutorial Modal -->
    <div class="modal fade" id="tutorialModal" tabindex="9999" aria-labelledby="tutorialModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="tutorialModalLabel"><i class="fas fa-graduation-cap me-2"></i>Panduan
                        Penggunaan</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="accordion" id="tutorialAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <i class="fas fa-user-check me-2"></i> Langkah 1: Masukkan Identitas
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                                data-bs-parent="#tutorialAccordion">
                                <div class="accordion-body">
                                    <p>Isi nama lengkap Anda dan instansi/perusahaan (opsional) sebelum memulai proses
                                        penilaian.</p>
                                    <img src="https://via.placeholder.com/800x400?text=Identitas+Pengguna"
                                        class="img-fluid rounded mb-3" alt="Identitas Pengguna">
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <i class="fas fa-list-check me-2"></i> Langkah 2: Penilaian Kriteria
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                data-bs-parent="#tutorialAccordion">
                                <div class="accordion-body">
                                    <p>Untuk setiap kriteria, berikan penilaian pada semua alternatif:</p>
                                    <ul>
                                        <li>Kriteria <strong>Benefit</strong>: Nilai lebih tinggi lebih baik</li>
                                        <li>Kriteria <strong>Cost</strong>: Nilai lebih rendah lebih baik</li>
                                    </ul>
                                    <img src="https://via.placeholder.com/800x400?text=Form+Penilaian"
                                        class="img-fluid rounded mb-3" alt="Form Penilaian">
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    <i class="fas fa-chart-line me-2"></i> Langkah 3: Lihat Hasil
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                data-bs-parent="#tutorialAccordion">
                                <div class="accordion-body">
                                    <p>Setelah mengisi semua penilaian, klik tombol <strong>"Proses & Lihat Hasil"</strong>
                                        untuk melihat ranking alternatif.</p>
                                    <p>Hasil akan menampilkan:</p>
                                    <ul>
                                        <li>Peringkat alternatif dari terbaik hingga terburuk</li>
                                        <li>Skor SAW masing-masing alternatif</li>
                                        <li>Visualisasi grafik perbandingan</li>
                                    </ul>
                                    <img src="https://via.placeholder.com/800x400?text=Hasil+Perhitungan"
                                        class="img-fluid rounded" alt="Hasil Perhitungan">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Formula Modal -->
    <div class="modal fade" id="formulaModal" tabindex="9999" aria-labelledby="formulaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title" id="formulaModalLabel"><i class="fas fa-square-root-variable me-2"></i>Rumus
                        Metode SAW</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5><i class="fas fa-ruler me-2"></i>Normalisasi Matriks</h5>
                            <p>Untuk kriteria benefit:</p>
                            <div class="bg-light p-3 rounded mb-3">
                                <code>r<sub>ij</sub> = x<sub>ij</sub> / max(x<sub>j</sub>)</code>
                            </div>
                            <p>Untuk kriteria cost:</p>
                            <div class="bg-light p-3 rounded">
                                <code>r<sub>ij</sub> = min(x<sub>j</sub>) / x<sub>ij</sub></code>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h5><i class="fas fa-calculator me-2"></i>Perhitungan Skor</h5>
                            <p>Skor akhir dihitung dengan:</p>
                            <div class="bg-light p-3 rounded">
                                <code>V<sub>i</sub> = Σ (w<sub>j</sub> × r<sub>ij</sub>)</code>
                            </div>
                            <p>Keterangan:</p>
                            <ul class="small">
                                <li><code>r<sub>ij</sub></code>: Nilai normalisasi</li>
                                <li><code>x<sub>ij</sub></code>: Nilai asli alternatif i kriteria j</li>
                                <li><code>w<sub>j</sub></code>: Bobot kriteria j</li>
                                <li><code>V<sub>i</sub></code>: Skor akhir alternatif i</li>
                            </ul>
                        </div>
                    </div>
                    <div class="mt-4">
                        <h5><i class="fas fa-diagram-project me-2"></i>Diagram Alur Metode SAW</h5>
                        <img src="https://via.placeholder.com/800x400?text=SAW+Flow+Diagram" class="img-fluid rounded"
                            alt="Diagram Alur SAW">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

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
    <style>
        /* Animasi untuk transisi */
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        #evaluationForm {
            display: none;
            animation: slideDown 0.5s ease-out forwards;
        }

        /* Style untuk tombol yang sudah diklik */
        .btn-saved {
            background-color: #28a745 !important;
            border-color: #28a745 !important;
        }
 

        /* Style untuk visual feedback */
        .form-saved {
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Style untuk loading state */
        .btn-loading {
            position: relative;
            pointer-events: none;
        }

        .btn-loading:after {
            content: "";
            position: absolute;
            top: 50%;
            left: 50%;
            width: 20px;
            height: 20px;
            margin: -10px 0 0 -10px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        .hover-scale {
            transition: transform 0.3s ease;
        }

        .hover-scale:hover {
            transform: translateY(-5px);
        }

        .ribbon {
            width: 85px;
            height: 88px;
            overflow: hidden;
            position: absolute;
            top: -3px;
            right: -3px;
        }

        .ribbon span {
            position: absolute;
            display: block;
            width: 125px;
            padding: 8px 0;
            background-color: #28a745;
            box-shadow: 0 5px 10px rgba(0, 0, 0, .1);
            color: #fff;
            font-size: 12px;
            text-align: center;
            right: -5px;
            top: 20px;
            transform: rotate(45deg);
        }

        .progress-bar {
            transition: width 1.5s ease;
        }

        .bg-gradient-success {
            background: linear-gradient(45deg, #28a745, #20c997);
        }

        .bg-gradient-info {
            background: linear-gradient(45deg, #17a2b8, #0dcaf0);
        }

        .bg-gradient-warning {
            background: linear-gradient(45deg, #ffc107, #fd7e14);
        }

        .accordion-button:not(.collapsed) {
            background-color: rgba(13, 110, 253, 0.1);
            color: #0d6efd;
        }

        code {
            font-size: 1.1em;
            color: #d63384;
        }
    </style>
@endsection
