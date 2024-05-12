<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\DataOrder;
use App\Models\DataPegawai;
use App\Models\DetailOrder;
use Illuminate\Http\Request;
use App\Models\SuratPerintahKerja;

class SuratPerintahKerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.operasional.surat-perintah-kerja', [
            'title' => 'Surat Perintah Kerja',
            'spk' => SuratPerintahKerja::get(),
            'dataOrder' => DataOrder::get(),
            'dataPegawai' => DataPegawai::get(),
            'detailOrder' => DetailOrder::get(),
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
        SuratPerintahKerja::create([
            'id_spk' => $request['id_spk'],
            'id_order' => $request['id_order'],
            'tanggal' => $request['tanggal'],
            'place_fumigation' => $request['place_fumigation'],
            'jumlah_container' => $request['jumlah_container'],
            'fumigan' => $request['fumigan'],
            'dosis' => $request['dosis'],
            'fumigator' => $request['fumigator'],
            'helper1' => $request['helper1'],
            'helper2' => $request['helper2'],
            'helper3' => $request['helper3'],
        ]);

        return redirect(route('Surat Perintah Kerja'))->with('success', 'Anda Berhasil Menambahkan Data Surat Perintah Kerja');
    }

    /**
     * Display the specified resource.
     */
    public function show(SuratPerintahKerja $suratPerintahKerja)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SuratPerintahKerja $suratPerintahKerja)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        SuratPerintahKerja::where('id', $id)->update([
            'id_spk' => $request['id_spk'],
            'tanggal' => $request['tanggal'],
            'place_fumigation' => $request['place_fumigation'],
            'jumlah_container' => $request['jumlah_container'],
            'id_order' => $request['id_order'],
            'fumigan' => $request['fumigan'],
            'dosis' => $request['dosis'],
            'fumigator' => $request['fumigator'],
            'helper1' => $request['helper1'],
            'helper2' => $request['helper2'],
            'helper3' => $request['helper3'],
        ]);

        return redirect(route('Surat Perintah Kerja'))->with('edit', 'Anda Berhasil Merubah Data Surat Perintah Kerja');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            SuratPerintahKerja::where('id', $id)->delete();

            // Validate the value...
        } catch (Throwable $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect(route('Surat Perintah Kerja'))->with('delete', 'Data Surat Perintah Kerja Berhasil Dihapus');
    }
}
