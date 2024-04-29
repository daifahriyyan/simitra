<?php

namespace App\Http\Controllers;

use App\Models\BuktiPembayaran;
use App\Models\DataOrder;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BuktiPembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.penerimaan-jasa.bukti-pembayaran', [
            'title' => 'Bukti Pembayaran',
            'records' => BuktiPembayaran::get(),
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
        $this->validate(request(), [
            'id_invoice' => 'required',
            'id_order' => 'required',
            'tanggal_pembayaran' => 'required',
            'bukti_pembayaran' => 'required',
        ]);

        $buktiPembayaran = $request->file('bukti_pembayaran');
        $fileBP = time() . "-" . $buktiPembayaran->getClientOriginalName();
        $tujuanBP = 'Bukti_pembayaran/' . $fileBP;

        Storage::disk('public')->put($tujuanBP, file_get_contents($buktiPembayaran));

        $storeData = new BuktiPembayaran;
        $storeData->id_invoice = $request->id_invoice;
        $storeData->id_order = $request->id_order;
        $storeData->tanggal_pembayaran = $request->tanggal_pembayaran;
        $storeData->bukti_pembayaran = $fileBP;
        $storeData->save();

        return redirect(route('Bukti Pembayaran'))->with('add', 'Data Berhasil Ditambahkan');
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
            'id_invoice' => 'required',
            'id_order' => 'required',
            'tanggal_pembayaran' => 'required',
            'bukti_pembayaran' => 'required',
        ]);

        if ($request->hasFile('bukti_pembayaran')) {
            $buktiPembayaran = $request->file('bukti_pembayaran');
            $fileBP = time() . "-" . $buktiPembayaran->getClientOriginalName();
            $tujuanBP = 'Bukti_pembayaran/' . $fileBP;

            $data = BuktiPembayaran::where('id', $id)->get()->first();

            Storage::disk('public')->delete('Bukti_pembayaran/' . $data->bukti_pembayaran);

            Storage::disk('public')->put($tujuanBP, file_get_contents($buktiPembayaran));
        }

        $storeData = new BuktiPembayaran;
        $storeData->id_invoice = $request->id_invoice;
        $storeData->id_order = $request->id_order;
        $storeData->tanggal_pembayaran = $request->tanggal_pembayaran;
        $storeData->bukti_pembayaran = $fileBP;
        $storeData->save();

        return redirect(route('Bukti Pembayaran'))->with('add', 'Data Berhasil Ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = BuktiPembayaran::where('id', $id)->get()->first();

        Storage::disk('public')->delete('Bukti_pembayaran/' . $data->bukti_pembayaran);

        BuktiPembayaran::where('id', $id)->delete();

        return redirect(route('Bukti Pembayaran'))->with('delete', 'Data Berhasil Dihapus');
    }
}
