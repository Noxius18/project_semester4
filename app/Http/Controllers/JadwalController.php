<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\Jadwal;
use App\Models\User;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = $request->query('tipe_jadwal');
        
        $jadwals = Jadwal::with('pelatih')
            ->when($filter, fn($q) => $q->where('tipe_jadwal', $filter))
            ->orderBy('tanggal', 'desc')
            ->paginate(10);
        
        // $jadwals = Jadwal::when($filter, function($query, $filter) {
        //     return $query->where('tipe_jadwal', $filter);
        // })->orderBy('tanggal', 'desc')->get();
        return view('jadwal.index', compact('jadwals', 'filter'));
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
        Carbon::setLocale('id');
        
            $request->validate([
            'tipe_jadwal' => 'required|in:REG,PNG,PRT',
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
            'lokasi' => 'required|string|max:255',
            'tim_lawan' => 'nullable|string|max:255' 
        ], [
            'tipe_jadwal.required' => 'Tipe jadwal harus dipilih.',
            'tipe_jadwal.in' => 'Tipe jadwal tidak valid.',
            'tanggal.required' => 'Tanggal harus diisi.',
            'tanggal.date' => 'Format tanggal tidak valid.',
            'tanggal.after_or_equal' => 'Tanggal tidak boleh kurang dari hari ini.',
            'waktu_mulai.required' => 'Waktu mulai harus diisi.',
            'waktu_mulai.date_format' => 'Format waktu mulai tidak valid (HH:MM).',
            'waktu_selesai.required' => 'Waktu selesai harus diisi.',
            'waktu_selesai.date_format' => 'Format waktu selesai tidak valid (HH:MM).',
            'waktu_selesai.after' => 'Waktu selesai harus lebih besar dari waktu mulai.',
            'lokasi.required' => 'Lokasi harus diisi.',
            'lokasi.max' => 'Lokasi maksimal 255 karakter.',
            'tim_lawan.max' => 'Nama tim lawan maksimal 255 karakter.'
        ]);
    
        $tipe = strtoupper(substr($request->tipe_jadwal, 0, 3));
        $tanggalCarbon = Carbon::parse($request->tanggal);
        
        // Check if regular schedule exists for the given date
        if ($tipe === 'REG') {
            $exists = Jadwal::where('tipe_jadwal', 'REG')
                ->whereDate('tanggal', $tanggalCarbon->toDateString())
                ->exists();
                
            if ($exists) {
                return redirect()->route('jadwal.create')
                    ->with('error', 'Jadwal Reguler untuk tanggal ini sudah dibuat')
                    ->withInput();
            }
        }
    
        $tanggal = $tanggalCarbon->format('Ymd');
        $hari = $tanggalCarbon->translatedFormat('l');
    
        if($tipe === 'REG') {
            $kode_unik = strtoupper(substr($hari, 0, 3));
        }
        else {
            $count = Jadwal::where('tipe_jadwal', $tipe)
            ->whereDate('tanggal', $tanggalCarbon->toDateString())
            ->count() + 1;
        
            $kode_unik = str_pad($count, 3, '0', STR_PAD_LEFT);
        }
    
        $jadwal_id = $tipe . $tanggal . $kode_unik;
    
        $request->merge([
            'jadwal_id' => $jadwal_id,
            'tanggal' => $tanggalCarbon->toDateString(),
            'hari' => $hari
        ]);
    
        Jadwal::create($request->all());
    
        return redirect()->route('jadwal.index')->with('success', 'Jadwal Berhasil Ditambahkan');
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
        $jadwal = Jadwal::findOrFail( $id );
        return view('jadwal.edit', compact('jadwal'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Carbon::setLocale('id');

        $request->validate([
            'tanggal' => 'nullable|date',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
            'lokasi' => 'required|string',
            'tim_lawan' => 'nullable|string'
        ]);

        $jadwal = Jadwal::findOrFail($id);
        $tanggalCarbon = Carbon::parse($request->tanggal);
        $hari = $tanggalCarbon->translatedFormat('l');

        $jadwal->update([
            'tanggal' => $tanggalCarbon->toDateString(),
            'hari' => $hari,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'lokasi' => $request->lokasi,
            'tim_lawan' => $request->tim_lawan
        ]);

        return redirect()->route('jadwal.index')->with('success', 'Jadwal Berhasil diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jadwal = Jadwal::findOrFail( $id );

        $jadwal->pelatih()->detach();

        $jadwal->delete();

        return redirect()->route('jadwal.index')->with('success', 'Jadwal Berhasil dihapus');
    }

    // Function Assign Pelatih ke Jadwal
    public function assign(string $id) {
        $jadwal = Jadwal::findOrFail($id);

        $listPelatih = User::whereHas('role', function($q) {
            $q->where('role', 'Pelatih');
        })->get();

        $assignedIds = $jadwal->pelatih()->pluck('user_id')->toArray();

        return view('jadwal.assign', compact('jadwal', 'listPelatih', 'assignedIds'));
    }

    public function storeAssign(Request $request, $id) {
        $request->validate([
            'pelatih_id' => 'nullable|array|max:2',
            'pelatih_id.*' => 'exists:user,user_id'
        ]);

        $jadwal = Jadwal::findOrFail( $id );
        $jadwal->pelatih()->sync($request->pelatih_id ?? []);

        return redirect()->route('jadwal.index')->with('success','Pelatih berhasil ditambah ke jadwal!');
    }
}
