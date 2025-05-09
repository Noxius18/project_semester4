<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Deperlas Futsal Academy Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    {{-- Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@600&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Main Content -->
    <div class="main-container d-flex align-items-center justify-content-center p-3">
        <div class="container login-container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="d-flex flex-column flex-md-row align-items-center justify-content-center">
                        <!-- Academy Logo -->
                        <div class="academy-logo-container me-md-5">
                            <img src='gambar/assets/Logo_Deperlas_Main.png' class="academy-logo" alt="Deperlas Futsal shield logo">
                        </div>
                        
                        <!-- Login Form -->
                        <div class="mt-4 mt-md-0">
                            <form class="login-form" method="POST" action="#">
                                @csrf
                                <h2 class="login-title">LOGIN</h2>
                                
                                <div class="form-group">
                                    <label for="username" class="visually-hidden">Username</label>
                                    <div class="input-icon-wrapper">
                                        <i class="fas fa-user input-icon"></i>
                                        <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" placeholder="JUNED" value="{{ old('username') }}" autocomplete="off">
                                    </div>
                                    @error('username')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="form-group mb-4">
                                    <label for="password" class="visually-hidden">Password</label>
                                    <div class="input-icon-wrapper">
                                        <i class="fas fa-lock input-icon"></i>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="PASSWORD" autocomplete="off">
                                    </div>
                                    @error('password')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <button type="submit" class="btn-login">LOGIN</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>