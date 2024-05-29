<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\DataOrder;
use App\Models\Sertifikat;
use App\Models\DetailOrder;
use App\Models\DataImporter;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\MetilRecordsheet;
use Illuminate\Support\Facades\Auth;

class SertifikatController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    if (Auth::user()->posisi == null) {
      return redirect()->route('Home');
      
    } else if (Auth::user()->posisi == 'Direktur' || Auth::user()->posisi == 'Administrasi') {
      if (isset(request()->tanggalMulai) && isset(request()->tanggalAkhir)) {
        $tanggalMulai = request()->tanggalMulai;
        $tanggalAkhir = request()->tanggalAkhir;
        $sertifikat = Sertifikat::whereBetween('tanggal_sertif', [$tanggalMulai, $tanggalAkhir])->get();
      } else {
        $sertifikat = Sertifikat::get();
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
        $pdf = Pdf::loadView('generate-pdf.tabel-sertifikat', ['sertifikat' => $sertifikat])->setPaper('a4', 'landscape');
        return $pdf->stream('Daftar Sertifikat.pdf');
      } else if (request()->get('export') == 'pdf-detail') {
        $detail = DetailOrder::where('id_detailorder', request()->id_detailorder)->get()->first();
        Pdf::setOption([
          'enabled' => true,
          'isRemoteEnabled' => true,
          'chroot' => realpath(''),
          'isPhpEnabled' => true,
          'isFontSubsettingEnabled' => true,
          'pdfBackend' => 'CPDF',
          'isHtml5ParserEnabled' => true
        ]);
        $pdf = Pdf::loadView('generate-pdf.request-order', ['detail' => $detail])->setPaper('a4');
        return $pdf->stream('Request Order.pdf');
      }
  
      if (request()->get('verif') !== null) {
        DetailOrder::where('id', request()->get('verif'))->update([
          'verifikasi' => 4
        ]);
      }
      return view('pages.penerimaan-jasa.sertifikat', [
        'sertifikat' => $sertifikat,
        'dataOrder' => DetailOrder::get(),
        'dataImporter' => DataImporter::get(),
        'metilRecordsheet' => MetilRecordsheet::get(),
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
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    Sertifikat::create([
      'id_sertif'       => $request->id_sertif,
      'id_reg'          => $request->id_reg,
      'id_importer'     => $request->id_importer,
      'id_recordsheet'  => $request->id_recordsheet,
      'id_order'        => $request->id_order,
      'target'          => $request->target,
      'consignment'     => $request->consignment,
      'country'         => $request->country,
      'pol'             => $request->pol,
      'attn'            => $request->attn,
      'tin'             => $request->tin,
      'wrapping'        => $request->wrapping,
      'tanggal_sertif'  => $request->tanggal_sertif,
      'no_reg'          => $request->no_reg,
    ]);

    return redirect(route('Sertifikat'))->with('success', 'Data Sertifikat Berhasil Ditambahkan');
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
    Sertifikat::where('id', $id)->update([
      'id_sertif'       => $request->id_sertif,
      'id_reg'          => $request->id_reg,
      'target'          => $request->target,
      'consignment'     => $request->consignment,
      'country'         => $request->country,
      'pol'             => $request->pol,
      'id_order'        => $request->id_order,
      'attn'            => $request->attn,
      'tin'             => $request->tin,
      'id_importer'     => $request->id_importer,
      'id_recordsheet'  => $request->id_recordsheet,
      'wrapping'        => $request->wrapping,
      'tanggal_sertif'  => $request->tanggal_sertif,
      'no_reg'          => $request->no_reg,
    ]);

    return redirect(route('Sertifikat'))->with('edit', 'Data Sertifikat Berhasil Diubah');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    try {
      Sertifikat::where('id', $id)->delete();

      // Validate the value...
    } catch (Throwable $e) {
      return back()->with('error', $e->getMessage());
    }

    return redirect(route('Sertifikat'))->with('delete', 'Data Sertifikat Berhasil Dihapus');
  }
}
