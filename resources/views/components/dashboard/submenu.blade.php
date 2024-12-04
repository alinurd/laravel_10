<!-- resources/views/components/dashboard/submenu.blade.php -->
@foreach ($menus as $menu)
    @php
        // Cek apakah submenu aktif
        $isActive = request()->routeIs($menu->url) || (isset($menu['children']) && $menu['children']->pluck('url')->contains(fn($url) => request()->routeIs($url)));
    @endphp
    <li class="dropdown-item dropdown {{ $isActive ? 'show' : '' }}">
        @if ($menu['children'] && $menu['children']->isNotEmpty())
            <!-- Submenu Parent -->
            <a href="javascript:void(0);" class="dropdown-toggle {{ $isActive ? 'active' : '' }}" data-bs-toggle="dropdown" aria-expanded="{{ $isActive ? 'true' : 'false' }}">
                <i class="{{ $menu->icon }}"></i> {{ ucwords($menu->name) }}
            </a>
            <ul class="dropdown-menu {{ $isActive ? 'show' : '' }}">
                @include('components.dashboard.submenu', ['menus' => $menu['children']])
            </ul>
        @else
            <!-- Submenu Item -->
            <a class="dropdown-item {{ request()->routeIs($menu->url) ? 'active' : '' }}" href="{{ route($menu->url) }}">
                <i class="{{ $menu->icon }}"></i> {{ ucwords($menu->name) }}
            </a>
        @endif
    </li>
@endforeach
