<form action="{{ route($currentRoute . '.store') }}" method="POST">
  @csrf
  <div class="card card-height-100 ">
    <!-- cardheader -->
    <div class="card-header border-bottom-dashed align-items-center d-flex">
      <div class="row w-100">
        <div class="d-flex gap-2">
          <button type="submit" class="btn btn-secondary btn-md">
            <i class="ri-save-line"></i>
            {{ __('global.save') }}
          </button>
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


          <div id="{{ $l['field'] }}Help" class="form-text text-warning">
            <i>{{ __($currentRoute . '.hlp_' . $l['field']) }}</i>
          </div>
        </div>
        @endif
        @empty
        <span>No data available</span>
        @endforelse
        <table class="table table-hover table-nowrap">
          <thead>
            <tr>
              <th>Menu</th>
              <th>Manage</th>
              <th>Create</th>
              <th>Delete</th>
              <th>Update</th>
              <th>View</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($menuGroup as $g)
            <tr>
              <td><i class="ri-folder-2-line"></i> &ensp; <strong>{{ $g->name }}</strong></td>
              @if($g['url']=='#')
              <td><input type="checkbox" class="form-switch" name="manage[{{ $g->id }}][{{ $g->id }}]" id="manage_{{ $g->id }}_{{ $g->id }}"></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              @else
              <td>
                <input type="checkbox" class="form-switch" name="manage[{{ $g->id }}][{{ $g->id }}]" id="manage_{{ $g->id }}_{{ $g->id }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Manage data {{ $g->name }}">
              </td>
              <td>
                <input type="checkbox" class="form-switch" name="create[{{ $g->id }}][{{ $g->id }}]" id="create_{{ $g->id }}_{{ $g->id }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Create data {{ $g->name }}">
              </td>
              <td>
                <input type="checkbox" class="form-switch" name="delete[{{ $g->id }}][{{ $g->id }}]" id="delete_{{ $g->id }}_{{ $g->id }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete data {{ $g->name }}">
              </td>
              <td>
                <input type="checkbox" class="form-switch" name="update[{{ $g->id }}][{{ $g->id }}]" id="update_{{ $g->id }}_{{ $g->id }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Update data {{ $g->name }}">
              </td>
              <td>
                <input type="checkbox" class="form-switch" name="view[{{ $g->id }}][{{ $g->id }}]" id="view_{{ $g->id }}_{{ $g->id }}" data-bs-toggle="tooltip" data-bs-placement="top" title="View data {{ $g->name }}">
              </td>
              @endif
            </tr>
            @foreach ($g->children as $i)
            @include('components.form.stm.child', ['g' => $g, 'i' => $i, 'level' => 1])
            @endforeach
            @endforeach
          </tbody>
        </table>
        <button type="submit" class="btn btn-primary">Save Permissions</button>

        <script>
          // Inisialisasi tooltip Bootstrap
          var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
          var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
          });
        </script>

        <script>
          // Initialize Bootstrap tooltips
          var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
          var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
          });
        </script>

      </div>

    </div>
  </div>
</form>