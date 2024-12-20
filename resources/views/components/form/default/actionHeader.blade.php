<a href=" {{ route($currentRoute.'.create') }} " class="btn btn-primary btn-md">
    <i class="ri-add-line"></i>
    {{ __('global.add_new') }}
</a>
<button type="button" class="btn btn-info btn-md" data-bs-toggle="modal" data-bs-target="#modal-form-print">
    <i class="ri-printer-line"></i>
    {{ __('global.print') }}
</button>
<button type="button" class="btn btn-danger btn-md" data-bs-toggle="modal" data-bs-target="#modal-form-delete">
    <i class="ri-delete-bin-line"></i>
    {{ __('global.del') }}
</button>
<button type="button" class="btn btn-success btn-md" data-bs-toggle="modal" data-bs-target="#filter">
    <i class="ri-filter-3-line"></i>
    {{ __('global.filter') }}
</button>