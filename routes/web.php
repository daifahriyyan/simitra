<?php

use Livewire\Livewire;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\ImporterController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\AsetTetapController;
use App\Http\Controllers\DataOrderController;
use App\Http\Controllers\HargaJasaController;
use App\Http\Controllers\DaftarAkunController;
use App\Http\Controllers\JurnalUmumController;
use App\Http\Controllers\PenggajianController;
use App\Http\Controllers\PersediaanController;
use App\Http\Controllers\SertifikatController;
use App\Http\Controllers\StandarHPPController;
use App\Http\Controllers\DataCustomerController;
use App\Http\Controllers\DokumenOrderController;
use App\Http\Controllers\DetailCustomerController;
use App\Http\Controllers\DetailSupplierController;
use App\Http\Controllers\DraftPelayaranController;
use App\Http\Controllers\RekapPenjualanController;
use App\Http\Controllers\BuktiPembayaranController;
use App\Http\Controllers\CeklistFumigasiController;
use App\Http\Controllers\HPPSesungguhnyaController;
use App\Http\Controllers\PemakaianMethylController;
use App\Http\Controllers\RekapHPPStandarController;
use App\Http\Controllers\VerifikasiOrderController;
use App\Http\Controllers\MethylRecordsheetController;
use App\Http\Controllers\SuratPemberitahuanController;
use App\Http\Controllers\SuratPerintahKerjaController;
use App\Http\Controllers\KartuStokPersediaanController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PenyusutanAsetTetapController;
use App\Http\Controllers\PemberitahuanKegiatanController;

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

Route::get('/', [HomeController::class, 'index'])->name('Home');
Route::get('/login', [UserController::class, 'index'])->name('Login');
Route::post('/signin', [UserController::class, 'authenticate'])->name('Sign In');
Route::post('/logout', [UserController::class, 'logout'])->name('Logout');
Route::get('/register', [UserController::class, 'register'])->name('Register');
Route::post('/signup', [UserController::class, 'store'])->name('Sign Up');
Route::view('/ajax', 'ajax.input');

Route::view('/dashboard', 'index')->name('Dashboard');

// Customer Side
Route::middleware('auth')->group(function () {
    Route::get('/profile', [UserController::class, 'profile'])->name('Profile');
    Route::post('/profile/update', [UserController::class, 'update'])->name('Update Profile');
    Route::get('/form-order', [HomeController::class, 'formOrder']);
});
Route::get('/home', [HomeController::class, 'index'])->name('Home');
Route::get('/contact', [HomeController::class, 'contact']);
Route::post('/order', [HomeController::class, 'order'])->name('Order');
Route::get('/daftar-order', [HomeController::class, 'daftarOrder']);
Route::get('/status-order', [HomeController::class, 'statusOrder'])->name('Status Order');

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
Route::get('/dashboard/penerimaan-jasa/customer/{export}', [DataCustomerController::class, 'index']);
Route::resource('/dashboard/penerimaan-jasa/customer', DataCustomerController::class)->names([
    'index' => 'Data Customer',
    'store' => 'Tambah Data Customer',
    'update' => 'Ubah Data Customer',
    'destroy' => 'Hapus Data Customer'
])->except(['edit', 'create', 'show']);
Route::resource('/dashboard/penerimaan-jasa/order', DataOrderController::class)->names([
    'index' => 'Data Order',
    'store' => 'Tambah Data Order',
    'update' => 'Ubah Data Order',
    'destroy' => 'Hapus Data Order',
])->except(['edit', 'show']);
Route::resource('/dashboard/penerimaan-jasa/dokumen-order', DokumenOrderController::class)->names([
    'index' => 'Dokumen Order',
    'store' => 'Tambah Dokumen Order',
    'update' => 'Ubah Dokumen Order',
    'destroy' => 'Hapus Dokumen Order'
])->except(['edit', 'show']);
Route::resource('/dashboard/penerimaan-jasa/sertifikat', SertifikatController::class)->names([
    'index' => 'Sertifikat',
    'store' => 'Tambah Sertifikat',
    'update' => 'Ubah Sertifikat',
    'destroy' => 'Hapus Sertifikat',
]);
Route::resource('/dashboard/penerimaan-jasa/invoice', InvoiceController::class)->names([
    'index' => 'Invoice',
    'store' => 'Tambah Invoice',
    'update' => 'Ubah Invoice',
    'destroy' => 'Hapus Invoice',
]);
Route::resource('/dashboard/penerimaan-jasa/bukti-pembayaran', BuktiPembayaranController::class)->names([
    'index' => 'Bukti Pembayaran',
    'store' => 'Tambah Bukti Pembayaran',
    'update' => 'Ubah Bukti Pembayaran',
    'destroy' => 'Hapus Bukti Pembayaran',
]);
Route::resource('/dashboard/penerimaan-jasa/pembelian', PembelianController::class)->names([
    'index' => 'Pembelian',
    'store' => 'Tambah Pembelian',
    'update' => 'Ubah Pembelian',
    'destroy' => 'Hapus Pembelian',
]);
Route::resource('/dashboard/penerimaan-jasa/detail-customer', DetailCustomerController::class)->names([
    'index' => 'Detail Customer',
    'store' => 'Tambah Detail Customer',
    'update' => 'Ubah Detail Customer',
    'destroy' => 'Hapus Detail Customer'
])->except(['edit', 'create', 'show']);
Route::resource('/dashboard/penerimaan-jasa/rekap-penjualan', RekapPenjualanController::class)->names([
    'index' => 'Rekap Penjualan',
    'store' => 'Tambah Rekap Penjualan',
    'update' => 'Ubah Rekap Penjualan',
    'destroy' => 'Hapus Rekap Penjualan',
])->except(['edit', 'create', 'show']);

// Operasional
Route::resource('/dashboard/operasional/ceklist-fumigasi', CeklistFumigasiController::class)->names([
    'index' => 'Ceklist Fumigasi',
    'store' => 'Tambah Ceklist Fumigasi',
    'update' => 'Ubah Ceklist Fumigasi',
    'destroy' => 'Hapus Ceklist Fumigasi',
]);
Route::resource('/dashboard/operasional/draft-pelayaran', DraftPelayaranController::class)->names([
    'index' => 'Draft Pelayaran',
    'store' => 'Tambah Draft Pelayaran',
    'update' => 'Ubah Draft Pelayaran',
    'destroy' => 'Hapus Draft Pelayaran',
]);
Route::resource('/dashboard/operasional/hpp-sesungguhnya', HPPSesungguhnyaController::class)->names([
    'index' => 'HPP Sesungguhnya',
    'store' => 'Tambah HPP Sesungguhnya',
    'update' => 'Ubah HPP Sesungguhnya',
    'destroy' => 'Hapus HPP Sesungguhnya',
]);
Route::resource('/dashboard/operasional/kartu-stok-persediaan', KartuStokPersediaanController::class)->names([
    'index' => 'Kartu Stok Persediaan',
    'store' => 'Tambah Kartu Stok Persediaan',
    'update' => 'Ubah Kartu Stok Persediaan',
    'destroy' => 'Hapus Kartu Stok Persediaan',
]);
Route::resource('/dashboard/operasional/methyl-recordsheet', MethylRecordsheetController::class)->names([
    'index' => 'Methyl Recordsheet',
    'store' => 'Tambah Methyl Recordsheet',
    'update' => 'Ubah Methyl Recordsheet',
    'destroy' => 'Hapus Methyl Recordsheet'
]);
Route::resource('/dashboard/operasional/pemakaian-methyl', PemakaianMethylController::class)->names([
    'index' => 'Pemakaian Methyl',
    'store' => 'Tambah Pemakaian Methyl',
    'update' => 'Ubah Pemakaian Methyl',
    'destroy' => 'Hapus Pemakaian Methyl'
]);
Route::resource('/dashboard/operasional/pemberitahuan-kegiatan', PemberitahuanKegiatanController::class)->names([
    'index' => 'Pemberitahuan Kegiatan',
    'store' => 'Tambah Pemberitahuan Kegiatan',
    'update' => 'Ubah Pemberitahuan Kegiatan',
    'destroy' => 'Hapus Pemberitahuan Kegiatan'
]);
Route::resource('/dashboard/operasional/surat-pemberitahuan', SuratPemberitahuanController::class)->names([
    'index' => 'Surat Pemberitahuan',
    'store' => 'Tambah Surat Pemberitahuan',
    'update' => 'Ubah Surat Pemberitahuan',
    'destroy' => 'Hapus Surat Pemberitahuan',
]);
Route::resource('/dashboard/operasional/surat-perintah-kerja', SuratPerintahKerjaController::class)->names([
    'index' => 'Surat Perintah Kerja',
    'store' => 'Tambah Surat Perintah Kerja',
    'update' => 'Ubah Surat Perintah Kerja',
    'destroy' => 'Hapus Surat Perintah Kerja',
]);
Route::resource('/dashboard/operasional/verifikasi-order', VerifikasiOrderController::class)->names([
    'index' => 'Verifikasi Order',
    'store' => 'Tambah Verifikasi Order',
    'update' => 'Ubah Verifikasi Order',
    'destroy' => 'Hapus Verifikasi Order',
    'show' => 'PDF Verifikasi Order',
]);

// Akuntansi
Route::resource('/dashboard/akuntansi/akun', DaftarAkunController::class)->names([
    'index' => 'Daftar Akun',
    'store' => 'Tambah Daftar Akun',
    'update' => 'Ubah Daftar Akun',
    'destroy' => 'Hapus Daftar Akun',
]);
Route::resource('/dashboard/akuntansi/aset-tetap', AsetTetapController::class)->names([
    'index' => 'Aset Tetap',
    'store' => 'Tambah Aset Tetap',
    'update' => 'Ubah Aset Tetap',
    'destroy' => 'Hapus Aset Tetap',
]);
Route::resource('/dashboard/akuntansi/jurnal-umum', JurnalUmumController::class)->names([
    'index' => 'Jurnal Umum',
    'store' => 'Tambah Jurnal Umum',
    'update' => 'Ubah Jurnal Umum',
    'destroy' => 'Hapus Jurnal Umum',
]);
Route::resource('/dashboard/akuntansi/penggajian', PenggajianController::class)->names([
    'index' => 'Penggajian',
    'store' => 'Tambah Penggajian',
    'update' => 'Ubah Penggajian',
    'destroy' => 'Hapus Penggajian',
]);
Route::resource('/dashboard/akuntansi/penyusutan-aset-tetap', PenyusutanAsetTetapController::class)->names([
    'index' => 'Penyusutan Aset Tetap',
    'store' => 'Tambah Penyusutan Aset Tetap',
    'update' => 'Ubah Penyusutan Aset Tetap',
    'destroy' => 'Hapus Penyusutan Aset Tetap',
]);
Route::resource('/dashboard/akuntansi/rekap-hpp-standar', RekapHPPStandarController::class)->names([
    'index' => 'Rekap HPP Standar',
    'store' => 'Tambah Rekap HPP Standar',
    'update' => 'Ubah Rekap HPP Standar',
    'destroy' => 'Hapus Rekap HPP Standar',
]);
Route::resource('/dashboard/akuntansi/supplier', SupplierController::class)->names([
    'index' => 'Supplier',
    'store' => 'Tambah Supplier',
    'update' => 'Ubah Supplier',
    'destroy' => 'Hapus Supplier',
]);
Route::resource('/dashboard/akuntansi/detail-supplier', DetailSupplierController::class)->names([
    'index' => 'Detail Supplier',
    'store' => 'Tambah Detail Supplier',
    'update' => 'Ubah Detail Supplier',
    'destroy' => 'Hapus Detail Supplier',
]);

// Laporan Keuangan
Route::resource('/dashboard/laporan-keuangan/buku-besar', DaftarAkunController::class)->names([
    'index' => 'Buku Besar',
    'store' => 'Tambah Buku Besar',
    'update' => 'Ubah Buku Besar',
    'destroy' => 'Hapus Buku Besar',
]);
Route::view('/dashboard/laporan-keuangan/hpp', 'pages.laporan-keuangan.hpp')->name('Harga Pokok Penjualan');
Route::view('/dashboard/laporan-keuangan/laba-rugi', 'pages.laporan-keuangan.laba-rugi')->name('Laporan Laba Rugi');
Route::view('/dashboard/laporan-keuangan/neraca-saldo', 'pages.laporan-keuangan.neraca-saldo')->name('Neraca Saldo');
Route::view('/dashboard/laporan-keuangan/posisi-keuangan', 'pages.laporan-keuangan.posisi-keuangan')->name('Posisi Keuangan');


// Route::post('/dashboard/ajax-order', [DataOrderController::class, 'ajaxOrder'])->name('ajax-order');
Route::view('/dashboard/ajax-order', 'ajax.ajax')->name('ajax-order');

// users
Route::get('/dashboard/user', [UserController::class, 'daftarUser'])->name('Daftar User');
Route::post('/dashboard/user/create', [UserController::class, 'tambahUser'])->name('Tambah User');
Route::put('/dashboard/user/edit/{id}', [UserController::class, 'updateUser'])->name('Ubah User');
Route::delete('/dashboard/user/delete/{id}', [UserController::class, 'deleteUser'])->name('Hapus User');
Route::view('/dashboard/user-logs', 'user-logs')->name('User Logs');

// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

// Route::view('profile', 'profile')
//     ->middleware(['auth'])
//     ->name('profile');

// require __DIR__.'/auth.php';

Livewire::setUpdateRoute(function ($handle) {
    return Route::post('/custom/livewire/update', $handle);
});
