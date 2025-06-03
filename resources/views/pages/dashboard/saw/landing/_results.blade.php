@php $ranking = session('hasil'); @endphp

<div class="card shadow-lg mt-4 border-0" id="resultsSection">
    <div class="card-header bg-white py-3">
        <h5 class="mb-0 text-primary">🏆 Hasil Perhitungan & Ranking</h5>
    </div>
    <div class="card-body">
        <div class="alert alert-info">
            <i class="fas fa-info-circle me-2"></i>
            Berikut adalah hasil perhitungan menggunakan metode SAW. Alternatif dengan skor tertinggi merupakan rekomendasi terbaik.
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
                                <span class="badge bg-{{ $i < 3 ? 'primary' : 'secondary' }} mb-2 fs-6 px-3 py-2 rounded-pill">
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
