<?php

namespace App\Http\Controllers;

use App\Models\KeuAkun;
use App\Models\KeuJurnal;
use App\Models\KeuSupplier;
use App\Models\KeuPembelian;
use Illuminate\Http\Request;
use App\Models\DataPersediaan;
use App\Models\DetailSupplier;
use App\Models\KartuPersediaan;
use App\Models\KeuDetailJurnal;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->posisi == null) {
          return redirect()->route('Home');
          
        } else if (Auth::user()->posisi == 'Direktur' || Auth::user()->posisi == 'Keuangan') {
            return view('pages.akuntansi.pembelian', [
                'id_pembelian' => isset(KeuPembelian::latest()->get()->first()->id) + 1,
                'keuSupplier' => KeuSupplier::get(),
                'dataPersediaan' => DataPersediaan::get(),
            ]);

        } else {
          return redirect()->route('Dashboard');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        KeuPembelian::create([
            'id_pembelian' => request()->id_pembelian,
            'tanggal_beli' => request()->tanggal_beli,
            'termin_pembayaran' => request()->termin_pembayaran,
            'id_supplier' => request()->id_supplier,
            'metode_beli' => request()->metode_beli,
            'id_persediaan' => request()->id_persediaan,
            'jumlah_beli' => request()->jumlah_beli,
            'harga_beli' => request()->harga_beli,
            'total_pembelian' => request()->total_pembelian,
            'ppn_masukan' => request()->ppn_masukan,
            'total_bayar' => request()->total_bayar,
        ]);

        // Menambahkan Detail Supplier Dan Jurnal Umum

        // ambil data Persediaan dengan kode 1130 dari table keu_akun
        $persediaan = KeuAkun::where('kode_akun', '1130')->get()->first();
        // ambil data Persediaan dengan kode 1140 dari table keu_akun
        $ppn_masukan = KeuAkun::where('kode_akun', '1140')->get()->first();
        // ambil data hutang usaha dengan kode 2110 dari table keu_akun
        $hutang_usaha = KeuAkun::where('kode_akun', '2110')->get()->first();


        // cek apakah Persediaan dengan kode 1130 ada?
        // jika tidak ada maka buat akun Persediaan
        if (is_null($persediaan)) {
            KeuAkun::create([
                'kode_akun' => '1130',
                'nama_akun' => 'Persediaan',
                'jenis_akun' => 'debet',
                'kelompok_akun' => 'aset',
                'saldo_akun' => 0
            ]);
        }

        // cek apakah Persediaan dengan kode 1130 ada?
        // jika tidak ada maka buat akun Persediaan
        if (is_null($ppn_masukan)) {
            KeuAkun::create([
                'kode_akun' => '1140',
                'nama_akun' => 'PPN Masukan',
                'jenis_akun' => 'debet',
                'kelompok_akun' => 'aset',
                'saldo_akun' => 0
            ]);
        }

        // cek apakah hutang usaha dengan kode 2110 ada?
        // jika tidak ada maka buat akun Hutang usaha
        if (is_null($hutang_usaha)) {
            KeuAkun::create([
                'kode_akun' => '2110',
                'nama_akun' => 'Hutang Usaha',
                'jenis_akun' => 'kredit',
                'kelompok_akun' => 'liabilitas',
                'saldo_akun' => 0
            ]);
        }
        // Ambil nama Persediaan 
        $nama_persediaan = DataPersediaan::where('id', $request['id_persediaan'])->first()->nama_persediaan;
        // Ambil nama Supplier
        $nama_supplier = KeuSupplier::where('id', $request['id_supplier'])->first()->nama_supplier;
        // ambil id penggajian terakhir
        $no_JUBELI = DetailSupplier::latest()->first()->id ?? 1;
        // Buat No Jurnal JUBELI
        $no_jurnal = 'JUBELI' . str_pad($no_JUBELI, 4, 0, STR_PAD_LEFT);

        // Masukkan Data Penggajian Ke Jurnal Umum
        KeuJurnal::create([
            'no_jurnal' => $no_jurnal,
            'tanggal_jurnal' => $request->tanggal_beli,
            'uraian_jurnal' => "Pembelian $nama_persediaan dari $nama_supplier",
            'no_bukti' => $request->id_pembelian,
        ]);

        $id_1130 = KeuAkun::where('kode_akun', '1130')->get()->first()->id;
        $id_1140 = KeuAkun::where('kode_akun', '1140')->get()->first()->id;
        $id_2110 = KeuAkun::where('kode_akun', '2110')->get()->first()->id;

        $no_jurnal = KeuJurnal::where('no_jurnal', $no_jurnal)->get()->first()->id;

        // Masukkan Data Penggajian Ke Detail Jurnal Umum bagian debet
        KeuDetailJurnal::create([
            'no_jurnal' => $no_jurnal,
            'kode_akun' => $id_1130,
            'debet' => $request->total_pembelian
        ]);
        // Masukkan Data Penggajian Ke Detail Jurnal Umum bagian debet
        KeuDetailJurnal::create([
            'no_jurnal' => $no_jurnal,
            'kode_akun' => $id_1140,
            'debet' => $request->ppn_masukan
        ]);
        // Masukkan Data Penggajian Ke Detail Jurnal Umum bagian kredit
        KeuDetailJurnal::create([
            'no_jurnal' => $no_jurnal,
            'kode_akun' => $id_2110,
            'kredit' => $request->total_bayar
        ]);

        // Buat Variabel Saldo Akhir Supplier
        $saldoAkhirSupplier = $request['total_bayar'];
        // ambil data Detail Supplier Berdasarkan id supplier yang dimasukkan
        $DetailSupplier = DetailSupplier::where('id_supplier', $request['id_supplier'])->latest()->get()->first();
        // Pecah Input Termin Pembayaran
        $termin = explode('/', $request['termin_pembayaran']);
        // Buat Tanggal Jatuh Tempo hasil dari penambahan termin pembayaran
        $tglJatuhTempo = date("Y-m-d", strtotime("+$termin[1] days", strtotime($request['tanggal_beli'])));
        // Jika Detail Supplier dengan id supplier yang dimasukkan sudah ada
        if (isset($DetailSupplier)) {
            $saldoAkhirSupplier = $DetailSupplier->saldo_akhir_supplier - $saldoAkhirSupplier;
            DetailSupplier::create([
                'id_detail_supplier' => 'DSP' . str_pad(isset(DetailSupplier::latest()->get()->first()->id) + 1, 6, 0, STR_PAD_LEFT),
                'id_supplier' => $request['id_supplier'],
                'termin_pembayaran' => $request['termin_pembayaran'],
                'tanggal_input' => $request['tanggal_beli'],
                'pembelian' => $request['total_bayar'],
                'pembayaran' => 0,
                'tanggal_jatuh_tempo' => $tglJatuhTempo,
                'saldo_akhir_supplier' => $saldoAkhirSupplier,
            ]);
            // Jika Detail Supplier dengan id supplier yang dimasukkan Belum ada
        } else {
            DetailSupplier::create([
                'id_detail_supplier' => 'DSP' . str_pad(isset(DetailSupplier::latest()->get()->first()->id) + 1, 6, 0, STR_PAD_LEFT),
                'id_supplier' => $request['id_supplier'],
                'termin_pembayaran' => $request['termin_pembayaran'],
                'tanggal_input' => $request['tanggal_beli'],
                'pembelian' => $request['total_bayar'],
                'pembayaran' => 0,
                'tanggal_jatuh_tempo' => $tglJatuhTempo,
                'saldo_akhir_supplier' => $saldoAkhirSupplier,
            ]);
        }

        // Ambil Saldo Data Persediaan
        $dataPersediaan = DataPersediaan::where('id', $request['id_persediaan'])->get()->first();

        // Ambil Record data Terakhir
        $KPTerakhir = KartuPersediaan::where('id_persediaan', $request['id_persediaan'])->latest()->get()->first();
        if (isset($KPTerakhir)) {
            // Membuat Total Keluar
            $total_saldo = $KPTerakhir->harga_saldo * $request['jumlah_beli'];
            // Membuat Jumlah Saldo
            $jumlah_saldo = $KPTerakhir->jumlah_saldo + $request['jumlah_beli'];
            // Membuat Total Saldo
            $total_saldo = $KPTerakhir->total_saldo + $total_saldo;
            // Membaut Harga Saldo
            $harga_saldo = $total_saldo / $jumlah_saldo;

            // update Saldo Persediaan Terakhir berdasarkan id Perediaan
            DataPersediaan::where('id', $request['id_persediaan'])->update([
                'saldo' => $dataPersediaan->saldo - $KPTerakhir->harga_saldo
            ]);

            // Menginput Data Kartu Persediaan
            KartuPersediaan::create([
                'id_kartu_persediaan' => $request['id_kartu_persediaan'],
                'id_persediaan' => $request['id_persediaan'],
                'tanggal_input' => $request['tanggal_beli'],
                'harga_keluar' => 0,
                'jumlah_keluar' => 0,
                'total_keluar' => 0,
                'harga_masuk' => $request->harga_beli,
                'jumlah_masuk' => $request->jumlah_beli,
                'total_masuk' => $request->total_pembelian,
                'harga_saldo' => $harga_saldo,
                'jumlah_saldo' => $jumlah_saldo,
                'total_saldo' => $total_saldo,
            ]);
        }

        return redirect()->route('Pembelian')->with('success', 'Berhasil Menambahkan Pembelian');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
