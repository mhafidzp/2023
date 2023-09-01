<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="#">
            <span class="align-middle">AdminKit</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Pages
            </li>

            <li class="sidebar-item @yield('item-dashboard-admin')">
                <a class="sidebar-link" href="{{ route('admin.dashboard') }}">
                <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li>

            <li class="sidebar-header">
                Data Master
            </li>

            <li class="sidebar-item @yield('data-user')">
                <a href="#data-user" data-bs-toggle="collapse" class="sidebar-link @yield('collapsed','collapsed')" aria-expanded="false">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Data User</span>
                </a>
                <ul id="data-user" class="sidebar-dropdown list-unstyled collapse @yield('data-user-show')" data-bs-parent="#sidebar">
                    <li class="sidebar-item @yield('item-admin')"><a class="sidebar-link" href="{{ route('admin.user') }}">Admin</a></li>
                    <li class="sidebar-item @yield('item-user')"><a class="sidebar-link" href="{{ route('index.user') }}">User</a></li>
                </ul>
            </li>

            <li class="sidebar-item @yield('item-provinsi')">
                <a class="sidebar-link" href="{{ route('index.provinsi') }}">
                <i class="align-middle" data-feather="archive"></i> <span class="align-middle">Data Provinsi</span>
                </a>
            </li>
            <li class="sidebar-item @yield('item-kota')">
                <a class="sidebar-link" href="{{ route('index.kota') }}">
                <i class="align-middle" data-feather="archive"></i> <span class="align-middle">Data Kota/Kab</span>
                </a>
            </li>
            <li class="sidebar-item @yield('item-kecamatan')">
                <a class="sidebar-link" href="{{ route('index.kecamatan') }}">
                <i class="align-middle" data-feather="archive"></i> <span class="align-middle">Data Kecamatan</span>
                </a>
            </li>
            <li class="sidebar-item @yield('item-kelurahan')">
                <a class="sidebar-link" href="{{ route('index.kelurahan') }}">
                <i class="align-middle" data-feather="archive"></i> <span class="align-middle">Data Kelurahan/Desa</span>
                </a>
            </li>
        </ul>

    </div>
</nav>
