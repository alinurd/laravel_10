 
  document.addEventListener('DOMContentLoaded', function() {
    const tambahBtn = document.getElementById('tambahTermin');
    const terminTable = document.getElementById('terminTable');
    const totalDisplay = document.getElementById('totalTermin');

    function formatRupiah(angka) {
      return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0,
        maximumFractionDigits: 2
      }).format(angka);
    }

    function parseRupiah(input) {
      // Ganti titik dengan kosong, koma dengan titik
      let clean = input.replace(/\./g, '').replace(',', '.');
      return parseFloat(clean) || 0;
    }

    function hitungTotal() {
      let total = 0;
      document.querySelectorAll('.nominal').forEach(input => {
        total += parseRupiah(input.value);
      });
      totalDisplay.textContent = formatRupiah(total);
    }

    function tambahBaris() {
      const index = terminTable.children.length + 1;
      const row = document.createElement('tr');
      row.innerHTML = `
        <td>Termin ${index}</td>
        <td><input name="termin[]" type="text" class="form-control nominal" value="0" placeholder="Contoh: 1000,50">
          <div id="${index}" class="form-text text-warning">
            <i>hanya bisa angka dan komam " 1000000,50 "</i>
          </div>
        </td>
        <td><span name="nominalTermin[]" class="btn btn-danger btn-sm hapus-btn">Hapus</span></td>
      `;
      terminTable.appendChild(row);
    }

    tambahBtn.addEventListener('click', function() {
      tambahBaris();
    });

    terminTable.addEventListener('input', function(e) {
      if (e.target.classList.contains('nominal')) {
        hitungTotal();
      }
    });

 

    // Batasi input hanya angka dan koma
    terminTable.addEventListener('keypress', function(e) {
      if (e.target.classList.contains('nominal')) {
        const char = String.fromCharCode(e.which);
        const allowed = /[0-9,]/;
        if (!allowed.test(char)) {
          e.target.value = formatRupiah(value)
          // e.preventDefault();
        }
      }
    });

    terminTable.addEventListener('click', function(e) {
      if (e.target.classList.contains('hapus-btn')) {
        e.target.closest('tr').remove();
        updateTerminNumbering(); // perbarui nomor Termin
        hitungTotal(); // hitung ulang total
      }
    });

    function updateTerminNumbering() {
      const rows = terminTable.querySelectorAll('tr');
      rows.forEach((row, index) => {
        row.children[0].textContent = `Termin ${index + 1}`;
      });
    }

    // tambahBaris();
    hitungTotal();
  });

  $(document).ready(function() {


    $(document).on('click', '.toggleHeader', function() {
      var tableId = $(this).data('id');
      var key = $(this).data('key');
      var headerRow = $('#header-row-' + tableId);

      headerRow.toggle();
    });
    $(document).on('click', '.addRow', function() {
      var tableId = $(this).data('id');
      var key = $(this).data('key');

      var newRow = `
                    <tr>
                    
                        <td width="45%" class="text-center">
                                        <input type="hidden" name="custom[cNameBaru][]" readonly value="${key}" class="form-control"  {{$disabled}} {{$readonly}}>

                <input type="text" name="custom[${key}][Uraian][]" class="form-control"  {{$disabled}} {{$readonly}}>
            </td>
            <td width="10%" class="text-center">
                <input name="custom[${key}][DOS][]" type="date" class="form-control"  {{$disabled}} {{$readonly}}>
            </td>
            <td width="25%" class="text-center">
                <textarea name="custom[${key}][Ket][]" class="form-control"  {{$disabled}} {{$readonly}}></textarea>
            </td>
            <td width="10%" class="text-center">
                <input type="date" name="custom[${key}][DOV][]" readonly class="form-control"  {{$disabled}} {{$readonly}}>
            </td>
                        <td>
                            <span class="btn btn-danger btn-sm removeRow"><i class="ri-delete-bin-7-line"></i></span>
                        </td>
                    </tr>
                `;
      $('#table-' + tableId + ' tbody').append(newRow);
    });

    $(document).on('click', '.removeRow', function() {
      $(this).closest('tr').remove();
    });
  }); 