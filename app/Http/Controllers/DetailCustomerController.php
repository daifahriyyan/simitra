<?php

namespace App\Http\Controllers;

use App\Models\DataCustomer;
use App\Models\DetailCustomer;
use Illuminate\Http\Request;

class DetailCustomerController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    if (request()->get('status') == 'Lunas') {
      DetailCustomer::where('id', request()->get('id'))->update([
        'status' => request()->get('status')
      ]);

      return redirect()->route('Detail Customer');
    }
    return view('pages.penerimaan-jasa.detail-customer', [
      'title' => 'Detail Customer',
      'records' => DetailCustomer::with('dataCustomer')->get(),
      'customers' => DataCustomer::all()
    ]);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $validator = request()->validate([
      'id_customer' => 'required|unique:detail_customer,id_customer',
      'termin' => 'required',
      'tanggal_input' => 'required',
      'saldo_awal' => 'required',
      'total_penjualan' => 'required',
      'penerimaan' => 'required',
      'saldo_akhir' => 'required',
    ]);

    DetailCustomer::create($validator);
    return redirect(route('Detail Customer'))->with('add', 'Data Berhasil Ditambahkan');
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
    request()->validate([
      'id_customer' => 'required',
      'termin' => 'required',
      'tanggal_input' => 'required',
      'saldo_awal' => 'required',
      'total_penjualan' => 'required',
      'penerimaan' => 'required',
      'saldo_akhir' => 'required',
    ]);

    $DataCustomer = DetailCustomer::where('id_customer', '=', $id)->first();
    $DataCustomer->id_customer = request('id_customer');
    $DataCustomer->termin = request('termin');
    $DataCustomer->tanggal_input = request('tanggal_input');
    $DataCustomer->saldo_awal = request('saldo_awal');
    $DataCustomer->total_penjualan = request('total_penjualan');
    $DataCustomer->penerimaan = request('penerimaan');
    $DataCustomer->saldo_akhir = request('saldo_akhir');
    $DataCustomer->update();

    return redirect(route('Detail Customer'))->with('edit', 'Data Berhasil Dirubah');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy($id)
  {
    DetailCustomer::where('id', $id)->delete();

    return redirect(route('Detail Customer'))->with('delete', 'Data Berhasil Dihapus');
  }
}
