<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\PemakaianMb;
use Illuminate\Http\Request;
use App\Models\DataPersediaan;
use Illuminate\Support\Facades\Auth;

class PemakaianMethylController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->posisi == null) {
          return redirect()->route('Home');
          
        } else if (Auth::user()->posisi == 'Direktur' || Auth::user()->posisi == 'Operasional') {
            return view('pages.operasional.pemakaian-methyl', [
                'pemakaianMethyl' => PemakaianMb::get(),
                'dataPersediaan' => DataPersediaan::get(),
            ]);

        } else {
          return redirect()->route('Dashboard');
        }
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
        $saldo = DataPersediaan::where('id', $request->id_persediaan)->first()->saldo;
        $berat_akhir = $saldo - $request->pemakaian_persediaan;
        PemakaianMb::create([
            'id_pemakaian' => $request->id_pemakaian,
            'tanggal_mulai' => $request->tanggal_mulai,
            'id_persediaan' => $request->id_persediaan,
            'tanggal_selesai' => $request->tanggal_selesai,
            'pemakaian_persediaan' => $request->pemakaian_persediaan,
            'berat_akhir' => $berat_akhir,
            'keterangan' => $request->keterangan,
        ]);

        return redirect(route('Pemakaian Methyl'))->with('success', 'Data Pemakaian Methyl Berhasil Ditambah');
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
        $saldo = DataPersediaan::where('id', $request->id_persediaan)->first()->saldo;
        $berat_akhir = $saldo - $request->pemakaian_persediaan;
        PemakaianMb::where('id', $id)->update([
            'id_pemakaian' => $request->id_pemakaian,
            'tanggal_mulai' => $request->tanggal_mulai,
            'id_persediaan' => $request->id_persediaan,
            'tanggal_selesai' => $request->tanggal_selesai,
            'pemakaian_persediaan' => $request->pemakaian_persediaan,
            'berat_akhir' => $berat_akhir,
            'keterangan' => $request->keterangan,
        ]);

        return redirect(route('Pemakaian Methyl'))->with('success', 'Data Pemakaian Methyl Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            PemakaianMb::where('id', $id)->delete();

            // Validate the value...
        } catch (Throwable $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect(route('Pemakaian Methyl'))->with('delete', 'Data Pemakaian Methyl Berhasil Dihapus');
    }
}
