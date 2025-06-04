@php
    $disabled = "";
    $readonly = "";
    $hide = "";

    if ($mode == "show") {
        $disabled = "disabled";
        $readonly = "readonly";
        $hide = "d-none";
    } 
@endphp

<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">Sub Kriteria</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th width="30%" class="text-center">Nama</th>
                        <th width="40%"  class="text-center">Keterangan</th>
                        <th width="20%"  class="text-center">Nilai</th>
                        <th width="10%"  class="text-center">
                            <button type="button" class="btn btn-dark btn-sm" id="tambahTermin">
                                <i class="fas fa-plus me-1"></i> Tambah
                            </button>
                        </th>
                    </tr>
                </thead>
                <tbody id="terminTable"> 
                    @if($costum['data'])
                        @foreach($costum['data'] as $termin)
                        <tr>
                            <td>
                                <input name="SubKriteria[nama][]" type="text" class="form-control" 
                                       value="{{ $termin->nama }}" placeholder="Nama Sub Kriteria" {{ $readonly }}>
                                       <input name="SubKriteria[id][]" type="hidden" class="form-control" 
                                       value="{{ $termin->id }}" placeholder="Nama Sub Kriteria" {{ $readonly }}>

                            </td>
                            <td>
                                <input name="SubKriteria[ket][]" type="text" class="form-control" 
                                       value="{{ $termin->ket }}" placeholder="Deskripsi" {{ $readonly }}>
                            </td>
                            <td>
                                <input name="SubKriteria[nilai][]" type="text" class="form-control nominal" 
                                       value="{{ $termin->nilai }}" placeholder="0.00" {{ $readonly }}>
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-danger btn-sm hapus-btn" {{ $disabled }}>
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>