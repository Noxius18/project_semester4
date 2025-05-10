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
        <div class="container-xl">
            <div class="header-logo d-flex align-items-center">
                <img src="{{ asset('images/assets/Logo_Deperlas_Main.png') }}" alt="Deperlas Futsal Academy" class="academy-logo">
                <div class="academy-titles ms-2">
                    <h1 class="academy-name">DEPERLAS</h1>
                    <p class="academy-tagline">FUTSAL ACADEMY</p>
                </div>
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

                <!-- Jadwal Dropdown -->
                <li class="menu-item has-dropdown">
                    <a href="#" class="menu-link dropdown-toggle">
                        <i class="fas fa-calendar-alt"></i> Jadwal
                        <i class="fas fa-chevron-down ms-auto"></i>
                    </a>
                    <ul class="dropdown-menu-collapsible">
                        <li><a href="#" class="dropdown-item">Jadwal Reguler</a></li>
                        <li><a href="#" class="dropdown-item">Jadwal Pengganti</a></li>
                    </ul>
                </li>

                <li class="menu-item">
                    <a href="#" class="menu-link">
                        <i class="fas fa-trophy"></i> Kompetisi
                    </a>
                </li>

                <!-- Anggota Dropdown -->
                <li class="menu-item has-dropdown">
                    <a href="#" class="menu-link dropdown-toggle">
                        <i class="fas fa-users"></i> Anggota
                        <i class="fas fa-chevron-down ms-auto"></i>
                    </a>
                    <ul class="dropdown-menu-collapsible">
                        <li><a href="#" class="dropdown-item">Pelatih</a></li>
                        <li><a href="#" class="dropdown-item">Pemain</a></li>
                    </ul>
                </li>

                <li class="menu-item">
                    <a href="#" class="menu-link">
                        <i class="fas fa-cog"></i> Pengaturan
                    </a>
                </li>
            </ul>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        @yield('content')
    </main>

    <!-- Sidebar Dropdown Script -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
