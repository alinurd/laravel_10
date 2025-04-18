<!-- Fullscreen Modal -->
<div id="showDoc" class="modal fade" tabindex="-1" aria-labelledby="showDoc-label" aria-hidden="true">
  <!-- Tempatkan di bagian bawah layout utama -->
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

      // Render konten modal
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

      // Handle tombol sync
      const syncButton = modalBody.querySelector('.sync-button');
      // Dalam event listener tombol sync
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

          // Handle HTTP errors
          if (!response.ok) {
            const errorResponse = await response.text();
            throw new Error(`HTTP error! status: ${response.status} - ${errorResponse}`);
          }

          const result = await response.json();

          if (!result.success) {
            throw new Error(result.message || 'Terjadi kesalahan tidak terduga');
          }

          // Notifikasi sukses
          showToast('success', 'Berhasil!', `${result.message} Jumlah data: ${result.count}`);

        } catch (error) {
          console.error('Sync Error:', error);

          // Klasifikasi jenis error
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

      // Fungsi toast notification
      function showToast(type, title, message) {
        const toastContainer = document.querySelector('.toast-container');
        const toastId = `toast-${Date.now()}`;

        const toast = document.createElement('div');
        toast.className = `toast align-items-center text-bg-${type} border-0 fade`;
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

      const docList = modalBody.querySelector('.document-list');
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
    });
  });
</script>

<style>
  .toast {
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    transition: all 0.3s ease;
  }

  .toast:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
  }

  .document-card {
    border-radius: 15px;
    transition: transform 0.2s;
    border: 1px solid rgba(0, 0, 0, 0.1);
  }

  .document-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
  }

  .termin-item {
    transition: all 0.2s;
    border: 1px solid #dee2e6;
  }

  .termin-item:hover {
    background: #f8f9fa;
    transform: scale(1.05);
  }

  .sync-button {
    transition: all 0.3s ease;
    padding: 8px 20px;
    border: 2px solid transparent;
    position: relative;
    overflow: hidden;
  }

  .sync-button:hover {
    transform: translateY(-1px);
    box-shadow: 0 2px 8px rgba(0, 123, 255, 0.3);
  }

  @keyframes spin {
    from {
      transform: rotate(0deg);
    }

    to {
      transform: rotate(360deg);
    }
  }

  .bi-arrow-repeat {
    transition: transform 0.3s ease;
  }

  .document-meta .badge {
    font-size: 0.9em;
    padding: 8px 12px;
    border-radius: 8px;
    margin-bottom: 5px;
  }
</style>