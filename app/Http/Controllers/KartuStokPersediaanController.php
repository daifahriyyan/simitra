<?php

namespace App\Http\Controllers;

use App\Models\DataPersediaan;
use App\Models\KartuPersediaan;
use Illuminate\Http\Request;

class KartuStokPersediaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.operasional.kartu-stok-persediaan', [
            'kartuPersediaan' => KartuPersediaan::get(),
            'id_KP' => KartuPersediaan::latest()->get()->first()->id ?? 0,
            'dataPersediaan' => DataPersediaan::get(),
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
        $total_masuk = $request['harga_masuk'] * $request['jumlah_masuk'];
        $total_keluar = $request['harga_keluar'] * $request['jumlah_keluar'];
        $total_saldo = $request['harga_saldo'] * $request['jumlah_saldo'];

        $saldoPersediaan = DataPersediaan::where('id', $request['id_persediaan'])->get()->first()->saldo;
        DataPersediaan::where('id', $request['id_persediaan'])->update([
            'saldo' => $saldoPersediaan - $request['harga_keluar']
        ]);

        KartuPersediaan::create([
            'id_kartu_persediaan' => $request['id_kartu_persediaan'],
            'id_persediaan' => $request['id_persediaan'],
            'tanggal_input' => date('Y-m-d H:i:s'),
            'harga_masuk' => 0,
            'jumlah_masuk' => 0,
            'total_masuk' => 0,
            'harga_keluar' => $request['harga_keluar'],
            'jumlah_keluar' => $request['jumlah_keluar'],
            'total_keluar' => $total_keluar,
            'harga_saldo' => $request['harga_saldo'],
            'jumlah_saldo' => $request['jumlah_saldo'],
            'total_saldo' => $total_saldo,
        ]);
        return redirect(route('Kartu Stok Persediaan'))->with('success', 'Data Kartu Stok Persediaan Berhasil Ditambah');
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
        $total_masuk = $request['harga_masuk'] * $request['jumlah_masuk'];
        $total_keluar = $request['harga_keluar'] * $request['jumlah_keluar'];
        $total_saldo = $request['harga_saldo'] * $request['jumlah_saldo'];
        KartuPersediaan::where('id', $id)->update([
            'id_kartu_persediaan' => $request['id_kartu_persediaan'],
            'id_persediaan' => $request['id_persediaan'],
            'harga_masuk' => $request['harga_masuk'],
            'jumlah_masuk' => $request['jumlah_masuk'],
            'total_masuk' => $total_masuk,
            'harga_keluar' => $request['harga_keluar'],
            'jumlah_keluar' => $request['jumlah_keluar'],
            'total_keluar' => $total_keluar,
            'harga_saldo' => $request['harga_saldo'],
            'jumlah_saldo' => $request['jumlah_saldo'],
            'total_saldo' => $total_saldo,
        ]);
        return redirect(route('Kartu Stok Persediaan'))->with('success', 'Data Kartu Stok Persediaan Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        KartuPersediaan::where('id', $id)->delete();
        return redirect(route('Kartu Stok Persediaan'))->with('success', 'Data Kartu Stok Persediaan Berhasil Dihapus');
    }
}
