<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\Invoice;
use App\Models\KeuAkun;
use App\Models\KeuJurnal;
use Illuminate\Http\Request;
use App\Models\KeuPenggajian;
use App\Models\DetailSupplier;
use App\Models\KeuDetailJurnal;
use Barryvdh\DomPDF\Facade\Pdf;

class JurnalUmumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jurnalUmum = KeuDetailJurnal::get();
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
            $pdf = Pdf::loadView('generate-pdf.tabel-jurnal', ['jurnalUmum' => $jurnalUmum])->setPaper('a4');
            return $pdf->stream('Jurnal Umum.pdf');
        }
        return view('pages.akuntansi.jurnal-umum', [
            // ambil seluruh data Detail Jurnal
            'jurnalUmum' => KeuDetailJurnal::get(),
            // ambil id terakhir dari Jurnal
            'jurnal' => isset(KeuJurnal::latest()->get()->first()->id) + 1 ?? 1,
            // ambil seluruh data akun
            'akun' => KeuAkun::latest()->get(),
            // ambil kode akun yang jenisnya debet
            'kodeAkunDebet' => KeuAkun::where('jenis_akun', 'debet')->get(),
            // ambil kode akun yang jenisnya kredit
            'kodeAkunKredit' => KeuAkun::where('jenis_akun', 'kredit')->get(),
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
        $jumlah_debet = count($request->jumlah_debet);
        $jumlah_kredit = count($request->jumlah_kredit);

        // lakukan penamabahan tiap tiap jurnal debet yang dmasukkan
        for ($i = 0; $i < $jumlah_debet; $i++) {
            KeuDetailJurnal::create([
                'no_jurnal' => $request->no_jurnal,
                'kode_akun' => $request->no_akun_debet[$i],
                'debet' => $request->jumlah_debet[$i]
            ]);

            // ambil data Akun
            $akunDebet = KeuAkun::where('kode_akun', $request->no_akun_debet[$i])->get()->first();

            if ($akunDebet->jenis_akun == 'kredit') {
                // jika jenis akun adalah kredit maka kurangi 
                $saldo_akun = $akunDebet->saldo_akun - $request->jumlah_debet[$i];
            } else if ($akunDebet->jenis_akun == 'debet') {
                // jika jenis akun adalah debet maka tambahi
                $saldo_akun = $akunDebet->saldo_akun + $request->jumlah_debet[$i];
            }

            // ubah sesuai operasi diatas
            KeuAkun::where('kode_akun', $request->no_akun_debet[$i])->update([
                'saldo_akun' => $saldo_akun,
            ]);
        }
        $id_jurnal = KeuJurnal::where('no_jurnal', $request->no_jurnal)->get()->first()->id;

        // lakukan penambahan tiap tiap jurnal kredit yang dimasukkan
        for ($i = 0; $i < $jumlah_kredit; $i++) {
            KeuDetailJurnal::create([
                'no_jurnal' => $id_jurnal,
                'kode_akun' => $request->no_akun_kredit[$i],
                'kredit' => $request->jumlah_kredit[$i]
            ]);

            // ambil data akun
            $akunKredit = KeuAkun::where('kode_akun', $request->no_akun_kredit[$i])->get()->first();

            if ($akunKredit->jenis_akun == 'debet') {
                // jika jenis akun adalah debet maka kurangi
                $saldo_akun = $akunKredit->saldo_akun - $request->jumlah_kredit[$i];
            } else if ($akunKredit->jenis_akun == 'kredit') {
                // jika jenis akun adalah kredit maka tambahi
                $saldo_akun = $akunKredit->saldo_akun + $request->jumlah_kredit[$i];
            }

            // Ubah sesuai dengan operasi diatas
            KeuAkun::where('kode_akun', $request->no_akun_kredit[$i])->update([
                'saldo_akun' => $saldo_akun,
            ]);
        }

        KeuJurnal::create([
            'no_jurnal' => $request->no_jurnal,
            'tanggal_jurnal' => $request->tanggal_jurnal,
            'uraian_jurnal' => $request->uraian_jurnal,
            'no_bukti' => $request->no_bukti,
        ]);


        return redirect()->route('Jurnal Umum')->with('success', 'Jurnal Umum Berhasil Ditambahkan');
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
    public function destroy(string $no_jurnal)
    {

        // ambil seluruh data detail jurnal
        $detail_jurnal = KeuDetailJurnal::where('no_jurnal', $no_jurnal)->get();

        $no_bukti = KeuJurnal::where('no_jurnal', $no_jurnal)->get()->first()->no_bukti;

        try {
            // ambil identitas jurnal
            $no_jurnal = explode('0', $no_jurnal);
            if ($no_jurnal[0] == 'JUBYR') {
                DetailSupplier::where('id_detail_supplier', $no_bukti)->delete();
            } else if ($no_jurnal[0] == 'JUGAJI') {
                KeuPenggajian::where('id_penggajian', $no_bukti)->delete();
            } else if ($no_jurnal[0] == 'JUINV') {
                Invoice::where('id_invoice', $no_bukti)->delete();
            }

            // hapus record table detail jurnal berdasarkan no jurnal
            KeuDetailJurnal::where('no_jurnal', $no_jurnal)->delete();
            // hapus record table jurnal berdasarkan no jurnal
            KeuJurnal::where('no_jurnal', $no_jurnal)->delete();

            // Validate the value...
        } catch (Throwable $e) {
            return back()->with('error', $e->getMessage());
        }

        // lakukan pengembalian saldo tiap tiap akun dari jurnal umum yang dihapus
        foreach ($detail_jurnal as $record) {
            // dapatkan kode akun dari tiap akun yang dihapus
            $kode_akun = $record->kode_akun;

            // dapatkan akun berdasarkan kode akun yang dihapus
            $akun = KeuAkun::where('kode_akun', $kode_akun)->get()->first();
            // ambil saldo debet tiap akun
            $saldoDebet = $record->debet;
            // ambil saldo kredit tiap akun
            $saldoKredit = $record->kredit;

            // jika jenis akun kredit dan saldo kreditnya berisi maka saldo akun dikurangi saldo kredit dari tiap akun jurnal
            if ($akun->jenis_akun == 'kredit' && !is_null($saldoKredit)) {
                KeuAkun::where('kode_akun', $kode_akun)->update([
                    'saldo_akun' => $akun->saldo_akun - $saldoKredit
                ]);

                $keterangan = 'kredit berhasil dikurangi kredit';
                // jika jenis akun debet dan saldo kredit berisi maka saldo akun ditambahi saldo kredit dari tiap akun jurnal
            } else if ($akun->jenis_akun == 'debet' && !is_null($saldoKredit)) {
                KeuAkun::where('kode_akun', $kode_akun)->update([
                    'saldo_akun' => $akun->saldo_akun + $saldoKredit
                ]);

                $keterangan = 'Debet berhasil ditambah Kredit';
                // jika jenis akun kredit dan saldo debet berisi maka saldo akun ditambahi saldo debet dari tiap akun jurnal
            } else if ($akun->jenis_akun == 'kredit' && !is_null($saldoDebet)) {
                KeuAkun::where('kode_akun', $kode_akun)->update([
                    'saldo_akun' => $akun->saldo_akun + $saldoDebet
                ]);

                $keterangan = 'kredit berhasil ditambah debet';
                // jika jenis akun debet dan saldo debet berisi maka saldo akun dikurangi saldo debet dari tiap akun jurnal
            } else if ($akun->jenis_akun == 'debet' && !is_null($saldoDebet)) {
                KeuAkun::where('kode_akun', $kode_akun)->update([
                    'saldo_akun' => $akun->saldo_akun - $saldoDebet
                ]);

                $keterangan = 'Debet berhasil dikurangi debet';
            }
        }

        return redirect()->route('Jurnal Umum')->with('hapus', 'Data Jurnal Umum Berhasil Dihapus');
    }
}
