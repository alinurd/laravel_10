 
<div id="showDoc" class="modal fade" tabindex="-1" aria-labelledby="showDoc-label" aria-hidden="true">
  <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 9999"></div>
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h5 class="modal-title text-primary">Detail Dokumen</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4">
        <!-- Konten akan diisi secara dinamis -->
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const showDocBtn = document.querySelector('[data-bs-target="#showDoc"]');
    const modalBody = document.querySelector('#showDoc .modal-body');

    showDocBtn.addEventListener('click', function() {
      const dokumentData = JSON.parse(this.getAttribute('data-dokument'));
      renderModalContent(dokumentData);
    });

    // Fungsi utama untuk merender modal + data dokumen
    function renderModalContent(dokumentData) {
      modalBody.innerHTML = `
        <div class="container-fluid">
          <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="text-primary mb-0">Dokumen Integrasi</h3>
            <button class="btn btn-primary btn-sm rounded-pill sync-button">
              <i class="bi bi-arrow-repeat me-2"></i>
              Sync Now
            </button>
          </div>
          <div class="document-list"></div>
        </div>
      `;

      // Attach listener ke tombol Sync
      const syncButton = modalBody.querySelector('.sync-button');
      syncButton.addEventListener('click', async function() {
        const btn = this;
        const icon = btn.querySelector('i');

        // Loading state
        btn.disabled = true;
        icon.style.animation = 'spin 1s linear infinite';
        btn.innerHTML = `<i class="bi bi-arrow-repeat me-2"></i> Memproses...`;

        try {
          const response = await fetch('/sync-document', {
            method: 'POST',
            headers: {
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
              'Accept': 'application/json',
            }
          });

          if (!response.ok) {
            const errorResponse = await response.text();
            throw new Error(`HTTP error! status: ${response.status} - ${errorResponse}`);
          }

          const result = await response.json();

          if (!result.success) {
            throw new Error(result.message || 'Terjadi kesalahan tidak terduga');
          }
 
          showToast('success', 'Berhasil!', `${result.message} Jumlah data: ${result.count.all}`);
          console.info(result.count);
          renderModalContent(result.data);  

        } catch (error) {
          console.error('Sync Error:', error);
          let errorMessage = error.message;

          if (error instanceof TypeError) {
            errorMessage = 'Gagal terhubung ke server. Periksa koneksi internet Anda.';
          } else if (error.message.includes('Failed to fetch')) {
            errorMessage = 'Tidak dapat terhubung ke server. Coba lagi nanti.';
          } else if (error.message.includes('HTTP error')) {
            errorMessage = `Kesalahan server: ${error.message.split('-')[1]}`;
          }

          showToast('danger', 'Gagal Sync', errorMessage);
        } finally {
          btn.disabled = false;
          icon.style.animation = '';
          btn.innerHTML = `<i class="bi bi-arrow-repeat me-2"></i> Sync Now`;
        }
      }); 
      renderDokumen(dokumentData);
    }

    function renderDokumen(dokumentData) { 
      const docList = modalBody.querySelector('.document-list');
      docList.innerHTML = ''; // Clear list lama

      dokumentData.forEach(item => {
        try {
          const terminData = JSON.parse(item.termin.replace(/^"|"$/g, '').replace(/\\"/g, '"'));

          const terminItems = terminData.map(t => `
            <div class="termin-item bg-light rounded-pill px-3 py-1 d-inline-flex align-items-center me-2 mb-2">
              <span class="termin-badge bg-dark text-white rounded-pill me-2">${t.termin}</span>
              <span class="termin-value">Rp ${Number(t.nominal).toLocaleString()}</span>
            </div>
          `).join('');

          const card = document.createElement('div');
          card.className = 'document-card card shadow-sm mb-4';
          card.innerHTML = `
            <div class="card-body">
              <div class="row align-items-center">
                <div class="col-md-8">
                  <h5 class="card-title text-dark">${item.jenis_product}</h5>
                  <div class="document-meta mb-3">
                    <span class="badge bg-info me-2">ID: ${item.id}</span>
                    <span class="badge bg-secondary me-2">Kode: ${item.kode}</span>
                    <span class="badge bg-success">Nilai: Rp ${Number(item.nilai).toLocaleString()}</span>
                  </div>
                </div>
              </div>
              <hr>
              <h6 class="text-muted mb-3">Termin Pembayaran</h6>
              <div class="termin-container">${terminItems}</div>
            </div>
          `;

          docList.appendChild(card);
        } catch (e) {
          const errorCard = document.createElement('div');
          errorCard.className = 'alert alert-danger mt-3';
          errorCard.textContent = 'Gagal memproses data termin';
          docList.appendChild(errorCard);
        }
      });
    }

    // Fungsi toast notifikasi
    function showToast(type, title, message) {
      const toastContainer = document.querySelector('.toast-container');
      const toastId = `toast-${Date.now()}`;

      const toast = document.createElement('div');
      toast.className = `toast align-items-center text-bg-${type} border-0 fade show mb-2`;
      toast.innerHTML = `
        <div class="d-flex">
          <div class="toast-body">
            <strong>${title}</strong><br>${message}
          </div>
          <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
      `;

      toastContainer.appendChild(toast);
      new bootstrap.Toast(toast).show();

      setTimeout(() => toast.remove(), 5000);
    }
  });
</script>

