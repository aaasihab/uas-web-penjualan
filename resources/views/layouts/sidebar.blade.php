<aside class="main-sidebar sidebar-dark-lightblue elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link">
        <img src="{{ asset('assets/img/sihab.jpg') }}" alt="profil" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Toserba</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column gap-1" data-widget="treeview" role="menu"
                data-accordion="false">

                <!-- Dashboard Menu -->
                <li class="nav-item user-panel">
                    <a href="{{ route('dashboard') }}"
                        class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                        onclick="{{ auth()->check() ? '' : 'return confirmLogin(event);' }}">
                        <i class="nav-icon bi bi-houses-fill"></i>
                        <p>Beranda</p>
                    </a>
                </li>

                @auth
                    <!-- Data Master Section -->
                    <!-- Dashboard Menu Admin -->
                    <li class="nav-item user-panel">
                        <a href="{{ route('master.data.admin') }}"
                            class="nav-link {{ request()->routeIs('master.data.admin') ? 'active' : '' }}"
                            onclick="{{ auth()->check() ? '' : 'return confirmLogin(event);' }}">
                            <i class="bi bi-speedometer"></i>
                            <p>Beranda Admin</p>
                        </a>
                    </li>

                    <li class="nav-header user-panel">DATA MASTER</li>

                    <!-- Daftar Transaksi -->
                    <li class="nav-item">
                        <a href="{{ route('master.data.transaksi.index') }}"
                            class="nav-link {{ request()->routeIs('master.data.transaksi.index') ? 'active' : '' }}"
                            onclick="{{ auth()->check() ? '' : 'return confirmLogin(event);' }}">
                            <i class="bi bi-cart4 nav-icon"></i>
                            <p>
                                {{ auth()->user()->role == 'admin' ? 'Daftar Transaksi' : 'Riwayat Transaksi' }}
                            </p>
                        </a>
                    </li>

                    <!-- Pembelian Selesai -->
                    <li class="nav-item">
                        <a href="{{ route('master.data.pembayaran.index') }}"
                            class="nav-link {{ request()->routeIs('master.data.pembayaran.index') ? 'active' : '' }}"
                            onclick="{{ auth()->check() ? '' : 'return confirmLogin(event);' }}">
                            <i class="bi bi-check-circle nav-icon"></i>
                            <p>
                                {{ auth()->user()->role == 'admin' ? 'Daftar Penjualan' : 'Riwayat Pembayaran' }}
                            </p>
                        </a>
                    </li>

                    <!-- Admin-Only Links -->
                    @if (auth()->user()->role == 'admin')
                        <!-- Kategori -->
                        <li class="nav-item">
                            <a href="{{ route('master.data.kategoriProduk.index') }}"
                                class="nav-link {{ request()->routeIs('master.data.kategoriProduk.*') ? 'active' : '' }}">
                                <i class="bi bi-list-ul nav-icon"></i>
                                <p>Kategori</p>
                            </a>
                        </li>

                        <!-- Produk -->
                        <li class="nav-item">
                            <a href="{{ route('master.data.produk.index') }}"
                                class="nav-link {{ request()->routeIs('master.data.produk.*') ? 'active' : '' }}">
                                <i class="bi bi-box nav-icon"></i>
                                <p>Produk</p>
                            </a>
                        </li>

                        <!-- User -->
                        <li class="nav-item">
                            <a href="{{ route('master.data.user.index') }}"
                                class="nav-link {{ request()->routeIs('master.data.user.*') ? 'active' : '' }}">
                                <i class="bi bi-person-lines-fill"></i>
                                <p>Manajemen Pengguna</p>
                            </a>
                        </li>
                    @endif
                @endauth
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
