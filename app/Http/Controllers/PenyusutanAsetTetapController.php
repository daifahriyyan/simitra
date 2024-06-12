<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\KeuAkun;
use App\Models\KeuJurnal;
use App\Models\DetailOrder;
use App\Models\KeuAsetTetap;
use Illuminate\Http\Request;
use App\Models\KeuDetailJurnal;
use App\Models\KeuPenyusutanAt;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PenyusutanAsetTetapController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->posisi == null) {
            return redirect()->route('Home');
        } else if (Auth::user()->posisi == 'Direktur' || Auth::user()->posisi == 'Keuangan') {
            if (isset(request()->tanggalMulai) && isset(request()->tanggalAkhir)) {
                $penyusutanAt = KeuPenyusutanAt::whereBetween('tanggal_penyusutan', [request()->tanggalMulai, request()->tanggalAkhir])->get();
            } else {
                $penyusutanAt = KeuPenyusutanAt::get();
            }

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
                $pdf = Pdf::loadView('generate-pdf.tabel-penyusutan-aset', ['penyusutanAt' => $penyusutanAt])->setPaper('a4');
                return $pdf->stream('Daftar Penyusutan Aset Tetap.pdf');
            } else if (request()->get('export') == 'pdf-detail') {
                $detail = KeuPenyusutanAt::where('id', request()->id)->get()->first();
                Pdf::setOption([
                    'enabled' => true,
                    'isRemoteEnabled' => true,
                    'chroot' => realpath(''),
                    'isPhpEnabled' => true,
                    'isFontSubsettingEnabled' => true,
                    'pdfBackend' => 'CPDF',
                    'isHtml5ParserEnabled' => true
                ]);
                $pdf = Pdf::loadView('generate-pdf.baris-penyusutan-aset', ['detail' => $detail])->setPaper('a4');
                return $pdf->stream('Penyusutan Aset Tetap.pdf');
            }

            if (request()->get('verif') == 'jurnal') {
                $PAT = KeuPenyusutanAt::where('id', request()->get('id'))->get()->first();

                // ambil data Piutang Usaha dengan kode 5240 dari table keu_akun
                $piutang_usaha = KeuAkun::where('kode_akun', '5240')->get()->first();
                // ambil data PPN Keluaran dengan kode 1220 dari table keu_akun
                $ppn_keluaran = KeuAkun::where('kode_akun', '1220')->get()->first();

                // cek apakah Piutang Usaha dengan kode 5240 ada?
                // jika tidak ada maka buat akun Piutang Usaha
                if (is_null($piutang_usaha)) {
                    KeuAkun::create([
                        'kode_akun' => '5240',
                        'nama_akun' => 'Piutang Usaha',
                        'jenis_akun' => 'debet',
                        'kelompok_akun' => 'aset',
                        'saldo_akun' => 0
                    ]);
                }
                // cek apakah PPN Keluaran dengan kode 1220 ada?
                // jika tidak ada maka buat akun PPN Keluaran
                if (is_null($ppn_keluaran)) {
                    KeuAkun::create([
                        'kode_akun' => '1220',
                        'nama_akun' => 'PPN Keluaran',
                        'jenis_akun' => 'kredit',
                        'kelompok_akun' => 'aset',
                        'saldo_akun' => 0
                    ]);
                }

                // ambil id invoice terakhir
                $no_JUPAT = KeuPenyusutanAt::latest()->first()->id + 1;
                // Buat No Jurnal JUPAT
                $no_jurnal = 'JUPAT' . str_pad($no_JUPAT, 4, 0, STR_PAD_LEFT);

                // ambil data Akun
                $kodeAkun5240 = KeuAkun::where('kode_akun', '5240')->get()->first();
                $kodeAkun1220 = KeuAkun::where('kode_akun', '1220')->get()->first();

                $beban_penyusutan = $PAT->beban_penyusutan / 12;

                // jika jenis akun adalah kredit maka kurangi 
                $saldo_akun5240 = $kodeAkun5240->saldo_akun + $beban_penyusutan;
                // jika jenis akun adalah kredit maka kurangi 
                $saldo_akun1220 = $kodeAkun1220->saldo_akun + $beban_penyusutan;

                // ubah sesuai operasi diatas
                KeuAkun::where('kode_akun', '5240')->update([
                    'saldo_akun' => $saldo_akun5240,
                ]);
                // ubah sesuai operasi diatas
                KeuAkun::where('kode_akun', '1220')->update([
                    'saldo_akun' => $saldo_akun1220,
                ]);

                // Masukkan Data invoice Ke Jurnal Umum
                KeuJurnal::create([
                    'no_jurnal' => $no_jurnal,
                    'tanggal_jurnal' => $PAT->tanggal_penyusutan,
                    'uraian_jurnal' => 'Penyusutan ' . $PAT->asetTetap->nama_at,
                    'no_bukti' => $PAT->kode_penyusutan_at,
                ]);

                $id_jurnal = KeuJurnal::where('no_jurnal', $no_jurnal)->get()->first()->id;
                $id_5240 = KeuAkun::where('kode_akun', '5240')->get()->first()->id;
                $id_1220 = KeuAkun::where('kode_akun', '1220')->get()->first()->id;

                // Masukkan Data invoice Ke Detail Jurnal Umum bagian debet
                KeuDetailJurnal::create([
                    'no_jurnal' => $id_jurnal,
                    'kode_akun' => $id_5240,
                    'debet' => $beban_penyusutan
                ]);
                // Masukkan Data invoice Ke Detail Jurnal Umum bagian debet
                KeuDetailJurnal::create([
                    'no_jurnal' => $id_jurnal,
                    'kode_akun' => $id_1220,
                    'kredit' => $beban_penyusutan
                ]);
            }
            return view("pages.akuntansi.penyusutan-aset-tetap", [
                'penyusutanAt' => $penyusutanAt,
                'id_PAT' => KeuPenyusutanAt::latest()->get()->first()->id ?? 1,
                'asetTetap' => KeuAsetTetap::get()
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
        // setting timezone
        date_default_timezone_set('Asia/Jakarta');

        // pisahkan timezone set 
        $tgl = explode("-", $request['tanggal_penyusutan']);

        // ambil tahunnya
        $tahun_sekarang = intval($tgl[0]);
        // ambil data aset tetap berdasarkan idnya
        $data_at = KeuAsetTetap::where('id', $request->kode_at)->get()->first();
        // mendapatkan input tahun ke 
        $tahun_ke = $tahun_sekarang - $data_at->tahun_perolehan;

        // mendapatkan total perolehan
        $total_perolehan = intval($data_at->harga_perolehan) * $data_at->jumlah_at;
        // Pengkondisian sesuai dengan jenis aset tetap
        if ($data_at->jenis_at == 'Tanah') {
            $beban_penyusutan = $total_perolehan * (0 / 100);
        } else if ($data_at->jenis_at == 'Bangunan') {
            $beban_penyusutan = $total_perolehan * (5 / 100);
        } else if ($data_at->jenis_at == 'Kendaraan Bermotor') {
            $beban_penyusutan = $total_perolehan * (12.5 / 100);
        } else if ($data_at->jenis_at == 'Inventaris Kantor') {
            $beban_penyusutan = $total_perolehan * (25 / 100);
        } else if ($data_at->jenis_at == 'Peralatan dan Mesin') {
            $beban_penyusutan = $total_perolehan * (6.25 / 100);
        }

        // Mendapatkan Akumulasi Penyusutan
        $akumulasi_penyusutan = $beban_penyusutan * $tahun_ke;
        // Mendapatkan Nilai Bukunya
        $nilai_buku = $total_perolehan - $akumulasi_penyusutan;

        KeuPenyusutanAt::create([
            'kode_penyusutan_at' => $request['kode_penyusutan_at'],
            'kode_at' => $request['kode_at'],
            'tanggal_penyusutan' => $request['tanggal_penyusutan'],
            'tahun_ke' => $tahun_ke,
            'beban_penyusutan' => $beban_penyusutan,
            'akumulasi_penyusutan' => $akumulasi_penyusutan,
            'nilai_buku' => $nilai_buku,
        ]);

        return redirect()->route('Penyusutan Aset Tetap')->with('success', 'Data Berhasil Ditambahkan');
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
        // setting timezone
        date_default_timezone_set('Asia/Jakarta');

        // pisahkan timezone set 
        $tgl = explode("-", $request['tanggal_penyusutan']);

        // ambil tahunnya
        $tahun_sekarang = intval($tgl[0]);
        // ambil data aset tetap berdasarkan idnya
        $data_at = KeuAsetTetap::where('id', $request->kode_at)->get()->first();
        // mendapatkan input tahun ke 
        $tahun_ke = $tahun_sekarang - $data_at->tahun_perolehan;

        // mendapatkan total perolehan
        $total_perolehan = intval($data_at->harga_perolehan) * $data_at->jumlah_at;
        // Pengkondisian sesuai dengan jenis aset tetap
        if ($data_at->jenis_at == 'Tanah') {
            $beban_penyusutan = $total_perolehan * (0 / 100);
        } else if ($data_at->jenis_at == 'Bangunan') {
            $beban_penyusutan = $total_perolehan * (5 / 100);
        } else if ($data_at->jenis_at == 'Kendaraan Bermotor') {
            $beban_penyusutan = $total_perolehan * (12.5 / 100);
        } else if ($data_at->jenis_at == 'Inventaris Kantor') {
            $beban_penyusutan = $total_perolehan * (25 / 100);
        } else if ($data_at->jenis_at == 'Peralatan dan Mesin') {
            $beban_penyusutan = $total_perolehan * (6.25 / 100);
        }

        // Mendapatkan Akumulasi Penyusutan
        $akumulasi_penyusutan = $beban_penyusutan * $tahun_ke;
        // Mendapatkan Nilai Bukunya
        $nilai_buku = $total_perolehan - $akumulasi_penyusutan;

        KeuPenyusutanAt::where('id', $id)->update([
            'kode_penyusutan_at' => $request['kode_penyusutan_at'],
            'kode_at' => $request['kode_at'],
            'tanggal_penyusutan' => $request['tanggal_penyusutan'],
            'tahun_ke' => $tahun_ke,
            'beban_penyusutan' => $beban_penyusutan,
            'akumulasi_penyusutan' => $akumulasi_penyusutan,
            'nilai_buku' => $nilai_buku,
        ]);

        return redirect()->route('Penyusutan Aset Tetap')->with('edit', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        KeuPenyusutanAt::where('id', $id)->delete();

        return redirect()->route('Penyusutan Aset Tetap')->with('hapus', 'Data Berhasil Dihapus');
    }
}
