<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-lightblue elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
        <img src="{{ asset('assets/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text">Toserba Baroakah</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column gap-1" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Dashboard Menu -->
                <li class="user-panel nav-item">
                    <a href="{{ route('dashboard') }}"
                        class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-houses-fill"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="user-panel nav-header">DATA MASTER</li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('master.data.transaksi.index') ? 'active' : '' }}"
                        href="{{ route('master.data.transaksi.index') }}">
                        <i class="bi bi-cart4"></i>
                        <p>
                            @if (auth()->user()->role == 'admin')
                                Daftar Transaksi
                            @else
                                Riwayat Transaksi
                            @endif
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('master.data.pembayaran.index') ? 'active' : '' }}"
                        href="{{ route('master.data.pembayaran.index') }}">
                        <i class="bi bi-check-circle"></i>
                        <p>Pesanan Selesai</p>
                    </a>
                </li>

                <!-- Admin-Only Links -->
                @if (auth()->user()->role == 'admin')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('master.data.kategoriProduk.index') ? 'active' : '' }}"
                            href="{{ route('master.data.kategoriProduk.index') }}">
                            <i class="bi bi-list-ul"></i>
                            <p>Kategori</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('master.data.produk.index') ? 'active' : '' }}"
                            href="{{ route('master.data.produk.index') }}">
                            <i class="bi bi-box"></i>
                            <p>Produk</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('master.data.user.index') ? 'active' : '' }}"
                            href="{{ route('master.data.user.index') }}">
                            <i class="bi bi-person-circle"></i>
                            <p>User</p>
                        </a>
                    </li>
                @endif

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('profile.index') ? 'active' : '' }}"
                        href="{{ route('profile.index') }}">
                        <i class="bi bi-gear"></i>
                        <p>Settings</p>
                    </a>
                </li>

                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="nav-link d-flex align-items-center gap-2 btn btn-link text-decoration-none">
                            <i class="bi bi-door-closed"></i>
                            Sign out
                        </button>
                    </form>
                </li>
            </ul>


        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
