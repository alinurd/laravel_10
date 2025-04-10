
@php
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
        <td><input name="termin[]" type="text" readonly class="form-control nominal" value="{{ $termin->nominal }}" placeholder="Contoh: 1.000,50"></td>
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
  @php
  $x=auth();
  $auth=$x;
  $user = $x->user();
  @endphp 
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
                type="date" class="form-control"{{ $user->verified ==1  ? '' : 'readonly' }}>
                 
              <br>
              <textarea name="review" id="review{{ $detail->id }}" cols="2" rows="2" class="form-control" {{ $user->verified ==1  ? '' : 'readonly' }}>{{ $detail->ket_review ? $detail->ket_review : '' }}</textarea>
            </td>
            <td>
              <div id="spinner{{ $detail->id }}" class="spinner-border text-dark d-none" role="status"
                style="width: 1.5rem; height: 1.5rem;">
                <span class="visually-hidden">Loading...</span>
              </div>
              <!-- is approv -->
              <div class="{{ $detail->review == 1 ? '' : 'd-none' }}" id="isApporv{{ $detail->id }}">
                <span style="padding:2px; font-size: 20px;" class="badge bg-success btn" data-toggle="tooltip" data-placement="top" title="Verified">
                  <strong><i class="ri-check-fill"></i></strong>
                </span>
                <div class="form-check form-switch form-switch-right form-switch-md mt-4">
                  <label for="reset{{ $detail->id }}" class="form-label text-info">Reset?</label>
                  <input class="form-check-input code-switcher reset" type="checkbox" id="reset{{ $detail->id }}" data-id="{{ $detail->id }}" name="reset{{ $detail->id }}" value="1" data-toggle="tooltip" data-placement="top" title="reset verifiied?" {{ $user->verified ==1  ? '' : 'disabled' }}>
                </div>
              </div>  
              <!-- is reject -->
              <div class="{{ $detail->review == 3 ? '' : 'd-none' }}" id="isRejected{{ $detail->id }}">
                <span style="padding:2px; font-size: 20px;" class="badge bg-danger btn" data-toggle="tooltip" data-placement="top" title="Rejected">
                  <strong><i class="ri-close-fill"></i></strong>
                </span>
                <div class="form-check form-switch form-switch-right form-switch-md mt-4">
                  <label for="reset{{ $detail->id }}" class="form-label text-info">Reset?</label>
                  <input class="form-check-input code-switcher" type="checkbox" id="reset{{ $detail->id }}" data-id="{{ $detail->id }}" name="reset{{ $detail->id }}" value="2" data-toggle="tooltip" data-placement="top" title="reset verifiied?" {{ $user->verified ==1  ? '' : 'disabled' }}>
                </div>
              </div>  

              <!-- rejected -->
              <div class="{{ $detail->review == 0 ? '' : 'd-none' }}" id="Rejected{{ $detail->id }}">
              <div class="form-check form-switch form-switch-right form-switch-md mt-4">
                  <label for="reject{{ $detail->id }}" class="form-label text-danger">Reject?</label>
                  <input class="form-check-input code-switcher reject" type="checkbox" id="reject{{ $detail->id }}" data-id="{{ $detail->id }}" name="reject{{ $detail->id }}" value="2" data-toggle="tooltip" data-placement="top" title="reject dokument?" {{ $user->verified ==1  ? '' : 'disabled' }}>
                </div>
               </div>
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


