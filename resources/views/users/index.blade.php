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

    <!-- Table -->
    <div class="table-responsive shadow-sm rounded">
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
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->nama }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->jenis_kelamin }}</td>
                    <td>
                        @if ($user->role->role === 'Admin')
                            <span class="badge bg-danger">{{ $user->role->role }}</span>
                        @elseif ($user->role->role === 'Pelatih')
                            <span class="badge bg-primary">{{ $user->role->role }}</span>
                        @else
                            <span class="badge bg-success">{{ $user->role->role }}</span>
                        @endif
                    </td>
                        <span class="badge"
                        @if($user->role->role == 'Admin') bg-danger
                        @elseif($user->role->role == 'Pelatih') bg-primary
                        @else bg-success
                        @endif>
                        {{ $user->role->role }}
                        </span>
                    </td>
                    <td>
                        <div class="d-flex justify-content-center gap-2">
                            <a href="#" class="btn btn-sm btn-outline-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="#" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger btn-delete" type="button">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">Tidak ada data user.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('script')
<script>
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
</script>
@endpush
