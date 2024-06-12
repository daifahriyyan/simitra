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

class PembelianController extends Controller 
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $keuPembelian = KeuPembelian::all();
        $latestId = KeuPembelian::latest()->first()->id ?? 0;

        return view('pages.akuntansi.pembelian', [
            'id_pembelian' => $latestId + 1,
            'keuSupplier' => KeuSupplier::all(),
            'dataPembelian' => KeuPembelian::all(),
            'dataPersediaan' => DataPersediaan::all(),
            'keuPembelian' => KeuPembelian::get()
        ]);
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
    //------- Tambah ke Table Pembeliam ---------
    // Mendapatkan nilai dari request
    $jumlah_beli = $request->jumlah_beli;
    $harga_beli = $request->harga_beli;
    $ppn_masukan = $request->ppn_masukan;

    // Menghitung total pembelian
    $total_beli = $jumlah_beli * $harga_beli;

    // Menghitung total bayar
    $total_bayar = $total_beli + $ppn_masukan;

    // Menyimpan data menggunakan metode create()
    KeuPembelian::create([
        'id_pembelian' => $request->id_pembelian,
        'tanggal_beli' => $request->tanggal_beli,
        'termin_pembayaran' => $request->termin_pembayaran,
        'id_supplier' => $request->id_supplier,
        'metode_beli' => $request->metode_beli,
        'id_persediaan' => $request->id_persediaan,
        'jumlah_beli' => $jumlah_beli,
        'harga_beli' => $harga_beli,
        'total_beli' => $total_beli,
        'ppn_masukan' => $ppn_masukan,
        'total_bayar' => $total_bayar,
    ]);

    // Tambah Detail Supplier Dan Jurnal Umum
    // ambil data Persediaan dengan kode 1130 dari table keu_akun
    $persediaan = KeuAkun::where('kode_akun', '1130')->first();
    // ambil data Persediaan dengan kode 1140 dari table keu_akun
    $ppn_masukan_akun = KeuAkun::where('kode_akun', '1140')->first();
    // ambil data hutang usaha dengan kode 2110 dari table keu_akun
    $hutang_usaha = KeuAkun::where('kode_akun', '2110')->first();

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

    // cek apakah Persediaan dengan kode 1140 ada?
    // jika tidak ada maka buat akun Persediaan
    if (is_null($ppn_masukan_akun)) {
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
    
        // ambil data Akun
        $kodeAkun1130 = KeuAkun::where('kode_akun', '1130')->get()->first();
        $kodeAkun1140 = KeuAkun::where('kode_akun', '1140')->get()->first();
        $kodeAkun2110 = KeuAkun::where('kode_akun', '2110')->get()->first();

        // jika jenis akun adalah kredit maka kurangi 
        $saldo_akun1130 = $kodeAkun1130->saldo_akun + $total_beli;
        // jika jenis akun adalah kredit maka kurangi 
        $saldo_akun1140 = $kodeAkun1140->saldo_akun + $ppn_masukan;
        // jika jenis akun adalah debet maka tambahi
        $saldo_akun2110 = $kodeAkun2110->saldo_akun + $total_bayar;

        // ubah sesuai operasi diatas
        KeuAkun::where('kode_akun', '1130')->update([
            'saldo_akun' => $saldo_akun1130,
        ]);
        // ubah sesuai operasi diatas
        KeuAkun::where('kode_akun', '1140')->update([
            'saldo_akun' => $saldo_akun1140,
        ]);
        // ubah sesuai operasi diatas
        KeuAkun::where('kode_akun', '2110')->update([
            'saldo_akun' => $saldo_akun2110,
        ]);

    // Ambil nama Persediaan 
    $nama_persediaan = DataPersediaan::where('id_persediaan', $request['id_persediaan'])->first()->nama_persediaan;
    // Ambil nama Supplier
    $supplier = KeuSupplier::where('id', $request->input('id_supplier'))->first();

    if ($supplier) {
        $nama_supplier = $supplier->nama_supplier;
    } else {
        // Tangani kasus di mana supplier tidak ditemukan
        return redirect()->back()->withErrors(['id_supplier' => 'Supplier tidak ditemukan']);
    }

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

    $id_1130 = KeuAkun::where('kode_akun', '1130')->first()->id;
    $id_1140 = KeuAkun::where('kode_akun', '1140')->first()->id;
    $id_2110 = KeuAkun::where('kode_akun', '2110')->first()->id;

    $no_jurnal_id = KeuJurnal::where('no_jurnal', $no_jurnal)->first()->id;

    // Masukkan Data Penggajian Ke Detail Jurnal Umum bagian debet
    KeuDetailJurnal::create([
        'no_jurnal' => $no_jurnal_id,
        'kode_akun' => $id_1130,
        'debet' => $total_beli,
    ]);
    // Masukkan Data Penggajian Ke Detail Jurnal Umum bagian debet
    KeuDetailJurnal::create([
        'no_jurnal' => $no_jurnal_id,
        'kode_akun' => $id_1140,
        'debet' => $ppn_masukan,
    ]);
    // Masukkan Data Penggajian Ke Detail Jurnal Umum bagian kredit
    KeuDetailJurnal::create([
        'no_jurnal' => $no_jurnal_id,
        'kode_akun' => $id_2110,
        'kredit' => $total_bayar,
    ]);

    // Buat Variabel Saldo Akhir Supplier
    $saldoAkhirSupplier = $total_bayar;
    // ambil data Detail Supplier Berdasarkan id supplier yang dimasukkan
    $DetailSupplier = DetailSupplier::where('id_supplier', $request['id_supplier'])->latest()->first();

    // Pecah Input Termin Pembayaran
    $termin = explode('/', $request['termin_pembayaran']);

    // Check if termin array has the required number of elements
    if (count($termin) < 2) {
        return redirect()->back()->withErrors(['termin_pembayaran' => 'Termin pembayaran tidak valid']);
    }

    // Buat Tanggal Jatuh Tempo hasil dari penambahan termin pembayaran
    $tglJatuhTempo = date("Y-m-d", strtotime("+$termin[1] days", strtotime($request['tanggal_beli'])));

    // Jika Detail Supplier dengan id supplier yang dimasukkan sudah ada
    if ($DetailSupplier) {
        $saldoAkhirSupplier = $DetailSupplier->saldo_akhir_supplier + $saldoAkhirSupplier;
        DetailSupplier::create([
            'id_detail_supplier' => 'DSP' . str_pad((DetailSupplier::latest()->first()->id ?? 0) + 1, 6, 0, STR_PAD_LEFT),
            'id_supplier' => $request['id_supplier'],
            'termin_pembayaran' => $request['termin_pembayaran'],
            'tanggal_input' => $request['tanggal_beli'],
            'pembelian' => $total_bayar,
            'pembayaran' => 0,
            'tanggal_jatuh_tempo' => $tglJatuhTempo,
            'saldo_akhir_supplier' => $saldoAkhirSupplier,
        ]);
    } else {
        DetailSupplier::create([
            'id_detail_supplier' => 'DSP' . str_pad((DetailSupplier::latest()->first()->id ?? 0) + 1, 6, 0, STR_PAD_LEFT),
            'id_supplier' => $request['id_supplier'],
            'termin_pembayaran' => $request['termin_pembayaran'],
            'tanggal_input' => $request['tanggal_beli'],
            'pembelian' => $total_bayar,
            'pembayaran' => 0,
            'tanggal_jatuh_tempo' => $tglJatuhTempo,
            'saldo_akhir_supplier' => $saldoAkhirSupplier,
        ]);
    }

    // ------------------------ Tambah ke Table Kartu Persediaan ------------------------------------------------

    // Ambil Record data Terakhir
    $KPTerakhir = KartuPersediaan::where('id_persediaan', $request['id_persediaan'])->latest()->first();

    // Ambil data dari tabel DataPersediaan berdasarkan id_persediaan
    $dataPersediaan = DataPersediaan::where('id_persediaan', $request['id_persediaan'])->first();

    if (!$dataPersediaan) {
        // Tangani kasus di mana data persediaan tidak ditemukan
        return redirect()->back()->withErrors(['id_persediaan' => 'Data persediaan tidak ditemukan']);
    }

    if ($KPTerakhir) {
        // Menghitung Total Masuk
        $total_masuk = $harga_beli * $jumlah_beli;

        // Menghitung Jumlah Saldo
        $jumlah_saldo = $KPTerakhir->jumlah_saldo + $jumlah_beli;

        // Menghitung Total Saldo
        $total_saldo = $KPTerakhir->total_saldo + $total_masuk;

        // Menghitung Harga Saldo
        $harga_saldo = $total_saldo / $jumlah_saldo;

        // Update Data Kartu Persediaan
        $KPTerakhir->update([
            'tanggal_input' => $request['tanggal_beli'],
            'harga_masuk' => $harga_beli,
            'jumlah_masuk' => $jumlah_beli,
            'total_masuk' => $total_masuk,
            'harga_saldo' => $harga_saldo,
            'jumlah_saldo' => $jumlah_saldo,
            'total_saldo' => $total_saldo,
        ]);

        // Update DataPersediaan
        $dataPersediaan->update([
            'quantity' => $jumlah_saldo,
            'saldo' => $total_saldo,
        ]);
    } else {
        // Menghitung Total Masuk
        $total_masuk = $harga_beli * $jumlah_beli;

        // Menghitung Jumlah Saldo
        $jumlah_saldo = $dataPersediaan->quantity + $jumlah_beli;

        // Menghitung Total Saldo
        $total_saldo = $dataPersediaan->saldo + $total_masuk;

        // Menghitung Harga Saldo
        $harga_saldo = $total_saldo / $jumlah_saldo;

        // Menginput Data Kartu Persediaan
        KartuPersediaan::create([
            'id_kartu_persediaan' => 'KP' . str_pad((KartuPersediaan::latest()->first()->id ?? 0) + 1, 4, 0, STR_PAD_LEFT),
            'id_persediaan' => $dataPersediaan->id,
            'tanggal_input' => $request['tanggal_beli'],
            'harga_masuk' => $harga_beli,
            'jumlah_masuk' => $jumlah_beli,
            'total_masuk' => $total_masuk,
            'harga_keluar' => 0,
            'jumlah_keluar' => 0,
            'total_keluar' => 0,
            'harga_saldo' => $harga_saldo,
            'jumlah_saldo' => $jumlah_saldo,
            'total_saldo' => $total_saldo,
        ]);

        // Update DataPersediaan
        $dataPersediaan->update([
            'quantity' => $jumlah_saldo,
            'saldo' => $total_saldo,
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
    public function edit()
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Mendapatkan nilai dari request
        $jumlah_beli = $request->jumlah_beli;
        $harga_beli = $request->harga_beli;
        $ppn_masukan = $request->ppn_masukan;

        // Menghitung total pembelian
        $total_beli = $jumlah_beli * $harga_beli;

        // Menghitung total bayar
        $total_bayar = $total_beli + $ppn_masukan;

        // Update data pembelian
        $pembelian = KeuPembelian::findOrFail($id);
        $pembelian->update([
            'tanggal_beli' => $request->tanggal_beli,
            'termin_pembayaran' => $request->termin_pembayaran,
            'id_supplier' => $request->id_supplier,
            'metode_beli' => $request->metode_beli,
            'id_persediaan' => $request->id_persediaan,
            'jumlah_beli' => $jumlah_beli,
            'harga_beli' => $harga_beli,
            'total_beli' => $total_beli,
            'ppn_masukan' => $ppn_masukan,
            'total_bayar' => $total_bayar,
        ]);

        // Update Detail Supplier dan Jurnal Umum
        $persediaan = KeuAkun::where('kode_akun', '1130')->first();
        $ppn_masukan_akun = KeuAkun::where('kode_akun', '1140')->first();
        $hutang_usaha = KeuAkun::where('kode_akun', '2110')->first();

        if (is_null($persediaan)) {
            $persediaan = KeuAkun::create([
                'kode_akun' => '1130',
                'nama_akun' => 'Persediaan',
                'jenis_akun' => 'debet',
                'kelompok_akun' => 'aset',
                'saldo_akun' => 0
            ]);
        }

        if (is_null($ppn_masukan_akun)) {
            $ppn_masukan_akun = KeuAkun::create([
                'kode_akun' => '1140',
                'nama_akun' => 'PPN Masukan',
                'jenis_akun' => 'debet',
                'kelompok_akun' => 'aset',
                'saldo_akun' => 0
            ]);
        }

        if (is_null($hutang_usaha)) {
            $hutang_usaha = KeuAkun::create([
                'kode_akun' => '2110',
                'nama_akun' => 'Hutang Usaha',
                'jenis_akun' => 'kredit',
                'kelompok_akun' => 'liabilitas',
                'saldo_akun' => 0
            ]);
        }

        // ambil data Akun
        $kodeAkun1130 = KeuAkun::where('kode_akun', '1130')->get()->first();
        $kodeAkun1140 = KeuAkun::where('kode_akun', '1140')->get()->first();
        $kodeAkun2110 = KeuAkun::where('kode_akun', '2110')->get()->first();

        // jika jenis akun adalah kredit maka kurangi 
        $saldo_akun1130 = $kodeAkun1130->saldo_akun + $total_beli;
        // jika jenis akun adalah kredit maka kurangi 
        $saldo_akun1140 = $kodeAkun1140->saldo_akun + $ppn_masukan;
        // jika jenis akun adalah debet maka tambahi
        $saldo_akun2110 = $kodeAkun2110->saldo_akun + $total_bayar;

        // ubah sesuai operasi diatas
        KeuAkun::where('kode_akun', '1130')->update([
            'saldo_akun' => $saldo_akun1130,
        ]);
        // ubah sesuai operasi diatas
        KeuAkun::where('kode_akun', '1140')->update([
            'saldo_akun' => $saldo_akun1140,
        ]);
        // ubah sesuai operasi diatas
        KeuAkun::where('kode_akun', '2110')->update([
            'saldo_akun' => $saldo_akun2110,
        ]);

        $nama_persediaan = DataPersediaan::where('id_persediaan', $request['id_persediaan'])->first()->nama_persediaan;
        $supplier = KeuSupplier::where('id', $request->input('id_supplier'))->first();

        if (!$supplier) {
            return redirect()->back()->withErrors(['id_supplier' => 'Supplier tidak ditemukan']);
        }

        $nama_supplier = $supplier->nama_supplier;
        $no_JUBELI = DetailSupplier::latest()->first()->id ?? 1;
        $no_jurnal = 'JUBELI' . str_pad($no_JUBELI, 4, 0, STR_PAD_LEFT);

        $jurnal = KeuJurnal::where('no_jurnal', $no_jurnal)->first();
        if ($jurnal) {
            $jurnal->update([
                'tanggal_jurnal' => $request->tanggal_beli,
                'uraian_jurnal' => "Pembelian $nama_persediaan dari $nama_supplier",
                'no_bukti' => $request->id_pembelian,
            ]);
        } else {
            $jurnal = KeuJurnal::create([
                'no_jurnal' => $no_jurnal,
                'tanggal_jurnal' => $request->tanggal_beli,
                'uraian_jurnal' => "Pembelian $nama_persediaan dari $nama_supplier",
                'no_bukti' => $request->id_pembelian,
            ]);
        }

        $id_1130 = $persediaan->id;
        $id_1140 = $ppn_masukan_akun->id;
        $id_2110 = $hutang_usaha->id;
        $no_jurnal_id = $jurnal->id;

        $detailJurnal = KeuDetailJurnal::where('no_jurnal', $no_jurnal_id)->get();

        if ($detailJurnal) {
            foreach ($detailJurnal as $detail) {
                if ($detail->kode_akun == $id_1130) {
                    $detail->update(['debet' => $total_beli]);
                } elseif ($detail->kode_akun == $id_1140) {
                    $detail->update(['debet' => $ppn_masukan]);
                } elseif ($detail->kode_akun == $id_2110) {
                    $detail->update(['kredit' => $total_bayar]);
                }
            }
        } else {
            KeuDetailJurnal::create([
                'no_jurnal' => $no_jurnal_id,
                'kode_akun' => $id_1130,
                'debet' => $total_beli,
            ]);
            KeuDetailJurnal::create([
                'no_jurnal' => $no_jurnal_id,
                'kode_akun' => $id_1140,
                'debet' => $ppn_masukan,
            ]);
            KeuDetailJurnal::create([
                'no_jurnal' => $no_jurnal_id,
                'kode_akun' => $id_2110,
                'kredit' => $total_bayar,
            ]);
        }

        $saldoAkhirSupplier = $total_bayar;
        $DetailSupplier = DetailSupplier::where('id_supplier', $request['id_supplier'])->latest()->first();
        $termin = explode('/', $request['termin_pembayaran']);

        if (count($termin) < 2) {
            return redirect()->back()->withErrors(['termin_pembayaran' => 'Termin pembayaran tidak valid']);
        }

        $tglJatuhTempo = date("Y-m-d", strtotime("+$termin[1] days", strtotime($request['tanggal_beli'])));

        if ($DetailSupplier) {
            $saldoAkhirSupplier = $DetailSupplier->saldo_akhir_supplier + $saldoAkhirSupplier;
            $DetailSupplier->update([
                'termin_pembayaran' => $request['termin_pembayaran'],
                'tanggal_input' => $request['tanggal_beli'],
                'pembelian' => $total_bayar,
                'tanggal_jatuh_tempo' => $tglJatuhTempo,
                'saldo_akhir_supplier' => $saldoAkhirSupplier,
            ]);
        } else {
            DetailSupplier::create([
                'id_detail_supplier' => 'DSP' . str_pad((DetailSupplier::latest()->first()->id ?? 0) + 1, 6, 0, STR_PAD_LEFT),
                'id_supplier' => $request['id_supplier'],
                'termin_pembayaran' => $request['termin_pembayaran'],
                'tanggal_input' => $request['tanggal_beli'],
                'pembelian' => $total_bayar,
                'pembayaran' => 0,
                'tanggal_jatuh_tempo' => $tglJatuhTempo,
                'saldo_akhir_supplier' => $saldoAkhirSupplier,
            ]);
        }

        $KPTerakhir = KartuPersediaan::where('id_persediaan', $request['id_persediaan'])->latest()->first();
        $dataPersediaan = DataPersediaan::where('id_persediaan', $request['id_persediaan'])->first();

        if (!$dataPersediaan) {
            return redirect()->back()->withErrors(['id_persediaan' => 'Data persediaan tidak ditemukan']);
        }

        if ($KPTerakhir) {
            $total_masuk = $harga_beli * $jumlah_beli;
            $jumlah_saldo = $KPTerakhir->jumlah_saldo + $jumlah_beli;
            $total_saldo = $KPTerakhir->total_saldo + $total_masuk;
            $harga_saldo = $total_saldo / $jumlah_saldo;

            $KPTerakhir->update([
                'tanggal_input' => $request['tanggal_beli'],
                'harga_masuk' => $harga_beli,
                'jumlah_masuk' => $jumlah_beli,
                'total_masuk' => $total_masuk,
                'harga_saldo' => $harga_saldo,
                'jumlah_saldo' => $jumlah_saldo,
                'total_saldo' => $total_saldo,
            ]);

            $dataPersediaan->update([
                'quantity' => $jumlah_saldo,
                'saldo' => $total_saldo,
            ]);
        } else {
            $total_masuk = $harga_beli * $jumlah_beli;
            $jumlah_saldo = $dataPersediaan->quantity + $jumlah_beli;
            $total_saldo = $dataPersediaan->saldo + $total_masuk;
            $harga_saldo = $total_saldo / $jumlah_saldo;

            KartuPersediaan::create([
                'id_kartu_persediaan' => 'KP' . str_pad((KartuPersediaan::latest()->first()->id ?? 0) + 1, 4, 0, STR_PAD_LEFT),
                'id_persediaan' => $dataPersediaan->id,
                'tanggal_input' => $request['tanggal_beli'],
                'harga_masuk' => $harga_beli,
                'jumlah_masuk' => $jumlah_beli,
                'total_masuk' => $total_masuk,
                'harga_keluar' => 0,
                'jumlah_keluar' => 0,
                'total_keluar' => 0,
                'harga_saldo' => $harga_saldo,
                'jumlah_saldo' => $jumlah_saldo,
                'total_saldo' => $total_saldo,
            ]);

            $dataPersediaan->update([
                'quantity' => $jumlah_saldo,
                'saldo' => $total_saldo,
            ]);
        }

        return redirect()->route('Pembelian')->with('success', 'Berhasil Memperbarui Pembelian');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        KeuPembelian::where('id', $id)->delete();

        return redirect()->route('Pembelian')->with('hapus', 'Data Pembelian berhasil dihapus');
    }
}
