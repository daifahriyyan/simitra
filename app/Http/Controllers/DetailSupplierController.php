<?php

namespace App\Http\Controllers;

use App\Models\DetailSupplier;
use App\Models\KeuSupplier;
use Illuminate\Http\Request;

class DetailSupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.akuntansi.detail-supplier', [
            'detailSupplier' => DetailSupplier::get(),
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
        $saldoAkhirSupplier = $request['pembelian'] - $request['pembayaran'];
        DetailSupplier::create([
            'id_detail_supplier' => $request['id_detail_supplier'],
            'id_supplier' => $request['id_supplier'],
            'termin_pembayaran' => $request['termin_pembayaran'],
            'tanggal_input' => $request['tanggal_input'],
            'pembelian' => $request['pembelian'],
            'pembayaran' => $request['pembayaran'],
            'saldo_akhir_supplier' => $saldoAkhirSupplier,
        ]);

        return redirect()->route('Detail Supplier')->with('success', 'Data Berhasil Ditambahkan');
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
        $saldoAkhirSupplier = $request['pembelian'] - $request['pembayaran'];
        DetailSupplier::where('id', $id)->update([
            'id_detail_supplier' => $request['id_detail_supplier'],
            'id_supplier' => $request['id_supplier'],
            'termin_pembayaran' => $request['termin_pembayaran'],
            'tanggal_input' => $request['tanggal_input'],
            'pembelian' => $request['pembelian'],
            'pembayaran' => $request['pembayaran'],
            'saldo_akhir_supplier' => $saldoAkhirSupplier,
        ]);

        return redirect()->route('Detail Supplier')->with('edit', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DetailSupplier::where('id', $id)->delete();

        return redirect()->route('Detail Supplier')->with('hapus', 'Data Berhasil Dihapus');
    }
}
