<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\RekapHpp;
use App\Models\DataHargar;
use Illuminate\Http\Request;
use App\Models\RekapPenjualan;

class RekapHPPStandarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("pages.akuntansi.rekap-hpp-standar", [
            'rekapHPPStandar' => RekapHpp::get(),
            'dataHarga' => DataHargar::get(),
            'rekapPenjualan' => RekapPenjualan::get(),
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
        $quantity = RekapPenjualan::get()->first()->quantity;
        $hpp = DataHargar::get()->first()->hpp;
        $totalHpp = $quantity * $hpp;

        RekapHpp::create([
            'id_rekap' => $request['id_rekap'],
            'tanggal_input' => $request['tanggal_input'],
            'id_data_harga' => $request['id_data_standar'],
            'id_rekap_penjualan' => $request['id_rekap_penjualan'],
            'total_hpp' => $totalHpp,
        ]);

        return redirect()->route('Rekap HPP Standar')->with('success', 'Data Berhasil Ditambahkan');
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
        $quantity = RekapPenjualan::get()->first()->dataOrder->jumlah_order;
        $hpp = DataHargar::get()->first()->hpp;
        $totalHpp = $quantity * $hpp;

        RekapHpp::where('id', $id)->update([
            'id_rekap' => $request['id_rekap'],
            'tanggal_input' => $request['tanggal_input'],
            'id_data_harga' => $request['id_data_standar'],
            'id_rekap_penjualan' => $request['id_rekap_penjualan'],
            'total_hpp' => $totalHpp,
        ]);

        return redirect()->route('Rekap HPP Standar')->with('edit', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            RekapHPP::where('id', $id)->delete();

            // Validate the value...
        } catch (Throwable $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect()->route('Rekap HPP Standar')->with('hapus', 'Data Berhasil Dihapus');
    }
}
