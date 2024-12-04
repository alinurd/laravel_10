<div class="app-menu navbar-menu" style="border-top-right-radius: 20px;border-bottom-right-radius: 20px;">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="{{ url('/') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="/assets/images/logo/" alt="sssssssssxxxxx" height="22">
            </span>
            <span class="logo-lg">
                <!-- <img src="/assets/images/logo/logo-dark.png" alt="" height="17"> -->
                <img src="/assets/images/logo/" alt="xxxxxxxxd">
                {{$user->name}} {{$group}}xxxxxxxxxx
            </span>
        </a>
        <!-- Light Logo-->
        <a href="{{ url('/') }}" class="logo logo-light">
            <span class="logo-sm">
                <img src="/assets/images/logo/" alt="ddddd" height="22">
            </span>
            <span class="logo-lg">
                <!-- <img src="/assets/images/logo/logo-light.png" alt="" height="17"> -->
                <img src="/assets/images/logo/" alt="ttttttttt">

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
            // Filter the permissions based on the current menu's parent ID
            $permissions = $menuWithPermission->filter(fn($permission) => $permission->parent_id == $menu->id);
            $isActive = request()->routeIs($menu->url) || (isset($menu['children']) && $menu['children']->pluck('url')->contains(fn($url) => request()->routeIs($url)));
        @endphp
        
        @if ($permissions->isNotEmpty())
            <li class="nav-item dropdown {{ $isActive ? 'show' : '' }}">
                @if ($menu['children'] && $menu['children']->isNotEmpty())
                    <!-- Parent Menu -->
                    <a href="javascript:void(0);" class="nav-link dropdown-toggle {{ $isActive ? 'active' : '' }}" data-bs-toggle="dropdown" aria-expanded="{{ $isActive ? 'true' : 'false' }}">
                        <i class="{{ $menu->icon }}"></i> <span>{{ ucwords($menu->name) }}</span>
                    </a>
                    <ul class="dropdown-menu {{ $isActive ? 'show' : '' }}">
                        @include('components.dashboard.submenu', ['menus' => $menu['children'], 'menuWithPermission' => $menuWithPermission])
                    </ul>
                @else
                    <!-- Single Menu -->
                    <a class="nav-link {{ request()->routeIs($menu->url) ? 'active' : '' }}" href="{{ route($menu->url) }}">
                        <i class="{{ $menu->icon }}"></i> <span>{{ ucwords($menu->name) }}</span>
                    </a>
                @endif
            </li>
        @endif
    @endforeach
</ul>


    </div>
</div>

<style>
    .navbar-nav .dropdown-menu.show {
        display: block;
        /* Tampilkan submenu saat parent aktif */
    }

    .navbar-nav .dropdown-toggle.active {
        color: #fff;
        background-color: #061f3a;
    }

    .navbar-nav .dropdown-item.active {
        color: #fff;
        background-color: #003e81;
    }

    .navbar-nav .nav-item .nav-link.active {
        color: #fff;
        background-color: #003e81;
    }
</style>