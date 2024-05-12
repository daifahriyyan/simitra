<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\DataOrder;
use Illuminate\Http\Request;
use App\Models\VerifikasiOrder;

class VerifikasiOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.operasional.verifikasi-order', [
            'dataOrder' => DataOrder::get(),
            'verifikasi' => VerifikasiOrder::get(),
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
        VerifikasiOrder::create([
            'id_verifikasi' => $request['id_verifikasi'],
            'id_order' => $request['id_order'],
            'waktu' => $request['waktu'],
            'tujuan' => $request['tujuan'],
            'destination' => $request['destination'],
            'packing' => $request['packing'],
            'kondisi_status' => $request['kondisi_status'],
            'place_fumigation' => $request['place_fumigation'],
            'kesimpulan' => $request['kesimpulan'],
        ]);

        return redirect(route('Verifikasi Order'))->with('success', 'Anda Berhasil Memverifikasi Data Order');
    }

    /**
     * Display the specified resource.
     */
    public function show(VerifikasiOrder $verifikasiOrder)
    {
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML('<h1>Hello world!</h1>');
        $mpdf->Output();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VerifikasiOrder $verifikasiOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        VerifikasiOrder::where('id', $id)->update([
            'id_verifikasi' => $request['id_verifikasi'],
            'id_order' => $request['id_order'],
            'waktu' => $request['waktu'],
            'tujuan' => $request['tujuan'],
            'destination' => $request['destination'],
            'packing' => $request['packing'],
            'kondisi_status' => $request['kondisi_status'],
            'place_fumigation' => $request['place_fumigation'],
            'kesimpulan' => $request['kesimpulan'],
        ]);

        return redirect(route('Verifikasi Order'))->with('edit', 'Anda Berhasil Merubah Verifikasi Data Order');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            VerifikasiOrder::where('id', $id)->delete();

            // Validate the value...
        } catch (Throwable $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect(route('Verifikasi Order'))->with('delete', 'Data Verifikasi Berhasil Dihapus');
    }
}
