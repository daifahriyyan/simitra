<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use Illuminate\Http\Request;
use App\Models\HppSesungguhnya;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class HPPSesungguhnyaController extends Controller
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
                $hppSesungguhnya = HppSesungguhnya::whereBetween('tanggal_input', [request()->tanggalMulai, request()->tanggalAkhir])->get();
            } else {
                $hppSesungguhnya = HppSesungguhnya::get();
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
                $pdf = Pdf::loadView('generate-pdf.tabel_hpp_sesungguhnya', ['hppSesungguhnya' => $hppSesungguhnya])->setPaper('a4');
                return $pdf->stream('Daftar HPP Sesungguhnya.pdf');
            }
            return view('pages.operasional.hpp-sesungguhnya', [
                'hppSesungguhnya' => $hppSesungguhnya
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
        $hppSesungguhnya = $request['bbb_sesungguhnya'] + $request['btk_sesungguhnya'] + $request['bop_sesungguhnya'];

        HppSesungguhnya::create([
            'id_beban_hpp' => $request['id_beban_hpp'],
            'tanggal_input' => $request['tanggal_input'],
            'bbb_sesungguhnya' => $request['bbb_sesungguhnya'],
            'btk_sesungguhnya' => $request['btk_sesungguhnya'],
            'bop_sesungguhnya' => $request['bop_sesungguhnya'],
            'hpp_sesungguhnya' => $hppSesungguhnya,
        ]);

        // Menambahkan Notifikasi
        Notifikasi::create([
            'keterangan' => "Telah ditambahkan HPP Sesungguhnya, cek laporan hpp",
            'is_read' => 'N',
            'posisi' => 'Keuangan',
        ]);

        return redirect(route('HPP Sesungguhnya'))->with('success', 'Data HPP Sesungguhnya Berhasil Ditambahkan');
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
        $hppSesungguhnya = $request['bbb_sesungguhnya'] + $request['btk_sesungguhnya'] + $request['bop_sesungguhnya'];

        HppSesungguhnya::where('id', $id)->update([
            'id_beban_hpp' => $request['id_beban_hpp'],
            'tanggal_input' => $request['tanggal_input'],
            'bbb_sesungguhnya' => $request['bbb_sesungguhnya'],
            'btk_sesungguhnya' => $request['btk_sesungguhnya'],
            'bop_sesungguhnya' => $request['bop_sesungguhnya'],
            'hpp_sesungguhnya' => $hppSesungguhnya,
        ]);

        return redirect(route('HPP Sesungguhnya'))->with('edit', 'Data HPP Sesungguhnya Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        HPPSesungguhnya::where('id', $id)->delete();

        return redirect(route('HPP Sesungguhnya'))->with('delete', 'Data HPP Sesungguhnya Berhasil Dihapus');
    }
}
