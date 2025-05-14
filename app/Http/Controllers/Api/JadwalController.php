<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Models\Jadwal;

class JadwalController extends Controller
{
    public function index(Request $request) {
        $tipe = $request->query('tipe_jadwal');
        
        $jadwals = Jadwal::with('pelatih')
                   ->when($tipe, function($query) use ($tipe) {
                        return $query->where('tipe_jadwal', $tipe);
                   })
                   ->orderBy('tanggal', 'desc')
                   ->get()
                   ->map(function($jadwal) {
                     return [
                        'jadwal_id' => $jadwal->jadwal_id,
                        'tipe_jadwal' => $jadwal->tipe_jadwal,
                        'hari' => $jadwal->hari,
                        'tanggal' => $jadwal->tanggal,
                        'waktu_mulai' => $jadwal->waktu_mulai,
                        'waktu_selesai' => $jadwal->waktu_selesai,
                        'lokasi' => $jadwal->lokasi,
                        'tim_lawan' => $jadwal->tim_lawan,
                        'status' => $jadwal->status,
                        'pelatih' => $jadwal->pelatih->map(function($p) {
                            return [
                                'user_id' => $p->user_id,
                                'nama' => $p->nama
                            ];
                        })
                     ];
                });
        
        return response()->json([
            'success' => true,
            'message' => 'Data jadwal berhasil diambil',
            'data' => $jadwals
        ]);
    }

    public function bukaAbsen($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $now = Carbon::now();

        // Validasi tanggal
        if ($jadwal->tanggal !== $now->toDateString()) {
            return response()->json([
                'success' => false,
                'message' => 'Absensi hanya bisa dibuka pada tanggal yang sesuai jadwal'
            ], 403);
        }

        // Gabungkan tanggal + jam
        $mulai = Carbon::parse($jadwal->tanggal . ' ' . $jadwal->waktu_mulai);
        $selesai = Carbon::parse($jadwal->tanggal . ' ' . $jadwal->waktu_selesai);

        if (!$now->between($mulai, $selesai)) {
            return response()->json([
                'success' => false,
                'message' => 'Absensi hanya bisa dibuka di antara waktu mulai dan selesai'
            ], 403);
        }

        $jadwal->status = 'Buka';
        $jadwal->save();

        return response()->json([
            'success' => true,
            'message' => 'Absensi berhasil dibuka',
            'data' => $jadwal
        ]);
    }




    public function tutupAbsen($id)
    {
        $jadwal = Jadwal::findOrFail($id);

        if ($jadwal->status !== 'Buka') {
            return response()->json([
                'success' => false,
                'message' => 'Absensi belum dibuka atau sudah ditutup'
            ]);
        }

        $jadwal->status = 'Tutup';
        $jadwal->save();

        return response()->json([
            'success' => true,
            'message' => 'Absensi berhasil ditutup',
            'data' => $jadwal
        ]);
    }

}
