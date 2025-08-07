<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $latest->system_name ?? 'APP' }}</title>
    {{-- <title>{{ $latest->system_name ?? 'System Name' }}</title> --}}

    @if ($latest && $latest->logo)
        <link rel="icon" href="{{ asset('systemlogo/' . $latest->logo) }}" type="image/png">
    @endif
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap-icons/bootstrap-icons.css') }}">

    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">


</head>
<body>
<div id="app">
@auth
    <!-- Mobile Navbar -->
    @include('sidebar.mobilenavbar')
    <!-- Sidebar (Desktop) -->
    @include('sidebar.desktop')
    <!-- Sidebar (Mobile) -->
    @include('sidebar.mobile')

@endauth
    <!-- Main Content -->
    <div class="main with-sidebar" id="mainContent">
        @yield('content')
    </div>
</div>

<!-- Logout Forms -->
<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>
<form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>

<script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('mobileSidebar');
        const toggleBtn = document.querySelector('.toggle-btn');
        sidebar.classList.toggle('show');
        toggleBtn.style.display = sidebar.classList.contains('show') ? 'none' : 'block';
    }

    function toggleDesktopSidebar() {
        const sidebar = document.getElementById('desktopSidebar');
        const main = document.getElementById('mainContent');

        sidebar.classList.toggle('collapsed');
        main.classList.toggle('collapsed');
    }

    document.addEventListener('DOMContentLoaded', function () {
        const alert = document.getElementById('success-alert');
        if (alert) {
            setTimeout(function () {
                alert.style.transition = 'opacity 0.5s ease-out';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            }, 3000); // change delay if needed
        }
    });
</script>
</body>
</html>
