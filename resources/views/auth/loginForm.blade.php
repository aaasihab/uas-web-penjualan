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

    {{-- Include common styles --}}
    @include('layouts.styles')
    {{-- Include additional styles --}}
    @yield('this-page-style')
    <style>
        body {
            background-color: #e3e3e3;
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
            height: 530px;
            width: 400px;
            background-color: rgba(255, 255, 255, 0.7);
            position: absolute;
            transform: translate(-50%, -50%);
            top: 50%;
            left: 50%;
            border-radius: 10px;
            backdrop-filter: blur(15px);
            border: 2px solid rgba(0, 0, 0, 0.1);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
            padding: 50px 35px;
        }

        form h3 {
            font-size: 32px;
            font-weight: 500;
            line-height: 42px;
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-top: 20px;
            font-size: 16px;
            font-weight: 500;
        }

        input {
            display: block;
            height: 50px;
            width: 100%;
            background-color: rgba(255, 255, 255, 0.3);
            border: 1px solid rgba(0, 0, 0, 0.2);
            border-radius: 3px;
            padding: 0 10px;
            margin-top: 8px;
            font-size: 14px;
            font-weight: 300;
            transition: all 0.3s ease-in-out;
        }

        input:focus {
            background-color: rgba(255, 255, 255, 0.8);
            border-color: #007bff;
            box-shadow: 0 0 10px rgba(0, 123, 255, 0.4);
            outline: none;
        }

        ::placeholder {
            color: #6c757d;
        }

        .btn-submit {
            border: 0;
            margin-top: 30px;
        }

        .btn-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            gap: 10px;
            margin-top: 15px;
        }

        button,
        .btn-register {
            margin-top: 15px;
            width: 100%;
            background-color: #007bff;
            color: #ffffff;
            padding: 10px 0;
            font-size: 18px;
            font-weight: 600;
            border-radius: 5px;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            transition: all 0.4s ease;
            text-align: center;
            text-decoration: none;
        }

        button::before,
        .btn-register::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(to right, rgba(255, 255, 255, 0.2), rgba(255, 255, 255, 0.1));
            transition: all 0.4s ease;
        }

        button:hover::before,
        .btn-register:hover::before {
            left: 100%;
        }

        button:hover,
        .btn-register:hover {
            text-decoration: none;
            background-color: #0056b3;
        }

        .btn-register {
            background-color: #6c757d;
        }

        .btn-register:hover {
            background-color: #5a6268;
        }

        .invalid-feedback {
            display: block;
            font-size: 14px;
            color: #dc3545;
            height: 16px;
            margin-top: 5px;
        }
    </style>
</head>

<body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <main class="form-signin w-100 m-auto">
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <h3>LOGIN</h3>

            <!-- Input Email -->
            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="@error('email') is-invalid @enderror"
                placeholder="Masukkan Email" value="{{ old('email') }}">
            <div class="invalid-feedback">
                @error('email')
                    {{ $message }}
                @enderror
            </div>

            <!-- Input Password -->
            <label for="password">Password</label>
            <input type="password" id="password" name="password" class="@error('password') is-invalid @enderror"
                placeholder="Masukkan Password">
            <div class="invalid-feedback">
                @error('password')
                    {{ $message }}
                @enderror
            </div>

            <!-- Login Button -->
            <button class="btn-submit" type="submit">Log In</button>

            <!-- Register Button -->
            <div class="btn-wrapper">
                <a href="{{ route('register.form') }}" class="btn-register text-white">Register</a>
            </div>
        </form>
    </main>

    {{-- Include scripts --}}
    @include('layouts.scripts')
    <script>
        @if (session('success'))
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
            });
            Toast.fire({
                icon: "success",
                title: "{{ session('success') }}"
            });
        @endif

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
