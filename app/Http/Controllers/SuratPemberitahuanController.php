<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\DataOrder;
use App\Models\DetailOrder;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\SuratPemberitahuan;

class SuratPemberitahuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (isset(request()->tanggalMulai) && isset(request()->tanggalAkhir)) {
            $tanggalMulai = request()->tanggalMulai;
            $tanggalAkhir = request()->tanggalAkhir;
            $sp = SuratPemberitahuan::whereBetween('tanggal', [$tanggalMulai, $tanggalAkhir])->orWhereBetween('tanggal_selesai', [$tanggalMulai, $tanggalAkhir])->get();
        } else {
            $sp = SuratPemberitahuan::get();
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
            $pdf = Pdf::loadView('generate-pdf.tabel_surat_pemberitahuan', ['sp' => $sp])->setPaper('a4');
            return $pdf->stream('Daftar Surat Pemberitahuan.pdf');
        } else if (request()->get('export') == 'pdf-detail') {
            $record = SuratPemberitahuan::where('id', request()->id)->get()->first();
            Pdf::setOption([
                'enabled' => true,
                'isRemoteEnabled' => true,
                'chroot' => realpath(''),
                'isPhpEnabled' => true,
                'isFontSubsettingEnabled' => true,
                'pdfBackend' => 'CPDF',
                'isHtml5ParserEnabled' => true
            ]);
            $pdf = Pdf::loadView('generate-pdf.baris_surat_pemberitahuan', ['record' => $record])->setPaper('a4');
            return $pdf->stream('Surat Pemberitahuan.pdf');
        }
        return view('pages.operasional.surat-pemberitahuan', [
            'title' => 'Surat Pemberitahuan',
            'detailOrder' => DetailOrder::get(),
            'sp' => $sp
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
        SuratPemberitahuan::create([
            'id_sp' => $request['id_sp'],
            'id_order' => $request['id_order'],
            'place_fumigation' => $request['place_fumigation'],
            'fumigan' => $request['fumigan'],
            'tanggal' => $request['tanggal'],
            'tanggal_selesai' => $request['tanggal_selesai'],
            'dimohon_kesediaan' => $request['dimohon_kesediaan'],
        ]);

        return redirect(route('Surat Pemberitahuan'))->with('success', 'Anda Berhasil Menambahkan Data Surat Pemberitahuan');
    }

    /**
     * Display the specified resource.
     */
    public function show(SuratPemberitahuan $suratPemberitahuan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SuratPemberitahuan $suratPemberitahuan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        SuratPemberitahuan::where('id', $id)->update([
            'id_sp' => $request['id_sp'],
            'id_order' => $request['id_order'],
            'place_fumigation' => $request['place_fumigation'],
            'fumigan' => $request['fumigan'],
            'tanggal' => $request['tanggal'],
            'tanggal_selesai' => $request['tanggal_selesai'],
            'dimohon_kesediaan' => $request['dimohon_kesediaan'],
        ]);

        return redirect(route('Surat Pemberitahuan'))->with('success', 'Anda Berhasil Menambahkan Data Surat Pemberitahuan');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            SuratPemberitahuan::where('id', $id)->delete();

            // Validate the value...
        } catch (Throwable $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect(route('Surat Pemberitahuan'))->with('delete', 'Data Surat Pemberitahuan Berhasil Dihapus');
    }
}
