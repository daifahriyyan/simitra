<?php

namespace App\Http\Controllers;

use App\Models\KeuAkun;
use App\Models\KeuJurnal;
use Illuminate\Http\Request;
use App\Models\KeuDetailJurnal;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DaftarAkunController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->posisi == null) {
          return redirect()->route('Home');
          
        } else if (Auth::user()->posisi == 'Direktur' || Auth::user()->posisi == 'Keuangan') {
            $keuAkun = KeuAkun::orderBy('kode_akun', 'asc')->get();
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
                $pdf = Pdf::loadView('generate-pdf.tabel-akun', ['keuAkun' => $keuAkun])->setPaper('a4');
                return $pdf->stream('Daftar Akun.pdf');
            }
            return view("pages.akuntansi.akun", [
                'keuAkun' => $keuAkun
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
        KeuAkun::create([
            'kode_akun' => $request['kode_akun'],
            'nama_akun' => $request['nama_akun'],
            'jenis_akun' => $request['jenis_akun'],
            'kelompok_akun' => $request['kelompok_akun'],
            'saldo_akun' => $request['saldo_akun']
        ]);

        $id_akun = KeuAkun::where('kode_akun', request()->kode_akun)->get()->first()->id;

        // Buat No Jurnal
        $no_jurnal = str_pad($id_akun, 4, 0, STR_PAD_LEFT);

        // Masukkan Data Penggajian Ke Jurnal Umum
        KeuJurnal::create([
            'no_jurnal' => $no_jurnal,
            'tanggal_jurnal' => date('Y-m-d'),
            'uraian_jurnal' => 'Saldo Awal ' . $request['nama_akun'],
            'no_bukti' => '-',
        ]);

        $id_jurnal = KeuJurnal::where('no_jurnal', $no_jurnal)->get()->first()->id;

        if (request()->jenis_akun == 'debet') {
            // Masukkan Data Penggajian Ke Detail Jurnal Umum bagian debet
            KeuDetailJurnal::create([
                'no_jurnal' => $id_jurnal,
                'kode_akun' => $id_akun,
                'debet' => request()->saldo_akun
            ]);
        } else if (request()->jenis_akun == 'kredit') {
            // Masukkan Data Penggajian Ke Detail Jurnal Umum bagian kredit
            KeuDetailJurnal::create([
                'no_jurnal' => $id_jurnal,
                'kode_akun' => $id_akun,
                'kredit' => request()->saldo_akun
            ]);
        }


        return redirect()->route('Daftar Akun')->with('success', 'Data Berhasil Ditambahkan');
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
        KeuAkun::where('id', $id)->update([
            'kode_akun' => $request['kode_akun'],
            'nama_akun' => $request['nama_akun'],
            'jenis_akun' => $request['jenis_akun'],
            'kelompok_akun' => $request['kelompok_akun'],
            'saldo_akun' => $request['saldo_akun']
        ]);

        return redirect()->route('Daftar Akun')->with('edit', 'Data Berhasil Dirubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        KeuAkun::where('id', $id)->delete();

        return redirect()->route('Daftar Akun')->with('hapus', 'Data Berhasil Dihapus');
    }
}
