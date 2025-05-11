@extends('layouts.app')
@section('title', 'List Jadwal')

@section('content')
<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0 fw-bold text-primary">Daftar Jadwal</h2>
        <a href="{{ route('jadwal.create') }}" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus me-1"></i> Tambah Jadwal
        </a>
    </div>

    <!-- Filter -->
    <form method="GET" class="mb-4">
        <div class="row g-3 align-items-center">
            <div class="col-auto">
                <label for="filterSelect" class="col-form-label fw-semibold">Filter Tipe Jadwal:</label>
            </div>
            <div class="col-md-4">
                <select name="tipe_jadwal" id="filterSelect" class="form-select shadow-sm border-primary" onchange="this.form.submit()">
                    <option value="">Semua Tipe Jadwal</option>
                    <option value="REG" {{ $filter === 'REG' ? 'selected' : '' }}>Latihan Reguler</option>
                    <option value="PNG" {{ $filter === 'PNG' ? 'selected' : '' }}>Jadwal Pengganti</option>
                    <option value="PRT" {{ $filter === 'PRT' ? 'selected' : '' }}>Pertandingan</option>
                </select>
            </div>
        </div>
    </form>

    <!-- Table -->
    <div class="table-responsive shadow-sm rounded">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr class="text-center text-uppercase small">
                    <th>#</th>
                    <th>Tipe</th>
                    <th>Tanggal</th>
                    <th>Waktu</th>
                    <th>Lokasi</th>
                    <th>Tim Lawan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($jadwals as $jadwal)
                <tr class="text-center">
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <span class="badge bg-{{ $jadwal->tipe_jadwal === 'PRT' ? 'danger' : ($jadwal->tipe_jadwal === 'PNG' ? 'warning text-dark' : 'info') }}">
                            {{ $jadwal->tipe_jadwal_label }}
                        </span>
                    </td>
                    <td>{{ $jadwal->tanggal ? \Carbon\Carbon::parse($jadwal->tanggal)->format('d M Y') : '-' }}</td>
                    <td>{{ $jadwal->waktu_mulai }} - {{ $jadwal->waktu_selesai }}</td>
                    <td>{{ $jadwal->lokasi }}</td>
                    <td>{{ $jadwal->tim_lawan ?? '-' }}</td>
                    <td>
                        <div class="d-flex justify-content-center gap-2">
                            <a href="#" class="btn btn-sm btn-outline-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="#" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin hapus jadwal ini?')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted py-4">Tidak ada jadwal ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
