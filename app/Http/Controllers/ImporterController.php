<?php

namespace App\Http\Controllers;

use App\Models\DataImporter;
use Illuminate\Http\Request;

class ImporterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.master.importer', [
            'title' => 'Importer',
            'records' => DataImporter::all(),
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
          'id_importer' => 'required',
          'nama_importer' => 'required',
          'alamat_importer' => 'required',
          'telp_importer' => 'required',
          'fax' => 'required',
          'usci' => 'required',
          'pic' => 'required',
        ]);
    
        DataImporter::create($validator);
        return redirect(route('Importer'))->with('add', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(DataImporter $dataImporter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DataImporter $dataImporter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = request()->validate([
            'id_importer' => 'required',
            'nama_importer' => 'required',
            'alamat_importer' => 'required',
            'telp_importer' => 'required',
            'fax' => 'required',
            'usci' => 'required',
            'pic' => 'required',
        ]);
        
        DataImporter::where('id', '=', $id)->update($validator);
        return redirect(route('Importer'))->with('add', 'Data Berhasil Ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DataImporter::where('id', $id)->delete();
        
        return redirect(route('Importer'))->with('delete', 'Data Berhasil Dihapus');
    }
}
