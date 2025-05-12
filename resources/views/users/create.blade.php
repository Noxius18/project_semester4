@extends('layouts.app')
@section('title', 'Tambah Pengguna')

@section('content')
<div class="container px-5 my-5">
    <form action="{{ route('user.store') }}" method="POST">
        @csrf

        <!-- Nama -->
        <div class="form-floating mb-3">
            <input class="form-control" id="nama" name="nama" type="text" required>
            <label for="nama">Nama</label>
        </div>

        <!-- Username -->
        <div class="form-floating mb-3">
            <input class="form-control" id="username" name="username" type="text" required>
            <label for="username">Username</label>
        </div>

        <!-- Jenis Kelamin -->
        <div class="form-floating mb-3">
            <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
            <label for="jenis_kelamin">Jenis Kelamin</label>
        </div>

        <!-- Role -->
        <div class="form-floating mb-3">
            <select class="form-select" id="role" name="role" required>
                <option value="Admin">Admin</option>
                <option value="Pelatih">Pelatih</option>
                <option value="Pemain">Pemain</option>
            </select>
            <label for="role">Role</label>
        </div>

        <!-- Submit -->
        <div class="d-grid">
            <button class="btn btn-primary btn-lg" type="submit">Tambah Pengguna</button>
        </div>
    </form>
</div>
@endsection

@push('script')
