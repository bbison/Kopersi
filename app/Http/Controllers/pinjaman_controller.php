<?php

namespace App\Http\Controllers;

use App\Models\pinjaman;
use App\Models\angsuran;
use Illuminate\Http\Request;
use App\Models\User;

class pinjaman_controller extends Controller
{
    public function pengajuan()
    {
        return view('pinjaman.pengajuan');
    }
    public function index()
    {
        return view('pinjaman.index',[
            'pinjaman_tunggu'=>pinjaman::where('status_pinjaman', 'Menunggu Verifikasi')->where('user_id',auth()->user()->id)->get(),
            'pinjaman_aktif' =>pinjaman::where('status_pinjaman', 'Aktif')->where('user_id',auth()->user()->id)->get()

        ]);
    }
    public function Validasi()
    {
        return view('pinjaman.validasi',[
            'pinjaman'=>pinjaman::All()
        ]);
    }
    public function bayar()
    {
        return view('pinjaman.bayar');
    }

    public function logicValidasi($id)
    {
        $data =pinjaman::find($id);
        $tagihan = intval(intval($data->nominal_pinjaman) / intval($data->lama_pinjaman));
        for($x = 1 ; $x <= intval($data->lama_pinjaman); $x++){
            angsuran::create([
                'pinjaman_id'=>$id,
                'jumlah_angsuran'=> " ",
                'sisa_angsuran'=>" ",
                'bulan_angsuran'=>$x,
                'tagihan_angsuran'=> $tagihan,
                'jatuh_tempo'=>date('Y-m-d', strtotime( '+'.$x.' month', strtotime( date('now') )))
            ]);
        }


        pinjaman::find($id)->update([
            'status_pinjaman'=>'Aktif'
        ]);
        return back()->with('pesan', 'Berhasil Aktifasi Pinjaman');
    }

    public function ajax($nominal, $bulan)
    {
        $buln = [];
        $tagihan = ceil($nominal / $bulan);
        ceil($nominal / $bulan);
        for($x = 0; $x<=$bulan - 1; $x++ ){
            $tbh = strval($x +1);
            array_push($buln, date('Y-m-d', strtotime( '+'.$tbh.' month', strtotime( date('now') ))) );
        }


       return view('ajax.pengajuan',[
        'data'=>$buln,
        'tagihan'=>$tagihan
       ]);
    }
    public function pembayaran($pinjaman_id, $nominal,$ke)
    {
        return view('ajax.pembayaran',[
            "data"=>pinjaman::where('id',$pinjaman_id)->where('user_id', auth()->user()->id)->get(),
            'nominal' =>$nominal,
            'ke'=> intval($ke)

        ]);
    }








    public function logicPengajuan(Request $request)
    {
        pinjaman::create([
            'user_id'=>auth()->user()->id,
            'bunga_pinjaman_id' =>'2',
            'bunga' =>'2',
            'nominal_pinjaman'=>$request->nominal_pinjaman,
            'no_pinjaman'=>pinjaman::all()->count()+1,
            'lama_pinjaman'=>$request->lama_pinjaman,

        ]);

        return redirect()->route('pinjaman.index');
    }

    public function logicbayar(Request $request)
    {
        
        $cek =   angsuran::firstWhere('pinjaman_id',$request->id)->firstwhere('bulan_angsuran', $request->pembayaran_ke);
        // dd($cek->status);
        if(intval($cek->tagihan_angsuran) != intval($request->nominal)){
            return back()->with('pesan', 'Nominal Tidak Sesuai');
        }
        elseif($cek->status == 'Sudah Bayar'){
            return back()->with('pesan', 'Angsuran ini sudah di bayar');
        }
        else{
            angsuran::where('pinjaman_id',$request->id)->where('bulan_angsuran', $request->pembayaran_ke)->update([
                'status'=>'Sudah Bayar'
            ]);

            if(intval($cek->pinjaman->lama_pinjaman) == intval($request->pembayaran_ke)){
                pinjaman::find(intval($request->id))->update([
                    'status_pinjaman'=>'Selesai'
                ]);
            }
            return redirect()->route('pinjaman.bayar')->with('pesan', 'Berhasil Melakukan Pembayaran');
        }
        
    }

    public function ajaxValidasi($str)
    {
        // dd($str);
        if($str=="PaRaMeTeR"){
            return view('ajax.validasi',[
                'pinjaman'=>pinjaman::all()
            ]);
        }
        else{
            return view('ajax.validasi',[
                'pinjaman'=>pinjaman::where('status_pinjaman',$str)
                ->orwhere('id', $str)
                ->get()
            ]);

        }
     
    }
}
