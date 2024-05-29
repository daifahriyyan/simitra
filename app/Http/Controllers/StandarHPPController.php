<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\DataHppFeet;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class StandarHPPController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->posisi == null) {
            return redirect()->route('Home');
        } else {
            $records = DataHppFeet::get();
            if (request()->get('export') == 'pdf') {
                Pdf::setOption([
                    'enabled' => true,
                    'isRemoteEnabled' => true,
                    'chroot' => realpath(''),
                    'isPhpEnabled' => true,
                    'isFontSubsettingEnabled' => true,
                    'pdfBackend' => 'CPDF',
                    'isHtml5ParserEnabled' => true
                ]);
                $pdf = Pdf::loadView('generate-pdf.tabel_standar_hpp', ['records' => $records])->setPaper('a4');
                return $pdf->stream('Daftar Standar Hpp.pdf');
            }
            return view('pages.master.standar-hpp', [
                'title' => 'Standar HPP',
                'records' => $records
            ]);
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
        $string = $request['bbb_feet'] + $request['btk_feet'] + $request['bop_feet'];
        request()->jumlah_hpp_feet = strval($string);
        $this->validate(request(), [
            'id_standar' => 'required',
            'bbb_feet' => 'required',
            'btk_feet' => 'required',
            'bop_feet' => 'required',
        ]);
        DataHppFeet::create([
            'id_standar' => request()->id_standar,
            'bbb_feet' => request()->bbb_feet,
            'btk_feet' => request()->btk_feet,
            'bop_feet' => request()->bop_feet,
            'jumlah_hpp_feet' => request()->jumlah_hpp_feet,
        ]);

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
        $string = $request['bbb_feet'] + $request['btk_feet'] + $request['bop_feet'];
        request()->jumlah_hpp_feet = strval($string);
        $this->validate(request(), [
            'id_standar' => 'required',
            'bbb_feet' => 'required',
            'btk_feet' => 'required',
            'bop_feet' => 'required',
        ]);

        DataHppFeet::where('id', '=', $id)->update([
            'id_standar' => request()->id_standar,
            'bbb_feet' => request()->bbb_feet,
            'btk_feet' => request()->btk_feet,
            'bop_feet' => request()->bop_feet,
            'jumlah_hpp_feet' => request()->jumlah_hpp_feet,
        ]);
        return redirect(route('Standar HPP'))->with('edit', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            DataHppFeet::where('id', $id)->delete();

            // Validate the value...
        } catch (Throwable $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect(route('Standar HPP'))->with('delete', 'Data Berhasil Dihapus');
    }
}
