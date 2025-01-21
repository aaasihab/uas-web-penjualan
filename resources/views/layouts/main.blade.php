<!DOCTYPE html>
<html lang="en" data-bs-theme="auto">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Toserba</title>
    @include('layouts.styles')

    @yield('this-page-style')
</head>

<body class="hold-transition sidebar-mini sidebar-collapse layout-navbar-fixed layout-fixed">
    <div class="wrapper">
        {{-- untuk header --}}
        @include('layouts.header')

        {{-- Sidebar --}}
        @include('layouts.sidebar')

        {{-- Konten utama --}}
        @yield('content')
    </div>
    {{-- footer --}}
    @include('layouts.footer')

    @include('layouts.scripts')
    {{-- untuk scripts khusus halaman tertentu --}}
    @yield('this-page-scripts')

</body>

</html>
