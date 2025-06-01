<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\Roles;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::with('role');

        // Filter Berdasarkan Role
        if($request->filled('role')) {
            $query->whereHas('role', function($q) use ($request) {
                $q->where('role', $request->role);
            }); 
        }

        // Filter Berdasarkan Jenis Kelamin
        if($request->filled('jenis_kelamin')) {
            $query->where('jenis_kelamin', $request->jenis_kelamin);
        }

        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('nama', 'like', "%{$searchTerm}%")
                  ->orWhere('username', 'like', "%{$searchTerm}%");
            });
        }

        $users = $query->paginate(10)->withQueryString();

        $roles = Roles::all()->pluck('role');
        $jenisKelaminOptions = [
            "L" => "Laki - Laki",
            "P" => "Perempuan"
        ];

        if ($request->ajax()) {
            return view('users.partials.user_table', compact('users'))->render();
        }

        return view('users.index', compact('users', 'roles', 'jenisKelaminOptions'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255|min:3|unique:user,username',
            'password' => 'required|min:8',
            'jenis_kelamin' => 'required|in:L,P',
            'role' => 'required|in:Admin,Pelatih,Pemain'
        ], [
            'nama.required' => 'Nama harus diisi.',
            'nama.max' => 'Nama maksimal 255 karakter.',
            
            'username.required' => 'Username harus diisi.',
            'username.min' => 'Username minimal 3 karakter.',
            'username.max' => 'Username maksimal 255 karakter.',
            'username.unique' => 'Username sudah digunakan.',
            
            'password.required' => 'Password harus diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            
            'jenis_kelamin.required' => 'Jenis kelamin harus dipilih.',
            'jenis_kelamin.in' => 'Jenis kelamin tidak valid.',
            
            'role.required' => 'Role harus dipilih.',
            'role.in' => 'Role tidak valid.'
        ]);

        // Hash password
        $validate['password'] = Hash::make($validate['password']);

        // Tentukan role_id
        $roleId = match($validate['role']) {
            'Admin'   => '100',
            'Pelatih' => '200',
            'Pemain'  => '300',
            default   => '000'
        };

        // Generate user_id unik
        $lastUser = User::where('user_id', 'like', $roleId . '%')
            ->orderBy('user_id', 'desc')
            ->first();

        $lastSequence = $lastUser ? intval(substr($lastUser->user_id, 3)) : 0;
        $newSequence = $lastSequence + 1;

        $userId = $roleId . str_pad($newSequence, 3, '0', STR_PAD_LEFT);

        // Simpan user
        User::create([
            'user_id' => $userId,
            'nama' => $validate['nama'],
            'username' => $validate['username'],
            'password' => $validate['password'],
            'jenis_kelamin' => $validate['jenis_kelamin'],
            'role_id' => $roleId
        ]);

        return redirect()->route('user.index')->with('success', 'User berhasil ditambahkan');
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
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $rules = [
            'nama' => 'required|string|max:75',
            'username' => 'required|string|max:25|unique:user,username,'.$user->user_id.',user_id',
            'jenis_kelamin' => 'required|in:L,P',
        ];

        // Password optional
        if ($request->filled('password')) {
            $rules['password'] = [
                'nullable',
                Password::min(8)->mixedCase()->letters()->numbers()->symbols()
            ];
        }

        $validated = $request->validate($rules);

        // Hanya update password jika diisi
        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('user.index')->with('success','User berhasil diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        $user->absensi()->delete();
        $user->jadwal()->detach();

        $user->delete();

        return redirect()->route('user.index')->with('success', 'User berhasil dihapus');
    }
}
