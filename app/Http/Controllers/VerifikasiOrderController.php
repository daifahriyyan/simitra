<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\DataOrder;
use App\Models\Notifikasi;
use App\Models\DetailOrder;
use Illuminate\Http\Request;
use App\Models\VerifikasiOrder;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class VerifikasiOrderController extends Controller
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
                $verifikasi = VerifikasiOrder::whereHas('dataOrder', function ($query) use ($tanggalMulai, $tanggalAkhir) {
                    $query->whereBetween('tanggal_order', [$tanggalMulai, $tanggalAkhir]);
                })->get();
            } else {
                $verifikasi = VerifikasiOrder::get();
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
                $pdf = Pdf::loadView('generate-pdf.tabel_verifikasi_order', ['verifikasi' => $verifikasi])->setPaper('a4');
                return $pdf->stream('Daftar Verifikasi Order.pdf');
            } else if (request()->get('export') == 'pdf-detail') {
                $record = VerifikasiOrder::where('id', request()->id)->get()->first();
                Pdf::setOption([
                    'enabled' => true,
                    'isRemoteEnabled' => true,
                    'chroot' => realpath(''),
                    'isPhpEnabled' => true,
                    'isFontSubsettingEnabled' => true,
                    'pdfBackend' => 'CPDF',
                    'isHtml5ParserEnabled' => true
                ]);
                $pdf = Pdf::loadView('generate-pdf.baris_verifikasi_order', ['record' => $record])->setPaper('a4');
                return $pdf->stream('Verifikasi Order.pdf');
            }
    
            if (request()->get('verif') !== null) {
                DetailOrder::where('id', request()->get('verif'))->update([
                    'verifikasi' => 2
                ]);

                $id_detailorder = DetailOrder::where('id', request()->get('verif'))->get()->first()->id_detailorder;
                
                // Menambahkan Notifikasi
                Notifikasi::create([
                    'keterangan' => "Order no.".$id_detailorder." telah diverifikasi",
                    'is_read' => 'N',
                    'posisi' => 'Administrasi',
                ]);
            }
            if (request()->get('reject') !== null) {
                DetailOrder::where('id', request()->get('reject'))->update([
                    'verifikasi' => 2,
                    'is_reject' => '1'
                ]);
            }
    
            return view('pages.operasional.verifikasi-order', [
                'dataOrder' => DetailOrder::get(),
                'verifikasi' => $verifikasi,
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
        VerifikasiOrder::create([
            'id_verifikasi' => $request['id_verifikasi'],
            'id_order' => $request['id_order'],
            'waktu' => $request['waktu'],
            'tujuan' => $request['tujuan'],
            'packing' => $request['packing'],
            'kondisi_status' => $request['kondisi_status'],
            'place_fumigation' => $request['place_fumigation'],
            'kesimpulan' => $request['kesimpulan'],
        ]);

        return redirect(route('Verifikasi Order'))->with('success', 'Anda Berhasil Memverifikasi Data Order');
    }

    /**
     * Display the specified resource.
     */
    public function show(VerifikasiOrder $verifikasiOrder)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VerifikasiOrder $verifikasiOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        VerifikasiOrder::where('id', $id)->update([
            'id_verifikasi' => $request['id_verifikasi'],
            'id_order' => $request['id_order'],
            'waktu' => $request['waktu'],
            'tujuan' => $request['tujuan'],
            'packing' => $request['packing'],
            'kondisi_status' => $request['kondisi_status'],
            'place_fumigation' => $request['place_fumigation'],
            'kesimpulan' => $request['kesimpulan'],
        ]);

        return redirect(route('Verifikasi Order'))->with('edit', 'Anda Berhasil Merubah Verifikasi Data Order');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            VerifikasiOrder::where('id', $id)->delete();

            // Validate the value...
        } catch (Throwable $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect(route('Verifikasi Order'))->with('delete', 'Data Verifikasi Berhasil Dihapus');
    }
}
