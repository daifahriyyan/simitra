<?php

namespace App\Http\Controllers;

use App\Models\HppSesungguhnya;
use Illuminate\Http\Request;

class HPPSesungguhnyaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.operasional.hpp-sesungguhnya', [
            'hppSesungguhnya' => HppSesungguhnya::get()
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
        $hppSesungguhnya = $request['bbb_sesungguhnya'] + $request['btk_sesungguhnya'] + $request['bop_sesungguhnya'];

        HppSesungguhnya::create([
            'id_beban_hpp' => $request['id_beban_hpp'],
            'tanggal_input' => $request['tanggal_input'],
            'bbb_sesungguhnya' => $request['bbb_sesungguhnya'],
            'btk_sesungguhnya' => $request['btk_sesungguhnya'],
            'bop_sesungguhnya' => $request['bop_sesungguhnya'],
            'hpp_sesungguhnya' => $hppSesungguhnya,
        ]);

        return redirect(route('HPP Sesungguhnya'))->with('success', 'Data HPP Sesungguhnya Berhasil Ditambahkan');
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
        $hppSesungguhnya = $request['bbb_sesungguhnya'] + $request['btk_sesungguhnya'] + $request['bop_sesungguhnya'];

        HppSesungguhnya::where('id', $id)->update([
            'id_beban_hpp' => $request['id_beban_hpp'],
            'tanggal_input' => $request['tanggal_input'],
            'bbb_sesungguhnya' => $request['bbb_sesungguhnya'],
            'btk_sesungguhnya' => $request['btk_sesungguhnya'],
            'bop_sesungguhnya' => $request['bop_sesungguhnya'],
            'hpp_sesungguhnya' => $hppSesungguhnya,
        ]);

        return redirect(route('HPP Sesungguhnya'))->with('edit', 'Data HPP Sesungguhnya Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        HPPSesungguhnya::where('id', $id)->delete();

        return redirect(route('HPP Sesungguhnya'))->with('delete', 'Data HPP Sesungguhnya Berhasil Dihapus');
    }
}
