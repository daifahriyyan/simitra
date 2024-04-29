<?php

namespace App\Http\Controllers;

use App\Models\DataPersediaan;
use Illuminate\Http\Request;

class PersediaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.master.persediaan', [
            'title' => 'Persediaan',
            'records' => DataPersediaan::get()
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
            'id_persediaan' => 'required',
            'nama_persediaan' => 'required',
            'quantity' => 'required',
            'saldo' => 'required',
        ]);

        DataPersediaan::create($validator);
        return redirect(route('Persediaan'))->with('add', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(DataPersediaan $dataPersediaan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DataPersediaan $dataPersediaan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = request()->validate([
            'id_persediaan' => 'required',
            'nama_persediaan' => 'required',
            'quantity' => 'required',
            'saldo' => 'required',
        ]);

        DataPersediaan::where('id', '=', $id)->update($validator);
        return redirect(route('Persediaan'))->with('add', 'Data Berhasil Ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DataPersediaan::where('id', $id)->delete();

        return redirect(route('Persediaan'))->with('delete', 'Data Berhasil Dihapus');
    }
}
