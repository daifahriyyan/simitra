<?php

namespace App\Http\Controllers;

use App\Models\DataOrder;
use App\Models\DataCustomer;
use App\Models\DataHargar;
use App\Models\DetailOrder;
use Illuminate\Http\Request;

class DataOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.penerimaan-jasa.order', [
            'title' => 'Data Order',
            'dataCustomers' => DataCustomer::all(), 
            'hargaJasa' => DataHargar::all(), 
            'dataOrder' => DataOrder::with('dataCustomer')->get(),
            'detailOrder' => DetailOrder::get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $id_customer = $_GET['id_customer'];
        $data_customer = DataCustomer::where('id_customer', $id_customer)->get();
        $data = array(
                    'nama'      =>  $data_customer[0]->id_customer,
                    'jeniskelamin'=>  $data_customer[0]->nama_customer,
                    'jurusan'   =>  $data_customer[0]->alamat_customer,
                    'notelp'      =>  $data_customer[0]->telp_customer,
                    'email'      =>  $data_customer[0]->email_customer,
                    'alamat'    =>  $data_customer[0]->alamat
                );
        
        //tampil data
        echo json_encode($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = request()->validate([
          'id_order' => 'required|unique:data_order,id_order',
          'id_order_container' => 'required|unique:data_order,id_order_container',
          'tanggal_order' => 'required',
          'id_customer' => 'required',
          'nama_customer' => 'required',
          'telp_customer' => 'required',
          'jumlah_order' => 'required',
          'treatment' => 'required',
          'stuffing_date' => 'required',
          'id_datastandar' => 'required',
          'volume' => 'required',
          'container' => 'required',
          'container_volume' => 'required',
          'commodity' => 'required',
          'vessel' => 'required',
          'place_fumigation' => 'required',
          'pic' => 'required',
          'phone_pic' => 'required',
        ]);
    
        DataOrder::create($validator);
        return redirect(route('Detail Customer'))->with('add', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(DataOrder $dataOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DataOrder $dataOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DataOrder $dataOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DataOrder $dataOrder, $id)
    {

        $idOrder = DetailOrder::where('id', $id)->get()->first()->id_order;
        DetailOrder::where('id', $id)->delete();
        DataOrder::where('id', $idOrder)->delete();

        return redirect(route('Data Order'));
    }

    public function ajaxOrder()
    {

        $data = DataCustomer::where('id', request()->id)->get();

        return json_encode($data);
    }
}
