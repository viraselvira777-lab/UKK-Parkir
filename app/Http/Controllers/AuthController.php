<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\LogAktivitas;

class AuthController extends Controller
{
    //menampilkan halaman login
    public function showLogin()
    {
        return view ('auth.login');
    } 

    //proses login
    public function login(Request $request)
    {
        $request->validate([
            'username'=>'required',
            'password'=>'required',
        ]);

        $credentials=$request->only('username','password');

        if(Auth::attempt($credentials)){
            $user=Auth::user();

            if($user->status_aktif==0){
                Auth::logout();
                return back()-with('eror','Akun anda nonaktif,hubungi admin.');
            }

            //catat log aktivitas login
            LogAktivitas::create([
                'id_user'=>$user->id_user,
                'aktivitas'=>'Login ke sistem',
                'waktu_aktivitas'=>now(),
            ]);

            //Redirect sesuai role
            return match ($user->role) {
                 'admin'=>redirect()->route('admin.dashboard') ,
                 'petugas'=>redirect()->route('petugas.dashboard') ,
                 'owner'=>redirect()->route('owner.dashboard') ,
                 default=>redirect('/') ,
            };
        }

        return back()->with('eror','Username atau Password salah.');
    }

    //proses logout
    public function logout(Request $request)
    {
        $user=Auth::user();

        LogAktivitas::create([
            'id_user'=>$user->id_user,
            'aktivitas'=>'Logout dari sistem',
            'waktu_aktivitas'=>now(),
        ]);

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
