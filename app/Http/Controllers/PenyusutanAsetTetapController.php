<?php

namespace App\Http\Controllers;

use App\Models\KeuAsetTetap;
use App\Models\KeuPenyusutanAt;
use Illuminate\Http\Request;

class PenyusutanAsetTetapController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("pages.akuntansi.penyusutan-aset-tetap", [
            'penyusutanAt' => KeuPenyusutanAt::get(),
            'asetTetap' => KeuAsetTetap::get()
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
        KeuPenyusutanAt::create([
            'kode_penyusutan_at' => $request['kode_penyusutan_at'],
            'kode_at' => $request['kode_at'],
            'tanggal_penyusutan' => $request['tanggal_penyusutan'],
            'tahun_ke' => $request['tahun_ke'],
            'beban_penyusutan' => $request['beban_penyusutan'],
            'akumulasi_penyusutan' => $request['akumulasi_penyusutan'],
            'nilai_buku' => $request['nilai_buku'],
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
        KeuPenyusutanAt::where('id', $id)->update([
            'kode_penyusutan_at' => $request['kode_penyusutan_at'],
            'kode_at' => $request['kode_at'],
            'tanggal_penyusutan' => $request['tanggal_penyusutan'],
            'tahun_ke' => $request['tahun_ke'],
            'beban_penyusutan' => $request['beban_penyusutan'],
            'akumulasi_penyusutan' => $request['akumulasi_penyusutan'],
            'nilai_buku' => $request['nilai_buku'],
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
