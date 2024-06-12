<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\DataOrder;
use App\Models\Notifikasi;
use App\Models\DetailOrder;
use Illuminate\Http\Request;
use App\Models\Pemberitahuan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class PemberitahuanKegiatanController extends Controller
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
                $pemberitahuanKegiatan = Pemberitahuan::whereBetween('jam_mulai', [request()->tanggalMulai, request()->tanggalAkhir])->orWhereBetween('jam_selesai', [request()->tanggalMulai, request()->tanggalAkhir])->get();
            } else {
                $pemberitahuanKegiatan = Pemberitahuan::get();
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
                $pdf = Pdf::loadView('generate-pdf.tabel_pemberitahuan_kegiatan', ['pemberitahuanKegiatan' => $pemberitahuanKegiatan])->setPaper('a4');
                return $pdf->stream('Daftar Pemberitahuan Kegiatan.pdf');
            } else if (request()->get('export') == 'pdf-detail') {
                $formPemberitahuan = Pemberitahuan::where('id', request()->id)->get()->first();
                Pdf::setOption([
                    'enabled' => true,
                    'isRemoteEnabled' => true,
                    'chroot' => realpath(''),
                    'isPhpEnabled' => true,
                    'isFontSubsettingEnabled' => true,
                    'pdfBackend' => 'CPDF',
                    'isHtml5ParserEnabled' => true
                ]);
                $pdf = Pdf::loadView('generate-pdf.baris_pemberitahuan_kegiatan', ['formPemberitahuan' => $formPemberitahuan])->setPaper('a4');
                return $pdf->stream('Formulir Pemberitahuan.pdf');
            }
    
            if (request()->get('verif') !== null) {
                DetailOrder::where('id', request()->get('verif'))->update([
                    'verifikasi' => 3,
                    'is_reject' => '0'
                ]);
                
                $id_detailorder = DetailOrder::where('id', request()->get('verif'))->get()->first()->id_detailorder;
                
                // Menambahkan Notifikasi
                Notifikasi::create([
                    'keterangan' => "Order no.".$id_detailorder." telah selesai dikerjakan, buat sertif",
                    'is_read' => 'N',
                    'posisi' => 'Administrasi',
                ]);
                
                return redirect()->route('Pemberitahuan Kegiatan')->with('success', 'Verifikasi telah berhasil diupdate di web luar');
            }
    
            return view('pages.operasional.pemberitahuan-kegiatan', [
                'pemberitahuanKegiatan' => $pemberitahuanKegiatan,
                'dataOrder' => DetailOrder::latest()->get(),
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
        Pemberitahuan::create([
            'id_kegiatan' => $request['id_kegiatan'],
            'id_order' => $request['id_order'],
            'jam_mulai' => $request['jam_mulai'],
            'jam_selesai' => $request['jam_selesai'],
            'keterangan' => $request['keterangan'],
        ]);

        return redirect(route('Pemberitahuan Kegiatan'))->with('success', 'Pemberitahuan Kegiatan Berhasil Ditambah');
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
        Pemberitahuan::where('id', $id)->update([
            'id_kegiatan' => $request['id_kegiatan'],
            'id_order' => $request['id_order'],
            'jam_mulai' => $request['jam_mulai'],
            'jam_selesai' => $request['jam_selesai'],
            'keterangan' => $request['keterangan'],
        ]);

        return redirect(route('Pemberitahuan Kegiatan'))->with('success', 'Pemberitahuan Kegiatan Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            pemberitahuan::where('id', $id)->delete();

            // Validate the value...
        } catch (Throwable $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect(route('Pemberitahuan Kegiatan'))->with('success', 'Pemberitahuan Kegiatan Berhasil Dihapus');
    }
}
