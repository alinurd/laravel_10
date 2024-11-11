<!-- Modals add menu -->
<div id="modal-form-add-role" class="modal fade" tabindex="-1" aria-labelledby="modal-form-add-role-label" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="card ">
    <!-- cardheader -->
    <div id="filter" class="card-header border-bottom-dashed align-items-center d-flex">
         <div class="d-flex gap-2">
          Filter Data
       </div>
    </div>
    <div class="card-footer ">
      <div class="table-responsive m-3">
        @forelse ($list as $l)
        @if($l['filter'])

        <div class="mb-3">
          <label for="{{ $l['field'] }}" class="form-contro form-label">
            {{ $l['field'] }}
            @if($l['required']) 
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
            <option value="{{ $opt['id'] }}">{{ $opt['value'] }}</option>
            @endforeach
          </select>
          @else
          <input type="{{ $l['type'] }}"
            name="{{ $l['field'] }}"
            class="form-control"
            id="{{ $l['field'] }}"
            @if($l['required']) required @endif
            aria-describedby="{{ $l['field'] }}Help">
          @endif
        </div>
        @endif
        @empty
        <span>No data available</span>
        @endforelse
      </div>
    </div>
  </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->