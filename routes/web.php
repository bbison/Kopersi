<?php

use Illuminate\Support\Facades\Route;
use App\http\Controllers\main_controller;
use App\http\Controllers\pinjaman_controller;
use App\http\Controllers\simpanan_controller;
use App\http\Controllers\anggota_controller;
use App\http\Controllers\shu_controller;

Route::get('/',[main_controller::class, 'index'])->name('login')->middleware('guest');
Route::post('/login',[main_controller::class, 'login'])->name('logiclogin')->middleware('guest');
Route::get('/dashboard',[main_controller::class, 'dashboard'])->name('dashboard')->middleware('auth');
Route::get('/logout',[main_controller::class, 'logout'])->name('logout')->Middleware('auth');


Route::name('shu.')->group(function () {
    Route::get('/shu',[shu_controller::class, 'index'])->name('index')->Middleware('auth');
    Route::post('/shu',[shu_controller::class, 'store'])->name('tambah')->Middleware('auth');
    Route::post('/edit-shu',[shu_controller::class, 'update'])->name('edit')->Middleware('auth');
    Route::post('/shu/{id}',[shu_controller::class, 'destroy'])->name('hapus')->Middleware('auth');
    Route::get('/shu-penerima/{id}',[shu_controller::class, 'penerima'])->name('penerima')->Middleware('auth');
    Route::post('/shu-bagi',[shu_controller::class, 'bagi'])->name('bagi')->Middleware('auth');
});

Route::name('pinjaman.')->group(function () {
    Route::get('/pinjaman',[pinjaman_controller::class, 'index'])->name('index')->Middleware('auth');
    Route::get('/ajuakan-pinjaman',[pinjaman_controller::class, 'pengajuan'])->name('pengajuan')->Middleware('auth');
    Route::post('/ajuakan-pinjaman',[pinjaman_controller::class, 'logicPengajuan'])->name('pengajuan.logic')->Middleware('auth');
    Route::get('/validasi-pinjaman',[pinjaman_controller::class, 'validasi'])->name('validasi')->Middleware('auth');
    Route::post('/validasi-pinjaman/{id}',[pinjaman_controller::class, 'logicvalidasi'])->name('logic.validasi')->Middleware('auth');
    Route::get('/bayar-pinjaman',[pinjaman_controller::class, 'bayar'])->name('bayar')->Middleware('auth');
    Route::post('/bayar-pinjaman',[pinjaman_controller::class, 'logicbayar'])->name('logic.bayar')->Middleware('auth');
});
Route::name('simpanan.')->group(function () {
    Route::get('/simpanan',[simpanan_controller::class, 'index'])->name('index')->Middleware('auth');
    //simpanan pokok
    Route::get('/simpanan-pokok',[simpanan_controller::class, 'pokokIndex'])->name('pokok.index')->Middleware('auth');
    Route::post('/simpanan-pokok',[simpanan_controller::class, 'pokokStore'])->name('pokok.store')->Middleware('auth');
    //simpanan wajib
    Route::get('/simpanan-wajib',[simpanan_controller::class, 'wajibIndex'])->name('wajib.index')->Middleware('auth');
    Route::post('/simpanan-wajib',[simpanan_controller::class, 'wajibStore'])->name('wajib.store')->Middleware('auth');
    //simpanan sukarela
    Route::get('/simpanan-sukarela',[simpanan_controller::class, 'sukarelaIndex'])->name('sukarela.index')->Middleware('auth');
    Route::post('/simpanan-sukarela',[simpanan_controller::class, 'sukarelaStore'])->name('sukarela.store')->Middleware('auth');
});
Route::name('anggota.')->group(function () {
    Route::get('/anggota',[anggota_controller::class, 'daftar'])->name('daftar')->Middleware('auth');
    Route::get('/anggota/password-change',[anggota_controller::class, 'updatepassword'])->name('gantipassword')->Middleware('auth');
    Route::post('/anggota/password-change',[anggota_controller::class, 'logicupdatepassword'])->name('logicgantipassword')->Middleware('auth');
    Route::post('/anggota',[anggota_controller::class, 'create'])->name('tambah')->Middleware('auth');
    Route::get('/anggota/{id}',[anggota_controller::class, 'show'])->name('show')->Middleware('auth');
    Route::post('/anggota/update',[anggota_controller::class, 'update'])->name('update')->Middleware('auth');
});
Route::name('ajax.')->group(function () {
    Route::get('/ajax/simpanan-wajib/{parameter}',[anggota_controller::class, 'ajaxSimpananWajib'])->name('simpanan.wajib')->Middleware('auth');
    Route::get('/ajax/simpanan-sukarela/{parameter}',[anggota_controller::class, 'ajaxSimpananSukarela'])->name('simpanan.wajib')->Middleware('auth');
    Route::get('/ajax/anggota/{filter}',[anggota_controller::class, 'ajaxAnggota'])->name('anggota')->Middleware('auth');
    Route::get('/ajax/anggota-kosong',[anggota_controller::class, 'ajaxAnggotaKosong'])->name('anggota.kosong')->Middleware('auth');
    Route::get('/ajax/pengajuan/{nominal}/{bulan}',[pinjaman_controller::class, 'ajax'])->name('anggota.kosong')->Middleware('auth');
    Route::get('/ajax/angsuran/{id_angsuran}/{nominal}/{ke}',[pinjaman_controller::class, 'pembayaran'])->name('pembayaran')->Middleware('auth');
    Route::get('/ajax/validasi/{str}',[pinjaman_controller::class, 'ajaxValidasi'])->name('validasi')->Middleware('auth');
});




