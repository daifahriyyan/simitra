<?php

namespace App\Http\Controllers;

use App\Models\DataHppFeet;
use Illuminate\Http\Request;

class StandarHPPController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.master.standar-hpp', [
            'title' => 'Standar HPP',
            'records' => DataHppFeet::get()
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
          'id_standar' => 'required',
          'bbb_feet' => 'required',
          'btk_feet' => 'required',
          'bop_feet' => 'required',
          'jumlah_hpp_feet' => 'required',
        ]);
    
        DataHppFeet::create($validator);
        return redirect(route('Standar HPP'))->with('add', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(DataHppFeet $dataHppFeet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DataHppFeet $dataHppFeet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = request()->validate([
            'id_standar' => 'required',
            'bbb_feet' => 'required',
            'btk_feet' => 'required',
            'bop_feet' => 'required',
            'jumlah_hpp_feet' => 'required',
        ]);
    
        DataHppFeet::where('id_standar', '=', $id)->update($validator);
        return redirect(route('Standar HPP'))->with('add', 'Data Berhasil Ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DataHppFeet::where('id_standar', $id)->delete();
        
        return redirect(route('Standar HPP'))->with('delete', 'Data Berhasil Dihapus');
    }
}
