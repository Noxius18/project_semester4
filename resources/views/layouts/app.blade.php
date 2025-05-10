<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Deperlas Futsal Academy - @yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('images/icon/Logo_Deperlas_Main.ico') }}" type="image/x-icon">
    
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-custom">
    <div class="container-fluid d-flex justify-content-between align-items-center px-4">
        <!-- Kiri: Logo dan Judul -->
        <div class="d-flex align-items-center">
            <img src="{{ asset('images/assets/Logo_Deperlas_Main.png') }}" alt="Deperlas Futsal Academy" class="academy-logo me-3">
            <div class="academy-titles">
                <h1 class="academy-name">DEPERLAS</h1>
                <p class="academy-tagline">FUTSAL ACADEMY</p>
            </div>
        </div>

        <!-- Kanan: Selamat datang dan Logout -->
        <div class="d-flex align-items-center gap-3">
            <span class="text-white fw-semibold">Selamat datang, {{ Auth::user()->nama }}</span>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline-light btn-sm">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </div>
    </div>
</nav>


    <!-- Sidebar -->
    <aside class="sidebar">
        <nav>
            <ul class="sidebar-menu">
                <li class="menu-item">
                    <a href="#" class="menu-link">
                        <i class="fas fa-home"></i> Beranda
                    </a>
                </li>

                <!-- Jadwal Collapsible -->
                <li class="menu-item has-dropdown">
                    <a href="#" class="menu-link dropdown-toggle">
                        <i class="fas fa-calendar-alt"></i> Jadwal
                        <i class="fas fa-chevron-down ms-auto"></i>
                    </a>
                    <ul class="dropdown-menu-collapsible">
                        <li><a href="{{ route('jadwal.reguler') }}" class="dropdown-item">Jadwal Reguler</a></li>
                        <li><a href="{{ route('jadwal.pengganti') }}" class="dropdown-item">Jadwal Pengganti</a></li>
                        <li><a href="{{ route('jadwal.pertandingan') }}" class="dropdown-item">Jadwal Pertandingan</a></li>
                    </ul>
                </li>

                <!-- Anggota Collapsible -->
                <li class="menu-item has-dropdown">
                    <a href="#" class="menu-link dropdown-toggle">
                        <i class="fas fa-users"></i> User
                        <i class="fas fa-chevron-down ms-auto"></i>
                    </a>
                    <ul class="dropdown-menu-collapsible">
                        <li><a href="{{ route('user.pelatih') }}" class="dropdown-item">Pelatih</a></li>
                        <li><a href="{{ route('user.pemain') }}" class="dropdown-item">Pemain</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        @yield('content')
    </main>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>