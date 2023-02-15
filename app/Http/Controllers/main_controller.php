<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\pinjaman;

class main_controller extends Controller
{
    public function index()
    {
        return view('login');
    }
    public function login(Request $request)
    {
        $auth = auth::attempt([
            'id'=>$request->input('id'),
            'password'=>$request->input('password')
        ]);


        if($auth){
            return redirect()->intended('/dashboard');
        }
        else{
            return back()->with('pesan', 'GAGAL Silahkan Cek Id Dan Password Anda')->withInput();
        }
       
       
        
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
        
    }
    public function dashboard()
    {
        return view('verifed.index',[
            'pinjaman_tunggu'=>pinjaman::where('status_pinjaman', 'Menunggu Verifikasi')->where('user_id',auth()->user()->id)->get(),
            'pinjaman_aktif' =>pinjaman::where('status_pinjaman', 'Aktif')->where('user_id',auth()->user()->id)->get(),
        ]);
    }
}
