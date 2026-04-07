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
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
.top-bar {
    width: 100vw;          /* عرض كامل الشاشة */
    margin: 0;
    padding: 12px 40px;    /* مسافة داخلية */
    background-color: #d8e7dd;
    direction: rtl;
    top: 0;
    z-index: 0;
    position: relative;
    left: 50%;
    right: 50%;
    margin-left: -50vw;
    margin-right: -50vw;
}

.top-bar-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

/* زر التواصل */
.contact-btn {
    background-color: #28a745;
    color: white;
    padding: 8px 18px;
    border-radius: 6px;
    text-decoration: none;
    font-size: 14px;
    font-weight: bold;
}

.contact-btn:hover {
    background-color: #218838;
}

/* نص الواتساب */
.whatsapp-support {
    text-align: right;
    color: #4b825f;
}

.whatsapp-support .title {
    display: block;
    font-weight: bold;
    font-size: 14px;
}

.whatsapp-support .sub {
    font-size: 12px;
    color: #7a9a87;
}
    </style>
<div class="top-bar">
    <div class="top-bar-container">

        <!-- نص اليمين -->
        <div class="whatsapp-support">
            <span class="title">الدعم الفني عبر واتساب</span>
            <span class="sub">في حال وجود أي مشكلة يمكنك التواصل معنا مباشرة</span>
        </div>
        <!-- زر اليسار -->
        <a href="https://chat.whatsapp.com/GuBqC7RjTqO9giL4vHwLgJ?mode=gi_t" target="_blank" class="contact-btn">
            تواصل الآن
        </a>



    </div>
</div>
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
        window.addEventListener('load', function () {
            const overlay = document.getElementById('loadingOverlay');
            overlay.style.display = 'none';
        });
    </script>
@endpush
