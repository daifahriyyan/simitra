<?php

namespace App\Http\Controllers;

use App\Models\DataHargar;
use App\Models\DataOrder;
use App\Models\DetailOrder;
use App\Models\Invoice;
use App\Models\MetilRecordsheet;
use App\Models\Sertifikat;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.penerimaan-jasa.invoice', [
            'invoice' => Invoice::get(),
            'dataSertif' => Sertifikat::get(),
            'dataOrder' => DataOrder::get(),
            'recordsheet' => MetilRecordsheet::get(),
            'dataHarga' => DataHargar::get(),
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
        $dataHarga = DataHargar::where('id', $request['id_data_standar'])->get()->first();
        $totalPenjualan = $dataHarga->harga_jual * $dataOrder->jumlah_order;
        Invoice::create([
            'id_invoice' => $request['id_invoice'],
            'tanggal_invoice' => $request['tanggal_invoice'],
            'id_order' => $request['id_order'],
            'id_sertif' => $request['id_sertif'],
            'no_bl' => $request['no_bl'],
            'shipper' => $request['shipper'],
            'stuffing_date' => $request['stuffing_date'],
            'closing_time' => $request['closing_time'],
            'id_recordsheet' => $request['id_recordsheet'],
            'id_data_standar' => $request['id_data_standar'],
            'total_penjualan' => $totalPenjualan,
            'ppn' => $request['ppn'],
            'jumlah_dibayar' => $totalPenjualan + ($totalPenjualan * $request['ppn']),
        ]);

        return redirect(route('Invoice'))->with('success', 'Data Invoice Berhasil ditambahkan');
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
        $dataHarga = DataHargar::where('id', $request['id_data_standar'])->get()->first();
        $totalPenjualan = $dataHarga->harga_jual * $dataOrder->jumlah_order;
        Invoice::where('id', $id)->update([
            'id_invoice' => $request['id_invoice'],
            'tanggal_invoice' => $request['tanggal_invoice'],
            'id_order' => $request['id_order'],
            'id_sertif' => $request['id_sertif'],
            'no_bl' => $request['no_bl'],
            'shipper' => $request['shipper'],
            'stuffing_date' => $request['stuffing_date'],
            'closing_time' => $request['closing_time'],
            'id_recordsheet' => $request['id_recordsheet'],
            'id_data_standar' => $request['id_data_standar'],
            'total_penjualan' => $totalPenjualan,
            'ppn' => $request['ppn'],
            'jumlah_dibayar' => $totalPenjualan + ($totalPenjualan * $request['ppn']),
        ]);

        return redirect(route('Invoice'))->with('edit', 'Data Invoice Berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Invoice::where('id', $id)->delete();

        return redirect(route('Invoice'))->with('delete', 'Data Invoice Berhasil dihapus');
    }
}
