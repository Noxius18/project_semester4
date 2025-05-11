@extends('layouts.app')
@section('title', 'Dashboard Admin')

@section('content')
<div class="container-fluid px-4 py-4">
    <h2 class="mb-4">Dashboard Admin</h2>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h5 class="card-title">Total Pelatih</h5>
                    <h2>{{ $totalPelatih }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h5 class="card-title">Total Pemain</h5>
                    <h2>{{ $totalPemain }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h5 class="card-title">Jadwal Reguler</h5>
                    <h2>{{ $totalReguler }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h5 class="card-title">Jadwal Pengganti</h5>
                    <h2>{{ $totalPengganti }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h5 class="card-title">Pertandingan</h5>
                    <h2>{{ $totalPertandingan }}</h2>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection