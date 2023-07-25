<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // dd($request);
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            // Jika data masukan benar dan login berhasil, maka pengguna telah diautentikasi
            // Lakukan sesuatu, misalnya arahkan ke halaman dashboard
            // dd("login sukses");
            return redirect()->route('dashboard');
        } else {
            // Jika data masukan salah, maka proses login gagal
            // Lakukan sesuatu, misalnya arahkan kembali ke halaman login dengan pesan error
            // dd("login gagal");
            return redirect()->route('login')->withInput($request->except('password'))->with('error', 'Email atau password salah.');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Anda telah berhasil logout.');
    }
}
