<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\User;
use App\Models\simpanan;
use \Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class anggota_Controller extends Controller
{
    public function daftar()
    {
        return view('anggota.daftar',[
            'anggotas'=>User::all()//samain dengan ajax
        ]);
    }
    public function create(Request $request)
    {
        $validated = $request->validate([
            'name'=>['required'],
            'simpanan_wajib'=>[],
            'simpanan_pokok'=>[],
            'simpanan_sukarela'=>[],
        ]);
        User::create($validated);

        return back()->with('pesan', 'Anggota Berhasil Ditambah');
    }
    public function show(Request $request,$id)
    {
      
        $id = Crypt::decryptString($id);
        return view('anggota.show',[
            'anggota'=>User::find($id)
        ]);
    }
    public function update(Request $request)
    {
        User::find($request->id)->update([
            'name'=>$request->name,
            'simpanan_wajib'=>intval($request->simpanan_wajib),
            'simpanan_pokok'=>intval($request->simpanan_pokok),
            'simpanan_suka_rela'=>intval($request->simpanan_sukarela),
            'created_at'=>$request->created_at
        ]);

        return back()->with('pesan', 'Berhasil Update Data Anggota');
    }

    public function updatepassword()
    {
        return view('verifed.updatepassword');
    }
    public function logicupdatepassword(Request $request)
    {
        if(Hash::check($request->password_lama, auth()->user()->password)){
            if($request->password_baru == ""){
                return back()->with('pesan', 'Masukan Password Baru');
            }
            User::find(auth()->user()->id)->update([
                'password'=> bcrypt($request->password_baru)
            ]);
            return back()->with('pesan', 'Password Berhasil Di Update');
        }
        else
        {
            return back()->with('pesan', 'Password Lama Salah');
        }

        
        
    }






    //ajax
    public function ajaxSimpananWajib($parameter)
    {  
        $id = Crypt::decryptString($parameter);
        return view('ajax.simpanan_wajib',[
            'anggota'=>User::find($id)
        ]);
    }
    public function ajaxSimpananSukarela($parameter)
    {
      
        $id = Crypt::decryptString($parameter);
        return view('ajax.simpanan_sukarela',[
            'anggota'=>User::find($id)
        ]);
    }
    public function ajaxAnggota($filter)
    {
        return view('ajax.anggota',[
            'anggotas'=>User::where('id','like','%'.$filter.'%')
            ->orWhere('name','like','%'.$filter.'%')->get()
        ]);
    }
    public function ajaxAnggotaKosong()
    {
        return view('ajax.anggota',[
            'anggotas'=>User::all()
        ]);
    }
}
