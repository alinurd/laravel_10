<form action="{{ route($currentRoute . '.store') }}" method="POST" enctype="multipart/form-data">
  @csrf
  <div class="card card-height-100 ">
    <!-- cardheader -->
    <div class="card-header border-bottom-dashed align-items-center d-flex">
      <div class="row w-100">
        <div class="d-flex gap-2">
        <x-dashboard.ActionHeader1 currentRoute="{{$currentRoute}}" mode="add" /> 
        </div>
      </div>
    </div>
    <div class="card-footer ">
      <div class="table-responsive m-3">
    
      @if(config('app.name') == 'Keuangan' && $currentRoute =="transaksi")
    <div class="mb-4">
        <label for="integrasiDokument" class="form-label fw-bold">
            Integrasi Dokument
        </label>

        <div class="d-flex align-items-center gap-2 flex-nowrap">
            {{-- Select2 Dropdown --}}
            <select id="integrasiDokument"
                    class="form-select form-select-lg select2"
                    style="width: 100px;"
                    aria-label="Pilih dokumen integrasi">
                <option selected disabled>Pilih dokumen...</option>
                <option value="1">Dokumen Satu</option>
                <option value="2">Dokumen Dua</option>
                <option value="3">Dokumen Tiga</option>
            </select>

            {{-- Tombol-tombol --}}
            <button type="button" class="btn btn-outline-primary">
                Lihat
            </button>
            <button type="button" class="btn btn-outline-secondary">
                Sync
            </button>
        </div>
    </div>
@endif

        <!-- form add -->
        @forelse ($list as $l)
        @if($l['show'])
        <div class="mb-3">
          <label for="{{ $l['field'] }}" class="form-label">
            {{ $l['label'] }}
            @if($l['required'])
            <span class="text-danger">(*</span>
            @endif
          </label>
          <br>

          <!-- Select Input -->
          @if($l['type'] === 'select')
          <select class="form-control select2" style="width: 100%"
            id="{{ $l['field'] }}"
            name="{{ $l['field'] }}@if($l['multiple'])[]@endif"
            @if($l['required']) required @endif
            @if($l['multiple']) multiple @endif
            aria-describedby="{{ $l['field'] }}Help">

            @if(!$l['multiple'])
            <option value="0" selected>{{ __('global.select') }}</option>
            @endif

            @foreach($l['option'] as $opt)
            <option value="{{ $opt['id'] }}">{{ $opt['value'] }}</option>
            @endforeach
          </select>

          @elseif($l['type'] === 'radio')
          @foreach($l['option'] as $opt)
          <div class="form-check">
            <input class="form-check-input"
              type="radio"
              name="{{ $l['field'] }}@if($l['multiple'])[]@endif"
              id="{{ $l['field'] }}_{{ $opt['id'] }}"
              value="{{ $opt['id'] }}"
              @if($l['required']) required @endif
              @if(isset($f[$l['field']]) && $f[$l['field']]==$opt['id']) checked @endif
              aria-describedby="{{ $l['field'] }}Help">
            <label class="form-check-label" for="{{ $l['field'] }}_{{ $opt['id'] }}">
              {{ $opt['value'] }}
            </label>
          </div>
          @endforeach

          @elseif($l['input'] === 'rupiah')
          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Rp</span>
            <input type="text"
              name="{{ $l['field'] }}"
              placeholder="{{ $l['label'] }}"
              aria-label="{{ $l['field'] }}"
              class="form-control rupiah inputRupiah"
              id="{{ $l['field'] }}"
              @if($l['required']) required @endif
              aria-describedby="{{ $l['field'] }}Help"
              oninput="_formatRupiah(this)">
          </div>

          @elseif($l['type'] === 'textarea')
          <div class="input-group mb-3">
          <textarea type="text" class="form-control"  id="{{ $l['field'] }}"  placeholder="{{ $l['label'] }}" name="{{ $l['field'] }}" @if($l['required']) required @endif
          aria-describedby="{{ $l['field'] }}Help"></textarea>
          </div>
          @elseif($l['type'] === 'json')
          <div class="input-group mb-3 bg">
          <textarea type="text" class="form-control"  id="{{ $l['field'] }}"  placeholder="{{ $l['label'] }}" name="{{ $l['field'] }}" @if($l['required']) required @endif
          aria-describedby="{{ $l['field'] }}Help" readonly></textarea>
          </div>
 
          @else
          <input type="{{ $l['type'] }}"
            name="{{ $l['field'] }}"
            class="form-control"
            id="{{ $l['field'] }}"
            @if($l['required']) required @endif
            aria-describedby="{{ $l['field'] }}Help">
          @endif

          <!-- Help Text -->
          @if(__($currentRoute . '.hlp_' . $l['field']) !== $currentRoute . '.hlp_' . $l['field'])
          <div id="{{ $l['field'] }}Help" class="form-text text-warning">
            <i>{{ __($currentRoute . '.hlp_' . $l['field']) }}</i>
          </div>
          @endif

        </div>
        @endif
        @empty
        @endforelse 
       </div>
        @if(!empty($costum))
    @if($costum[0] == 'chart')
        @include('components.form.costum.chart')
    @else
        @include('components.form.costum.documenctferify')
    @endif
@endif

 
      
    </div>
</form>

<script src="{{ asset('assets/js/pages/custom/' . $currentRoute . '.js') }}"></script>

