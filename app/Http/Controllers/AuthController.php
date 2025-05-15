<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm(Request $request) {
        return view("Auth.login");
    }

    public function login(Request $request) {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('username', $request->username)->first();

        if($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);

            if($user->role->role == 'Admin') {
                return redirect()->intended('dashboard');
            }

            Auth::logout();
            return back()->withErrors([
                'login' => 'Akses Web hanya untuk Admin'
            ]);
        }

        return back()->withErrors([
            'login' => 'Username atau Password Salah'
        ]);
    }
    
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect("/login");
    }
}
