<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\KeuAkun;
use App\Models\DataOrder;
use App\Models\KeuJurnal;
use Illuminate\Http\Request;
use App\Models\BuktiPembayaran;
use App\Models\KeuDetailJurnal;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class BuktiPembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.penerimaan-jasa.bukti-pembayaran', [
            'title' => 'Bukti Pembayaran',
            'records' => BuktiPembayaran::get(),
            'invoice' => Invoice::get(),
            'dataOrder' => DataOrder::get(),
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
        $this->validate(request(), [
            'id_invoice' => 'required',
            'id_order' => 'required',
            'tanggal_pembayaran' => 'required',
            'bukti_pembayaran' => 'required',
        ]);

        $buktiPembayaran = $request->file('bukti_pembayaran');
        $fileBP = time() . "-" . $buktiPembayaran->getClientOriginalName();
        $tujuanBP = 'Bukti_pembayaran/' . $fileBP;

        Storage::disk('public')->put($tujuanBP, file_get_contents($buktiPembayaran));

        $storeData = new BuktiPembayaran;
        $storeData->id_invoice = $request->id_invoice;
        $storeData->id_order = $request->id_order;
        $storeData->tanggal_pembayaran = $request->tanggal_pembayaran;
        $storeData->bukti_pembayaran = $fileBP;
        $storeData->save();

        return redirect(route('Bukti Pembayaran'))->with('add', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        // ambil data Bukti Pembayaran
        $dataBP = BuktiPembayaran::where('id', $id)->get()->first();
        // ambil data Piutang Usaha dengan kode 1110 dari table keu_akun
        $kas = KeuAkun::where('kode_akun', '1110')->get()->first();
        // ambil data hutang gaji dengan kode 1120 dari table keu_akun
        $piutang_usaha = KeuAkun::where('kode_akun', '1120')->get()->first();

        // cek apakah Piutang Usaha dengan kode 1110 ada?
        // jika tidak ada maka buat akun Piutang Usaha
        if (is_null($kas)) {
            KeuAkun::create([
                'kode_akun' => '1110',
                'nama_akun' => 'Piutang Usaha',
                'jenis_akun' => 'debet',
                'kelompok_akun' => 'aset',
                'saldo_akun' => 0
            ]);
        }
        // cek apakah Penjualan Jasa dengan kode 1120 ada?
        // jika tidak ada maka buat akun Penjualan Jasa
        if (is_null($piutang_usaha)) {
            KeuAkun::create([
                'kode_akun' => '1120',
                'nama_akun' => 'Penjualan Jasa',
                'jenis_akun' => 'kredit',
                'kelompok_akun' => 'pendapatan',
                'saldo_akun' => 0
            ]);
        }

        // ambil data Invoice
        $invoice = Invoice::where('id', $dataBP->id_invoice)->get()->first();
        // ambil id penggajian terakhir
        $no_JULNS = $invoice->id + 1;
        // Buat No Jurnal JULNS
        $no_jurnal = 'JULNS' . str_pad($no_JULNS, 4, 0, STR_PAD_LEFT);

        // ambil data Akun
        $kodeAkun1110 = KeuAkun::where('kode_akun', '1110')->get()->first();
        $kodeAkun1120 = KeuAkun::where('kode_akun', '1120')->get()->first();

        // jika jenis akun adalah kredit maka kurangi 
        $saldo_akun1110 = $kodeAkun1110->saldo_akun + $invoice->jumlah_dibayar;
        // jika jenis akun adalah debet maka tambahi
        $saldo_akun1120 = $kodeAkun1120->saldo_akun - $invoice->jumlah_dibayar;

        // ubah sesuai operasi diatas
        KeuAkun::where('kode_akun', '1110')->update([
            'saldo_akun' => $saldo_akun1110,
        ]);
        // ubah sesuai operasi diatas
        KeuAkun::where('kode_akun', '1120')->update([
            'saldo_akun' => $saldo_akun1120,
        ]);


        // Masukkan Data Penggajian Ke Jurnal Umum
        KeuJurnal::create([
            'no_jurnal' => $no_jurnal,
            'tanggal_jurnal' => $invoice->tanggal_invoice,
            'uraian_jurnal' => 'Pelunasan ' . $invoice->id_invoice,
            'no_bukti' => $invoice->id_invoice,
        ]);


        // Masukkan Data Penggajian Ke Detail Jurnal Umum bagian debet
        KeuDetailJurnal::create([
            'no_jurnal' => $no_jurnal,
            'kode_akun' => '1110',
            'debet' => $invoice->jumlah_dibayar
        ]);
        // Masukkan Data Penggajian Ke Detail Jurnal Umum bagian kredit
        KeuDetailJurnal::create([
            'no_jurnal' => $no_jurnal,
            'kode_akun' => '1120',
            'kredit' => $invoice->jumlah_dibayar
        ]);

        return redirect()->route('Bukti Pembayaran');
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
        $this->validate(request(), [
            'id_invoice' => 'required',
            'id_order' => 'required',
            'tanggal_pembayaran' => 'required',
            'bukti_pembayaran' => 'required',
        ]);

        if ($request->hasFile('bukti_pembayaran')) {
            $buktiPembayaran = $request->file('bukti_pembayaran');
            $fileBP = time() . "-" . $buktiPembayaran->getClientOriginalName();
            $tujuanBP = 'Bukti_pembayaran/' . $fileBP;

            $data = BuktiPembayaran::where('id', $id)->get()->first();

            Storage::disk('public')->delete('Bukti_pembayaran/' . $data->bukti_pembayaran);

            Storage::disk('public')->put($tujuanBP, file_get_contents($buktiPembayaran));
        }

        $storeData = new BuktiPembayaran;
        $storeData->id_invoice = $request->id_invoice;
        $storeData->id_order = $request->id_order;
        $storeData->tanggal_pembayaran = $request->tanggal_pembayaran;
        $storeData->bukti_pembayaran = $fileBP;
        $storeData->save();

        return redirect(route('Bukti Pembayaran'))->with('add', 'Data Berhasil Ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = BuktiPembayaran::where('id', $id)->get()->first();

        Storage::disk('public')->delete('Bukti_pembayaran/' . $data->bukti_pembayaran);

        BuktiPembayaran::where('id', $id)->delete();

        return redirect(route('Bukti Pembayaran'))->with('delete', 'Data Berhasil Dihapus');
    }
}
