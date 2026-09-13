<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;

class AuthController extends Controller
{
    /**
     * Menampilkan halaman login
     */
    public function index()
    {
        return view('login');
    }

    /**
     * Memproses login
     */
    public function auth(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {

            // Regenerasi session setelah login
            $request->session()->regenerate();

            return redirect()
                ->route('dashboard')
                ->with(
                    'success',
                    'Selamat datang, ' . Auth::user()->name . '!'
                );
        }

        return back()
            ->withErrors([
                'email' => 'Email atau password tidak valid.'
            ])
            ->withInput($request->only('email'));
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();

        // Hapus session
        $request->session()->invalidate();

        // Buat token CSRF baru
        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with('success', 'Anda telah keluar dari aplikasi.');
    }
}