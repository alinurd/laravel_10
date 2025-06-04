<div class="modal fade InfoPopup" id="tutorialModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Panduan Metode SAW</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p><strong>SAW (Simple Additive Weighting)</strong> adalah metode pengambilan keputusan multikriteria dengan menjumlahkan nilai terbobot dari setiap alternatif berdasarkan setiap kriteria.</p>
        <ol>
          <li><strong>Tentukan alternatif</strong> yang akan dievaluasi (misalnya: Tokopedia, Shopee, dll).</li>
          <li><strong>Tentukan kriteria</strong> (misalnya: Biaya Admin, Fitur, Popularitas, dll), termasuk <strong>bobot</strong> dan <strong>jenis atribut</strong> (Benefit atau Cost).</li>
          <li><strong>Isi nilai (skor)</strong> dari setiap alternatif terhadap tiap kriteria.</li>
          <li><strong>Lakukan normalisasi</strong> nilai sesuai tipe kriteria:</li>
            <ul>
              <li>Benefit: nilai dibagi dengan nilai maksimal</li>
              <li>Cost: nilai minimal dibagi dengan nilai</li>
            </ul>
          <li><strong>Hitung nilai terbobot</strong> dengan mengalikan hasil normalisasi dengan bobot kriteria.</li>
          <li><strong>Jumlahkan semua nilai terbobot</strong> untuk mendapatkan skor akhir.</li>
        </ol>
        <p>Alternatif dengan <strong>skor tertinggi</strong> adalah yang paling direkomendasikan.</p>
      </div>
    </div>
  </div>
</div>



<div class="modal fade InfoPopup" id="formulaModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Formula Metode SAW</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h6><strong>Normalisasi Nilai</strong></h6>
        <ul>
          <li><strong>Jika Benefit:</strong> 
            <code>r<sub>ij</sub> = x<sub>ij</sub> / max(x<sub>j</sub>)</code></li>
          <li><strong>Jika Cost:</strong> 
            <code>r<sub>ij</sub> = min(x<sub>j</sub>) / x<sub>ij</sub></code></li>
        </ul>

        <h6><strong>Nilai Terbobot</strong></h6>
        <p><code>t<sub>ij</sub> = r<sub>ij</sub> × w<sub>j</sub></code></p>

        <h6><strong>Skor Akhir Alternatif</strong></h6>
        <p><code>Skor<sub>i</sub> = Σ t<sub>ij</sub></code></p>

        <hr>
        <p><strong>Keterangan:</strong></p>
        <ul>
          <li><code>x<sub>ij</sub></code>: Nilai asli alternatif ke-i pada kriteria ke-j</li>
          <li><code>w<sub>j</sub></code>: Bobot kriteria ke-j (harus dinormalisasi)</li>
          <li><code>r<sub>ij</sub></code>: Nilai normalisasi</li>
          <li><code>t<sub>ij</sub></code>: Nilai terbobot</li>
        </ul>
      </div>
    </div>
  </div>
</div>
