<div class="app-menu navbar-menu" style="border-top-right-radius: 20px; border-bottom-right-radius: 20px;">
    <div class="navbar-brand-box">
        <a href="{{ url('/') }}" class="logo logo-light">
            <span class="logo-lg">
                <img src="{{ asset('assets/images/logo/logo.png') }}" class="mt-3" alt="Logo" height="45">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>
    <hr>
    <div id="scrollbar">
        @php
        use Illuminate\Support\Str;
        @endphp

        <ul class="navbar-nav">
            @foreach ($menus as $menu)
            @php
            $akses = collect($menuWithPermission)->contains('menu_item_id', $menu->id);
            $hasChildren = isset($menu['children']) && collect($menu['children'])->isNotEmpty();

            // Periksa apakah URL saat ini mengandung URL dasar menu
            $isActive = Str::contains(request()->url(), route($menu->url, [], false)) ||
            ($hasChildren && collect($menu['children'])->pluck('url')->contains(fn($url) => Str::contains(request()->url(), route($url, [], false))));
            @endphp

            @if ($akses || $hasChildren)
            <li class="nav-item dropdown {{ $isActive ? 'show' : '' }}">
                <a href="javascript:void(0);"
                    class="nav-link dropdown-toggle {{ $isActive ? 'active' : '' }}"
                    data-bs-toggle="dropdown"
                    aria-expanded="{{ $isActive ? 'true' : 'false' }}">
                    <i class="{{ $menu->icon }}"></i>
                    <span>{{ ucwords($menu->name) }}</span>
                </a>
                <ul class="dropdown-menu {{ $isActive ? 'show' : '' }}">
                    @foreach ($menu['children'] as $child)
                    @php
                    $childAkses = collect($menuWithPermission)->contains('menu_item_id', $child['id']);
                    $isChildActive = Str::contains(request()->url(), route($child->url, [], false));
                    @endphp
                    @if ($childAkses)
                    <li>
                        <a class="dropdown-item {{ $isChildActive ? 'active' : '' }}" href="{{ route($child->url) }}">
                            <i class="{{ $child->icon }}"></i>
                            <span>{{ ucwords($child->name) }}</span>
                        </a>
                    </li>
                    @endif
                    @endforeach
                </ul>
            </li>
            @endif
            @endforeach
        </ul>

    </div>
    <div class="user-profile">
        <div class="user-info">
            <div class="user-icon">
                <i class="ri-user-line"></i>
            </div>
            <div class="user-details" onclick="showLogoutPopup()">
                <span class="user-name">{{ $user->name }}</span>
                <small class="user-group">{{ $group }}</small>
            </div>
        </div>
    </div>
</div>