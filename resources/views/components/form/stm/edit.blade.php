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
        @php
        $uniqueGroupPermission = collect($groupPermission)->unique('group_name');
        @endphp

        @forelse ($uniqueGroupPermission as $gp)
        @if($gp['group_name'])
        <div class="mb-3">
          <input type="text" name="group_name" class="form-control" id="group_name" value="{{ $gp['group_name'] }}">
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
            @php
            // Menyaring permissions untuk menu_group_id
            $permissions = collect($groupPermission)->where('menu_item_id', $g->id);
            @endphp
            <tr>
              <td>
                <i class="{{ $g->url == '#' ? 'ri-layout-grid-fill' : 'ri-checkbox-blank-circle-line' }}"></i>
                &ensp;
                <strong style="margin-right: 7px;">
                  <i class="{{ $g->icon }}"></i>
                  &ensp;{{ $g->name }}
                </strong>
                [<i style="color: rgb(0, 125, 243); margin: 5px;">{{ $g->url }}</i>]
              </td>
              @if($g['url']=='#')
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              @else
              <td>
                <input type="checkbox" class="form-switch" name="manage[{{ $g->id }}][{{ $g->id }}]" id="manage_{{ $g->id }}_{{ $g->id }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Manage data {{ $g->name }}"
                  @if($permissions->contains('permission_types.manage', true)) checked @endif
                >
              </td>
              <td>
                <input type="checkbox" class="form-switch" name="create[{{ $g->id }}][{{ $g->id }}]" id="create_{{ $g->id }}_{{ $g->id }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Create data {{ $g->name }}"
                  @if($permissions->contains('permission_types.create', true)) checked @endif
                >
              </td>
              <td>
                <input type="checkbox" class="form-switch" name="delete[{{ $g->id }}][{{ $g->id }}]" id="delete_{{ $g->id }}_{{ $g->id }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete data {{ $g->name }}"
                  @if($permissions->contains('permission_types.delete', true)) checked @endif
                >
              </td>
              <td>
                <input type="checkbox" class="form-switch" name="update[{{ $g->id }}][{{ $g->id }}]" id="update_{{ $g->id }}_{{ $g->id }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Update data {{ $g->name }}"
                  @if($permissions->contains('permission_types.update', true)) checked @endif
                >
              </td>
              <td>
                <input type="checkbox" class="form-switch" name="view[{{ $g->id }}][{{ $g->id }}]" id="view_{{ $g->id }}_{{ $g->id }}" data-bs-toggle="tooltip" data-bs-placement="top" title="View data {{ $g->name }}"
                  @if($permissions->contains('permission_types.view', true)) checked @endif
                >
              </td>
              @endif
            </tr>
            @foreach ($g->children as $i)
            @php
            // Menyaring $groupPermission untuk mendapatkan izin berdasarkan menu_item_id
            $itemPermissions = collect($groupPermission)->firstWhere('menu_item_id', $i->id);
            @endphp

            @include('components.form.stm.editchild', [
            'g' => $g,
            'i' => $i,
            'level' => 1,
            'itemPermissions' => $itemPermissions
            ])
            @endforeach
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</form>