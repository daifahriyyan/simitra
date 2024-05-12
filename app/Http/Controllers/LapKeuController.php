<?php

namespace App\Http\Controllers;

use App\Models\KeuAkun;
use Illuminate\Http\Request;
use App\Models\KeuDetailJurnal;

class LapKeuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function bukuBesar()
    {
        if (isset(request()->nama_akun)) {
            // dd(request()->nama_akun);
            if (isset(request()->tanggalMulai) && isset(request()->tanggalAkhir)) {
                $jurnalUmum = KeuDetailJurnal::where('kode_akun', request()->nama_akun)->whereBetween('created_at', [request()->tanggalMulai, request()->tanggalAkhir])->get();
            } else {
                $jurnalUmum = KeuDetailJurnal::where('kode_akun', request()->nama_akun)->get();
            }
        } else {
            $jurnalUmum = KeuDetailJurnal::where('kode_akun', '1110')->get();
        }

        return view("pages.laporan-keuangan.buku-besar", [
            // ambil seluruh data Detail Jurnal
            'jurnalUmum' => $jurnalUmum,
            'akun' => KeuAkun::get(),
            'akunSelected' => KeuAkun::where('kode_akun', request()->nama_akun ?? '1110')->get()->first(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function neracaSaldo()
    {
        return view('pages.laporan-keuangan.neraca-saldo', [
            'neracaSaldo' => KeuAkun::get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function destroy(string $id)
    {
        //
    }
}
