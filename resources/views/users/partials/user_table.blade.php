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
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm btn-outline-danger btn-delete" data-bs-toggle="tooltip" title="Hapus Pengguna">
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
                                    <button type="button" class="btn btn-sm btn-outline-primary" id="empty-reset-filter">
                                        <i class="fas fa-redo-alt me-1"></i> Reset Filter
                                    </button>
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
@if($users->count() > 0)
<div class="d-md-flex justify-content-between align-items-center mt-3">
    <div class="text-muted small mb-2 mb-md-0">
        Menampilkan {{ $users->firstItem() }} hingga {{ $users->lastItem() }} dari {{ $users->total() }} data
    </div>
    <nav aria-label="Page navigation">
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
@endif