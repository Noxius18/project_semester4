<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Deperlas Futsal Academy - @yield('title')</title>
    
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@700&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-custom">
        <div class="header-logo">
            <img src="{{ asset('images/assets/Logo_Deperlas_Main.png') }}" 
                 alt="Deperlas Futsal Academy" 
                 class="academy-logo">
            <div class="academy-titles ms-2">
                <h1 class="academy-name">DEPERLAS</h1>
                <p class="academy-tagline">FUTSAL ACADEMY</p>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <aside class="sidebar">
        <nav>
            <ul class="sidebar-menu">
                <li class="menu-item">
                    <a href="#" class="menu-link">
                        <i class="fas fa-home"></i>
                        Beranda
                    </a>
                </li>
                <li class="menu-item">
                    <a href="#" class="menu-link">
                        <i class="fas fa-calendar-alt"></i>
                        Jadwal
                    </a>
                </li>
                <li class="menu-item">
                    <a href="#" class="menu-link">
                        <i class="fas fa-trophy"></i>
                        Kompetisi
                    </a>
                </li>
                <li class="menu-item">
                    <a href="#" class="menu-link">
                        <i class="fas fa-users"></i>
                        Anggota
                    </a>
                </li>
                <li class="menu-item">
                    <a href="#" class="menu-link">
                        <i class="fas fa-cog"></i>
                        Pengaturan
                    </a>
                </li>
            </ul>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <!-- @yield('content') -->
         Test
    </main>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>