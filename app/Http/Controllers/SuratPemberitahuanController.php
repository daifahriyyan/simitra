<?php

namespace App\Http\Controllers;

use App\Models\DataOrder;
use Illuminate\Http\Request;
use App\Models\SuratPemberitahuan;

class SuratPemberitahuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.operasional.surat-pemberitahuan', [
            'title' => 'Surat Pemberitahuan',
            'dataOrder' => DataOrder::get(),
            'sp' => SuratPemberitahuan::get(),
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
        SuratPemberitahuan::create([
            'id_sp' => $request['id_sp'],
            'id_order' => $request['id_order'],
            'place_fumigation' => $request['place_fumigation'],
            'fumigan' => $request['fumigan'],
            'tanggal' => $request['tanggal'],
            'tanggal_selesai' => $request['tanggal_selesai'],
            'dimohon_kesediaan' => $request['dimohon_kesediaan'],
        ]);

        return redirect(route('Surat Pemberitahuan'))->with('success', 'Anda Berhasil Menambahkan Data Surat Pemberitahuan');
    }

    /**
     * Display the specified resource.
     */
    public function show(SuratPemberitahuan $suratPemberitahuan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SuratPemberitahuan $suratPemberitahuan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        SuratPemberitahuan::where('id', $id)->update([
            'id_sp' => $request['id_sp'],
            'id_order' => $request['id_order'],
            'place_fumigation' => $request['place_fumigation'],
            'fumigan' => $request['fumigan'],
            'tanggal' => $request['tanggal'],
            'tanggal_selesai' => $request['tanggal_selesai'],
            'dimohon_kesediaan' => $request['dimohon_kesediaan'],
        ]);

        return redirect(route('Surat Pemberitahuan'))->with('success', 'Anda Berhasil Menambahkan Data Surat Pemberitahuan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        SuratPemberitahuan::where('id', $id)->delete();
        
        return redirect(route('Surat Pemberitahuan'))->with('delete', 'Data Surat Pemberitahuan Berhasil Dihapus');
    }
}
