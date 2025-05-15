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
            <form id="search-form" method="GET" action="{{ route('user.index') }}" class="row g-3">
                <!-- Search Bar -->
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-text bg-white">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                        <input type="text" name="search" id="search-input" class="form-control border-start-0" 
                               placeholder="Cari nama atau username..." value="{{ request('search') }}">
                    </div>
                </div>
                
                <!-- Role Filter -->
                <div class="col-md-4">
                    <select name="role" id="role-filter" class="form-select">
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
                        <button type="button" id="reset-filter" class="btn btn-outline-secondary">
                            <i class="fas fa-redo-alt me-1"></i> Reset
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Loading Indicator -->
    <div id="loading-indicator" class="text-center my-4 d-none">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <p class="mt-2 text-muted">Memuat data...</p>
    </div>

    <!-- Table Container -->
    <div id="user-table-container">
        @include('users.partials.user_table')
    </div>
</div>
@endsection

@push('script')
<script src="{{ asset('js/index_user.js') }}"></script>
@endpush