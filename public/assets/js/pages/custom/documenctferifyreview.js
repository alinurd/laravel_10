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
    $(document).on('change', 'input[id^="reject"]', function() {
      if ($(this).is(':checked')) {
        var confirmation = confirm("Apakah Anda yakin mereject data ini ?");
        if (confirmation) {
          var detailId = $(this).data('id');
           var dovValue = $("#DOV" + detailId).val();
         
          updateDOV(dovValue, detailId, 3)
        } else {
          $(this).prop('checked', false);
          $(this).val(0);
        }
      } else {
        $(this).val(0);
      }
    });
    $(document).on('change', 'input[id^="reset"]', function() {
      if ($(this).is(':checked')) {
        var confirmation = confirm("Apakah Anda yakin reset data ini ?");
        if (confirmation) {
          var detailId = $(this).data('id');
           var dovValue = $("#DOV" + detailId).val();
         
          updateDOV(dovValue, detailId, 2 )
        } else {
          $(this).prop('checked', false);
          $(this).val(0);
        }
      } else {
        $(this).val(0);
      }
    });

    $(document).on('change', 'input[id^="DOV"]', function() {
      var dovValue = $(this).val();
      var detailId = $(this).data('id');
      updateDOV(dovValue, detailId,1)
    });
  });

  function showSpinner(elementId) {
    $('#' + elementId).removeClass('d-none');  
  }
  function hideSpinner(elementId) {
    $('#' + elementId).addClass('d-none');  
  }
  $(document).on('click', '.toggleHeader', function() {
    var tableId = $(this).data('id');
    var key = $(this).data('key');
    var headerRow = $('#header-row-' + tableId);
    headerRow.toggle();
  });

  function updateDOV(dovValue, detailId, reset) {
    var dovValue = dovValue;
    var detailId = detailId;
    var reset = reset;
    var spinnerId = 'spinner' + detailId;
    var ket_review = $("#review" + detailId).val();
    
    showSpinner(spinnerId);
    var data = {
      _token: '{{ csrf_token() }}', // CSRF Token Laravel
      id: detailId,
      dov: dovValue,
      ket_review: ket_review,
      reset: reset,
      review: (reset > 0 ? reset : 0) // 1 => approved | 3 => reject | 1 => reset
    };
    console.log(data)
    $.ajax({
      url: '/update-dov',
      method: 'POST',
      data: data,
      success: function(response) {
        if (response.review == 1) {
          $("#Rejected" + detailId).addClass("d-none");
          $("#isRejected" + detailId).addClass("d-none");
          $("#isApporv" + detailId).removeClass("d-none");
        } else if (response.review == 3) {
          console.log("is rejectd")
          $("#isApporv" + detailId).addClass("d-none");
          $("#Rejected" + detailId).addClass("d-none");
          $("#isRejected" + detailId).removeClass("d-none");
        } else {
          $("#Rejected" + detailId).removeClass("d-none");
          $("#isApporv" + detailId).addClass("d-none");
          $("#isRejected" + detailId).addClass("d-none");
          $("#review" + detailId).val('');
          $("#DOV" + detailId).val(null);
        }
        hideSpinner(spinnerId);
      },
      error: function(xhr, status, error) {
        hideSpinner(spinnerId);
        console.error('Error updating DOV:', error);
      }
    });
  }