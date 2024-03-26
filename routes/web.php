<?php

use App\Http\Controllers\BuktiPembayaranController;
use App\Http\Controllers\DokumenOrderController;
use App\Http\Controllers\HargaJasaController;
use App\Http\Controllers\HomeController;
use Livewire\Livewire;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataCustomer;
use App\Http\Controllers\DataOrderController;
use App\Http\Controllers\DataCustomerController;
use App\Http\Controllers\DetailCustomerController;
use App\Http\Controllers\ImporterController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PersediaanController;
use App\Http\Controllers\StandarHPPController;

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
Route::view('/ajax', 'ajax.input');

Route::view('/dashboard/index', 'index')->name('Dashboard');


// Customer Side
Route::get('/home', [HomeController::class, 'index']);
Route::get('/contact', [HomeController::class, 'contact']);
Route::get('/form-order', [HomeController::class, 'formOrder']);
Route::post('/order', [HomeController::class, 'order'])->name('Order');
Route::get('/daftar-order', [HomeController::class, 'daftarOrder']);
Route::get('/status-order', [HomeController::class, 'statusOrder']);

// Master
Route::resource('/dashboard/standar-hpp', StandarHPPController::class)->names([
    'index'     => 'Standar HPP',
    'store'     => 'Tambah Standar HPP',
    'update'    => 'Ubah Standar HPP',
    'destroy'   => 'Hapus Standar HPP',
])->except(['edit', 'create', 'show']);
Route::resource('/dashboard/harga-jasa', HargaJasaController::class)->names([
    'index'     => 'Harga Jasa',
    'store'     => 'Tambah Harga Jasa',
    'update'    => 'Ubah Harga Jasa',
    'destroy'   => 'Hapus Harga Jasa',
])->except(['edit', 'create', 'show']);
Route::resource('/dashboard/persediaan', PersediaanController::class)->names([
    'index'     => 'Persediaan',
    'store'     => 'Tambah Persediaan',
    'update'    => 'Ubah Persediaan',
    'destroy'   => 'Hapus Persediaan',
])->except(['edit', 'create', 'show']);
Route::resource('/dashboard/importer', ImporterController::class)->names([
    'index'     => 'Importer',
    'store'     => 'Tambah Importer',
    'update'    => 'Ubah Importer',
    'destroy'   => 'Hapus Importer',
]);
Route::resource('/dashboard/pegawai', PegawaiController::class)->except(['edit', 'create', 'show']);

// Penerimaan Jasa
Route::resource('/customer/penerimaan-jasa', DataCustomerController::class)->names([
    'index' => 'Data Customer',
    'store' => 'Tambah Data Customer',
    'update'=> 'Ubah Data Customer',
    'destroy'=> 'Hapus Data Customer'
])->except(['edit', 'create', 'show']);
Route::resource('/dashboard/penerimaan-jasa/order', DataOrderController::class)->names([
    'index' => 'Data Order',
    'store' => 'Tambah Data Order',
    'update'=> 'Ubah Data Order',
    'destroy'=> 'Hapus Data Order',
])->except(['edit', 'show']);
Route::resource('/dashboard/penerimaan-jasa/dokumen-order', DokumenOrderController::class)->names([
    'index' => 'Dokumen Order',
    'store' => 'Tambah Dokumen Order',
    'update' => 'Ubah Dokumen Order',
    'destroy' => 'Hapus Dokumen Order'
])->except(['edit', 'show']);
Route::resource('/dashboard/penerimaan-jasa/sertifikat', 'pages.penerimaan-jasa.sertifikat')->names('Sertifikat');
Route::view('/dashboard/penerimaan-jasa/invoice', 'pages.penerimaan-jasa.invoice')->name('Invoice');
Route::resource('/dashboard/penerimaan-jasa/bukti-pembayaran', BuktiPembayaranController::class)->names([
    'index' => 'Bukti Pembayaran',
    'store' => 'Tambah Bukti Pembayaran',
    'update' => 'Ubah Bukti Pembayaran',
    'destroy' => 'Hapus Bukti Pembayaran',
]);
Route::resource('/dashboard/penerimaan-jasa/detail-customer', DetailCustomerController::class)->names([
    'index' => 'Detail Customer',
    'store' => 'Tambah Detail Customer',
    'update'=> 'Ubah Detail Customer',
    'destroy'=> 'Hapus Detail Customer'
])->except(['edit', 'create', 'show']);
Route::view('/dashboard/penerimaan-jasa/rekap-penjualan', 'pages.penerimaan-jasa.rekap-penjualan')->name('Rekap Penjualan');

// Operasional
Route::view('/dashboard/operasional/ceklist-fumigasi', 'pages.operasional.ceklist-fumigasi')->name('Ceklist Fumigasi');
Route::view('/dashboard/operasional/draft-pelayaran', 'pages.operasional.draft-pelayaran')->name('Draft Pelayaran');
Route::view('/dashboard/operasional/hpp-sesungguhnya', 'pages.operasional.hpp-sesungguhnya')->name('HPP Sesungguhnya');
Route::view('/dashboard/operasional/kartu-stok-persediaan', 'pages.operasional.kartu-stok-persediaan')->name('Kartu Stok Persediaan');
Route::view('/dashboard/operasional/methyl-recordsheet', 'pages.operasional.methyl-recordsheet')->name('Methyl Recordsheet');
Route::view('/dashboard/operasional/pemakaian-methyl', 'pages.operasional.pemakaian-methyl')->name('Pemakaian Methyl');
Route::view('/dashboard/operasional/pemberitahuan-kegiatan', 'pages.operasional.pemberitahuan-kegiatan')->name('Pemberitahuan Kegiatan');
Route::view('/dashboard/operasional/surat-pemberitahuan', 'pages.operasional.surat-pemberitahuan')->name('Surat Pemberitahuan');
Route::view('/dashboard/operasional/surat-perintah-kerja', 'pages.operasional.surat-perintah-kerja')->name('Surat Perintah Kerja');
Route::view('/dashboard/operasional/verifikasi-order', 'pages.operasional.verifikasi-order')->name('Verifikasi Order');

// Laporan Keuangan
Route::view('/dashboard/laporan-keuangan/buku-besar', 'pages.laporan-keuangan.buku-besar')->name('Buku Besar');
Route::view('/dashboard/laporan-keuangan/hpp', 'pages.laporan-keuangan.hpp')->name('Harga Pokok Penjualan');
Route::view('/dashboard/laporan-keuangan/laba-rugi', 'pages.laporan-keuangan.laba-rugi')->name('Laporan Laba Rugi');
Route::view('/dashboard/laporan-keuangan/neraca-saldo', 'pages.laporan-keuangan.neraca-saldo')->name('Neraca Saldo');
Route::view('/dashboard/laporan-keuangan/posisi-keuangan', 'pages.laporan-keuangan.posisi-keuangan')->name('Posisi Keuangan');

// Akuntansi
Route::view('/dashboard/akuntansi/akun', 'pages.akuntansi.akun')->name('Daftar Akun');
Route::view('/dashboard/akuntansi/aset-tetap', 'pages.akuntansi.aset-tetap')->name('Aset Tetap');
Route::view('/dashboard/akuntansi/jurnal-umum', 'pages.akuntansi.jurnal-umum')->name('Jurnal Umum');
Route::view('/dashboard/akuntansi/penggajian', 'pages.akuntansi.penggajian')->name('Penggajian');
Route::view('/dashboard/akuntansi/penyusutan-aset-tetap', 'pages.akuntansi.penyusutan-aset-tetap')->name('Penyusutan Aset Tetap');
Route::view('/dashboard/akuntansi/rekap-hpp-standar', 'pages.akuntansi.rekap-hpp-standar')->name('Rekap HPP Standar');
Route::view('/dashboard/akuntansi/supplier', 'pages.akuntansi.supplier')->name('Supplier');

// Route::post('/dashboard/ajax-order', [DataOrderController::class, 'ajaxOrder'])->name('ajax-order');
Route::view('/dashboard/ajax-order', 'ajax.ajax')->name('ajax-order');

// users
Route::view('/dashboard/user', 'user')->name('Daftar User');
Route::view('/dashboard/user-logs', 'user-logs')->name('User Logs');

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