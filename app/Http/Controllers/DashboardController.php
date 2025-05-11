<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Jadwal;

class DashboardController extends Controller
{
    public function index() {
        $totalPelatih = User::whereHas('role', fn($q) => $q->where('role', 'pelatih'))->count();
        $totalPemain = User::whereHas('role', fn($q) => $q->where('role', 'pemain'))->count();

        $totalReguler = Jadwal::where('tipe_jadwal', 'REG')->count();
        $totalPengganti = Jadwal::where('tipe_jadwal', 'PNG')->count();
        $totalPertandingan = Jadwal::where('tipe_jadwal', 'PRT')->count();

        return view('dashboard.index', compact(
            'totalPelatih', 'totalPemain',
            'totalReguler', 'totalPengganti', 'totalPertandingan'
        ));
    }   
}
