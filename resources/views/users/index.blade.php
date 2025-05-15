@extends('layouts.app')
@section('title', 'Daftar User')

@section('content')
<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0 fw-bold text-primary">Daftar Pengguna</h2>
        <a href="{{ route('user.create') }}" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus me-1"></i> Tambah Pengguna
        </a>
    </div>

    <!-- Filter & Search -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('user.index') }}" class="row g-3">
                <!-- Search Bar -->
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-text bg-white">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                        <input type="text" name="search" class="form-control border-start-0" 
                               placeholder="Cari nama atau username..." value="{{ request('search') }}">
                    </div>
                </div>
                
                <!-- Role Filter -->
                <div class="col-md-4">
                    <select name="role" class="form-select" onchange="this.form.submit()">
                        <option value="">Semua Role</option>
                        @foreach($roles as $role)
                            <option value="{{ $role }}" {{ request('role') == $role ? 'selected' : '' }}>
                                {{ $role }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <!-- Reset Button -->
                <div class="col-md-2">
                    <div class="d-grid">
                        <a href="{{ route('user.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-redo-alt me-1"></i> Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Table -->
    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr class="text-center text-uppercase small">
                        <th>#</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Jenis Kelamin</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                    <tr class="text-center">
                        <td>{{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}</td>
                        <td class="text-start">{{ $user->nama }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->jenis_kelamin }}</td>
                        <td>
                            <span class="badge 
                                {{ $user->role->role === 'Admin' ? 'bg-danger' : 
                                  ($user->role->role === 'Pelatih' ? 'bg-primary' : 'bg-success') }}">
                                {{ $user->role->role }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('user.edit', $user->user_id) }}" class="btn btn-sm btn-outline-warning" data-bs-toggle="tooltip" title="Edit Pengguna">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('user.destroy', $user->user_id) }}" method="POST" class="d-inline delete-form">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger btn-delete" type="button" data-bs-toggle="tooltip" title="Hapus Pengguna">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">
                            <div class="my-4 text-muted">
                                <i class="fas fa-users-slash fa-3x mb-3"></i>
                                <p class="mb-0">Tidak ada data pengguna yang ditemukan.</p>
                                @if(request('search') || request('role'))
                                    <div class="mt-2">
                                        <a href="{{ route('user.index') }}" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-redo-alt me-1"></i> Reset Filter
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination & Info -->
    <div class="d-md-flex justify-content-between align-items-center mt-3">
        <div class="text-muted small mb-2 mb-md-0">
            Menampilkan {{ $users->firstItem() ?? 0 }} hingga {{ $users->lastItem() ?? 0 }} dari {{ $users->total() }} data
        </div>
        <nav>
            <ul class="pagination pagination-sm mb-0">
                {{-- Previous Page Link --}}
                @if ($users->onFirstPage())
                    <li class="page-item disabled">
                        <span class="page-link">&laquo;</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $users->previousPageUrl() }}" rel="prev">&laquo;</a>
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @for ($i = 1; $i <= $users->lastPage(); $i++)
                    <li class="page-item {{ ($users->currentPage() == $i) ? 'active' : '' }}">
                        <a class="page-link" href="{{ $users->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor

                {{-- Next Page Link --}}
                @if ($users->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $users->nextPageUrl() }}" rel="next">&raquo;</a>
                    </li>
                @else
                    <li class="page-item disabled">
                        <span class="page-link">&raquo;</span>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
</div>
@endsection

@push('script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize tooltips
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
        
        // Konfirmasi hapus
        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', () => {
                Swal.fire({
                    title: 'Yakin ingin menghapus user ini?',
                    text: "Tindakan ini tidak bisa dibatalkan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        button.closest('form').submit();
                    }
                });
            });
        });
        
        // Submit form pada enter di search
        document.querySelector('input[name="search"]').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                this.form.submit();
            }
        });
    });
</script>
@endpush