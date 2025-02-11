<ul class="sidebar-nav" data-coreui="navigation" data-simplebar>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('home') }}">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-speedometer') }}"></use>
            </svg>
            {{ __('Dashboard') }}
        </a>
    </li>

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

    <li class="nav-group {{ request()->routeIs('jenis-barang.*') || request()->routeIs('satuan-barang.*') || request()->routeIs('barang.*') ? 'show' : '' }}"
        aria-expanded="{{ request()->routeIs('jenis-barang.*') || request()->routeIs('satuan-barang.*') || request()->routeIs('barang.*') ? 'true' : 'false' }}">
        <a class="nav-link nav-group-toggle" href="#">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-badge') }}"></use>
            </svg>
            Barang
        </a>
        <ul class="nav-group-items"
            style="{{ request()->routeIs('jenis-barang.*') || request()->routeIs('satuan-barang.*') || request()->routeIs('barang.*') ? 'height:auto' : 'height:0px' }}">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('jenis-barang.index') }}" target="_top">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-arrow-circle-right') }}"></use>
                    </svg>
                    Jenis Barang
                </a>
                <a class="nav-link" href="{{ route('satuan-barang.index') }}" target="_top">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-arrow-circle-right') }}"></use>
                    </svg>
                    Satuan Barang
                </a>
                <a class="nav-link" href="{{ route('barang.index') }}" target="_top">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-arrow-circle-right') }}"></use>
                    </svg>
                    Barang
                </a>
            </li>
        </ul>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('pos.index') }}">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-dollar') }}"></use>
            </svg>
            {{ __('POS') }}
        </a>
    </li>

    <li class="nav-group {{ request()->routeIs('transaksi-pos.*') || request()->routeIs('laba-rugi.*') ? 'show' : '' }}"
        aria-expanded="{{ request()->routeIs('transaksi-pos.*') || request()->routeIs('laba-rugi.*') ? 'true' : 'false' }}">
        <a class="nav-link nav-group-toggle" href="#">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-transfer') }}"></use>
            </svg>
            Transaksi
        </a>
        <ul class="nav-group-items"
            style="{{ request()->routeIs('transaksi-pos.*') || request()->routeIs('laba-rugi.*') ? 'height:auto' : 'height:0px' }}">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('transaksi-pos.index') }}" target="_top">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-arrow-circle-right') }}"></use>
                    </svg>
                    Transaksi Pos
                </a>
                <a class="nav-link" href="{{ route('laba-rugi.index') }}" target="_top">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-arrow-circle-right') }}"></use>
                    </svg>
                    Laba Rugi
                </a>
            </li>
        </ul>
    </li>
</ul>
