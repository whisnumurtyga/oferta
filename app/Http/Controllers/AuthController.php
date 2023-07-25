<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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


    public function update(Request $request, $id, $role_id)
    {
        // Lakukan pembaruan profil pengguna berdasarkan $id dan $role_id yang diberikan
        // Contoh:
        $user = User::findOrFail($id);
        // dd($user);
        $user->name = $request->input('name');
        $user->role_id = $role_id;
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        if (Hash::check($request->input("password"), $user->password))
        {
            $user->save();
            return redirect()->route('profile', ['id' => $id, 'role_id' => $role_id])->with('success', 'Anda telah berhasil update profile.');;
        } else {
            return redirect()->route('profile', ['id' => $id, 'role_id' => $role_id])->with('failed', 'Password Salah');;
        }

        // Redirect atau lakukan tindakan lain setelah update berhasil
    }
}
