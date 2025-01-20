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
            background-color: #f4f6f9;
            padding: 20px;
        }

        .error-box {
            padding: 3rem;
            border-radius: 12px;
            background-color: #ffffff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
        }

        .error-code {
            font-size: 6rem;
            font-weight: bold;
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
    </style>
@endsection

{{-- Konten utama --}}
@section('content')
    <div class="content-wrapper">
        <!-- Main Content -->
        <section class="content">
            <div class="error-container">
                <div class="error-box">
                    <h1 class="error-code">403</h1>
                    <h2 class="error-message">Akses Ditolak</h2>
                    <p class="error-description">Anda tidak memiliki izin untuk mengakses halaman ini.</p>
                    <a href="{{ url('/') }}" class="btn btn-primary">
                        <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
                    </a>
                </div>
            </div>
        </section>
    </div>
@endsection

{{-- Scripts khusus halaman --}}
@section('this-page-scripts')
@endsection
