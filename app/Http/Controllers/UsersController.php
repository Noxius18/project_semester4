<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('role')->paginate(10);

        return view('users.index', compact('users'));
        
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
        $validate = $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:user,username',
            'password' => [
                'required',
                Password::min(8)->mixedCase()->letters()->numbers()->symbols()
            ],
            'jenis_kelamin' => 'required|in:L,P',
            'role' => 'required|in:Admin,Pelatih,Pemain'
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
        $user = User::findOrFail( $id );
        
        $validate = $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:user,username',
            'password' => [
                'required',
                Password::min(8)->mixedCase()->letters()->numbers()->symbols()
            ],
            'jenis_kelamin' => 'required|in:L,P',
        ]);

        $validate['password'] = Hash::make($validate['password']);

        $user->update([
            'nama' => $validate['nama'],
            'username' => $validate['username'],
            'password' => $validate['password'],
            'jenis_kelamin' => $validate['jenis_kelamin']
        ]);

        return redirect()->route('user.index')->with('success','User berhasil diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user.index')->with('success', 'User berhasil dihapus');
    }
}
