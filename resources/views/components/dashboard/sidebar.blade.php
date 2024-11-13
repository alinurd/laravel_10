<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="{{ url('/') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="/assets/images/logo/logo-sm.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <!-- <img src="/assets/images/logo/logo-dark.png" alt="" height="17"> -->
                <img src="/assets/images/logo/dark.png" alt="" height="30">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="{{ url('/') }}" class="logo logo-light">
            <span class="logo-sm">
                <img src="/assets/images/logo/logo-sm.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <!-- <img src="/assets/images/logo/logo-light.png" alt="" height="17"> -->
                <img src="/assets/images/logo/dark.png" alt="" height="35">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
            <li class="menu-title"><span data-key="t-menu">Dashboard</span></li>
            <li class="nav-item">
                    <a class="nav-link menu-link{{ request()->routeIs('dashboard.index') ? ' active' : '' }}" href="{{ route('dashboard.index') }}">
                        <i class="ri-home-line"></i> <span data-key="t-landing">Home</span>
                    </a>
                @foreach ($menuWithPermission as $menu)
                 <li class="menu-title"><span data-key="t-menu">{{ $menu->menu_parent }}</span></li>
                 <li class="nav-item">
                    <a class="nav-link menu-link{{ request()->routeIs($menu->menu_item_route) ? ' active' : '' }}" href="{{ route($menu->menu_item_route) }}">
                        <i class="{{ $menu->menu_item_icon }}"></i> <span data-key="t-landing">{{ ucwords($menu->menu_item_name)  }}</span>
                    </a>
                </li> 
                @endforeach
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>