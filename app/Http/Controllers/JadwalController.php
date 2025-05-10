<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\Jadwal;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function indexReguler() {
        $jadwals = Jadwal::where('tipe_jadwal', 'REG')->get();
        return view('jadwal.latihan',[
            'title' => 'Jadwal Latihan Reguler'
        ], compact('jadwals'));
    }

    public function indexPengganti() {
        $jadwals = Jadwal::where('tipe_jadwal', 'PNG')->get();
        return view('jadwal.pengganti', [
            'title' => 'Jadwal Latihan Pengganti'
        ], compact('jadwals'));
    }

    public function indexPertandingan() {
        $jadwals = Jadwal::where('tipe_jadwal', 'PRT')->get();
        return view('jadwal.pertandingan', [
            'title' => 'Jadwal Latihan Pertandingan'
        ], compact('jadwals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jadwal.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tipe_jadwal' => 'required|in:reguler,pengganti,pertandingan',
            'hari' => 'string',
            'tanggal' => 'nullable|date',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
            'lokasi' => 'required|string',
            'tim_lawan' => 'nullable|string' 
        ]);

        // ID Formatting
        $tipe = strtoupper(substr($request->tipe_jadwal, 0, 3));

        if($request->tipe_jadwal === 'reguler') {
            $tanggalCarbon = now()->next($request->hari);
            $tanggal = $tanggalCarbon->format('Ymd');
            $kode_unik = strtoupper(substr($request->hari, 0, 3));
        }
        else {
            $tanggalCarbon = Carbon::parse($request->tanggal);
            $tanggal = $tanggalCarbon->format('Ymd');

            $count = Jadwal::where('tipe_jadwal', $request->tipe_jadwal)
                ->whereDate('tanggal', $tanggalCarbon->toDateString())
                ->count() + 1;
            
            $kode_unik = str_pad($count, 3, '0', STR_PAD_LEFT);
        }

        $jadwal_id = $tipe . $tanggal . $kode_unik;

        $request->merge([
            'jadwal_id' => $jadwal_id,
            'tanggal' => $tanggalCarbon->toDateString()
        ]);

        Jadwal::create($request->all());

        return redirect()->route('jadwal.create')->with('success', 'Jadwal Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
    }
}
