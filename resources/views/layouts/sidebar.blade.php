<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-lightblue elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link">
        <img src="{{ asset('assets/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Toserba Barokah</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column gap-1" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Dashboard Menu -->
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}"
                        class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-houses-fill"></i>
                        <p>Dasbor</p>
                    </a>
                </li>

                <!-- Data Master Section -->
                <li class="nav-header">DATA MASTER</li>

                <!-- Daftar Transaksi -->
                <li class="nav-item">
                    <a href="{{ route('master.data.transaksi.index') }}"
                        class="nav-link {{ request()->routeIs('master.data.transaksi.index') ? 'active' : '' }}">
                        <i class="bi bi-cart4 nav-icon"></i>
                        <p>
                            {{ auth()->user()->role == 'admin' ? 'Daftar Transaksi' : 'Riwayat Transaksi' }}
                        </p>
                    </a>
                </li>

                <!-- Pesanan Selesai -->
                <li class="nav-item">
                    <a href="{{ route('master.data.pembayaran.index') }}"
                        class="nav-link {{ request()->routeIs('master.data.pembayaran.index') ? 'active' : '' }}">
                        <i class="bi bi-check-circle nav-icon"></i>
                        <p>Pesanan Selesai</p>
                    </a>
                </li>

                <!-- Admin-Only Links -->
                @if (auth()->user()->role == 'admin')
                    <!-- Kategori -->
                    <li class="nav-item">
                        <a href="{{ route('master.data.kategoriProduk.index') }}"
                            class="nav-link {{ request()->routeIs('master.data.kategoriProduk.index') ? 'active' : '' }}">
                            <i class="bi bi-list-ul nav-icon"></i>
                            <p>Kategori</p>
                        </a>
                    </li>

                    <!-- Produk -->
                    <li class="nav-item">
                        <a href="{{ route('master.data.produk.index') }}"
                            class="nav-link {{ request()->routeIs('master.data.produk.index') ? 'active' : '' }}">
                            <i class="bi bi-box nav-icon"></i>
                            <p>Produk</p>
                        </a>
                    </li>

                    <!-- User -->
                    <li class="nav-item">
                        <a href="{{ route('master.data.user.index') }}"
                            class="nav-link {{ request()->routeIs('master.data.user.index') ? 'active' : '' }}">
                            <i class="bi bi-person-lines-fill"></i>
                            <p>User</p>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
