<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request) {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string'
        ]);

        $user = User::where('username', $request->username)->first();

        if(!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Login gagal! Username atau Password Salah'
            ], 403);
        }

        if(!in_array($user->role->role, ['Pelatih', 'Pemain'])) {
            return response()->json([
                'success' => false,
                'message' => 'Role Admin tidak diizinkan via aplikasi'
            ], 403);
        }

        return response()->json([
            'success' => true,
            'message' => 'Login Berhasil',
            'user' => [
                'user_id' => $user->user_id,
                'nama' => $user->nama,
                'username' => $user->username,
                'jenis_kelamin' => $user->jenis_kelamin,
                'role' => $user->role->role
            ]
            ], 200);

    }
}
