<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
    {{-- <script src="{{ asset('template/js/color-mode.js') }}"></script> --}}

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors" />
    <meta name="generator" content="Hugo 0.122.0" />
    <title>Register Form</title>

    {{-- Include common styles --}}
    @include('layouts.styles')
    {{-- Include additional styles --}}
    @yield('this-page-style')

    <style>
        body {
            background-color: #f0f0f0;
            font-family: 'Poppins', sans-serif;
            color: #333333;
            height: 100vh;
            overflow: hidden;
        }

        .background {
            width: 430px;
            height: 500px;
            position: absolute;
            transform: translate(-50%, -50%);
            left: 50%;
            top: 50%;
        }

        .background .shape {
            height: 200px;
            width: 200px;
            position: absolute;
            border-radius: 50%;
        }

        .shape:first-child {
            background: linear-gradient(#a8dadc, #457b9d);
            left: -80px;
            top: -80px;
        }

        .shape:last-child {
            background: linear-gradient(to right, #ff9f43, #fecd1a);
            right: -30px;
            bottom: -80px;
        }

        form {
            width: 400px;
            background-color: rgba(255, 255, 255, 0.7);
            position: absolute;
            display: flex;
            flex-direction: column;
            transform: translate(-50%, -50%);
            top: 50%;
            left: 50%;
            border-radius: 10px;
            backdrop-filter: blur(15px);
            border: 2px solid rgba(0, 0, 0, 0.1);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
            padding: 35px 35px;
            overflow-y: auto;
        }

        form h3 {
            font-size: 28px;
            font-weight: 500;
            line-height: 15px;
            text-align: center;
        }

        .form-group {
            position: relative;
            margin-top: 5px;
            margin-bottom: 5px;
        }

        label {
            display: block;
            font-size: 14px;
            font-weight: 500;
            margin-top: 10px;
        }

        input {
            display: block;
            height: 40px;
            width: 100%;
            background-color: rgba(255, 255, 255, 0.3);
            border: 1px solid rgba(0, 0, 0, 0.2);
            border-radius: 3px;
            padding: 0 10px;
            margin-top: 4px;
            font-size: 12px;
            font-weight: 300;
            transition: all 0.3s ease-in-out;
        }

        input:focus {
            background-color: rgba(255, 255, 255, 0.8);
            border-color: #007bff;
            box-shadow: 0 0 10px rgba(0, 123, 255, 0.4);
            outline: none;
        }

        .invalid-feedback {
            position: absolute;
            top: 100%;
            left: 0;
            color: #e74c3c;
            font-size: 10px;
            margin-top: 3px;
            display: block;
        }

        ::placeholder {
            color: #6c757d;
        }

        button {
            margin-top: 20px;
            width: 100%;
            background-color: #007bff;
            color: #ffffff;
            padding: 10px 0;
            font-size: 16px;
            font-weight: 600;
            border-radius: 5px;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            transition: all 0.4s ease;
        }

        button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(to right, rgba(255, 255, 255, 0.2), rgba(255, 255, 255, 0.1));
            transition: all 0.4s ease;
        }

        button:hover::before {
            left: 100%;
        }

        button:hover {
            background-color: #0056b3;
        }

        a {
            margin-top: 10px;
            color: #6c757d;
            text-align: center;
        }

        a:hover {
            color: #30353a;
        }
    </style>
</head>

<body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <main class="form-signin w-100 m-auto">
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <h3>Register</h3>

            <div class="form-group">
                <label for="name">Nama</label>
                <input type="text" id="name" name="name" class="@error('name') is-invalid @enderror"
                    placeholder="Masukkan Nama" value="{{ old('name') }}">
                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="@error('email') is-invalid @enderror"
                    placeholder="Masukkan Email" value="{{ old('email') }}">
                @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="@error('password') is-invalid @enderror"
                    placeholder="Masukkan Password">
                @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation"
                    placeholder="Konfirmasi Password Anda">
            </div>

            <button type="submit">Register</button>
            <a href="{{ route('login') }}">Sudah memiliki Akun?</a>
        </form>
    </main>

    {{-- Include scripts --}}
    @include('layouts.scripts')
    <script>
        @if (session('error'))
        Swal.fire({
            title: "Gagal!",
            text: "{{ session('error') }}",
            icon: "error",
            confirmButtonText: "OK",
        });
        @endif
    </script>
    @yield('this-page-scripts')
</body>

</html>
