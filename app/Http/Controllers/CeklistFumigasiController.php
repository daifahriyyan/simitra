<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\DataOrder;
use App\Models\DetailOrder;
use Illuminate\Http\Request;
use App\Models\CeklistFumigasi;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CeklistFumigasiController extends Controller
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
                $ceklistFumigasi = CeklistFumigasi::whereBetween('tanggal_order', [$tanggalMulai, $tanggalAkhir])->get();
            } else {
                $ceklistFumigasi = CeklistFumigasi::get();
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
                $pdf = Pdf::loadView('generate-pdf.tabel-ceklist-fumigasi', ['ceklistFumigasi' => $ceklistFumigasi])->setPaper('a4');
                return $pdf->stream('Daftar Ceklist Fumigasi.pdf');
            }
    
            return view('pages.operasional.ceklist-fumigasi', [
                'title' => 'Ceklist Fumigasi',
                'ceklist' => $ceklistFumigasi,
                'dataOrder' => DetailOrder::get()
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
        if (request()->hasFile('ceklist_fumigasi')) {
            $CF = $request->file("ceklist_fumigasi");
            $fileCF    = time() . "-" . $CF->getClientOriginalName();
            $uploadCF   = "ceklist_fumigasi/" . $fileCF;

            Storage::disk('public')->put($uploadCF, file_get_contents($CF));
        }

        CeklistFumigasi::create([
            'id_ceklist' => $request['id_ceklist'],
            'id_order' => $request['id_order'],
            'tanggal_order' => $request['tanggal_order'],
            'ceklist_fumigasi' => $fileCF,
        ]);

        return redirect(route('Ceklist Fumigasi'))->with('success', 'Anda Berhasil Menambahkan Data Ceklist Fumigasi');
    }

    /**
     * Display the specified resource.
     */
    public function show(CeklistFumigasi $ceklistFumigasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CeklistFumigasi $ceklistFumigasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id)
    {
        $ceklistFumigasi = CeklistFumigasi::where('id', $id)->first();
        $fileCF = $ceklistFumigasi->ceklist_fumigasi;
        if (request()->hasFile("ceklist_fumigasi")) {
            $CF = request()->file("ceklist_fumigasi");
            $fileCF    = time() . "-" . $CF->getClientOriginalName();
            $uploadCF   = "ceklist_fumigasi/" . $fileCF;

            // Delete old file
            Storage::disk('public')->delete('ceklist_fumigasi/' . $ceklistFumigasi->ceklist_fumigasi);

            // Upload new file
            Storage::disk('public')->put($uploadCF, file_get_contents($CF));

            // Update file path in database
            $ceklistFumigasi->ceklist_fumigasi = $fileCF;
        }
        CeklistFumigasi::where('id', $id)->update([
            'id_ceklist' => request()->id_ceklist,
            'id_order' => request()->id_order,
            'ceklist_fumigasi' => $fileCF,
            'tanggal_order' => request()->tanggal_order,
        ]);

        return redirect(route('Ceklist Fumigasi'))->with('success', 'Data Ceklist Fumigasi Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $ceklistFumigasi = CeklistFumigasi::where('id', $id)->first();
        try {
            CeklistFumigasi::where('id', $id)->delete();
            // Delete file from storage if it exists
            Storage::disk('public')->delete('ceklist_fumigasi/' . $ceklistFumigasi->ceklist_fumigasi);
            // Validate the value...
        } catch (Throwable $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect(route('Ceklist Fumigasi'))->with('delete', 'Data Ceklist Fumigasi Berhasil Dihapus');
    }
}
