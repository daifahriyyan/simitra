<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\Invoice;
use App\Models\RekapHpp;
use App\Models\DataHargar;
use Illuminate\Http\Request;
use App\Models\RekapPenjualan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class RekapHPPStandarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->posisi == null) {
          return redirect()->route('Home');
          
        } else if (Auth::user()->posisi == 'Direktur' || Auth::user()->posisi == 'Keuangan') {
            if (isset(request()->tanggalMulai) && isset(request()->tanggalAkhir) && isset(request()->volume)) {
                $tanggalMulai = request()->tanggalMulai;
                $tanggalAkhir = request()->tanggalAkhir;
                $volume = request()->volume;
                $rekapHppStandar = Invoice::whereHas('dataHarga', function ($query) use ($volume) {
                    $query->where('volume', $volume);
                })->whereBetween('tanggal_invoice', [$tanggalMulai, $tanggalAkhir])->get();
            } else if(isset(request()->tanggalMulai) && isset(request()->tanggalAkhir)) {
                $tanggalMulai = request()->tanggalMulai;
                $tanggalAkhir = request()->tanggalAkhir;
                $rekapHppStandar = Invoice::whereBetween('tanggal_invoice', [$tanggalMulai, $tanggalAkhir])->get();
            } else if (isset(request()->volume)) {
                $volume = request()->volume;
                $rekapHppStandar = Invoice::whereHas('dataHarga', function ($query) use ($volume) {
                    $query->where('volume', $volume);
                })->get();
            } else {
                $rekapHppStandar = Invoice::get();
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
                $pdf = Pdf::loadView('generate-pdf.tabel_rekap_hpp_standar', ['rekapHppStandar' => $rekapHppStandar, 'JumlahTotalHPP' => 0])->setPaper('a4');
                return $pdf->stream('Rekap Hpp Standar.pdf');
            }
            return view("pages.akuntansi.rekap-hpp-standar", [
                'rekapHPPStandar' => $rekapHppStandar,
                'dataHarga' => DataHargar::get(),
                'rekapPenjualan' => RekapPenjualan::get(),
                'JumlahTotalHPP' => 0
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
        $quantity = intval(RekapPenjualan::where('id', request()->id_rekap_penjualan)->get()->first()->dataOrder->jumlah_order);
        $hpp = intval(DataHargar::where('id', request()->id_data_standar)->get()->first()->hpp);
        $totalHpp = $quantity * $hpp;

        RekapHpp::create([
            'id_rekap' => $request['id_rekap'],
            'tanggal_input' => $request['tanggal_input'],
            'id_data_harga' => $request['id_data_standar'],
            'id_rekap_penjualan' => $request['id_rekap_penjualan'],
            'total_hpp' => $totalHpp,
        ]);

        return redirect()->route('Rekap HPP Standar')->with('success', 'Data Berhasil Ditambahkan');
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
        $quantity = RekapPenjualan::get()->first()->dataOrder->jumlah_order;
        $hpp = DataHargar::get()->first()->hpp;
        $totalHpp = $quantity * $hpp;

        RekapHpp::where('id', $id)->update([
            'id_rekap' => $request['id_rekap'],
            'tanggal_input' => $request['tanggal_input'],
            'id_data_harga' => $request['id_data_standar'],
            'id_rekap_penjualan' => $request['id_rekap_penjualan'],
            'total_hpp' => $totalHpp,
        ]);

        return redirect()->route('Rekap HPP Standar')->with('edit', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            RekapHPP::where('id', $id)->delete();

            // Validate the value...
        } catch (Throwable $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect()->route('Rekap HPP Standar')->with('hapus', 'Data Berhasil Dihapus');
    }
}
