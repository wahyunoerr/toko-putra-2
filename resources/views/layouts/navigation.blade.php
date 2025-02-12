<ul class="sidebar-nav" data-coreui="navigation" data-simplebar>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('home') }}">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-speedometer') }}"></use>
            </svg>
            {{ __('Dashboard') }}
        </a>
    </li>

    @role('admin')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('users.index') }}">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-user') }}"></use>
            </svg>
            {{ __('Users') }}
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('roles.index') }}">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-lock-locked') }}"></use>
            </svg>
            {{ __('Roles') }}
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('supplier.index') }}">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-industry') }}"></use>
            </svg>
            {{ __('Supplier') }}
        </a>
    </li>

    <li
        class="nav-group {{ request()->routeIs('jenis-barang.*') || request()->routeIs('satuan-barang.*') || request()->routeIs('barang.*') ? 'show' : '' }}">
        <a class="nav-link nav-group-toggle" href="#">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-badge') }}"></use>
            </svg>
            Barang
        </a>
        <ul class="nav-group-items">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('jenis-barang.index') }}">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-arrow-circle-right') }}"></use>
                    </svg>
                    Jenis Barang
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('satuan-barang.index') }}">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-arrow-circle-right') }}"></use>
                    </svg>
                    Satuan Barang
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('barang.index') }}">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-arrow-circle-right') }}"></use>
                    </svg>
                    Barang
                </a>
            </li>
        </ul>
    </li>
    @endrole

    @role('admin|kasir')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('pos.index') }}">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-dollar') }}"></use>
            </svg>
            {{ __('POS') }}
        </a>
    </li>

    <li
        class="nav-group {{ request()->routeIs('transaksi-pos.*') || request()->routeIs('laba-rugi.*') ? 'show' : '' }}">
        <a class="nav-link nav-group-toggle" href="#">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-transfer') }}"></use>
            </svg>
            Transaksi
        </a>
        <ul class="nav-group-items">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('transaksi-pos.index') }}">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-arrow-circle-right') }}"></use>
                    </svg>
                    Transaksi POS
                </a>
            </li>
            @role('admin')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('laba-rugi.index') }}">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-arrow-circle-right') }}"></use>
                    </svg>
                    Laba Rugi
                </a>
            </li>
            @endrole
        </ul>
    </li>
    @endrole
</ul>