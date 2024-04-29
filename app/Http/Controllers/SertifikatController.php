<?php

namespace App\Http\Controllers;

use App\Models\DataImporter;
use App\Models\DataOrder;
use App\Models\MetilRecordsheet;
use App\Models\Sertifikat;
use Illuminate\Http\Request;

class SertifikatController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    return view('pages.penerimaan-jasa.sertifikat', [
      'sertifikat' => Sertifikat::get(),
      'dataOrder' => DataOrder::get(),
      'dataImporter' => DataImporter::get(),
      'metilRecordsheet' => MetilRecordsheet::get(),
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
    Sertifikat::create([
      'id_sertif'       => $request->id_sertif,
      'id_reg'          => $request->id_reg,
      'id_importer'     => $request->id_importer,
      'id_recordsheet'  => $request->id_recordsheet,
      'id_order'        => $request->id_order,
      'target'          => $request->target,
      'commodity'       => $request->commodity,
      'consignment'     => $request->consignment,
      'country'         => $request->country,
      'pol'             => $request->pol,
      'destination'     => $request->destination,
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
      'commodity'       => $request->commodity,
      'consignment'     => $request->consignment,
      'country'         => $request->country,
      'pol'             => $request->pol,
      'destination'     => $request->destination,
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
    Sertifikat::where('id', $id)->delete();

    return redirect(route('Sertifikat'))->with('delete', 'Data Sertifikat Berhasil Dihapus');
  }
}
