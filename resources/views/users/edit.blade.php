@extends('layouts.app')
@section('title', 'Edit User')

@section('content')
<div class="container px-5 my-5">
    <h2 class="mb-4">Edit Pengguna</h2>

    <form action="{{ route('user.update', $user->user_id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Nama -->
        <div class="form-floating mb-3">
            <input class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" type="text" 
                   value="{{ old('nama', $user->nama) }}" required>
            <label for="nama">Nama</label>
            @error('nama')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Username -->
        <div class="form-floating mb-3">
            <input class="form-control @error('username') is-invalid @enderror" id="username" name="username" type="text" 
                   value="{{ old('username', $user->username) }}" required>
            <label for="username">Username</label>
            @error('username')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="form-floating mb-3">
            <input class="form-control @error('password') is-invalid @enderror" id="password" name="password" 
                   type="password" placeholder="Kosongkan jika tidak ingin mengubah password">
            <label for="password">Password Baru</label>
            @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Jenis Kelamin -->
        <div class="form-floating mb-3">
            <select class="form-select @error('jenis_kelamin') is-invalid @enderror" id="jenis_kelamin" name="jenis_kelamin" required>
                <option value="L" {{ old('jenis_kelamin', $user->jenis_kelamin) === 'L' ? 'selected' : '' }}>Laki-laki</option>
                <option value="P" {{ old('jenis_kelamin', $user->jenis_kelamin) === 'P' ? 'selected' : '' }}>Perempuan</option>
            </select>
            <label for="jenis_kelamin">Jenis Kelamin</label>
            @error('jenis_kelamin')
            <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <!-- Submit -->
        <div class="d-grid">
            <button class="btn btn-success btn-lg" type="submit">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection