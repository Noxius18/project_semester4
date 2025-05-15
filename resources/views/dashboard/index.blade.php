@extends('layouts.app')
@section('title', 'Dashboard Admin')

@section('content')
<div class="container-fluid px-4 py-4">
    <h2 class="mb-4">Dashboard Admin</h2>

    <div class="row g-4">
        <!-- Total Admin -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 bg-dark text-white">
                <div class="card-body text-center">
                    <i class="fas fa-user-shield fa-3x mb-3"></i>
                    <h5 class="card-title">Total Admin</h5>
                    <h2>{{ $totalAdmin }}</h2>
                </div>
            </div>
        </div>

        <!-- Total Pelatih -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 bg-primary text-white">
                <div class="card-body text-center">
                    <i class="fas fa-chalkboard-teacher fa-3x mb-3"></i>
                    <h5 class="card-title">Total Pelatih</h5>
                    <h2>{{ $totalPelatih }}</h2>
                </div>
            </div>
        </div>

        <!-- Total Pemain -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 bg-success text-white">
                <div class="card-body text-center">
                    <i class="fas fa-users fa-3x mb-3"></i>
                    <h5 class="card-title">Total Pemain</h5>
                    <h2>{{ $totalPemain }}</h2>
                </div>
            </div>
        </div>

        <!-- Jadwal Reguler -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 bg-info text-white">
                <div class="card-body text-center">
                    <i class="fas fa-calendar-alt fa-3x mb-3"></i>
                    <h5 class="card-title">Jadwal Reguler</h5>
                    <h2>{{ $totalReguler }}</h2>
                </div>
            </div>
        </div>

        <!-- Jadwal Pengganti -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 bg-warning text-dark">
                <div class="card-body text-center">
                    <i class="fas fa-calendar-check fa-3x mb-3"></i>
                    <h5 class="card-title">Jadwal Pengganti</h5>
                    <h2>{{ $totalPengganti }}</h2>
                </div>
            </div>
        </div>

        <!-- Pertandingan -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 bg-danger text-white">
                <div class="card-body text-center">
                    <i class="fas fa-futbol fa-3x mb-3"></i>
                    <h5 class="card-title">Pertandingan</h5>
                    <h2>{{ $totalPertandingan }}</h2>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
