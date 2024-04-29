<?php

namespace App\Http\Controllers;

use App\Models\DataPegawai;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.master.pegawai', [
            'title' => 'Data Pegawai',
            'records' => DataPegawai::get()
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
        DataPegawai::create([
            'id_pegawai' => request()->id_pegawai,
            'nama_pegawai' => request()->nama_pegawai,
            'alamat_pegawai' => request()->alamat_pegawai,
            'telp_pegawai' => request()->telp_pegawai,
            'posisi' => request()->posisi,
            'noreg_fumigasi' => request()->noreg_fumigasi,
            'gaji_pokok' => request()->gaji_pokok,
          ]);
        return redirect(route('pegawai.index'))->with('add', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(DataPegawai $dataPegawai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DataPegawai $dataPegawai)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        DataPegawai::where('id', '=', $id)->update([
            'id_pegawai' => request()->id_pegawai,
            'nama_pegawai' => request()->nama_pegawai,
            'alamat_pegawai' => request()->alamat_pegawai,
            'telp_pegawai' => request()->telp_pegawai,
            'posisi' => request()->posisi,
            'noreg_fumigasi' => request()->noreg_fumigasi,
            'gaji_pokok' => request()->gaji_pokok,
        ]);
        return redirect(route('pegawai.index'))->with('add', 'Data Berhasil Ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DataPegawai::where('id', $id)->delete();
        
        return redirect(route('pegawai.index'))->with('delete', 'Data Berhasil Dihapus');
    }
}
