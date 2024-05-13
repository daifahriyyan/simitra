<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\KeuAkun;
use App\Models\KeuJurnal;
use Illuminate\Http\Request;
use App\Models\DataPersediaan;
use App\Models\KartuPersediaan;
use App\Models\KeuDetailJurnal;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;

class KartuStokPersediaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kartuPersediaan = KartuPersediaan::get();
        if (request()->get('export') == 'pdf') {
            Pdf::setOption([
                'enabled' => true,
                'isRemoteEnabled' => true,
                'chroot' => realpath(''),
                'isPhpEnabled' => true,
                'isFontSubsettingEnabled' => true,
                'pdfBackend' => 'CPDF',
                'isHtml5ParserEnabled' => true
            ]);
            $pdf = Pdf::loadView('generate-pdf.tabel_kartu_persediaan', ['kartuPersediaan' => $kartuPersediaan])->setPaper('a4');
            return $pdf->stream('Daftar Kartu Stok Persediaan.pdf');
        }
        date_default_timezone_set("Asia/Jakarta");
        return view('pages.operasional.kartu-stok-persediaan', [
            'kartuPersediaan' => $kartuPersediaan,
            'id_KP' => KartuPersediaan::latest()->get()->first()->id ?? 0,
            'dataPersediaan' => DataPersediaan::get(),
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
        // Ambil Saldo Data Persediaan
        $dataPersediaan = DataPersediaan::where('id', $request['id_persediaan'])->get()->first();

        // Ambil Record data Terakhir
        $KPTerakhir = KartuPersediaan::where('id_persediaan', $request['id_persediaan'])->latest()->get()->first();
        if (isset($KPTerakhir)) {
            // Membuat Total Keluar
            $total_keluar = $KPTerakhir->harga_saldo * $request['jumlah_keluar'];
            // Membuat Jumlah Saldo
            $jumlah_saldo = $KPTerakhir->jumlah_saldo - $request['jumlah_keluar'];
            // Membuat Total Saldo
            $total_saldo = $KPTerakhir->total_saldo - $total_keluar;
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
                'tanggal_input' => $request['tanggal_input'],
                'harga_masuk' => 0,
                'jumlah_masuk' => 0,
                'total_masuk' => 0,
                'harga_keluar' => $KPTerakhir->harga_saldo,
                'jumlah_keluar' => $request['jumlah_keluar'],
                'total_keluar' => $total_keluar,
                'harga_saldo' => $harga_saldo,
                'jumlah_saldo' => $jumlah_saldo,
                'total_saldo' => $total_saldo,
            ]);

            // ambil data Piutang Usaha dengan kode 1110 dari table keu_akun
            $kas = KeuAkun::where('kode_akun', '1110')->get()->first();
            // ambil data hutang gaji dengan kode 1130 dari table keu_akun
            $persediaan = KeuAkun::where('kode_akun', '1130')->get()->first();

            // cek apakah Piutang Usaha dengan kode 1110 ada?
            // jika tidak ada maka buat akun Piutang Usaha
            if (is_null($kas)) {
                KeuAkun::create([
                    'kode_akun' => '1110',
                    'nama_akun' => 'Kas',
                    'jenis_akun' => 'debet',
                    'kelompok_akun' => 'aset',
                    'saldo_akun' => 0
                ]);
            }
            // cek apakah Penjualan Jasa dengan kode 1130 ada?
            // jika tidak ada maka buat akun Penjualan Jasa
            if (is_null($persediaan)) {
                KeuAkun::create([
                    'kode_akun' => '1130',
                    'nama_akun' => 'Penjualan Jasa',
                    'jenis_akun' => 'kredit',
                    'kelompok_akun' => 'pendapatan',
                    'saldo_akun' => 0
                ]);
            }

            // ambil id kartu persediaan terakhir
            $no_JUPP = KartuPersediaan::latest()->first()->id + 1;
            // Buat No Jurnal JUPP
            $no_jurnal = 'JUPP' . str_pad($no_JUPP, 4, 0, STR_PAD_LEFT);

            // ambil data Akun
            $kodeAkun1110 = KeuAkun::where('kode_akun', '1110')->get()->first();
            $kodeAkun1130 = KeuAkun::where('kode_akun', '1130')->get()->first();

            // jika jenis akun adalah kredit maka kurangi 
            $saldo_akun1110 = $kodeAkun1110->saldo_akun + $total_keluar;
            // jika jenis akun adalah debet maka tambahi
            $saldo_akun1130 = $kodeAkun1130->saldo_akun - $total_keluar;

            // ubah sesuai operasi diatas
            KeuAkun::where('kode_akun', '1110')->update([
                'saldo_akun' => $saldo_akun1110,
            ]);
            // ubah sesuai operasi diatas
            KeuAkun::where('kode_akun', '1130')->update([
                'saldo_akun' => $saldo_akun1130,
            ]);


            // Masukkan Data invoice Ke Jurnal Umum
            KeuJurnal::create([
                'no_jurnal' => $no_jurnal,
                'tanggal_jurnal' => $request->tanggal_invoice,
                'uraian_jurnal' => "Pemakaian $dataPersediaan->nama_persediaan Sebanyak $request->jumlah_keluar",
                'no_bukti' => $request->id_kartu_persediaan,
            ]);


            // Masukkan Data invoice Ke Detail Jurnal Umum bagian debet
            KeuDetailJurnal::create([
                'no_jurnal' => $no_jurnal,
                'kode_akun' => '1110',
                'debet' => $total_keluar
            ]);
            // Masukkan Data invoice Ke Detail Jurnal Umum bagian kredit
            KeuDetailJurnal::create([
                'no_jurnal' => $no_jurnal,
                'kode_akun' => '1130',
                'kredit' => $total_keluar
            ]);
        } else {
            return redirect(route('Kartu Stok Persediaan'))->with('error', 'Belum Ada Data Persediaan Yang masuk');
        }
        return redirect(route('Kartu Stok Persediaan'))->with('success', 'Data Kartu Stok Persediaan Berhasil Ditambah');
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
        // Ambil Saldo Data Persediaan
        $dataPersediaan = DataPersediaan::where('id', $request['id_persediaan'])->get()->first();
        // Ambil Record data Terakhir
        $KPTerakhir = KartuPersediaan::where('id_persediaan', $request['id_persediaan'])->latest()->get()->first();
        // Ambil Logika Harga Keluar untuk Update Saldo Data Persediaan
        $harga_keluar = $KPTerakhir->harga_keluar - $request->harga_keluar;

        // Ambil Logika Total Keluar untuk Update Saldo Akun
        $total_keluar_terakhir = $KPTerakhir->total_keluar - $request->total_keluar;

        // update Saldo Persediaan Terakhir berdasarkan id Perediaan
        DataPersediaan::where('id', $request['id_persediaan'])->update([
            'saldo' => $dataPersediaan->saldo + $harga_keluar
        ]);

        // Membuat Total Keluar
        $total_keluar = $KPTerakhir->harga_saldo * $request['jumlah_keluar'];
        // Membuat Jumlah Saldo
        $jumlah_saldo = $KPTerakhir->jumlah_saldo - $request['jumlah_keluar'];
        // Membuat Total Saldo
        $total_saldo = $KPTerakhir->total_saldo - $total_keluar;
        // Membaut Harga Saldo
        $harga_saldo = $total_saldo / $jumlah_saldo;

        KartuPersediaan::where('id', $id)->update([
            'id_kartu_persediaan' => $request['id_kartu_persediaan'],
            'id_persediaan' => $request['id_persediaan'],
            'tanggal_input' => $request['tanggal_input'],
            'harga_masuk' => 0,
            'jumlah_masuk' => 0,
            'total_masuk' => 0,
            'harga_keluar' => $KPTerakhir->harga_saldo,
            'jumlah_keluar' => $request['jumlah_keluar'],
            'total_keluar' => $total_keluar,
            'harga_saldo' => $harga_saldo,
            'jumlah_saldo' => $jumlah_saldo,
            'total_saldo' => $total_saldo,
        ]);

        // Masukkan Data invoice Ke Jurnal Umum
        KeuJurnal::where('no_bukti', $request->id_kartu_persediaan)->update([
            'tanggal_jurnal' => $request->tanggal_invoice,
            'uraian_jurnal' => "Pemakaian $dataPersediaan->nama_persediaan Sebanyak $request->jumlah_keluar",
            'no_bukti' => $request->id_kartu_persediaan,
        ]);


        // ambil data Akun
        $kodeAkun1110 = KeuAkun::where('kode_akun', '1110')->get()->first();
        $kodeAkun1130 = KeuAkun::where('kode_akun', '1130')->get()->first();

        // jika jenis akun adalah kredit maka kurangi 
        $saldo_akun1110 = $kodeAkun1110->saldo_akun - $total_keluar_terakhir;
        // jika jenis akun adalah debet maka tambahi
        $saldo_akun1130 = $kodeAkun1130->saldo_akun + $total_keluar_terakhir;

        // ubah sesuai operasi diatas
        KeuAkun::where('kode_akun', '1110')->update([
            'saldo_akun' => $saldo_akun1110,
        ]);
        // ubah sesuai operasi diatas
        KeuAkun::where('kode_akun', '1130')->update([
            'saldo_akun' => $saldo_akun1130,
        ]);



        // ambil data no jurnal dimana no bukti berdasarkan data invoice yang ingin dirubah
        $no_jurnal = KeuJurnal::where('no_bukti', $request->id_kartu_persediaan)->get()->first()->no_jurnal;

        // Ubah Data Detail Jurnal bagian debet berdasarkan no jurnal yang dirubah dan kode akun
        KeuDetailJurnal::where('no_jurnal', $no_jurnal)->where('kode_akun', '1110')->update([
            'no_jurnal' => $no_jurnal,
            'kode_akun' => '1110',
            'debet' => $total_keluar
        ]);
        // Ubah Data Detail Jurnal bagian kredit berdasarkan no jurnal yang dirubah dan kode akun
        KeuDetailJurnal::where('no_jurnal', $no_jurnal)->where('kode_akun', '1130')->update([
            'no_jurnal' => $no_jurnal,
            'kode_akun' => '1130',
            'kredit' => $total_keluar
        ]);

        return redirect(route('Kartu Stok Persediaan'))->with('success', 'Data Kartu Stok Persediaan Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            KartuPersediaan::where('id', $id)->delete();
            // Validate the value...
        } catch (Throwable $e) {
            return back()->with('error', $e->getMessage());
        }
        return redirect(route('Kartu Stok Persediaan'))->with('success', 'Data Kartu Stok Persediaan Berhasil Dihapus');
    }
}
