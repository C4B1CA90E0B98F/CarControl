<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('dashboard') }}" class="app-brand-link">
            <span class="app-brand-text demo menu-text fw-bolder ms-2">{{ config('app.name') }}</span>
        </a>

        <a href="javascript:void(0);"
            class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item @if (request()->routeIs('dashboard')) active @endif">
            <a href="{{ route('dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Dashboard">Dashboard</div>
            </a>
        </li>

        {{-- Admin --}}
        @can('Admin')
        <li class="menu-item @if (request()->routeIs('user.*')) active open @endif">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="User">User</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item @if (request()->routeIs('user.*') && (!request()->routeIs('user.driver.*'))) active @endif">
                    <a href="{{ route('user.index') }}" class="menu-link">
                        <div data-i18n="Without menu">Users</div>
                    </a>
                </li>
                <li class="menu-item @if (request()->routeIs('user.driver.*')) active @endif">
                    <a href="{{ route('user.driver.index') }}" class="menu-link">
                        <div data-i18n="Without menu">Driver</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item @if (request()->routeIs('kendaraan.*')) active @endif">
            <a href="{{ route('kendaraan.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-car"></i>
                <div data-i18n="kendaraan">Kendaraan</div>
            </a>
        </li>
        <li class="menu-item @if (request()->routeIs('lokasi.*')) active @endif">
            <a href="{{ route('lokasi.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-map"></i>
                <div data-i18n="lokasi">Lokasi</div>
            </a>
        </li>
        <li class="menu-item @if (request()->routeIs('pesanan.*')) active @endif">
            <a href="{{ route('pesanan.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-calendar-event"></i>
                <div data-i18n="Pesanan">Pesanan</div>
            </a>
        </li>
        @endcan

        {{-- Approval --}}
        @can('Approver')
        {{-- <li class="menu-item @if (request()->routeIs('approval.*')) active @endif">
            <a href="{{ route('approval.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-check"></i>
                <div data-i18n="Approval">Approval</div>
            </a>
        </li> --}}
        @endcan
    </ul>
</aside>