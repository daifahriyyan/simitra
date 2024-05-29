<?php

namespace App\Http\Controllers;

use App\Models\KeuSupplier;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->posisi == null) {
          return redirect()->route('Home');
          
        } else if (Auth::user()->posisi == 'Direktur' || Auth::user()->posisi == 'Keuangan') {
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
                $pdf = Pdf::loadView('generate-pdf.tabel-supplier', ['keuSupplier' => KeuSupplier::get()])->setPaper('a4');
                return $pdf->stream('Daftar Supplier.pdf');
            }
            return view('pages.akuntansi.supplier', [
                'keuSupplier' => KeuSupplier::get()
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
