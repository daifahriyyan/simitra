<?php

namespace App\Http\Controllers;

use App\Models\DataOrder;
use App\Models\Pemberitahuan;
use Illuminate\Http\Request;

class PemberitahuanKegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.operasional.pemberitahuan-kegiatan', [
            'pemberitahuanKegiatan' => Pemberitahuan::get(),
            'dataOrder' => DataOrder::get(),
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
        pemberitahuan::where('id', $id)->delete();

        return redirect(route('Pemberitahuan Kegiatan'))->with('success', 'Pemberitahuan Kegiatan Berhasil Dihapus');
    }
}
