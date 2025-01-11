<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
    <script src="{{ asset('template/js/color-mode.js') }}"></script>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors" />
    <meta name="generator" content="Hugo 0.122.0" />
    <title>Login Form</title>
    {{-- untuk styles --}}
    @include('layouts.styles')
    {{-- untuk styles khusus halaman tertentu --}}
    @yield('this-page-style')

    <style>
        html,
        body {
            min-height: 100vh;
        }

        .form-signin {
            max-width: 330px;
            padding: 1rem;
        }

        .form-signin .form-floating:focus-within {
            z-index: 2;
        }

        .form-signin input[type="email"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }

        .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }
    </style>
</head>

<body class="d-flex  align-items-center py-4 bg-body-tertiary">
    <main class="form-signin w-100 m-auto">
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <img class="mb-4"
                src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9a/Laravel.svg/1969px-Laravel.svg.png"
                alt="" width="72" height="57">
            <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

            <!-- Input Email -->
            <div class="form-floating">
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="floatingInput"
                    placeholder="name@example.com" name="email" value="{{ old('email') }}">
                <label for="floatingInput"><i class="bi bi-envelope-fill"></i> Email address</label>

                <!-- Menampilkan error untuk email -->
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Input Password -->
            <div class="form-floating">
                <input type="password" class="form-control @error('password') is-invalid @enderror"
                    id="floatingPassword" placeholder="Password" name="password">
                <label for="floatingPassword"><i class="bi bi-lock-fill"></i> Password</label>

                <!-- Menampilkan error untuk password -->
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button class="btn btn-primary w-100 py-2" type="submit"><i class="bi bi-box-arrow-in-right"></i> Sign
                in</button>
            <p class="mt-5 mb-3 text-body-secondary">&copy; KELAS KOMPUTASI</p>
        </form>
    </main>
    {{-- untuk scripts --}}
    @include('layouts.scripts')
    <script>
        @if (session('error'))
            Swal.fire({
                title: "Login Gagal!",
                text: "{{ session('error') }}",
                icon: "error",
                confirmButtonText: "OK",
            });
        @endif
    </script>
    @yield('this-page-scripts')
</body>

</html>
