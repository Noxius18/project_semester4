{{-- resources/views/home.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Deperlas Futsal Academy</title>
    
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/beranda.css') }}">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@700&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    
    
</head>
<body>
    <!-- Combined Navbar Header -->
    <nav class="navbar navbar-custom navbar-expand-lg">
        <div class="container-xl">
            <!-- Logo Header -->
            <div class="d-flex align-items-center header-logo">
                <img src="{{ asset('images/assets/Logo_Deperlas_Main.png') }}" 
                     alt="Deperlas Futsal Academy" 
                     class="academy-logo">
                <div class="academy-titles ms-2">
                    <h1 class="academy-name">DEPERLAS</h1>
                    <p class="academy-tagline">FUTSAL ACADEMY</p>
                </div>
            </div>

            <!-- Navigation Menu -->
            <div class="d-flex align-items-center" style="position: absolute; right: 0; margin-right: 2rem;">
                <div class="d-flex align-items-center gap-1">
                    <!-- Dropdown Menu -->
                    <div class="dropdown">
                        <a class="nav-icon dropdown-toggle" 
                           href="#" 
                           role="button" 
                           data-bs-toggle="dropdown"
                           style="padding: 0.8rem 1.2rem;">
                            <i class="fas fa-bars"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-calendar-alt me-3"></i>Jadwal</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-trophy me-3"></i>Kompetisi</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-users me-3"></i>List User</a></li>
                        </ul>
                    </div>

                    <!-- Home Icon -->
                    <a class="nav-icon" href="#" style="padding: 0.8rem 1.2rem;">
                        <i class="fas fa-home"></i>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container-xl px-3">
        <!-- Welcome Section -->
        <section class="text-center py-5 my-4">
            <h2 class="font-deperlas welcome-title">SELAMAT DATANG</h2>
            <h3 class="font-deperlas welcome-subtitle">DI DEPERLAS FUTSAL ACADEMY</h3>
        </section>
    </main>

    <!-- Full Width Banner -->
    <section class="full-width-banner">
        <img src="{{ asset('images/assets/Banner_Deperlas.png') }}" 
             alt="Deperlas Futsal Academy Banner" 
             class="banner-image">
    </section>

    <!-- Carousel Section -->
    <section class="bottom-section">
        <div class="container-xl px-3">
            <div class="d-flex flex-column align-items-center">
                <!-- Carousel Dots -->
                <div class="d-flex gap-3 mb-4">
                    <i class="fas fa-circle carousel-dot active"></i>
                    <i class="fas fa-circle carousel-dot"></i>
                    <i class="fas fa-circle carousel-dot"></i>
                </div>

                <!-- Carousel Content -->
                <div class="d-flex align-items-center gap-5">
                    <i class="fas fa-chevron-left carousel-arrow"></i>
                    
                    <div class="d-flex gap-4">
                        <img src="{{ asset('images/assets/Achiv_1.png') }}" 
                             alt="Player Match" 
                             class="carousel-image">
                        <img src="{{ asset('images/assets/Achiv_2.png') }}" 
                             alt="Best Player 2007" 
                             class="carousel-image">
                        <img src="{{ asset('images/assets/Achiv_3.png') }}" 
                             alt="Best Player 2005" 
                             class="carousel-image">
                    </div>
                    
                    <i class="fas fa-chevron-right carousel-arrow"></i>
                </div>
            </div>
        </div>
    </section>
</body>
</html>