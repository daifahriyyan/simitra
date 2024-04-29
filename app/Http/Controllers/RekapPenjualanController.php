<?php

namespace App\Http\Controllers;

use App\Models\DataOrder;
use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Models\RekapPenjualan;

class RekapPenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.penerimaan-jasa.rekap-penjualan', [
            'rekapPenjualan' => RekapPenjualan::get(),
            'invoice' => Invoice::get(),
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
        $dataOrder = DataOrder::where('id', $request['id_order'])->get()->first();
        $totalPenjualan = $dataOrder->volume * $dataOrder->jumlah_order;
        RekapPenjualan::create([
            'id_rekap_penjualan' => $request['id_rekap_penjualan'],
            'id_invoice' => $request['id_invoice'],
            'id_order' => $request['id_order'],
            'total_penjualan' => $totalPenjualan,
        ]);

        return redirect(route('Rekap Penjualan'))->with('success', 'Rekap Penjualan Berhasil Ditambahkan');
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
        $dataOrder = DataOrder::where('id', $request['id_order'])->get()->first();
        $totalPenjualan = $dataOrder->volume * $dataOrder->jumlah_order;
        RekapPenjualan::where('id', $id)->update([
            'id_rekap_penjualan' => $request['id_rekap_penjualan'],
            'id_invoice' => $request['id_invoice'],
            'id_order' => $request['id_order'],
            'total_penjualan' => $totalPenjualan,
        ]);

        return redirect(route('Rekap Penjualan'))->with('edit', 'Rekap Penjualan Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        RekapPenjualan::where('id', $id)->delete();

        return redirect(route('Rekap Penjualan'))->with('delete', 'Rekap Penjualan Berhasil Dihapus');
    }
}
