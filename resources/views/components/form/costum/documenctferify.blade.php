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
                  <th><span class="btn btn-success btn-sm addRow" data-id="{{ $p->id }}" data-key="{{ $p->data }}"><i class="ri-add-large-line"></i></span></th>
                </tr>
              </thead>
              <tbody>


                <input type="hidden" name="customEdit[cName][]" readonly value="{{ $p->data }}" class="form-control">
              @if(isset($dataDetail) && in_array($p->data, array_column($dataDetail->toArray(), 'pid')))
              @foreach($dataDetail as $detail)
            @if($detail->pid == $p->data) 

                <tr>
                    <td class="text-center">
                        <input type="hidden" name="customEdit[{{ $p->data }}][id][]" value="{{ $detail->id }}" class="form-control"> 
                        <input type="text" name="customEdit[{{ $p->data }}][Uraian][]" value="{{ $detail->uraian }}" class="form-control">
                    </td>
                    <td class="text-center">
                        <input type="date" name="customEdit[{{ $p->data }}][DOS][]" value="{{ $detail->dos ? \Carbon\Carbon::parse($detail->dos)->format('Y-m-d') : '' }}" class="form-control">
                    </td>
                    <td class="text-center">
                        <textarea name="customEdit[{{ $p->data }}][Ket][]" class="form-control">{{ $detail->ket }}</textarea>
                    </td>
                    <td class="text-center">
                        <input name="customEdit[{{ $p->data }}][DOV][]" value="{{ $detail->dov ? \Carbon\Carbon::parse($detail->dov)->format('Y-m-d') : '' }}" readonly type="date" class="form-control">
                    </td>
                    <td>
                        <span class="btn btn-danger btn-sm removeRow"><i class="ri-delete-bin-7-line"></i></span>
                    </td>
                </tr>
            @endif
        @endforeach
    @else
        <tr>
            <td class="text-center">
                <input type="hidden" name="custom[cName][]" readonly value="{{ $p->data }}" class="form-control">
                <input type="hidden" name="custom[{{ $p->data }}][id][]" class="form-control">
                <input type="text" name="custom[{{ $p->data }}][Uraian][]" class="form-control">
            </td>
            <td class="text-center">
                <input type="date" name="custom[{{ $p->data }}][DOS][]" class="form-control">
            </td>
            <td class="text-center">
                <textarea name="custom[{{ $p->data }}][Ket][]" class="form-control"></textarea>
            </td>
            <td class="text-center">
                <input name="custom[{{ $p->data }}][DOV][]" type="date"readonly  class="form-control">
            </td>
            <td>
                <span class="btn btn-danger btn-sm removeRow"><i class="ri-delete-bin-7-line"></i></span>
            </td>
        </tr>
    @endif
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
                                        <input type="hidden" name="custom[cNameBaru][]" readonly value="${key}" class="form-control">

                <input type="text" name="custom[${key}][Uraian][]" class="form-control">
            </td>
            <td width="10%" class="text-center">
                <input name="custom[${key}][DOS][]" type="date" class="form-control">
            </td>
            <td width="25%" class="text-center">
                <textarea name="custom[${key}][Ket][]" class="form-control"></textarea>
            </td>
            <td width="10%" class="text-center">
                <input type="date" name="custom[${key}][DOV][]" readonly class="form-control">
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