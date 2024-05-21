<?php

namespace App\Http\Controllers;

use App\Models\DataHargar;
use App\Models\DataHppFeet;
use App\Models\KeuAkun;
use Illuminate\Http\Request;
use App\Models\KeuDetailJurnal;

class LapKeuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function bukuBesar()
    {
        $kode_akun = KeuAkun::where('kode_akun', request()->nama_akun)->get()->first()->id ?? 1;
        if (isset(request()->tanggalMulai) && isset(request()->tanggalAkhir)) {
            $jurnalUmum = KeuDetailJurnal::where('kode_akun', $kode_akun)->whereBetween('created_at', [request()->tanggalMulai, request()->tanggalAkhir])->get();
        } else {
            $jurnalUmum = KeuDetailJurnal::where('kode_akun', $kode_akun)->get();
        }

        return view("pages.laporan-keuangan.buku-besar", [
            // ambil seluruh data Detail Jurnal
            'jurnalUmum' => $jurnalUmum,
            'akun' => KeuAkun::get(),
            'akunSelected' => KeuAkun::where('kode_akun', request()->nama_akun ?? '1110')->get()->first(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function neracaSaldo()
    {
        return view('pages.laporan-keuangan.neraca-saldo', [
            'neracaSaldo' => KeuAkun::get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function hpp()
    {
        if (isset(request()->tanggalMulai) && isset(request()->tanggalAkhir)) {
            $DataHarga = DataHargar::whereBetween('created_at', [request()->tanggalMulai, request()->tanggalAkhir])->get();
        } else {
            $DataHarga = DataHargar::get();
        }
        return view('pages.laporan-keuangan.hpp', [
            'hpp' => $DataHarga
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function labaRugi()
    {
        if (isset(request()->bulan) && isset(request()->tahun)) {
            $beban = KeuAkun::where('kode_akun', 'like', "52%")->whereMonth('created_at', request()->bulan)->whereYear('created_at', request()->tahun)->get();
            $hpp = DataHargar::whereMonth('created_at', request()->bulan)->whereYear('created_at', request()->tahun)->get();
            $pendapatan = KeuAkun::where('kode_akun', 'like', "41%")->whereMonth('created_at', request()->bulan)->whereYear('created_at', request()->tahun)->get();
        } else if (isset(request()->tahun)) {
            $beban = KeuAkun::where('kode_akun', 'like', "52%")->whereYear('created_at', request()->tahun)->get();
            $hpp = DataHargar::whereYear('created_at', request()->tahun)->get();
            $pendapatan = KeuAkun::where('kode_akun', 'like', "41%")->whereYear('created_at', request()->tahun)->get();
        } else if (isset(request()->bulan)) {
            $beban = KeuAkun::where('kode_akun', 'like', "52%")->whereMonth('created_at', request()->bulan)->get();
            $hpp = DataHargar::whereMonth('created_at', request()->bulan)->get();
            $pendapatan = KeuAkun::where('kode_akun', 'like', "41%")->whereMonth('created_at', request()->bulan)->get();
        } else {
            $beban = KeuAkun::where('kode_akun', 'like', "52%")->get();
            $hpp = DataHargar::get();
            $pendapatan = KeuAkun::where('kode_akun', 'like', "41%")->get();
        }

        return view('pages.laporan-keuangan.laba-rugi', [
            'beban' => $beban,
            'hpp' => $hpp,
            'pendapatan' => $pendapatan,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function posKeu()
    {
        if (isset(request()->bulan) && isset(request()->tahun)) {
            $asetLancar = KeuAkun::where('kode_akun', 'like', '11%')->whereMonth('created_at', request()->bulan)->whereYear('created_at', request()->tahun)->get()->all();
            $asetTetap = KeuAkun::where('kode_akun', 'like', '12%')->whereMonth('created_at', request()->bulan)->whereYear('created_at', request()->tahun)->get()->all();
            $kewajibanJkPdk = KeuAkun::where('kode_akun', 'like', '21%')->whereMonth('created_at', request()->bulan)->whereYear('created_at', request()->tahun)->get()->all();
            $kewajibanJkPjg = KeuAkun::where('kode_akun', 'like', '22%')->whereMonth('created_at', request()->bulan)->whereYear('created_at', request()->tahun)->get()->all();
            $ekuitas = KeuAkun::where('kode_akun', 'like', '3%')->whereMonth('created_at', request()->bulan)->whereYear('created_at', request()->tahun)->get()->all();
        } else if (isset(request()->tahun)) {
            $asetLancar = KeuAkun::where('kode_akun', 'like', '11%')->whereYear('created_at', request()->tahun)->get()->all();
            $asetTetap = KeuAkun::where('kode_akun', 'like', '12%')->whereYear('created_at', request()->tahun)->get()->all();
            $kewajibanJkPdk = KeuAkun::where('kode_akun', 'like', '21%')->whereYear('created_at', request()->tahun)->get()->all();
            $kewajibanJkPjg = KeuAkun::where('kode_akun', 'like', '22%')->whereYear('created_at', request()->tahun)->get()->all();
            $ekuitas = KeuAkun::where('kode_akun', 'like', '3%')->whereYear('created_at', request()->tahun)->get()->all();
        } else if (isset(request()->bulan)) {
            $asetLancar = KeuAkun::where('kode_akun', 'like', '11%')->whereMonth('created_at', request()->bulan)->get()->all();
            $asetTetap = KeuAkun::where('kode_akun', 'like', '12%')->whereMonth('created_at', request()->bulan)->get()->all();
            $kewajibanJkPdk = KeuAkun::where('kode_akun', 'like', '21%')->whereMonth('created_at', request()->bulan)->get()->all();
            $kewajibanJkPjg = KeuAkun::where('kode_akun', 'like', '22%')->whereMonth('created_at', request()->bulan)->get()->all();
            $ekuitas = KeuAkun::where('kode_akun', 'like', '3%')->whereMonth('created_at', request()->bulan)->get()->all();
        } else {
            $asetLancar = KeuAkun::where('kode_akun', 'like', '11%')->get()->all();
            $asetTetap = KeuAkun::where('kode_akun', 'like', '12%')->get()->all();
            $kewajibanJkPdk = KeuAkun::where('kode_akun', 'like', '21%')->get()->all();
            $kewajibanJkPjg = KeuAkun::where('kode_akun', 'like', '22%')->get()->all();
            $ekuitas = KeuAkun::where('kode_akun', 'like', '3%')->get()->all();
        }
        return view('pages.laporan-keuangan.posisi-keuangan', [
            'asetLancar' => $asetLancar,
            'asetTetap' => $asetTetap,
            'kewajibanJkPdk' => $kewajibanJkPdk,
            'kewajibanJkPjg' => $kewajibanJkPjg,
            'ekuitas' => $ekuitas,
            'jumlah_aset_lancar' => 0,
            'jumlah_aset_tetap' => 0,
            'jumlah_kewajiban_jkpdk' => 0,
            'jumlah_kewajiban_jkpjg' => 0,
            'jumlah_ekuitas' => 0
        ]);
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
