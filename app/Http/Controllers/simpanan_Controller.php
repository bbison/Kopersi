<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\simpanan;
use App\Models\simpanan_wajib;

class simpanan_Controller extends Controller
{
    public function index()
    {
        return view('simpanan.index',[
            'anggotas'=>User::All()
        ]);
    }

    //simpanan pokok
    public function pokokIndex()
    {
        return view('administrasi.simpanan_pokok.index',[
            'anggotas'=>User::All()
        ]);
    }
    public function pokokStore(Request $request)
    {
        User::find($request->id)->update([
            'simpanan_pokok'=>$request->simpanan_pokok
        ]);
        return back();
    }








    //simpanan wajib
    public function wajibIndex()
    {
        return view('administrasi.simpanan_wajib.index',[
            'anggotas'=>User::all()
        ]);
    }
    public function wajibStore(Request $request)
    {
        simpanan_Wajib::create([
            'simpanan_wajib'=>$request->simpanan_wajib,
            'user_id'=>$request->id,
            'no_simpanan'=>$request->id
        ]);
        // //get nominal terakhir 
        // $nominal_akhir =intval(User::find($request->id)->simpanan_wajib);
        // $tambahan =intval($request->simpanan_wajib);
        // //penambahan
        // $hasil = $nominal_akhir + $tambahan;
        // //update total

        $hasil = simpanan_wajib::where('user_id',$request->id)->sum('simpanan_Wajib');
    
        User::find($request->id)->update([
            'simpanan_wajib'=>$hasil
        ]);
      

        return back()->with('pesan', 'Berhasil Menambah Simpanan Wajib');
    }








    //simpanan sukarela
    public function pokoksukarela()
    {
        return view('administrasi.simpanan_sukarela.index',[
            'anggotas'=>User::all()
        ]);
    }
    public function sukarelaStore(Request $request)
    {
        simpanan::create([
            'simpanan_suka_rela'=>$request->simpanan_sukarela,
            'user_id'=>$request->id,
            'no_simpanan'=>$request->id
        ]);

        $hasil = simpanan::where('user_id',$request->id)->sum('simpanan_suka_rela');
           //update total
        User::find($request->id)->update([
            'simpanan_sukarela'=>$hasil
        ]);
      
        return back();
    }
}
