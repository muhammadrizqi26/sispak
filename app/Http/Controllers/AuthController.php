<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'no_hp' => 'required|string',
            'password' => 'required|string', // Password diisi Tanggal Lahir (ex: 25081995 atau YYYY-MM-DD)
        ], [
            'no_hp.required' => 'Nomor HP wajib diisi!',
            'password.required' => 'Tanggal Lahir (Password) wajib diisi!',
        ]);

        // Cek login berdasarkan Nomor HP & Password
        if (Auth::attempt(['no_hp' => $credentials['no_hp'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();
            return redirect()->intended('/')->with('success', 'Berhasil login!');
        }

        return back()->withErrors([
            'no_hp' => 'Nomor HP atau Tanggal Lahir salah.',
        ])->onlyInput('no_hp');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    // Menampilkan Halaman Form Registrasi
public function showRegisterForm()
{
    return view('auth.register');
}

// Memproses Pendaftaran User Baru
public function register(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'no_hp' => 'required|string|unique:users,no_hp',
        'tanggal_lahir' => 'required|date',
        'password' => 'required|string|confirmed', // 'confirmed' akan mengecek field password_confirmation
    ], [
        'name.required' => 'Nama lengkap wajib diisi!',
        'no_hp.required' => 'Nomor HP wajib diisi!',
        'no_hp.unique' => 'Nomor HP sudah terdaftar!',
        'tanggal_lahir.required' => 'Tanggal lahir wajib diisi!',
        'password.required' => 'Password (TTL) wajib diisi!',
        'password.confirmed' => 'Konfirmasi Tanggal Lahir tidak cocok!',
    ]);

    // Format Tanggal Lahir YYYY-MM-DD ke DDMMYYYY untuk dijadikan Password Hash
    $formattedPassword = date('dmY', strtotime($request->tanggal_lahir));

    User::create([
        'name' => $request->name,
        'no_hp' => $request->no_hp,
        'tanggal_lahir' => $request->tanggal_lahir,
        'password' => Hash::make($formattedPassword),
    ]);

    return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login menggunakan Nomor HP dan Tanggal Lahir (DDMMYYYY).');
}
}