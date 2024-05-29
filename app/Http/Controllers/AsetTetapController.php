<?php

namespace App\Http\Controllers;

use App\Models\DataPegawai;
use App\Models\KeuAsetTetap;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class AsetTetapController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->posisi == null) {
          return redirect()->route('Home');
          
        } else if (Auth::user()->posisi == 'Direktur' || Auth::user()->posisi == 'Keuangan') {
            $asetTetap = KeuAsetTetap::get();
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
                $pdf = Pdf::loadView('generate-pdf.tabel-aset', ['asetTetap' => $asetTetap])->setPaper('a4');
                return $pdf->stream('Daftar Aset Tetap.pdf');
            }
            return view('pages.akuntansi.aset-tetap', [
                'asetTetap' => $asetTetap,
                'pegawai' => DataPegawai::get()
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
        KeuAsetTetap::create([
            'kode_at' => $request['kode_at'],
            'jenis_at' => $request['jenis_at'],
            'nama_at' => $request['nama_at'],
            'jumlah_at' => $request['jumlah_at'],
            'keberadaan_at' => $request['keberadaan_at'],
            'tahun_perolehan' => $request['tahun_perolehan'],
            'umur_ekonomis' => $request['umur_ekonomis'],
            'harga_perolehan' => $request['harga_perolehan'],
        ]);

        return redirect()->route('Aset Tetap')->with('success', 'Data Berhasil Ditambahkan');
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
        KeuAsetTetap::where('id', $id)->update([
            'kode_at' => $request['kode_at'],
            'jenis_at' => $request['jenis_at'],
            'nama_at' => $request['nama_at'],
            'jumlah_at' => $request['jumlah_at'],
            'keberadaan_at' => $request['keberadaan_at'],
            'tahun_perolehan' => $request['tahun_perolehan'],
            'umur_ekonomis' => $request['umur_ekonomis'],
            'harga_perolehan' => $request['harga_perolehan'],
        ]);

        return redirect()->route('Aset Tetap')->with('edit', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        KeuAsetTetap::where('id', $id)->delete();

        return redirect()->route('Aset Tetap')->with('hapus', 'Data Berhasil Dihapus');
    }
}
