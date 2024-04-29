<?php

namespace App\Http\Controllers;

use App\Models\KeuAkun;
use App\Models\KeuJurnal;
use Illuminate\Http\Request;

class JurnalUmumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.akuntansi.jurnal-umum', [
            'jurnalUmum' => KeuJurnal::get(),
            'kodeAkunDebet' => KeuAkun::where('jenis_akun', 'debet')->get(),
            'kodeAkunKredit' => KeuAkun::where('jenis_akun', 'kredit')->get(),
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
        KeuJurnal::create([]);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
