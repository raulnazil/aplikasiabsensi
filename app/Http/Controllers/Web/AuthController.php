<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function dashboard()
    {
        return view('pages.jadwals.index');
    }
    // menampilkan form login

    public function form()
{
    return view('login');
}

public function login(Request $request)
{
   $request->validate([
    'username' => 'required|email',
    'password' => 'required',
   ]);

   // cek apakah data login valid
   if (Auth::attempt(['email' => $request->username, 'password' => $request->password])) {
    // jika berhasil login, arahkan ke halaman dashboard
    return redirect()->intended('/dashboard');
   } else {
     // jika gagal, kembalikan ke halaman login dengan pesan error
     return back()->withErrors(['email' => 'Login gagal. Periksa kembali email dan password anda.']);
}
}
}


