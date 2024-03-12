<?php

namespace App\Http\Controllers;
use App\Models\DataCustomer;
use Illuminate\Http\Request;

class DataCustomerController extends Controller
{
    public function index(){
        return view('pages.penerimaan-jasa.customer', [
            'title' => 'Data Customer'
        ]);
    }

    public function store(){
        $validator = request()->validate([
            'id_customer' => 'required|unique:data_customer,id_customer',
            'nama_customer' => 'required',
            'alamat_customer' => 'required',
            'telp_customer' => 'required',
            'email_customer' => 'required',
            'pic' => 'required',
            'phone_pic' => 'required',
        ]);

        DataCustomer::create($validator);
        return redirect(route('Customer'))->with('success', 'Data Berhasil Ditambahkan');
    }

    public function update(){
        $validator = request()->validate([
            'id_customer' => 'required|unique:data_customer,id_customer',
            'nama_customer' => 'required',
            'alamat_customer' => 'required',
            'telp_customer' => 'required',
            'email_customer' => 'required',
            'pic' => 'required',
            'phone_pic' => 'required',
        ]);

        DataCustomer::where('id_customer', request('id_customer'))->update($validator);
        return redirect(route('Customer'))->with('success', 'Data Berhasil Ditambahkan');
    }
}
