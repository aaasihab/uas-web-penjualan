<!-- Preloader -->
{{-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
</div> --}}

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
            <a href="#" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Contact</a>
        </li>
    </ul>

    <!-- Right-side Header Section with User Name and Icon -->
    <ul class="navbar-nav ms-auto me-4 flex-row username-text">
        @auth
            <li class="nav-item me-2">
                <span class="nav-link text-white">
                    Hai, {{ Auth::user()->name }} <!-- Display user name -->
                </span>
            </li>
            <li class="nav-item me-3">
                <a href="{{ route('profile.index') }}" class="nav-link text-white">
                    <i class="bi bi-people"></i>
                </a>
            </li>
        @endauth
    </ul>

    <!-- Mobile Menu Button -->
    <ul class="navbar-nav flex-row d-md-none">
        <li class="nav-item text-nowrap">
            <button class="nav-link px-3 text-white" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="bi bi-list"></i>
            </button>
        </li>
    </ul>
</nav>
<!-- /.navbar -->
