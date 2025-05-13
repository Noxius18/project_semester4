@extends('layouts.app')
@section('title', 'Tambah Pengguna')

@section('content')
<div class="container px-5 my-5">
    <h2 class="mb-4">Tambah Pengguna</h2>

    <form action="{{ route('user.store') }}" method="POST">
        @csrf

        <!-- Nama -->
        <div class="form-floating mb-3">
            <input class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" type="text" value="{{ old('nama') }}" required>
            <label for="nama">Nama</label>
            @error('nama')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Username -->
        <div class="form-floating mb-3">
            <input class="form-control @error('username') is-invalid @enderror" id="username" name="username" type="text" value="{{ old('username') }}" required>
            <label for="username">Username</label>
            @error('username')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="form-floating mb-3">
            <input class="form-control @error('password') is-invalid @enderror" id="password" name="password" type="password" required>
            <label for="password">Password</label>
            @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Jenis Kelamin -->
        <div class="form-floating mb-3">
            <select class="form-select @error('jenis_kelamin') is-invalid @enderror" id="jenis_kelamin" name="jenis_kelamin" required>
                <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
            </select>
            <label for="jenis_kelamin">Jenis Kelamin</label>
            @error('jenis_kelamin')
            <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <!-- Role -->
        <div class="form-floating mb-3">
            <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
                <option value="Admin" {{ old('role') == 'Admin' ? 'selected' : '' }}>Admin</option>
                <option value="Pelatih" {{ old('role') == 'Pelatih' ? 'selected' : '' }}>Pelatih</option>
                <option value="Pemain" {{ old('role') == 'Pemain' ? 'selected' : '' }}>Pemain</option>
            </select>
            <label for="role">Role</label>
            @error('role')
            <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <!-- Submit -->
        <div class="d-grid">
            <button class="btn btn-primary btn-lg" type="submit">Tambah Pengguna</button>
        </div>
    </form>
</div>
@endsection
