<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-fixed navbar-lightblue navbar-dark">
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

    <!-- Right-side Header Section -->
    <ul class="navbar-nav ms-auto flex-row username-text">
        @auth
            <li class="nav-item">
                <span class="nav-link text-white px-0">
                    Hai, {{ Auth::user()->name }} <!-- Display user name -->
                </span>
            </li>

            <!-- Dropdown for Settings and Logout -->
            <li class="nav-item dropdown">
                <a href="#" class="nav-link text-white dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <i class="fas fa-user-circle"></i> <!-- Icon user circle -->
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow">
                    <!-- Settings Button -->
                    <a href="{{ route('profile.index') }}" class="dropdown-item text-dark">
                        <i class="fas fa-cogs"></i> Pengaturan
                    </a>
                    <div class="dropdown-divider"></div>
                    <!-- Logout Button -->
                    <button type="button" class="dropdown-item text-danger" onclick="confirmLogout()">
                        <i class="fas fa-sign-out-alt"></i> Keluar
                    </button>

                    <!-- Logout Form -->
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                        @csrf
                    </form>
                </div>
            </li>
        @else
            <li class="nav-item me-3">
                <span class="nav-link text-white px-0">
                    Hai, Tamu <!-- Display user name -->
                </span>
            </li>
            <!-- Login Button for Guest -->
            <li class="nav-item me-3">
                <a href="{{ route('login') }}" class="btn btn-light text-dark">
                    <i class="fas fa-sign-in-alt"></i> Login
                </a>
            </li>
        @endauth
    </ul>
</nav>
<!-- /.navbar -->
