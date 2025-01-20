<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-lightblue navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav flex-row">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                <i class="fas fa-bars"></i>
            </a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('dashboard') }}" class="nav-link">Beranda</a>
        </li>
    </ul>

    <!-- Right-side Header Section with User Name and Icon -->
    <ul class="navbar-nav ms-auto me-4 flex-row username-text">
        @auth
            <li class="nav-item">
                <span class="nav-link text-white px-0">
                    Hai, {{ Auth::user()->name }} <!-- Display user name -->
                </span>
            </li>

            <!-- Dropdown for Settings and Logout -->
            <li class="nav-item dropdown">
                <a href="#" class="nav-link text-white" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <i class="bi bi-door-open"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <!-- Settings Button -->
                    <a href="{{ route('profile.index') }}" class="dropdown-item">
                        <i class="bi bi-gear"></i> Pengaturan
                    </a>
                    <!-- Logout Button -->
                    <form action="{{ route('logout') }}" method="POST" class="dropdown-item p-0">
                        @csrf
                        <button type="submit" class="btn btn-link w-100 text-left text-dark">
                            <i class="bi bi-box-arrow-right"></i> Keluar
                        </button>
                    </form>
                </div>
            </li>
        @endauth
    </ul>
</nav>
<!-- /.navbar -->
