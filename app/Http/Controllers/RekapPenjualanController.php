<?php

namespace App\Http\Controllers;

use App\Models\DataHargar;
use Throwable;
use App\Models\Invoice;
use App\Models\DataOrder;
use Illuminate\Http\Request;
use App\Models\RekapPenjualan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class RekapPenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->posisi == null) {
          return redirect()->route('Home');
          
        } else if (Auth::user()->posisi == 'Direktur' || Auth::user()->posisi == 'Administrasi') {
            if (isset(request()->tanggalMulai) && isset(request()->tanggalAkhir) && isset(request()->volume)) {
                $tanggalMulai = request()->tanggalMulai;
                $tanggalAkhir = request()->tanggalAkhir;
                $volume = request()->volume;
                $rekapPenjualan = Invoice::whereHas('dataHarga', function ($query) use ($volume) {
                    $query->where('volume', $volume);
                })->whereBetween('tanggal_invoice', [$tanggalMulai, $tanggalAkhir])->get();
            } else if(isset(request()->tanggalMulai) && isset(request()->tanggalAkhir)) {
                $tanggalMulai = request()->tanggalMulai;
                $tanggalAkhir = request()->tanggalAkhir;
                $rekapPenjualan = Invoice::whereBetween('tanggal_invoice', [$tanggalMulai, $tanggalAkhir])->get();
            } else if (isset(request()->volume)) {
                $volume = request()->volume;
                $rekapPenjualan = Invoice::whereHas('dataHarga', function ($query) use ($volume) {
                    $query->where('volume', $volume);
                })->get();
            } else {
                $rekapPenjualan = Invoice::get();
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
                $pdf = Pdf::loadView('generate-pdf.Rekap-Penjualan', ['rekapPenjualan' => $rekapPenjualan])->setPaper('a4');
                return $pdf->stream('Daftar Pegawai.pdf');
            }
    
            return view('pages.penerimaan-jasa.rekap-penjualan', [
                'rekapPenjualan' => $rekapPenjualan,
                'id_rekapPenjualan' => RekapPenjualan::latest()->get()->first()->id ?? 1,
                'dataHarga' => DataHargar::get(),
                'invoice' => Invoice::get(),
                'dataOrder' => DataOrder::get(),
                'jumlahTotalPenjualan' => 0,
                'jumlahJumlahDibayar' => 0
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
        $dataOrder = DataOrder::where('id', $request['id_order'])->get()->first();
        $totalPenjualan = $dataOrder->volume * $dataOrder->jumlah_order;
        RekapPenjualan::create([
            'id_rekap_penjualan' => $request['id_rekap_penjualan'],
            'id_invoice' => $request['id_invoice'],
            'id_order' => $request['id_order'],
            'total_penjualan' => $totalPenjualan,
        ]);

        return redirect(route('Rekap Penjualan'))->with('success', 'Rekap Penjualan Berhasil Ditambahkan');
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
        $dataOrder = DataOrder::where('id', $request['id_order'])->get()->first();
        $totalPenjualan = $dataOrder->volume * $dataOrder->jumlah_order;
        RekapPenjualan::where('id', $id)->update([
            'id_rekap_penjualan' => $request['id_rekap_penjualan'],
            'id_invoice' => $request['id_invoice'],
            'id_order' => $request['id_order'],
            'total_penjualan' => $totalPenjualan,
        ]);

        return redirect(route('Rekap Penjualan'))->with('edit', 'Rekap Penjualan Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            RekapPenjualan::where('id', $id)->delete();

            // Validate the value...
        } catch (Throwable $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect(route('Rekap Penjualan'))->with('delete', 'Rekap Penjualan Berhasil Dihapus');
    }
}
