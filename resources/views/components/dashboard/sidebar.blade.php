<div class="app-menu navbar-menu" style="border-top-right-radius: 20px; border-bottom-right-radius: 20px;">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <a href="{{ url('/') }}" class="logo logo-light">
            <span class="logo-lg">
                <img src="{{ asset('assets/images/logo/logo.png') }}" class="mt-3" alt="Logo" height="45">
            </span>
        </a>
        <div class="logo logo-lg text-white d-none">
            {{$user->name}} {{$group}}
        </div>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>
    <hr>

    <div id="scrollbar">
  
    <ul class="navbar-nav">
    @foreach ($menus as $menu)
        @php 
            $akses = collect($menuWithPermission)->contains('menu_item_id', $menu->id);
 
            $aksesChild = isset($menu['children']) && collect($menu['children'])->contains(function ($child) use ($menuWithPermission) {
                return collect($menuWithPermission)->contains('menu_item_id', $child['id']);
            });
 
            $shouldDisplay = $akses || $aksesChild;
 
            $hasChildren = isset($menu['children']) && collect($menu['children'])->isNotEmpty();
 
            $isActive = request()->routeIs($menu->url) || ($hasChildren && collect($menu['children'])->pluck('url')->contains(fn($url) => request()->routeIs($url)));
        @endphp

        @if ($shouldDisplay)
            <li class="nav-item {{ $hasChildren ? 'dropdown' : '' }} {{ $isActive ? 'show' : '' }}">
                @if ($hasChildren)
                    <!-- Menu dengan Submenu -->
                    <a href="javascript:void(0);" class="nav-link dropdown-toggle {{ $isActive ? 'active' : '' }}" data-bs-toggle="dropdown" aria-expanded="{{ $isActive || $aksesChild ? 'true' : 'false' }}">
                        <i class="{{ $menu->icon }}"></i> 
                        <span>
                            {{ ucwords($menu->name) }}
                        </span>
                    </a>
                    <ul class="dropdown-menu {{ $isActive || $aksesChild ? 'show' : '' }}">
                        @foreach ($menu['children'] as $child)
                            @php 
                                $childAkses = collect($menuWithPermission)->contains('menu_item_id', $child['id']);
                            @endphp

                            @if ($childAkses)
                                <li>
                                    <a class="dropdown-item {{ request()->routeIs($child->url) ? 'active' : '' }}" href="{{ route($child->url) }}">
                                        <i class="{{ $child->icon }}"></i> 
                                        <span>{{ ucwords($child->name) }}</span>
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                @else
                    <!-- Menu Tanpa Submenu -->
                    <a class="nav-link {{ request()->routeIs($menu->url) ? 'active' : '' }} {{ $menu->url=='#' ? 'd-none' : '' }}" href="{{ $menu->url ? route($menu->url) : 'javascript:void(0);' }}">
                        <i class="{{ $menu->icon }}"></i> 
                        <span>
                            {{ ucwords($menu->name) }}
                        </span>
                    </a>
                @endif
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

<style>
    .navbar-nav .dropdown-menu.show {
        display: block;
    }

    .navbar-nav .dropdown-toggle.active {
        color: #ffffff;
        background-color: #061f3a;
    }

    .navbar-nav .dropdown-item.active {
        color: #ffffff;
        background-color: #003e81;
    }

    .navbar-nav .nav-item .nav-link.active {
        color: #ffffff;
        background-color: #003e81;
    }

    /* User Profile Section */
    .user-profile {
        position: absolute;
        bottom: 0;
        width: 100%;
        padding: 20px 30px;
        text-align: left;
        border-top: 1px solid #082F56;
    }

    .user-info {
        display: flex;
        align-items: center;
        gap: 10px;
        color: #ffffff;
        font-size: 14px;
    }

    .user-icon {
        background-color: #003e81;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        font-size: 18px;
    }

    .user-details {
        display: flex;
        flex-direction: column;
        justify-content: center;
        line-height: 1.2;
    }

    .user-name {
        font-size: 12px;
        font-weight: bold;
    }

    .user-group {
        font-size: 10px;
        color: #bbbbbb;
        margin-top: 3px;
    }
</style>
