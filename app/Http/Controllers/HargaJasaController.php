<?php

namespace App\Http\Controllers;

use App\Models\DataHargar;
use Illuminate\Http\Request;

class HargaJasaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.master.harga-jasa', [
            'title' => 'Harga Jasa',
            'records' => DataHargar::get()
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
        $validator = request()->validate([
          'id_datastandar' => 'required|unique:data_harga,id_datastandar',
          'id_standar' => 'required',
          'volume' => 'required',
          'treatment' => 'required',
          'bbb_standar' => 'required',
          'btk_standar' => 'required',
          'bop_standar' => 'required',
          'hpp' => 'required',
          'markup' => 'required',
          'harga_jual' => 'required',
        ]);
    
        DataHargar::create($validator);
        return redirect(route('Harga Jasa'))->with('add', 'Data Berhasil Ditambahkan');
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
        $validator = request()->validate([
          'id_datastandar' => 'required',
          'id_standar' => 'required',
          'volume' => 'required',
          'treatment' => 'required',
          'bbb_standar' => 'required',
          'btk_standar' => 'required',
          'bop_standar' => 'required',
          'hpp' => 'required',
          'markup' => 'required',
          'harga_jual' => 'required',
        ]);
    
        DataHargar::where('id_standar', '=', $id)->update($validator);
        return redirect(route('Harga Jasa'))->with('add', 'Data Berhasil Ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DataHargar::where('id_standar', $id)->delete();
        
        return redirect(route('Harga Jasa'))->with('delete', 'Data Berhasil Dihapus');
    }
}
