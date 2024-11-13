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
          <label for="{{ $l['field'] }}" class="form-contro form-label">
            {{ $l['label'] }}
            @if($l['required'])
            <span class="text-danger">(*</span>
            @endif
          </label>
          <br>@if($l['type'] === 'select')
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
              @if(isset($field[$l['field']]) && $opt['id']==$field[$l['field']]) selected @endif>
              {{ $opt['value'] }}
            </option>
            @endforeach


          </select>
          @else
          <input type="{{ $l['type'] }}"
            name="{{ $l['field'] }}"
            class="form-control"
            id="{{ $l['field'] }}"
            value="{{ $field[$l['field']] }}"
            @if($l['required']) required @endif
            aria-describedby="{{ $l['field'] }}Help">
          @endif


          <div id="{{ $l['field'] }}Help" class="form-text text-warning">
            <i>{{ __($currentRoute . '.hlp_' . $l['field']) }}</i>
          </div>
        </div>
        @endif
        @empty
        <span>No data available</span>
        @endforelse



      </div>
    </div>
  </div>
</form>