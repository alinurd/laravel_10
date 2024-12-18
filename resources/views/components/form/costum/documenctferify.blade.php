@foreach($costum as $p)
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
                  <th><span class="btn btn-success btn-sm addRow" data-id="{{ $p->id }}" data-key="{{ $p->data }}"><i class="ri-add-large-line"></i></span></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td width="45%" class="text-center">
                    <input type="text" name="custom[cName][]" readonly value="{{ $p->data }}" class="form-control">
                    <input type="text" name="custom[{{ $p->data }}][Uraian][]" class="form-control">
                  </td>
                  <td width="10%" class="text-center">
                    <input type="date" name="custom[{{ $p->data }}][DOS][]" class="form-control">
                  </td>
                  <td width="25%" class="text-center">
                    <textarea name="custom[{{ $p->data }}][Ket][]" class="form-control"></textarea>
                  </td>
                  <td width="10%" class="text-center">
                    <input name="custom[{{ $p->data }}][DOV][]" type="date" class="form-control">
                  </td>
                  <td>
                    <span class="btn btn-danger btn-sm removeRow"><i class="ri-delete-bin-7-line"></i></span>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      @endforeach
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

      <script>
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
                <input type="text" name="custom[${key}][Uraian][]" class="form-control">
            </td>
            <td width="10%" class="text-center">
                <input name="custom[${key}][DOS][]" type="date" class="form-control">
            </td>
            <td width="25%" class="text-center">
                <textarea name="custom[${key}][Ket][]" class="form-control"></textarea>
            </td>
            <td width="10%" class="text-center">
                <input type="date" name="custom[${key}][DOV][]" class="form-control">
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
      </script>