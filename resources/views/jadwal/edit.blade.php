@extends('layouts.app')
@section('title', 'Edit Jadwal')

@section('content')
<div class="container px-5 my-5">
    <h2 class="mb-4">Edit Jadwal</h2>

    <form action="{{ route('jadwal.update', $jadwal->jadwal_id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Tipe Jadwal (readonly, tidak diubah) -->
        <div class="form-floating mb-3">
            <input class="form-control" value="{{ $jadwal->tipe_jadwal_label }}" disabled>
            <label for="tipe_jadwal">Tipe Jadwal</label>
        </div>

        <!-- Tanggal -->
        <div class="form-floating mb-3">
            <input class="form-control" id="tanggal" name="tanggal" type="date" value="{{ old('tanggal', $jadwal->tanggal) }}">
            <label for="tanggal">Tanggal</label>
        </div>

        <!-- Waktu Mulai -->
        <div class="form-floating mb-3">
            <input class="form-control" id="waktu_mulai" name="waktu_mulai" type="time" value="{{ old('waktu_mulai', $jadwal->waktu_mulai) }}" required>
            <label for="waktu_mulai">Waktu Mulai</label>
        </div>

        <!-- Waktu Selesai -->
        <div class="form-floating mb-3">
            <input class="form-control" id="waktu_selesai" name="waktu_selesai" type="time" value="{{ old('waktu_selesai', $jadwal->waktu_selesai) }}" required>
            <label for="waktu_selesai">Waktu Selesai</label>
        </div>

        <!-- Lokasi -->
        <div class="form-floating mb-3">
            <input class="form-control" id="lokasi" name="lokasi" type="text" value="{{ old('lokasi', $jadwal->lokasi) }}" required>
            <label for="lokasi">Lokasi</label>
        </div>

        <!-- Tim Lawan (opsional) -->
        @if ($jadwal->tipe_jadwal === 'PRT')
            <div class="form-floating mb-3">
                <input class="form-control" id="tim_lawan" name="tim_lawan" type="text" value="{{ old('tim_lawan', $jadwal->tim_lawan) }}">
                <label for="tim_lawan">Tim Lawan</label>
            </div>
        @endif
        <!-- Submit -->
        <div class="d-grid">
            <button class="btn btn-success btn-lg" type="submit">
                <i class="fas fa-save me-1"></i> Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection

@push('script')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const tipe = document.getElementById('tipe_jadwal').value;
        const fieldTimLawan = document.getElementById('field-tim-lawan');
        
        if (tipe !== 'PRT') {
            fieldTimLawan.classList.add('d-none');
        } else {
            fieldTimLawan.classList.remove('d-none');
        }
    });
</script>
@endpush
