<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();
            
            $user = Auth::user();
            
            // Redirect based on role
            return redirect()->intended($this->getRedirectPath($user->role));
        }

        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'institution' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'username' => 'required|string|regex:/^[a-z0-9]+$/|unique:users',
            'password' => 'required|string|min:6',
            'agree_privacy' => 'required|accepted',
            'agree_notify' => 'required|accepted',
            'agree_review' => 'nullable',
        ], [
            'username.regex' => 'Username hanya boleh berisi huruf kecil tanpa spasi atau karakter khusus.',
            'username.unique' => 'Username ini sudah digunakan.',
            'email.unique' => 'Email ini sudah terdaftar.',
            'agree_privacy.accepted' => 'Anda harus menyetujui pernyataan privasi untuk melanjutkan.',
            'agree_notify.accepted' => 'Anda harus menyetujui pemberitahuan publikasi untuk melanjutkan.',
            'password.min' => 'Password minimal harus 6 karakter.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'country' => $request->country,
            'password' => Hash::make($request->password),
            'role' => 'author', // Automatically registers as author to access the submission dashboard
            'institution' => $request->institution,
        ]);

        Profile::create([
            'user_id' => $user->id,
            'bio' => 'Anggota baru platform EduJournal.',
        ]);

        Auth::login($user);

        return redirect('/author')->with('success', 'Pendaftaran berhasil! Anda otomatis masuk.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    private function getRedirectPath($role)
    {
        return match ($role) {
            'admin' => '/admin',
            'reviewer' => '/reviewer',
            'partner' => '/partner',
            'author' => '/author',
            default => '/',
        };
    }
}
