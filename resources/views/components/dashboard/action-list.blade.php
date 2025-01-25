<div class="dropdown">
    <a href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="ri-list-check"></i>
    </a>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
        @if($canEdit && $currentRoute !="documenctferifyreview")
        <li>
            <a class="text-primary dropdown-item" href="{{ route($currentRoute . '.edit', [$currentRoute => $id]) }}">
                <i class="ri-edit-line text-primary"></i> {{__('global.edit')}}
            </a>
        </li>
        @endif
        @if($canView)
        @if($currentRoute==="documenctferifyreview")
        <li>
            <a class="text-success dropdown-item" href="{{ route($currentRoute . '.show', [$currentRoute => $id]) }}">
                <i class="ri-draft-fill text-success"></i> {{__('global.approval')}}
            </a>
        </li>
        @else
        <li>
            <a class="text-info dropdown-item" href="{{ route($currentRoute . '.show', $id) }}">
                <i class="ri-eye-line text-info"></i> {{__('global.view')}}
            </a>
        </li>
        @endif
        @endif
        @if($canDelete)
        <li>
            <a class="text-danger dropdown-item">
                <form action="{{ route($currentRoute . '.destroy', [$currentRoute => $id]) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-danger dropdown-item" style="background:none;border:none;padding:0;">
                        <i class="ri-delete-bin-2-line text-danger"></i> {{ __('global.del') }}
                    </button>
                </form>
            </a>
        </li>
        @endif
    </ul>
</div>