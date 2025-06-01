<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Deperlas Futsal Academy Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="shortcut icon" href="{{ asset('images/icon/Logo_Deperlas_Main.ico') }}" type="image/x-icon">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@600&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="main-container d-flex align-items-center justify-content-center">
        <div class="container login-container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="d-flex flex-column flex-md-row align-items-center justify-content-center gap-5">
                        <!-- Academy Logo -->
                        <div class="academy-logo-container">
                            <img src="{{ asset('images/assets/Logo_Deperlas_Main.png') }}" class="academy-logo" alt="Deperlas Futsal logo">
                        </div>
                        
                        <!-- Login Form -->
                        <div class="login-form-wrapper">
                            <form class="login-form" method="POST" action="{{ route('login') }}">
                                @csrf
                                <h2 class="login-title">LOGIN</h2>

                                @if($errors->any())
                                    <div class="alert-danger">
                                        <i class="fas fa-exclamation-circle"></i>
                                        <span>{{ $errors->first() }}</span>
                                    </div>
                                @endif
                                
                                <div class="form-group">
                                    <label for="username" class="visually-hidden">Username</label>
                                    <div class="input-icon-wrapper @error('username') error @enderror">
                                        <i class="fas fa-user input-icon"></i>
                                        <input type="text" class="form-control" id="username" name="username" 
                                               placeholder="Username" value="{{ old('username') }}" 
                                               autocomplete="username">
                                    </div>
                                    @error('username')
                                        <div class="error-message">
                                            <i class="fas fa-exclamation-circle"></i>
                                            <span>{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="password" class="visually-hidden">Password</label>
                                    <div class="input-icon-wrapper @error('password') error @enderror">
                                        <i class="fas fa-lock input-icon"></i>
                                        <input type="password" class="form-control" id="password" name="password" 
                                               placeholder="Password" autocomplete="current-password">
                                    </div>
                                    @error('password')
                                        <div class="error-message">
                                            <i class="fas fa-exclamation-circle"></i>
                                            <span>{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>
                                
                                <button type="submit" class="btn-login">
                                    <i class="fas fa-sign-in-alt me-2"></i>LOGIN
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
