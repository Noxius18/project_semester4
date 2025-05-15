@extends('layouts.app')
@section('title', 'List Jadwal')

@section('content')
<div class="container py-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary mb-0">Daftar Jadwal</h2>
        <a href="{{ route('jadwal.create') }}" class="btn btn-primary shadow">
            <i class="fas fa-plus me-1"></i> Tambah Jadwal
        </a>
    </div>

    <!-- Filter -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" class="row g-3 align-items-center mb-0">
                <div class="col-auto">
                    <label for="filterSelect" class="col-form-label fw-semibold">Filter Tipe Jadwal:</label>
                </div>
                <div class="col-md-4">
                    <select name="tipe_jadwal" id="filterSelect" class="form-select border-primary" onchange="this.form.submit()">
                        <option value="">Semua Tipe Jadwal</option>
                        <option value="REG" {{ $filter === 'REG' ? 'selected' : '' }}>Latihan Reguler</option>
                        <option value="PNG" {{ $filter === 'PNG' ? 'selected' : '' }}>Jadwal Pengganti</option>
                        <option value="PRT" {{ $filter === 'PRT' ? 'selected' : '' }}>Pertandingan</option>
                    </select>
                </div>
            </form>
        </div>
    </div>

    <!-- Table -->
    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light text-center text-uppercase small">
                    <tr>
                        <th>#</th>
                        <th>Tipe</th>
                        <th>Tanggal</th>
                        <th>Waktu</th>
                        <th>Lokasi</th>
                        <th>Tim Lawan</th>
                        <th>Pelatih</th>
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
                        <td>{{ $jadwal->tanggal ? \Carbon\Carbon::parse($jadwal->tanggal)->translatedFormat('d M Y') : '-' }}</td>
                        <td>{{ $jadwal->waktu_mulai }} - {{ $jadwal->waktu_selesai }}</td>
                        <td>{{ $jadwal->lokasi }}</td>
                        <td>{{ $jadwal->tim_lawan ?? '-' }}</td>
                        <td>
                            @forelse ($jadwal->pelatih as $p)
                                <span class="badge bg-success d-block mb-1">{{ $p->nama }}</span>
                            @empty
                                <span class="badge bg-secondary">Belum diatur</span>
                            @endforelse
                        </td>
                        <td>
                            <div class="d-flex justify-content-center flex-wrap gap-1">
                                <a href="{{ route('jadwal.assign', $jadwal->jadwal_id) }}" class="btn btn-sm btn-outline-primary" data-bs-toggle="tooltip" title="Atur Pelatih">
                                    <i class="fas fa-user-plus"></i> <span class="d-none d-md-inline">({{ $jadwal->pelatih->count() }}/2)</span>
                                </a>
                                <a href="{{ route('jadwal.edit', $jadwal->jadwal_id) }}" class="btn btn-sm btn-outline-warning" data-bs-toggle="tooltip" title="Edit Jadwal">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('jadwal.destroy', $jadwal->jadwal_id) }}" method="POST" class="d-inline delete-form">
                                    @csrf @method('DELETE')
                                    <button type="button" class="btn btn-sm btn-outline-danger btn-delete" data-bs-toggle="tooltip" title="Hapus Jadwal">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">
                            <i class="fas fa-calendar-times fa-3x mb-2"></i><br>
                            Tidak ada jadwal ditemukan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <!-- Pagination & Info -->
    @if($jadwals->count() > 0)
    <div class="d-md-flex justify-content-between align-items-center mt-3">
        <div class="text-muted small mb-2 mb-md-0">
            Menampilkan {{ $jadwals->firstItem() }} hingga {{ $jadwals->lastItem() }} dari {{ $jadwals->total() }} data
        </div>
        <nav aria-label="Halaman jadwal">
            <ul class="pagination pagination-sm mb-0">
                {{-- Previous Page Link --}}
                @if ($jadwals->onFirstPage())
                    <li class="page-item disabled">
                        <span class="page-link">&laquo;</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $jadwals->previousPageUrl() }}" rel="prev">&laquo;</a>
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @for ($i = 1; $i <= $jadwals->lastPage(); $i++)
                    <li class="page-item {{ ($jadwals->currentPage() == $i) ? 'active' : '' }}">
                        <a class="page-link" href="{{ $jadwals->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor

                {{-- Next Page Link --}}
                @if ($jadwals->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $jadwals->nextPageUrl() }}" rel="next">&raquo;</a>
                    </li>
                @else
                    <li class="page-item disabled">
                        <span class="page-link">&raquo;</span>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
    @endif
@endsection

@push('script')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Bootstrap Tooltip
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.forEach(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));

        // SweetAlert2 Delete
        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Yakin hapus jadwal ini?',
                    text: "Data tidak dapat dikembalikan setelah dihapus.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Hapus',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.closest('form').submit();
                    }
                });
            });
        });
    });
</script>
@endpush
