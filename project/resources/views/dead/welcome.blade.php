@extends('layouts.main')
@section('title', '')
@section('content')
    <style>
        body {
            margin: 0;
            padding: 0;
            background-image: url('{{ asset('assets/media/images/baby.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            width: 100%;
            font-family: Arial, sans-serif;
        }

        .loading-overlay {
            position: fixed;
            inset: 0;
            background-color: white;
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            direction: rtl;
            font-family: 'Cairo', sans-serif;
        }

        .loading-box {
            border: 2px solid #4b825f;
            border-radius: 50px;
            padding: 30px 50px;
            display: flex;
            align-items: center;
            gap: 20px;
            color: #4b825f;
            font-size: 32px;
            font-weight: 600;
        }

        .loading-icon {
            width: 65px;
            height: 65px;
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>

    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-box">
            <img src="{{ asset('assets/media/logos/logo_new.png') }}" alt="Loading" class="loading-icon">
            <span class="loading-text">يُرجى الانتظار بينما يتم التحقُّق من طلبك...</span>
        </div>
    </div>

    <body>
    </body>
@endsection

@push('scripts')
    <script>
        window.addEventListener('load', function() {
            const overlay = document.getElementById('loadingOverlay');
            overlay.style.display = 'none';
        });
    </script>
@endpush
