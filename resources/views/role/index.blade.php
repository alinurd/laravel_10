@extends('components.layouts.default')

@section('title', 'Role Management')

@section('breadcrumb')
<x-dashboard.breadcrumb title="Role Management" page="Role Management" active="Role" route="{{ route('role.index') }}" />
@endsection

@section('content')
<form action="{{ route('role.store') }}" method="post">
@csrf
    <div class="card card-height-100 table-responsive">
        <!-- cardheader -->
        <div class="card-header border-bottom-dashed align-items-center d-flex">
            <div class="flex-shrink-0">
                <button type="submit" class="btn btn-primary btn-md">
                    <i class="ri-add-line"></i>
                    Simpan
                </button>
            </div>
        </div>
        <!-- end cardheader -->
        <!-- Hoverable Rows -->
        <div class="modal-body">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="hidden" class="form-control" id="guard_name" value="web" placeholder="Guard Name" name="guard_name">
                <input type="text" class="form-control" id="name" placeholder="Role Name" name="name">
                <x-form.validation.error name="name" />
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea type="text" class="form-control" id="description" placeholder="Role description" name="description"></textarea>
                <x-form.validation.error name="description" />
            </div>
            <div class="mb-3">
                <label for="permissions[]" class="form-label">Permission Name</label>
                <select class="form-control" id="permissions[]" name="permissions[]" data-choices data-choices-removeItem multiple>
                    @foreach ($permissions as $permission)
                    <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                    @endforeach
                </select>
                <x-form.validation.error name="permissions" />
            </div>

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
                        <td><strong>{{ $g->name }}</strong></td>
                        <td><input type="checkbox" class="form-switch" name="manage[{{ $g->id }}][]" id="manage_{{ $g->id }}"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    @foreach ($g->menuItems as $i)
                    <tr>
                        <td style="padding-left: 30px;"><strong>{{ $i->name }}</strong></td>
                        <td><input type="checkbox" class="form-switch" name="manage[{{ $g->id }}][{{ $i->id }}]" id="manage_{{ $g->id }}_{{ $i->id }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Manage  {{ $i->name }}"></td>
                        <td><input type="checkbox" class="form-switch" name="create[{{ $g->id }}][{{ $i->id }}]" id="create_{{ $g->id }}_{{ $i->id }}" data-bs-toggle="tooltip" data-bs-placement="top" title="create data {{ $i->name }}"></td>
                        <td><input type="checkbox" class="form-switch" name="delete[{{ $g->id }}][{{ $i->id }}]" id="delete_{{ $g->id }}_{{ $i->id }}" data-bs-toggle="tooltip" data-bs-placement="top" title="delete data {{ $i->name }}"></td>
                        <td><input type="checkbox" class="form-switch" name="update[{{ $g->id }}][{{ $i->id }}]" id="update_{{ $g->id }}_{{ $i->id }}" data-bs-toggle="tooltip" data-bs-placement="top" title="update data {{ $i->name }}"></td>
                        <td><input type="checkbox" class="form-switch" name="view[{{ $g->id }}][{{ $i->id }}]" id="view_{{ $g->id }}_{{ $i->id }}" data-bs-toggle="tooltip" data-bs-placement="top" title="view data {{ $i->name }}"></td>
                    </tr>
                    @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</form>
@endsection