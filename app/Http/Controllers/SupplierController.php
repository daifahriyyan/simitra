<?php

namespace App\Http\Controllers;

use App\Models\KeuSupplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.akuntansi.supplier', [
            'keuSupplier' => KeuSupplier::get()
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
        KeuSupplier::create([
            'id_supplier' => $request['id_supplier'],
            'nama_supplier' => $request['nama_supplier'],
            'alamat_supplier' => $request['alamat_supplier'],
            'telepon_supplier' => $request['telepon_supplier'],
            'email_supplier' => $request['email_supplier'],
        ]);

        return redirect()->route('Supplier')->with('success', 'Data Berhasil Ditambahkan');
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
        KeuSupplier::where('id', $id)->update([
            'id_supplier' => $request['id_supplier'],
            'nama_supplier' => $request['nama_supplier'],
            'alamat_supplier' => $request['alamat_supplier'],
            'telepon_supplier' => $request['telepon_supplier'],
            'email_supplier' => $request['email_supplier'],
        ]);

        return redirect()->route('Supplier')->with('edit', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        KeuSupplier::where('id', $id)->delete();

        return redirect()->route('Supplier')->with('hapus', 'Data Berhasil Dihapus');
    }
}
