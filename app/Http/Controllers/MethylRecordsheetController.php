<?php

namespace App\Http\Controllers;

use App\Models\DataOrder;
use Illuminate\Http\Request;
use App\Models\MetilRecordsheet;
use Illuminate\Support\Facades\Storage;

class MethylRecordsheetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.operasional.methyl-recordsheet', [
            'dataOrder' => DataOrder::get(),
            'dataRecordsheet' => MetilRecordsheet::get()
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
    public function store(Request $request)
    {
        if (request()->hasFile('dokumen_metil_recordsheet')) {
            $MR = $request->file("dokumen_metil_recordsheet");
            $fileMR    = time() . "-" . $MR->getClientOriginalName();
            $uploadMR   = "metil_recordsheet/" . $fileMR;

            Storage::disk('public')->put($uploadMR, file_get_contents($MR));
        }

        MetilRecordsheet::create([
            'id_recordsheet' => $request['id_recordsheet'],
            'id_order' => $request['id_order'],
            'tanggal_selesai' => $request['tanggal_selesai'],
            'daff_prescribed_doses_rate' => $request['daff_prescribed_doses_rate'],
            'forecast_minimum_temperature' => $request['forecast_minimum_temperature'],
            'exposure_period' => $request['exposure_period'],
            'applied_dose_rate' => $request['applied_dose_rate'],
            'dokumen_metil_recordsheet' => $fileMR,
        ]);

        return redirect(route('Methyl Recordsheet'))->with('success', 'Anda Berhasil Menambahkan Data Methyl Recordsheet');
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
        $metilRecordsheet = MetilRecordsheet::where('id', $id)->first();
        $fileMR = $metilRecordsheet->dokumen_metil_recordsheet;
        if (request()->hasFile("dokumen_metil_recordsheet")) {
            $MR = request()->file("dokumen_metil_recordsheet");
            $fileMR    = time() . "-" . $MR->getClientOriginalName();
            $uploadMR   = "metil_recordsheet/" . $fileMR;

            // Delete old file
            Storage::disk('public')->delete('metil_recordsheet/' . $metilRecordsheet->dokumen_metil_recordsheet);

            // Upload new file
            Storage::disk('public')->put($uploadMR, file_get_contents($MR));
        }
        MetilRecordsheet::where('id', $id)->update([
            'id_recordsheet' => $request['id_recordsheet'],
            'id_order' => $request['id_order'],
            'tanggal_selesai' => $request['tanggal_selesai'],
            'daff_prescribed_doses_rate' => $request['daff_prescribed_doses_rate'],
            'forecast_minimum_temperature' => $request['forecast_minimum_temperature'],
            'exposure_period' => $request['exposure_period'],
            'applied_dose_rate' => $request['applied_dose_rate'],
            'dokumen_metil_recordsheet' => $fileMR,
        ]);

        return redirect(route('Methyl Recordsheet'))->with('edit', 'Data Methyl Recordsheet Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ceklistFumigasi = MetilRecordsheet::where('id', $id)->first();

        // Delete file from storage if it exists
        Storage::disk('public')->delete('metil_recordsheet/' . $ceklistFumigasi->dokumen_metil_recordsheet);

        MetilRecordsheet::where('id', $id)->delete();

        return redirect(route('Methyl Recordsheet'))->with('delete', 'Data Methyl Recordsheet Berhasil Dihapus');
    }
}