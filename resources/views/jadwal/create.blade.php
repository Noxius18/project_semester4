@extends('layouts.app')
@section('title', 'Tambah Jadwal')

@section('content')
<div class="container px-5 my-5">
    <!-- Alert untuk menampilkan error umum -->
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Terjadi kesalahan:</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Alert untuk success message -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Alert untuk error message -->
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form action="{{ route('jadwal.store') }}" method="POST">
        @csrf

        <!-- Tipe Jadwal -->
        <div class="form-floating mb-3">
            <select class="form-select @error('tipe_jadwal') is-invalid @enderror" 
                    id="tipe_jadwal" 
                    name="tipe_jadwal" 
                    required>
                <option value="">-- Pilih Tipe Jadwal --</option>
                <option value="REG" {{ old('tipe_jadwal') == 'REG' ? 'selected' : '' }}>Latihan Reguler</option>
                <option value="PNG" {{ old('tipe_jadwal') == 'PNG' ? 'selected' : '' }}>Jadwal Pengganti</option>
                <option value="PRT" {{ old('tipe_jadwal') == 'PRT' ? 'selected' : '' }}>Pertandingan</option>
            </select>
            <label for="tipe_jadwal">Tipe Jadwal</label>
            @error('tipe_jadwal')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Tanggal -->
        <div class="form-floating mb-3" id="field-tanggal">
            <input class="form-control @error('tanggal') is-invalid @enderror" 
                   id="tanggal" 
                   name="tanggal" 
                   type="date" 
                   value="{{ old('tanggal') }}"
                   placeholder="Tanggal">
            <label for="tanggal">Tanggal</label>
            @error('tanggal')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Waktu Mulai -->
        <div class="form-floating mb-3">
            <input class="form-control @error('waktu_mulai') is-invalid @enderror" 
                   id="waktu_mulai" 
                   name="waktu_mulai" 
                   type="time" 
                   value="{{ old('waktu_mulai') }}"
                   required>
            <label for="waktu_mulai">Waktu Mulai</label>
            @error('waktu_mulai')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Waktu Selesai -->
        <div class="form-floating mb-3">
            <input class="form-control @error('waktu_selesai') is-invalid @enderror" 
                   id="waktu_selesai" 
                   name="waktu_selesai" 
                   type="time" 
                   value="{{ old('waktu_selesai') }}"
                   required>
            <label for="waktu_selesai">Waktu Selesai</label>
            @error('waktu_selesai')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Lokasi -->
        <div class="form-floating mb-3">
            <input class="form-control @error('lokasi') is-invalid @enderror" 
                   id="lokasi" 
                   name="lokasi" 
                   type="text" 
                   value="{{ old('lokasi') }}"
                   maxlength="255"
                   placeholder="Lokasi"
                   required>
            <label for="lokasi">Lokasi</label>
            @error('lokasi')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Tim Lawan -->
        <div class="form-floating mb-3" id="field-tim-lawan">
            <input class="form-control @error('tim_lawan') is-invalid @enderror" 
                   id="tim_lawan" 
                   name="tim_lawan" 
                   type="text" 
                   value="{{ old('tim_lawan') }}"
                   maxlength="255"
                   placeholder="Tim Lawan">
            <label for="tim_lawan">Tim Lawan</label>
            @error('tim_lawan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Submit -->
        <div class="d-grid">
            <button class="btn btn-primary btn-lg" type="submit">Tambah Jadwal</button>
        </div>
    </form>
</div>
@endsection

@push('script')
<script src="{{ asset('js/create_jadwal.js') }}"></script>
