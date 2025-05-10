@extends('layouts.app')

@section('content')
<div class="container px-5 my-5">
    <form action="#" method="POST">
        @csrf

        <!-- Tipe Jadwal -->
        <div class="form-floating mb-3">
            <select class="form-select" id="tipe_jadwal" name="tipe_jadwal" required>
                <option value="latihan">Latihan Reguler</option>
                <option value="pengganti">Jadwal Pengganti</option>
                <option value="pertandingan">Pertandingan</option>
            </select>
            <label for="tipe_jadwal">Tipe Jadwal</label>
        </div>

        <!-- Hari (khusus latihan) -->
        <div class="form-floating mb-3" id="field-hari">
            <select class="form-select" id="hari" name="hari">
                <option value="Senin">Senin</option>
                <option value="Selasa">Selasa</option>
                <option value="Rabu">Rabu</option>
                <option value="Kamis">Kamis</option>
                <option value="Jumat">Jumat</option>
                <option value="Sabtu">Sabtu</option>
                <option value="Minggu">Minggu</option>
            </select>
            <label for="hari">Hari</label>
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