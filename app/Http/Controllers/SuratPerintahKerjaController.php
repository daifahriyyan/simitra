<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\DataOrder;
use App\Models\DataPegawai;
use App\Models\DetailOrder;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\SuratPerintahKerja;
use Illuminate\Support\Facades\Auth;

class SuratPerintahKerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->posisi == null) {
          return redirect()->route('Home');
          
        } else if (Auth::user()->posisi == 'Direktur' || Auth::user()->posisi == 'Operasional') {
            if (isset(request()->tanggalMulai) && isset(request()->tanggalAkhir)) {
                $tanggalMulai = request()->tanggalMulai;
                $tanggalAkhir = request()->tanggalAkhir;
                $spk = SuratPerintahKerja::whereBetween('tanggal', [$tanggalMulai, $tanggalAkhir])->get();
            } else {
                $spk = SuratPerintahKerja::get();
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
                $pdf = Pdf::loadView('generate-pdf.tabel_surat_perintah_kerja', ['spk' => $spk])->setPaper('a4');
                return $pdf->stream('Daftar Surat Perintah Kerja.pdf');
            } else if (request()->get('export') == 'pdf-detail') {
                $record = SuratPerintahKerja::where('id', request()->id)->get()->first();
                Pdf::setOption([
                    'enabled' => true,
                    'isRemoteEnabled' => true,
                    'chroot' => realpath(''),
                    'isPhpEnabled' => true,
                    'isFontSubsettingEnabled' => true,
                    'pdfBackend' => 'CPDF',
                    'isHtml5ParserEnabled' => true
                ]);
                $pdf = Pdf::loadView('generate-pdf.baris_surat_perintah_kerja', ['record' => $record])->setPaper('a4');
                return $pdf->stream('Surat Perintah Kerja.pdf');
            }
            return view('pages.operasional.surat-perintah-kerja', [
                'title' => 'Surat Perintah Kerja',
                'spk' => $spk,
                'dataOrder' => DataOrder::get(),
                'dataPegawai' => DataPegawai::get(),
                'detailOrder' => DetailOrder::get(),
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
        SuratPerintahKerja::create([
            'id_spk' => $request['id_spk'],
            'id_order' => $request['id_order'],
            'tanggal' => $request['tanggal'],
            'place_fumigation' => $request['place_fumigation'],
            'jumlah_container' => $request['jumlah_container'],
            'fumigan' => $request['fumigan'],
            'dosis' => $request['dosis'],
            'fumigator' => $request['fumigator'],
            'helper1' => $request['helper1'],
            'helper2' => $request['helper2'],
            'helper3' => $request['helper3'],
        ]);

        return redirect(route('Surat Perintah Kerja'))->with('success', 'Anda Berhasil Menambahkan Data Surat Perintah Kerja');
    }

    /**
     * Display the specified resource.
     */
    public function show(SuratPerintahKerja $suratPerintahKerja)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SuratPerintahKerja $suratPerintahKerja)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        SuratPerintahKerja::where('id', $id)->update([
            'id_spk' => $request['id_spk'],
            'tanggal' => $request['tanggal'],
            'place_fumigation' => $request['place_fumigation'],
            'jumlah_container' => $request['jumlah_container'],
            'id_order' => $request['id_order'],
            'fumigan' => $request['fumigan'],
            'dosis' => $request['dosis'],
            'fumigator' => $request['fumigator'],
            'helper1' => $request['helper1'],
            'helper2' => $request['helper2'],
            'helper3' => $request['helper3'],
        ]);

        return redirect(route('Surat Perintah Kerja'))->with('edit', 'Anda Berhasil Merubah Data Surat Perintah Kerja');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            SuratPerintahKerja::where('id', $id)->delete();

            // Validate the value...
        } catch (Throwable $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect(route('Surat Perintah Kerja'))->with('delete', 'Data Surat Perintah Kerja Berhasil Dihapus');
    }
}
