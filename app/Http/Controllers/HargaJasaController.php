<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\DataHargar;
use App\Models\DataHppFeet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HargaJasaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.master.harga-jasa', [
            'title' => 'Harga Jasa',
            'records' => DataHargar::get(),
            'datahppfeet' => DataHppFeet::with('standarHPP')->get()
        ]);
        if (Auth::user()->posisi == null) {
        } else if (Auth::user()->posisi == 'Direktur') {
        } else if (Auth::user()->posisi == 'Manajer') {
        } else if (Auth::user()->posisi == 'Admin') {
        } else if (Auth::user()->posisi == 'Operasional') {
        } else if (Auth::user()->posisi == 'Fumigator') {
        } else if (Auth::user()->posisi == 'Staff Lainnya') {
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
        $this->validate(request(), [
            'id_datastandar' => 'required|unique:data_harga,id_datastandar',
            'id_standar' => 'required',
            'volume' => 'required',
            'treatment' => 'required',
            'markup' => 'required',
        ]);

        $datahppfeet = DataHppFeet::where('id', $request['id_standar'])->get()->first();
        intval($request['volume']);
        $bbb_feet = $datahppfeet->bbb_feet * $request['volume'];
        $btk_feet = $datahppfeet->btk_feet * $request['volume'];
        $bop_feet = $datahppfeet->bop_feet * $request['volume'];
        $hpp = $bbb_feet + $btk_feet + $bop_feet;
        $markup = intval(request()->markup);
        $markup = $markup / 100;
        DataHargar::create([
            'id_datastandar' => request()->id_datastandar,
            'id_standar' => request()->id_standar,
            'volume' => request()->volume,
            'treatment' => request()->treatment,
            'bbb_standar' => $bbb_feet,
            'btk_standar' => $btk_feet,
            'bop_standar' => $bop_feet,
            'hpp' => $hpp,
            'markup' => $markup,
            'harga_jual' => $hpp * $markup,
        ]);
        return redirect(route('Harga Jasa'))->with('add', 'Data Berhasil Ditambahkan');
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
        $this->validate(request(), [
            'volume' => 'required',
            'treatment' => 'required',
            'markup' => 'required',
        ]);

        $datahppfeet = DataHppFeet::where('id', $request['id_standar'])->get()->first();
        intval($request['volume']);
        $bbb_feet = $datahppfeet->bbb_feet * $request['volume'];
        $btk_feet = $datahppfeet->btk_feet * $request['volume'];
        $bop_feet = $datahppfeet->bop_feet * $request['volume'];
        $hpp = $bbb_feet + $btk_feet + $bop_feet;
        $markup = intval(request()->markup);
        DataHargar::where('id', '=', $id)->update([
            'volume' => request()->volume,
            'treatment' => request()->treatment,
            'bbb_standar' => $bbb_feet,
            'btk_standar' => $btk_feet,
            'bop_standar' => $bop_feet,
            'hpp' => $hpp,
            'markup' => $markup,
            'harga_jual' => $hpp * ($markup / 100),
        ]);

        return redirect(route('Harga Jasa'))->with('add', 'Data Berhasil Ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            DataHargar::where('id', $id)->delete();
            // Validate the value...
        } catch (Throwable $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect(route('Harga Jasa'))->with('delete', 'Data Berhasil Dihapus');
    }
}
