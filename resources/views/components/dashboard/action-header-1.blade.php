 @if($mode=='add' && $canCreate && $currentRoute !="documenctferifyreview")
 @if($currentRoute =="chacrtdetail")
 
 <span class="btn btn-secondary btn-md me-2" id="simpanBtn">
  <i class="ri-save-line"></i>
    {{ __('global.save') }}
  </span>
 
 <span class="btn btn-warning btn-md me-2" id="showChartBtn">
 <i class="ri-bar-chart-grouped-line"></i>
     Lihat Chart
  </span>

          <a href="{{ route($currentRoute.'.create') }}" class="btn btn-primary btn-md">
            <i class="ri-add-line"></i>
            {{ __('global.addNew') }}
          </a>
 @else
 <button type="submit" class="btn btn-secondary btn-md">
            <i class="ri-save-line"></i>
            {{ __('global.save') }}
          </button>
          <a href="{{ route($currentRoute.'.create') }}" class="btn btn-primary btn-md">
            <i class="ri-add-line"></i>
            {{ __('global.addNew') }}
          </a>
 @endif
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


    