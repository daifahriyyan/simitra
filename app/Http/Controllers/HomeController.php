<?php

namespace App\Http\Controllers;

use App\Models\DataOrder;
use App\Models\DataHargar;
use App\Models\DetailOrder;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    //

    public function index()
    {
        return view('customer-side.index', [
            'data_harga' => DataHargar::get()
        ]);
    }

    public function formOrder()
    {
        return view('customer-side.form', [
            'jumlah_order' => request()->jumlah_order,
            'id_order' => isset(DataOrder::latest()->get()->first()->id) + 1,
        ]);
    }

    public function order(Request $request)
    {
        DataOrder::create([
            'id_order' => request()->id_order,
            'id_data_harga' => request()->id_data_harga,
            'tanggal_order' => request()->tanggal_order,
            'id_customer' => request()->id_customer,
            'treatment' => request()->treatment,
            'volume' => request()->volume,
            'place_fumigation' => request()->place_fumigation,
            'jumlah_order' => request()->jumlah_order,
        ]);

        $id = DataOrder::latest()->get()->first()->id;
        for ($i = 1; $i <= $request["jumlah_order"]; $i++) {

            if (request()->hasFile("shipment_instruction$i")) {
                $SI = $request->file("shipment_instruction$i");
                $fileSI    = time() . "-" . $SI->getClientOriginalName();
                $uploadSI   = "shipment_instruction/" . $fileSI;
                Storage::disk('public')->put($uploadSI, file_get_contents($SI));
            }

            if (request()->hasFile("packing_list$i")) {
                $PL = $request->file("packing_list$i");
                $filePL    = time() . "-" . $PL->getClientOriginalName();
                $uploadPL   = "packing_list/" . $filePL;
                Storage::disk('public')->put($uploadPL, file_get_contents($PL));
            }

            DetailOrder::create([
                'id_order' => $id,
                'id_detailorder' => $request["id_detailorder$i"],
                'stuffing_date' => $request["stuffing_date$i"],
                'container' => $request["container$i"],
                'container_volume' => $request["container_volume$i"],
                'commodity' => $request["commodity$i"],
                'vessel' => $request["vessel$i"],
                'closing_time' => $request["closing_time$i"],
                'destination' => $request["destination$i"],
                'nama_driver' => $request["nama_driver$i"],
                'telp_driver' => $request["telp_driver$i"],
                'shipment_instruction' => $fileSI,
                'packing_list' => $filePL,
            ]);
        }

        Notifikasi::create([
            'keterangan' => 'Mendapat Order Baru no. '.request()->id_order,
            'is_read' => 'N',
            'posisi' => 'Administrasi',
        ]);

        return redirect(route('Daftar Order'))->with('success', 'Data Order Berhasil Ditambah');
    }

    public function updateOrder()
    {
        $dataOrder = DetailOrder::where('id', request()->id_order)->get()->first();
        if (request()->hasFile("shipment_instruction")) {
            $SI = request()->file("shipment_instruction");
            $fileSI    = time() . "-" . $SI->getClientOriginalName();
            $uploadSI   = "shipment_instruction/" . $fileSI;
            Storage::disk('public')->delete("shipment_instruction/" . $dataOrder->shipment_instruction);
            Storage::disk('public')->put($uploadSI, file_get_contents($SI));
        }

        if (request()->hasFile("packing_list")) {
            $PL = request()->file("packing_list");
            $filePL    = time() . "-" . $PL->getClientOriginalName();
            $uploadPL   = "packing_list/" . $filePL;
            Storage::disk('public')->delete("packing_list/" . $dataOrder->packing_list);
            Storage::disk('public')->put($uploadPL, file_get_contents($PL));
        }

        DetailOrder::where('id', request()->id_order)->update([
            'shipment_instruction' => $fileSI,
            'packing_list' => $filePL,
            'is_reject' => '0'
        ]);

        return redirect()->back();
    }

    public function contact()
    {
        return view('customer-side.contact');
    }

    public function daftarOrder()
    {
        return view('customer-side.order', [
            'order' => DataOrder::where('id_customer', Auth::user()->dataCustomer->id)->get()
        ]);
    }

    public function statusOrder($id)
    {
        return view('customer-side.status-order', [
            'order' => DetailOrder::with('dataOrder')->where('id_order', $id)->get()
        ]);
    }
}
