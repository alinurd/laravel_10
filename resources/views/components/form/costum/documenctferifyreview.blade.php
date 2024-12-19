@foreach($costum as $k=> $p)
<div class="card">
  <div class="card-header d-flex justify-content-between">
    <span><strong>{{ $p->key1 }}. {{ $p->data }}</strong></span>
    <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $p->key1 }}" aria-expanded="false" aria-controls="collapse{{ $p->key1 }}">
      <i class="ri-arrow-down-s-line"></i>
    </button>
  </div>

  <div class="collapse" id="collapse{{ $p->key1 }}">
    <div class="card-body">
      <table class="table" id="table-{{ $p->id }}">
        <thead>
          <tr>
            <th width="45%" class="text-center">Uraian</th>
            <th width="10%" class="text-center">Date Of Submit</th>
            <th width="25%" class="text-center">Keterangan</th>
            <th width="10%" class="text-center">Date Of Verified</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <input type="hidden" name="customEdit[cName][]" readonly value="{{ $p->data }}" class="form-control">
          @if(isset($dataDetail) && in_array($p->data, array_column($dataDetail->toArray(), 'pid')))
          @foreach($dataDetail as $detail)
          @if($detail->pid == $p->data)

          <tr>
            <td class="text-center">
              <input type="hidden" name="customEdit[{{ $p->data }}][id][]" readonly value="{{ $detail->id }}" class="form-control">
              <input type="text" name="customEdit[{{ $p->data }}][Uraian][]" readonly value="{{ $detail->uraian }}" class="form-control">
            </td>
            <td class="text-center">
              <input type="date" name="customEdit[{{ $p->data }}][DOS][]" readonly value="{{ $detail->dos ? \Carbon\Carbon::parse($detail->dos)->format('Y-m-d') : '' }}" class="form-control">
            </td>
            <td class="text-center">
              <textarea name="customEdit[{{ $p->data }}][Ket][]" class="form-control" readonly>{{ $detail->ket }}</textarea>
            </td>
            <td class="text-center">
              <input name="customEdit[{{ $p->data }}][DOV][]" id="DOV{{ $detail->id }}" data-id="{{ $detail->id }}"
                value="{{ $detail->dov ? \Carbon\Carbon::parse($detail->dov)->format('Y-m-d') : '' }}"
                type="date" class="form-control">
              <br>
              <textarea name="review" id="review{{ $detail->id }}" cols="2" rows="2" class="form-control"></textarea>
            </td>
            <td>
              <div id="spinner{{ $detail->id }}" class="spinner-border text-dark d-none" role="status"
                style="width: 1.5rem; height: 1.5rem;">
                <span class="visually-hidden">Loading...</span>
              </div>
              <span style="padding:2px; font-size: 20px;" class="badge bg-success   d-none " id="{{ $detail->id }}"><strong><i class="ri-check-fill"></i></strong></span>
            </td>
          </tr>
          @endif
          @endforeach
          @else

          @endif
        </tbody>


      </table>
    </div>
  </div>
</div>


@endforeach
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
  function showSpinner(elementId) {
    $('#' + elementId).removeClass('d-none'); // Tampilkan spinner
  }

  function hideSpinner(elementId) {
    $('#' + elementId).addClass('d-none'); // Sembunyikan spinner
  }

  $(document).on('click', '.toggleHeader', function() {
    var tableId = $(this).data('id');
    var key = $(this).data('key');
    var headerRow = $('#header-row-' + tableId);

    headerRow.toggle();
  });
  $(document).ready(function() {
    // Event handler untuk perubahan pada input DOV

    $(document).on('change', 'input[id^="DOV"]', function() {
      var dovValue = $(this).val(); // Nilai dari DOV
      var detailId = $(this).data('id'); // ID dari detail yang terkait
      var spinnerId = 'spinner' + detailId; // ID spinner terkait

      // Ambil nilai dari textarea review
      var reviewValue = $(this).closest('tr').find('textarea').val();

      // Tampilkan spinner
      showSpinner(spinnerId);

      // Kirimkan data ke server menggunakan AJAX
      $.ajax({
        url: '/update-dov',
        method: 'POST',
        data: {
          _token: '{{ csrf_token() }}', // CSRF Token Laravel
          id: detailId,
          dov: dovValue,
          review: reviewValue
        },
        success: function(response) {
          $("#" + detailId).removeClass("d-none");
          hideSpinner(spinnerId);
          console.log('DOV updated successfully', response);
        },
        error: function(xhr, status, error) {
          // Sembunyikan spinner jika terjadi error
          hideSpinner(spinnerId);
          console.error('Error updating DOV:', error);
        }
      });
    });




  });
</script>