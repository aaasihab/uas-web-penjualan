<header class="navbar sticky-top bg-info flex-md-nowrap p-0 shadow" data-bs-theme="auto">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6 text-white" href="#">Toserba Berkah Abadi</a>

    <ul class="navbar-nav flex-row d-md-none">
        <li class="nav-item text-nowrap">
            <button class="nav-link px-3 text-white" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu"
                aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="bi bi-list"></i>
                <!-- Replaced SVG with Bootstrap list icon -->
            </button>
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
</header>
