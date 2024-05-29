<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataPersediaan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class PersediaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->posisi == null) {
            return redirect()->route('Home');
        } else {
            $persediaan = DataPersediaan::get();
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
                $pdf = Pdf::loadView('generate-pdf.tabel_persediaan', ['persediaan' => $persediaan])->setPaper('a4');
                return $pdf->stream('Daftar Persediaan.pdf');
            }
            return view('pages.master.persediaan', [
                'title' => 'Persediaan',
                'records' => $persediaan
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
        $validator = request()->validate([
            'id_persediaan' => 'required',
            'nama_persediaan' => 'required',
            'quantity' => 'required',
            'saldo' => 'required',
        ]);

        DataPersediaan::create($validator);
        return redirect(route('Persediaan'))->with('add', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(DataPersediaan $dataPersediaan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DataPersediaan $dataPersediaan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = request()->validate([
            'id_persediaan' => 'required',
            'nama_persediaan' => 'required',
            'quantity' => 'required',
            'saldo' => 'required',
        ]);

        DataPersediaan::where('id', '=', $id)->update($validator);
        return redirect(route('Persediaan'))->with('add', 'Data Berhasil Ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DataPersediaan::where('id', $id)->delete();

        return redirect(route('Persediaan'))->with('delete', 'Data Berhasil Dihapus');
    }
}
