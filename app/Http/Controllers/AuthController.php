<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginWithPassword(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $role = Auth::user()->role;

            if ($role === 'admin') return redirect()->route('admin.dashboard');
            if ($role === 'seller') return redirect()->route('seller.dashboard');
            return redirect()->route('landing');
        }

        return back()->withErrors(['email' => 'Email atau password salah!']);
    }

    public function sendOTP(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak terdaftar!']);
        }

        // Simulasi OTP (Untuk keperluan development, OTP diset 123456)
        $user->otp_code = '123456';
        $user->save();

        return redirect()->route('login', ['email' => $request->email])
            ->with('success', 'Kode OTP simulasi Anda: 123456 (Masukkan kode ini di bawah)');
    }

    public function verifyOTP(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp_code' => 'required',
        ]);

        $user = User::where('email', $request->email)->where('otp_code', $request->otp_code)->first();

        if ($user) {
            $user->otp_code = null;
            $user->save();
            Auth::login($user);

            $role = $user->role;
            if ($role === 'admin') return redirect()->route('admin.dashboard');
            if ($role === 'seller') return redirect()->route('seller.dashboard');
            return redirect()->route('landing');
        }

        return back()->withErrors(['otp_code' => 'Kode OTP salah atau kedaluwarsa!']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('landing');
    }
}