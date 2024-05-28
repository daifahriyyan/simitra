<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\DataCustomer;
use Illuminate\Http\Request;
use App\Models\DetailCustomer;
use Barryvdh\DomPDF\Facade\Pdf;

class DetailCustomerController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    if (isset(request()->tanggalMulai) && isset(request()->tanggalAkhir)) {
      $tanggalMulai = request()->tanggalMulai;
      $tanggalAkhir = request()->tanggalAkhir;
      $detailCustomer = DetailCustomer::whereBetween('tanggal_input', [$tanggalMulai, $tanggalAkhir])->get();
    } else {
      $detailCustomer = DetailCustomer::get();
    }

    if (request()->get('export') == 'pdf') {
      Pdf::setOption([
        'enabled' => true,
        'isRemoteEnabled' => true,
        'chroot' => realpath(''),
        'isPhpEnabled' => true,
        'isFontSubsettingEnabled' => true,
        'pdfBackend' => 'CPDF',
        'isHtml5ParserEnabled' => true
      ]);
      $pdf = Pdf::loadView('generate-pdf.tabel-detail-customer', ['detailCustomer' => $detailCustomer])->setPaper('a4');
      return $pdf->stream('Daftar Detail Customer.pdf');
    }

    if (request()->get('export') == 'pdf') {
      $detailCustomer = DetailCustomer::with('dataCustomer')->where('id', request()->get('id_customer'))->get()->first();
      Pdf::setOption([
        'enabled' => true,
        'isRemoteEnabled' => true,
        'chroot' => realpath(''),
        'isPhpEnabled' => true,
        'isFontSubsettingEnabled' => true,
        'pdfBackend' => 'CPDF',
        'isHtml5ParserEnabled' => true
      ]);
      $pdf = Pdf::loadView('generate-pdf.detail-customer', ['detailCustomer' => $detailCustomer])->setPaper('a4');
      return $pdf->stream('Detail Customer.pdf');
    }

    if (request()->get('status') == 'Lunas') {
      DetailCustomer::where('id', request()->get('id'))->update([
        'status' => request()->get('status')
      ]);

      return redirect()->route('Detail Customer');
    }

    return view('pages.penerimaan-jasa.detail-customer', [
      'title' => 'Detail Customer',
      'records' => $detailCustomer,
      'id_detail_customer' => DetailCustomer::latest()->get()->first()->id ?? 1,
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
    $termin = explode('/', $request->termin);
    $tglJatuhTempo = date("Y-m-d", strtotime("+$termin[1] days", strtotime($request['tanggal_input'])));

    DetailCustomer::create([
      'id_detail_customer' => request()->id_detail_customer,
      'id_customer' => request()->id_customer,
      'termin' => request()->termin,
      'tanggal_input' => request()->tanggal_input,
      'saldo_awal' => request()->saldo_awal,
      'total_penjualan' => request()->total_penjualan,
      'penerimaan' => request()->penerimaan,
      'saldo_akhir' => request()->saldo_akhir,
      'tanggal_jatuh_tempo' => $tglJatuhTempo,
    ]);
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
    try {
      DetailCustomer::where('id', $id)->delete();
      // Validate the value...
    } catch (Throwable $e) {
      return back()->with('error', $e->getMessage());
    }

    return redirect(route('Detail Customer'))->with('delete', 'Data Berhasil Dihapus');
  }
}
