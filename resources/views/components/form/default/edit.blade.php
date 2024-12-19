<form action="{{ route($currentRoute . '.update', [$currentRoute => $id]) }}" method="POST">
  @csrf
  @method('PUT')
  <div class="card card-height-100 ">
    <!-- cardheader -->
    <div class="card-header border-bottom-dashed align-items-center d-flex">
      <div class="row w-100">
        <div class="d-flex gap-2">
          <button type="submit" class="btn btn-secondary btn-md">
            <i class="ri-save-line"></i>
            {{ __('global.save') }}
          </button>
          <a href="{{ route($currentRoute.'.create') }}" class="btn btn-primary btn-md">
            <i class="ri-add-line"></i>
            {{ __('global.addNew') }}
          </a>
          <a href=" {{ route($currentRoute.'.index') }} " class="btn btn-dark btn-md">
            <i class="ri-arrow-left-line"></i>
            {{ __('global.back') }}
          </a>
        </div>
      </div>
    </div>
    <div class="card-footer ">
      <div class="table-responsive m-3">
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
    <option value="{{ $opt['id'] }}"
      @if(isset($field[$l['field']]) && $opt['id'] == $field[$l['field']]) selected @endif>
      {{ $opt['value'] }}
    </option>
    @endforeach

  </select>

  <!-- Radio Input -->
  @elseif($l['type'] === 'radio')
  @foreach($l['option'] as $opt)
  <div class="form-check">
    <input class="form-check-input"
      type="radio"
      name="{{ $l['field'] }}@if($l['multiple'])[]@endif"
      id="{{ $l['field'] }}_{{ $opt['id'] }}"
      value="{{ $opt['id'] }}"
      @if($l['required']) required @endif
      @if(isset($field[$l['field']]) && $field[$l['field']] == $opt['id']) checked @endif
      aria-describedby="{{ $l['field'] }}Help">
    <label class="form-check-label" for="{{ $l['field'] }}_{{ $opt['id'] }}">
      {{ $opt['value'] }}
    </label>
  </div>
  @endforeach

  <!-- Rupiah Input -->
  @elseif($l['input'] === 'rupiah')
  <div class="input-group mb-3">
    <span class="input-group-text" id="basic-addon1">Rp</span>
    <input type="text"
      name="{{ $l['field'] }}"
      placeholder="{{ $l['label'] }}"
      aria-label="{{ $l['field'] }}"
      class="form-control rupiah"
      id="{{ $l['field'] }}"
      value="{{ old($l['field'], $field[$l['field']]) }}"
      @if($l['required']) required @endif
      aria-describedby="{{ $l['field'] }}Help"
      oninput="_formatRupiah(this)">
  </div>

  <!-- Text Input -->
  @else
  <input type="{{ $l['type'] }}"
    name="{{ $l['field'] }}"
    class="form-control"
    id="{{ $l['field'] }}"
    value="{{ old($l['field'], $field[$l['field']]) }}"
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


        @if(isset($costum) && $costum->isNotEmpty())
        <!-- @include('components.form.costum.documenctferifyreview') -->
        @include('components.form.costum.documenctferify')
        @else
        @endif

      </div>
    </div>
  </div>
</form>