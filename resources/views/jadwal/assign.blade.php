@extends('layouts.app')
@section('title', 'Assign Pelatih')

@section('content')
<div class="container px-5 my-5">
    <h2 class="mb-4">Atur Pelatih untuk Jadwal</h2>

    <!-- Info Jadwal -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5 class="card-title mb-2">{{ $jadwal->tipe_jadwal_label }}</h5>
            <p class="mb-1"><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d M Y') }}</p>
            <p class="mb-1"><strong>Waktu:</strong> {{ $jadwal->waktu_mulai }} - {{ $jadwal->waktu_selesai }}</p>
            <p class="mb-0"><strong>Lokasi:</strong> {{ $jadwal->lokasi }}</p>
        </div>
    </div>

    <!-- Form Assign -->
    <form action="{{ route('jadwal.assign.store', $jadwal->jadwal_id) }}" method="POST" id="assignForm">
        @csrf
        <div class="mb-3">
            <label class="form-label fw-semibold">Pilih Pelatih (maksimal 2):</label>
            <div class="row">
                @foreach ($listPelatih as $pelatih)
                <div class="col-md-6 mb-2">
                    <div class="form-check">
                        <input 
                            class="form-check-input pelatih-checkbox"
                            type="checkbox"
                            name="pelatih_id[]"
                            value="{{ $pelatih->user_id }}"
                            id="pelatih_{{ $pelatih->user_id }}"
                            {{ in_array($pelatih->user_id, $assignedIds) ? 'checked' : '' }}
                        >
                        <label class="form-check-label" for="pelatih_{{ $pelatih->user_id }}">
                            {{ $pelatih->nama }}
                        </label>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="d-grid">
            <button class="btn btn-primary" type="submit">Simpan Penugasan</button>
        </div>
    </form>
</div>
@endsection

@push('script')
<script>
    // Validasi maksimal 2 pelatih
    document.addEventListener('DOMContentLoaded', function () {
        const checkboxes = document.querySelectorAll('.pelatih-checkbox');
        checkboxes.forEach(cb => {
            cb.addEventListener('change', () => {
                let checked = document.querySelectorAll('.pelatih-checkbox:checked').length;
                if (checked > 2) {
                    cb.checked = false;
                    Swal.fire({
                        icon: 'warning',
                        title: 'Maksimal 2 pelatih',
                        text: 'Kamu hanya bisa memilih hingga 2 pelatih saja.',
                        confirmButtonText: 'OK'
                    });
                }
            });
        });
    });
</script>