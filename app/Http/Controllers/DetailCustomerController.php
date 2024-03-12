<?php

namespace App\Http\Controllers;

use App\Models\DetailCustomer;
use Illuminate\Http\Request;

class DetailCustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.penerimaan-jasa.detail-customer', [
            'title' => 'Detail Customer'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $validator = request()->validate([
            'id_customer' => 'required|unique:data_customer,id_customer',
            'nama_customer' => 'required',
            'alamat_customer' => 'required',
            'telp_customer' => 'required',
            'email_customer' => 'required',
            'pic' => 'required',
            'phone_pic' => 'required',
        ]);

        DetailCustomer::create($validator);
        return redirect(route('Customer'))->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
