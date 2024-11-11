     <div class="card card-height-100 ">
        <!-- cardheader -->
        <div class="card-header border-bottom-dashed align-items-center d-flex">
            <div class="row w-100">
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#modal-form-add-permission">
                        <i class="ri-add-line"></i>
                        {{ __('global.save') }}
                    </button>
                    <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modal-form-print">
                        <i class="ri-printer-line"></i>
                        {{ __('global.saveBack') }}
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modal-form-filter">
                        <i class="ri-filter-3-line"></i>
                        {{ __('global.censel') }}
                    </button>
                    <a href=" {{ route($currentRoute.'.index') }} " class="btn btn-dark btn-sm">
                        <i class="ri-add-line"></i>
                        {{ __('global.back') }}
                    </a>
                </div>
            </div>
        </div>
        <div class="card-footer ">
        <div class="table-responsive m-3">
            <form>
            @forelse ($list as $l)
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">{{ $l['label'] }}</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
                @empty
                <th colspan="3" class="text-center">No data available</th>

                @endforelse

            </form>
        </div>
        </div>
        
    </div>
 