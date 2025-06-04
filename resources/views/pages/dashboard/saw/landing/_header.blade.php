<div class="card bg-gradient-primary shadow-lg mb-4">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="text-dark mb-1">📊 Metode SAW (Simple Additive Weighting)</h2>
                <p class="text-dark opacity-8 mb-0">Sistem Pendukung Keputusan Pemilihan Alternatif Terbaik</p>
            </div>
            <div class="d-flex">
                <button class="btn btn-light btn-sm me-2" data-bs-toggle="modal" data-bs-target="#tutorialModal">
                    <i class="fas fa-question-circle me-1"></i> Panduan
                </button>
                <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#formulaModal">
                    <i class="fas fa-square-root-variable me-1"></i> Rumus
                </button>
                
                <a hhref="{{ route('login') }}" class="btn btn-light btn-sm">
                    <i class="fas fa-square-root-variable me-1"></i> Login
                </a>
                <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop" aria-controls="offcanvasTop">Toggle top offcanvas</button>

            </div>
        </div>
    </div>
    <div class="offcanvas offcanvas-top" tabindex="-1" id="offcanvasTop" aria-labelledby="offcanvasTopLabel">
  <div class="offcanvas-header">
    <h5 id="offcanvasTopLabel">Offcanvas top</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    ...
  </div>
</div>
</div>


Offcanvas

munculkan di bawah