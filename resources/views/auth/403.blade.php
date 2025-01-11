@extends('layouts.main')

{{-- Styles khusus halaman --}}
@section('this-page-style')
    <style>
        .error-container {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            text-align: center;
            background-color: #f3f4f6;
            padding: 20px;
        }

        .error-box-wrapper {
            position: relative;
            padding: 2rem;
            background-color: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            max-width: 600px;
            width: 100%;
            animation: fadeIn 1s ease-in-out;
        }

        .error-box {
            padding: 3rem;
            border-radius: 15px;
            background-color: #ffffff;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 2;
        }

        .error-code {
            font-size: 6rem;
            font-weight: 800;
            color: #e74c3c;
        }

        .error-message {
            font-size: 2rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: #333;
            margin-bottom: 1rem;
        }

        .error-description {
            font-size: 1.2rem;
            color: #777;
            margin-bottom: 2rem;
        }

        .error-icon {
            font-size: 4rem;
            color: #e74c3c;
            margin-bottom: 2rem;
        }

        .btn-primary {
            background-color: #e74c3c;
            color: white;
            border: none;
            padding: 1rem 2.5rem;
            border-radius: 30px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s ease, transform 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary:hover {
            background-color: #c0392b;
            transform: scale(1.05);
        }


        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }
    </style>
@endsection

{{-- Konten utama --}}
@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="error-container">
            <div class="error-box">
                <h1 class="error-code">403</h1>
                <h2 class="error-message">Akses Ditolak</h2>
                <p class="error-description">Anda tidak memiliki izin untuk mengakses halaman ini.</p>
                <a href="{{ url('/') }}" class="btn btn-primary btn-lg">
                    Kembali ke Dashboard
                </a>
            </div>
        </div>
    </main>
@endsection

{{-- Scripts khusus halaman --}}
@section('this-page-scripts')
@endsection
