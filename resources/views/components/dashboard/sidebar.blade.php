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
                <img src="/assets/images/logo/" alt="xxxxxxxxd"  >
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
       </div >
         <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
        
    </div>
<hr>
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