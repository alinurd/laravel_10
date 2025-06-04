  
<div class="container">
    <h2 class="mb-4">Hasil Perhitungan SAW (Simple Additive Weighting)</h2>

    <p><strong>Rumus Normalisasi:</strong></p>
    <ul>
        <li>Jika kriteria <strong>Benefit</strong>: <code>r<sub>ij</sub> = x<sub>ij</sub> / max(x<sub>j</sub>)</code></li>
        <li>Jika kriteria <strong>Cost</strong>: <code>r<sub>ij</sub> = min(x<sub>j</sub>) / x<sub>ij</sub></code></li>
    </ul>

    <p><strong>Rumus Terbobot:</strong></p>
    <ul>
        <li><code>t<sub>ij</sub> = r<sub>ij</sub> × w<sub>j</sub></code>, di mana <code>w<sub>j</sub></code> adalah bobot normalisasi</li>
    </ul>

    <p><strong>Skor Akhir:</strong> <code>Skor<sub>i</sub> = Σ t<sub>ij</sub></code></p>

    <hr>

    @foreach($hasil as $data)
        <div class="card mb-4 shadow">
            <div class="card-body">
                <h4 class="card-title">{{ $data['nama'] }}</h4>

                <table class="table table-bordered mt-3">
                    <thead class="table-light">
                        <tr>
                            <th>Kriteria</th>
                            <th>Nilai Asli (x<sub>ij</sub>)</th>
                            <th>Normalisasi (r<sub>ij</sub>)</th>
                            <th>Bobot (w<sub>j</sub>)</th>
                            <th>Terbobot (t<sub>ij</sub>)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data['detail'] as $item)
                            <tr>
                                <td>{{ $item['kriteria'] }}</td>
                                <td>{{ $item['nilai'] }}</td>
                                <td>{{ $item['normalisasi'] }}</td>
                                <td>{{ number_format($item['bobot'], 4) }}</td>
                                <td>{{ number_format($item['terbobot'], 6) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <h5 class="mt-3">Skor Akhir {{ $data['nama'] }}:
                    <strong>{{ number_format($data['skor'], 6) }}</strong></h5>

                <p><em>Rumus:</em> 
                    @foreach($data['detail'] as $item)
                        {{ number_format($item['normalisasi'], 6) }} × {{ number_format($item['bobot'], 4) }}
                        @if (!$loop->last)+@endif
                    @endforeach
                    = <strong>{{ number_format($data['skor'], 6) }}</strong>
                </p>
            </div>
        </div>
    @endforeach
</div>  
