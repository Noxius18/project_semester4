@extends('layouts.app')
@section('title', 'Tambah Jadwal')

@section('content')
<div class="container px-5 my-5">
    <form action="{{ route('jadwal.store') }}" method="POST">
        @csrf

        <!-- Tipe Jadwal -->
        <div class="form-floating mb-3">
            <select class="form-select" id="tipe_jadwal" name="tipe_jadwal" required>
                <option value="REG">Latihan Reguler</option>
                <option value="PNG">Jadwal Pengganti</option>
                <option value="PRT">Pertandingan</option>
            </select>
            <label for="tipe_jadwal">Tipe Jadwal</label>
        </div>

        <!-- Tanggal (non-reguler) -->
        <div class="form-floating mb-3" id="field-tanggal">
            <input class="form-control" id="tanggal" name="tanggal" type="date" placeholder="Tanggal">
            <label for="tanggal">Tanggal</label>
        </div>

        <!-- Waktu Mulai -->
        <div class="form-floating mb-3">
            <input class="form-control" id="waktu_mulai" name="waktu_mulai" type="time" required>
            <label for="waktu_mulai">Waktu Mulai</label>
        </div>

        <!-- Waktu Selesai -->
        <div class="form-floating mb-3">
            <input class="form-control" id="waktu_selesai" name="waktu_selesai" type="time" required>
            <label for="waktu_selesai">Waktu Selesai</label>
        </div>

        <!-- Lokasi -->
        <div class="form-floating mb-3">
            <input class="form-control" id="lokasi" name="lokasi" type="text" required>
            <label for="lokasi">Lokasi</label>
        </div>

        <!-- Tim Lawan (hanya pertandingan) -->
        <div class="form-floating mb-3" id="field-tim-lawan">
            <input class="form-control" id="tim_lawan" name="tim_lawan" type="text">
            <label for="tim_lawan">Tim Lawan</label>
        </div>

        <!-- Submit -->
        <div class="d-grid">
            <button class="btn btn-primary btn-lg" type="submit">Tambah Jadwal</button>
        </div>
    </form>
</div>
@endsection