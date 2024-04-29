<?php

namespace App\Http\Controllers;

use App\Models\DataPegawai;
use App\Models\KeuPenggajian;
use Illuminate\Http\Request;

class PenggajianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.akuntansi.penggajian', [
            'penggajian' => KeuPenggajian::get(),
            'pegawai' => DataPegawai::get()
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
        $gaji_pokok = DataPegawai::where('id', $request['id_pegawai'])->get()->first()->gaji_pokok;
        $gaji_bersih = $gaji_pokok + $request['bonus'] + $request['tunjangan_lembur'] + $request['iuran'];
        KeuPenggajian::create([
            'id_penggajian' => $request['id_penggajian'],
            'tanggal_input' => $request['tanggal_input'],
            'id_pegawai' => $request['id_pegawai'],
            'bonus' => $request['bonus'],
            'tunjangan_lembur' => $request['tunjangan_lembur'],
            'iuran' => $request['iuran'],
            'gaji_bersih' => $gaji_bersih
        ]);

        return redirect()->route('Penggajian')->with('success', 'Data Berhasil Ditambahkan');
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
        $gaji_pokok = DataPegawai::where('id', $request['id_pegawai'])->get()->first()->gaji_pokok;
        $gaji_bersih = $gaji_pokok + $request['bonus'] + $request['tunjangan_lembur'] + $request['iuran'];
        KeuPenggajian::where('id', $id)->update([
            'id_penggajian' => $request['id_penggajian'],
            'tanggal_input' => $request['tanggal_input'],
            'id_pegawai' => $request['id_pegawai'],
            'bonus' => $request['bonus'],
            'tunjangan_lembur' => $request['tunjangan_lembur'],
            'iuran' => $request['iuran'],
            'gaji_bersih' => $gaji_bersih
        ]);

        return redirect()->route('Penggajian')->with('edit', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        KeuPenggajian::where('id', $id)->delete();

        return redirect()->route('Penggajian')->with('hapus', 'Data Berhasil Dihapus');
    }
}
