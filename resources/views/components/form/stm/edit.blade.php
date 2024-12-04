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
                 $permissions = collect($groupPermission)->where('menu_group_id', $g->id);
            @endphp

            <tr>
                <td><i class="ri-folder-2-line"></i> &ensp; <strong><strong>{{ $g->name }}</strong></td>
                <td>
                    <input type="checkbox" class="form-switch" name="manage[{{ $g->id }}][]" id="manage_{{ $g->id }}" 
                           @if($permissions->contains('permission_types.manage', true)) checked @endif>
                </td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            @foreach ($g->children as $i)
            @include('components.form.stm.editchild', ['g' => $g, 'i' => $i, 'level' => 1])
            @endforeach
            @endforeach
 
    </tbody>
</table>



      </div>
    </div>
  </div>
</form>