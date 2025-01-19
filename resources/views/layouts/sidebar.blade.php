<div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
    <div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu"
        aria-labelledby="sidebarMenuLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="sidebarMenuLabel">
                Toserba Barokah Abadi
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu"
                aria-label="Close"></button>
        </div>
        <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2 active" aria-current="page"
                        href="{{ '/' }}">
                        <i class="bi bi-house-door"></i>
                        Dashboard
                    </a>
                </li>
            </ul>

            <h6
                class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-body-secondary text-uppercase">
                <span>Data Master</span>
            </h6>

            <ul class="nav flex-column mb-auto">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2"
                        href="{{ route('master.data.transaksi.index') }}">
                        @if (auth()->user()->role == 'admin')
                            <i class="bi bi-cart4"></i>
                            Daftar Transaksi
                        @else
                            <i class="bi bi-cart4"></i>
                            Riwayat Transaksi
                        @endif

                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2"
                        href="{{ route('master.data.pembayaran.index') }}">
                        <i class="bi bi-check-circle"></i>
                        Pesanan Selesai
                    </a>
                </li>

                <!-- Show these only if the user is an admin -->
                @if (auth()->user()->role == 'admin')
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-2"
                            href="{{ route('master.data.kategoriProduk.index') }}">
                            <i class="bi bi-list-ul"></i>
                            Kategori
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-2"
                            href="{{ route('master.data.produk.index') }}">
                            <i class="bi bi-box"></i>
                            Produk
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-2"
                            href="{{ route('master.data.user.index') }}">
                            <i class="bi bi-person-circle"></i>
                            User
                        </a>
                    </li>
                @endif
            </ul>

            <hr class="my-3" />

            <ul class="nav flex-column mb-auto">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2" href="{{ route('profile.index') }}">
                        <i class="bi bi-gear"></i>
                        Settings
                    </a>
                </li>

                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit"
                            class="nav-link d-flex align-items-center gap-2 btn btn-link text-decoration-none">
                            <i class="bi bi-door-open"></i>
                            Sign out
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>
