<?php

namespace App\Http\Controllers;

use App\Models\KeuAkun;
use Illuminate\Http\Request;

class DaftarAkunController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("pages.akuntansi.akun", [
            'keuAkun' => KeuAkun::get()
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
        KeuAkun::create([
            'kode_akun' => $request['kode_akun'],
            'nama_akun' => $request['nama_akun'],
            'jenis_akun' => $request['jenis_akun'],
            'kelompok_akun' => $request['kelompok_akun'],
            'saldo_akun' => $request['saldo_akun']
        ]);

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
