<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataPersyaratan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DokumenOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->posisi == null) {
          return redirect()->route('Home');

        } else if (Auth::user()->posisi == 'Direktur' || Auth::user()->posisi == 'Administrasi') {
            return view('pages.penerimaan-jasa.dokumen-order', [
                'title' => 'Dokumen Order',
                'records' => DataPersyaratan::get()
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
        $this->validate(request(),[
          'id_order' => 'required',
          'id_order_container' => 'required',
          'nama_driver' => 'required',
          'telp_driver' => 'required',
          'shipment_instruction' => 'required',
          'packing_list' => 'required',
        ]);

        $shipment_instruction = $request->file('shipment_instruction');
        $fileSI = time()."-".$shipment_instruction->getClientOriginalName();
        $tujuanSI = 'Shipment_instruction/'.$fileSI;

        $packing_list = $request->file('packing_list');
        $filePL = time()."-".$packing_list->getClientOriginalName();
        $tujuanPL = 'Packing_list/'.$fileSI;

        Storage::disk('public')->put($tujuanSI, file_get_contents($shipment_instruction));
        Storage::disk('public')->put($tujuanPL, file_get_contents($packing_list));

        $storeData = new DataPersyaratan();
        $storeData->id_order = $request->id_order;
        $storeData->id_order_container = $request->id_order_container;
        $storeData->nama_driver = $request->nama_driver;
        $storeData->telp_driver = $request->telp_driver;
        $storeData->shipment_instruction = $fileSI;
        $storeData->packing_list = $filePL;
        $storeData->save();
    
        return redirect(route('Dokumen Order'))->with('add', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(DataPersyaratan $dataPersyaratan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DataPersyaratan $dataPersyaratan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = request()->validate([
            'id_order'              => 'required',
            'id_order_container'    => 'required',
            'nama_driver'           => 'required',
            'telp_driver'           => 'required',
            'shipment_instruction'  => 'required',
            'packing_list'          => 'required',
        ]);
    
        DataPersyaratan::where('id', '=', $id)->update($validator);
        return redirect(route('Dokumen Order'))->with('add', 'Data Berhasil Ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = DataPersyaratan::where('id', $id)->get();

        Storage::disk('public')->delete('Shipment_instruction/'.$data[0]->shipment_instruction);
        Storage::disk('public')->delete('Packing_list/'.$data[0]->packing_list);

        DataPersyaratan::where('id', $id)->delete();
        
        return redirect(route('Dokumen Order'))->with('delete', 'Data Berhasil Dihapus');
    }
}
