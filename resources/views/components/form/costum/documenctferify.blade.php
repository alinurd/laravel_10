@php
$disabled = "";
$readonly = "";
$hide = "";

if ($mode == "show") {
$disabled = "disabled";
$readonly = "readonly";
$hide = "d-none";
}
$arrTermin=false;
if(isset($costum['header'])){
  $arrTermin=json_decode($costum['header']['termin']);
}
@endphp

<div class="card">
  <div class="card-header d-flex justify-content-between">

    <span><strong>Input Termin</strong></span>
    <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTermin" aria-expanded="false" aria-controls="collapseTermin">
      <i class="ri-arrow-down-s-line"></i>
    </button>
  </div>
  <div class="collapse" id="collapseTermin">
    
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Termin</th>
          <th>Nominal</th>
          <th>
            <span class="btn btn-dark btn-sm" id="tambahTermin">Tambah Termin</span>
          </th>
        </tr>
      </thead>
      <tbody id="terminTable">
        @if($arrTermin)
        @foreach($arrTermin as $termin)
        <tr>
        <td>Termin {{ $termin->termin }}</td>
        <td><input name="termin[]" type="text" class="form-control nominal" value="{{ $termin->nominal }}" placeholder="Contoh: 1.000,50"></td>
        <td><span name="nominalTermin[]" class="btn btn-danger btn-sm hapus-btn">Hapus</span></td>
        </tr>
        @endforeach
        @endif
      </tbody>
      <tfoot>
        <tr>
          <td class="fw-bold">Total:</td>
          <td colspan="2"><span class="fw-bold" id="totalTermin">Rp 0</span></td>
        </tr>
      </tfoot>
    </table> 
  </div>
</div> 

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
            <th><span class="btn btn-success btn-sm addRow {{$hide}}" data-id="{{ $p->id }}" data-key="{{ $p->data }}"><i class="ri-add-large-line"></i></span></th>
          </tr>
        </thead>
        <tbody>
          <input type="hidden" name="customEdit[cName][]" value="{{ $p->data }}" class="form-control" {{$disabled}} {{$readonly}}>
          @if(isset($dataDetail) && in_array($p->data, array_column($dataDetail->toArray(), 'pid')))
          @foreach($dataDetail as $detail)
          @if($detail->pid == $p->data)

          <tr>
            <td class="text-center">
              <input type="hidden" name="customEdit[{{ $p->data }}][id][]" value="{{ $detail->id }}" class="form-control" {{$disabled}} {{$readonly}}>
              <input type="text" name="customEdit[{{ $p->data }}][Uraian][]" value="{{ $detail->uraian }}" class="form-control" {{$disabled}} {{$readonly}}>
            </td>
            <td class="text-center">
              <input type="date" name="customEdit[{{ $p->data }}][DOS][]" value="{{ $detail->dos ? \Carbon\Carbon::parse($detail->dos)->format('Y-m-d') : '' }}" class="form-control" {{$disabled}} {{$readonly}}>
            </td>
            <td class="text-center">
              <textarea name="customEdit[{{ $p->data }}][Ket][]" class="form-control" {{$disabled}} {{$readonly}}>{{ $detail->ket }}</textarea>
            </td>
            <td class="text-center">
              <input name="customEdit[{{ $p->data }}][DOV][]" value="{{ $detail->dov ? \Carbon\Carbon::parse($detail->dov)->format('Y-m-d') : '' }}" readonly type="date" class="form-control" {{$disabled}} {{$readonly}}>
            </td>
            <td>
              <span class="btn btn-danger btn-sm removeRow {{$hide}}"><i class="ri-delete-bin-7-line"></i></span>
            </td>
          </tr>
          @endif
          @endforeach
          @else
          <tr>
            <td class="text-center">
              <input type="hidden" name="custom[cName][]" readonly value="{{ $p->data }}" class="form-control" {{$disabled}} {{$readonly}}>
              <input type="hidden" name="custom[{{ $p->data }}][id][]" class="form-control" {{$disabled}} {{$readonly}}>
              <input type="text" name="custom[{{ $p->data }}][Uraian][]" class="form-control" {{$disabled}} {{$readonly}}>
            </td>
            <td class="text-center">
              <input type="date" name="custom[{{ $p->data }}][DOS][]" class="form-control" {{$disabled}} {{$readonly}}>
            </td>
            <td class="text-center">
              <textarea name="custom[{{ $p->data }}][Ket][]" class="form-control" {{$disabled}} {{$readonly}}></textarea>
            </td>
            <td class="text-center">
              <input name="custom[{{ $p->data }}][DOV][]" type="date" readonly class="form-control" {{$disabled}} {{$readonly}}>
            </td>
            <td>
              <span class="btn btn-danger btn-sm removeRow {{$hide}}"><i class="ri-delete-bin-7-line"></i></span>
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

