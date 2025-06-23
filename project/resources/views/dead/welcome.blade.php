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
            width   : 100%;
            font-family: Arial, sans-serif;
        }
    </style>
<body>
    {{-- <div class="row m-12">
            <h1 class="text-center">أهلا وسهلا بك في نظام إدارة المواليد و الوفيات</h1>


    </div> --}}

</body>
@endsection

@push('scripts')
    <script>

    </script>
@endpush
