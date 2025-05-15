<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Absen;
use App\Models\Jadwal;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

class AbsenController extends Controller
{
    public function absen(Request $request) {
        $request->validate([
            'user_id' => 'required|string',
            'jadwal_id' => 'required|string',
            'status' => 'required|in:Hadir,"Tidak Hadir"'
        ]);

        $jadwal = Jadwal::find($request->jadwal_id);

        if(!$jadwal || $jadwal->status !== 'Buka') {
            return response()->json([
                'success' => false,
                'message' => 'Tidak bisa absen karena jadwal belum dibuka'
            ], 403);
        }

        $sudahAbsen = Absen::where('user_id', $request->user_id)
                           ->where('jadwal_id', $request->jadwal_id)
                           ->exists();
        
        if($sudahAbsen) {
            return response()->json([
                'success' => false,
                'message' => 'Kamu sudah melakukan absen hari ini'
            ], 409);
        }

        $kodeStatus = strtoupper(substr($request->status, 0, 1));
        $tanggal = now()->format('d');

        $count = Absen::where('user_id', $request->user_id)
                  ->where('jadwal_id', $request->jadwal_id)
                  ->count() + 1;
        
        $urut = str_pad($count, 2, '0', STR_PAD_LEFT);

        $absenId = 'A' . $kodeStatus . $tanggal . $urut;

        while(Absen::where('absen_id', $absenId)->exists()) {
            $count++;
            $urut = str_pad($count, 2, '0', STR_PAD_LEFT);
            $absenId = 'A' . $kodeStatus . $tanggal . $urut;
        }

        $absen = Absen::create([
            'absen_id' => $absenId,
            'user_id' => $request->user_id,
            'jadwal_id' => $request->jadwal_id,
            'status' => $request->status
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Absensi berhasil dicatat',
            'data' => $absen
        ], 200);
    }

    public function rekap($id) {
        $jadwal = Jadwal::find($id);

        if(!$jadwal) {
            return response()->json([
                'success' => false,
                'message' => 'Jadwal tidak ditemukan'
            ]. 404);
        }

        $absensi = Absen::with('user')
                        ->where('jadwal_id', $id)
                        ->get()
                        ->map(function($absen) {
                            return [
                                'user_id' => $absen->user->user_id,
                                'nama' => $absen->user->nama,
                                'status' => $absen->status,
                            ];
                        });

        return response()->json([
            'success' => true,
            'message' => 'Rekap berhasil ditemukan',
            'data' => $absensi
        ]);
        
    }
}
