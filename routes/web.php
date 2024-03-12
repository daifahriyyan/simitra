<?php

use Livewire\Livewire;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataCustomer;
use App\Http\Controllers\DataCustomerController;
use App\Http\Controllers\DetailCustomerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::view('/', 'welcome');

Route::view('/index', 'index')->name('Dashboard');

// Master
Route::view('/standar-hpp', 'pages.master.standar-hpp')->name('Standar HPP');
Route::view('/harga-jasa', 'pages.master.harga-jasa')->name('Harga Jasa');
Route::view('/persediaan', 'pages.master.persediaan')->name('Persediaan');
Route::view('/importer', 'pages.master.importer')->name('Importer');
Route::view('/pegawai', 'pages.master.pegawai')->name('Pegawai');

// Penerimaan Jasa
Route::resource('customer', DataCustomer::class)->names([
    'index' => 'Data Customer',
    'store' => 'Tambah Data Customer',
    'update'=> 'Ubah Data Customer',
    'destroy'=> 'Hapus Data Customer'
])->except(['edit', 'create', 'show']);
Route::view('/order', 'pages.penerimaan-jasa.order')->name('Order');
Route::view('/dokumen-order', 'pages.penerimaan-jasa.dokumen-order')->name('Dokumen Order');
Route::view('/sertifikat', 'pages.penerimaan-jasa.sertifikat')->name('Sertifikat');
Route::view('/invoice', 'pages.penerimaan-jasa.invoice')->name('Invoice');
Route::view('/bukti-pembayaran', 'pages.penerimaan-jasa.bukti-pembayaran')->name('Bukti Pembayaran');
Route::resource('/detail-customer', DetailCustomerController::class)->names([
    'index' => 'Detail Customer',
    'store' => 'Tambah Detail Customer',
    'update'=> 'Ubah Detail Customer',
    'destroy'=> 'Hapus Detail Customer'
])->except(['edit', 'create', 'show']);
Route::view('/rekap-penjualan', 'pages.penerimaan-jasa.rekap-penjualan')->name('Rekap Penjualan');

// Operasional
Route::view('/ceklist-fumigasi', 'pages.operasional.ceklist-fumigasi')->name('Ceklist Fumigasi');
Route::view('/draft-pelayaran', 'pages.operasional.draft-pelayaran')->name('Draft Pelayaran');
Route::view('/hpp-sesungguhnya', 'pages.operasional.hpp-sesungguhnya')->name('HPP Sesungguhnya');
Route::view('/kartu-stok-persediaan', 'pages.operasional.kartu-stok-persediaan')->name('Kartu Stok Persediaan');
Route::view('/methyl-recordsheet', 'pages.operasional.methyl-recordsheet')->name('Methyl Recordsheet');
Route::view('/pemakaian-methyl', 'pages.operasional.pemakaian-methyl')->name('Pemakaian Methyl');
Route::view('/pemberitahuan-kegiatan', 'pages.operasional.pemberitahuan-kegiatan')->name('Pemberitahuan Kegiatan');
Route::view('/surat-pemberitahuan', 'pages.operasional.surat-pemberitahuan')->name('Surat Pemberitahuan');
Route::view('/surat-perintah-kerja', 'pages.operasional.surat-perintah-kerja')->name('Surat Perintah Kerja');
Route::view('/verifikasi-order', 'pages.operasional.verifikasi-order')->name('Verifikasi Order');

// Laporan Keuangan
Route::view('/buku-besar', 'pages.laporan-keuangan.buku-besar')->name('Buku Besar');
Route::view('/hpp', 'pages.laporan-keuangan.hpp')->name('Harga Pokok Penjualan');
Route::view('/laba-rugi', 'pages.laporan-keuangan.laba-rugi')->name('Laporan Laba Rugi');
Route::view('/neraca-saldo', 'pages.laporan-keuangan.neraca-saldo')->name('Neraca Saldo');
Route::view('/posisi-keuangan', 'pages.laporan-keuangan.posisi-keuangan')->name('Posisi Keuangan');

// Akuntansi
Route::view('/akun', 'pages.akuntansi.akun')->name('Daftar Akun');
Route::view('/aset-tetap', 'pages.akuntansi.aset-tetap')->name('Aset Tetap');
Route::view('/jurnal-umum', 'pages.akuntansi.jurnal-umum')->name('Jurnal Umum');
Route::view('/penggajian', 'pages.akuntansi.penggajian')->name('Penggajian');
Route::view('/penyusutan-aset-tetap', 'pages.akuntansi.penyusutan-aset-tetap')->name('Penyusutan Aset Tetap');
Route::view('/rekap-hpp-standar', 'pages.akuntansi.rekap-hpp-standar')->name('Rekap HPP Standar');
Route::view('/supplier', 'pages.akuntansi.supplier')->name('Supplier');

// users
Route::view('/user', 'user')->name('Daftar User');
Route::view('/user-logs', 'user-logs')->name('User Logs');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';

Livewire::setUpdateRoute(function ($handle) {
    return Route::post('/custom/livewire/update', $handle);
});