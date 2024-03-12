<?php

namespace App\Http\Controllers;

use App\Models\DataCustomer as ModelsDataCustomer;
use Illuminate\Http\Request;

class DataCustomer extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    return view('pages.penerimaan-jasa.customer', [
      'title' => 'Data Customer',
      'records' => ModelsDataCustomer::all()
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
  public function store()
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

    ModelsDataCustomer::create($validator);
    return redirect(route('Data Customer'))->with('add', 'Data Berhasil Ditambahkan');
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
  public function update($id)
  {
    request()->validate([
      'id_customer' => 'required',
      'nama_customer' => 'required',
      'alamat_customer' => 'required',
      'telp_customer' => 'required',
      'email_customer' => 'required',
      'pic' => 'required',
      'phone_pic' => 'required',
    ]);

    $DataCustomer = ModelsDataCustomer::where('id_customer', '=', $id)->first();
    $DataCustomer->id_customer = request('id_customer');
    $DataCustomer->nama_customer = request('nama_customer');
    $DataCustomer->alamat_customer = request('alamat_customer');
    $DataCustomer->telp_customer = request('telp_customer');
    $DataCustomer->email_customer = request('email_customer');
    $DataCustomer->pic = request('pic');
    $DataCustomer->phone_pic = request('phone_pic');
    $DataCustomer->update();

    return redirect(route('Data Customer'))->with('edit', 'Data Berhasil Dirubah');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy($id)
  {
    ModelsDataCustomer::where('id_customer', $id)->delete();
    
    return redirect(route('Data Customer'))->with('delete', 'Data Berhasil Dihapus');
  }
}
