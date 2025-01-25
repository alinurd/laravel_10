 @if($mode=='add' && $canCreate && $currentRoute !="documenctferifyreview")
 <button type="submit" class="btn btn-secondary btn-md">
            <i class="ri-save-line"></i>
            {{ __('global.save') }}
          </button>
          <a href="{{ route($currentRoute.'.create') }}" class="btn btn-primary btn-md">
            <i class="ri-add-line"></i>
            {{ __('global.addNew') }}
          </a>
 @endif
@if($mode=='edit' && $canEdit)

<button type="submit" class="btn btn-secondary btn-md">
            <i class="ri-save-line"></i>
            {{ __('global.save') }}
          </button>
          @if($canCreate)
          <a href="{{ route($currentRoute.'.create') }}" class="btn btn-primary btn-md">
            <i class="ri-add-line"></i>
            {{ __('global.addNew') }}
          </a>
@endif
@endif

          <a href=" {{ route($currentRoute.'.index') }} " class="btn btn-dark btn-md">
            <i class="ri-arrow-left-line"></i>
            {{ __('global.back') }}
          </a>