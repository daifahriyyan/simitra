<?php

namespace App\Http\Controllers;

use App\Models\KeuAkun;
use App\Models\DataHargar;
use App\Models\DataHppFeet;
use Illuminate\Http\Request;
use App\Models\HppSesungguhnya;
use App\Models\KeuDetailJurnal;
use App\Models\KeuLabaRugi;
use Barryvdh\DomPDF\Facade\Pdf;

class LapKeuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public
        $bulan = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];

    public function bukuBesar()
    {
        $kode_akun = KeuAkun::where('kode_akun', request()->nama_akun)->get()->first()->id ?? 1;
        $akunSelected = KeuAkun::where('kode_akun', request()->nama_akun ?? '1110')->get()->first();
        if (isset(request()->tanggalMulai) && isset(request()->tanggalAkhir)) {
            $jurnalUmum = KeuDetailJurnal::where('kode_akun', $kode_akun)->whereBetween('created_at', [request()->tanggalMulai, request()->tanggalAkhir])->get();
        } else {
            $jurnalUmum = KeuDetailJurnal::where('kode_akun', $kode_akun)->get();
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
            $pdf = Pdf::loadView('generate-pdf.lapkeu-buku-besar', ['jurnalUmum' => $jurnalUmum, 'akunSelected' => $akunSelected])->setPaper('a4');
            return $pdf->stream('Laporan Buku Besar.pdf');
        }

        return view("pages.laporan-keuangan.buku-besar", [
            // ambil seluruh data Detail Jurnal
            'jurnalUmum' => $jurnalUmum,
            'akun' => KeuAkun::get(),
            'akunSelected' => $akunSelected,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function neracaSaldo()
    {
        if (isset(request()->bulan) && isset(request()->tahun)) {
            $neracaSaldo = KeuAkun::orderBy('kode_akun', 'asc')->whereMonth('created_at', request()->bulan)->whereYear('created_at', request()->tahun)->get();
        } else if (isset(request()->tahun)) {
            $neracaSaldo = KeuAkun::orderBy('kode_akun', 'asc')->whereYear('created_at', request()->tahun)->get();
        } else if (isset(request()->bulan)) {
            $neracaSaldo = KeuAkun::orderBy('kode_akun', 'asc')->whereMonth('created_at', request()->bulan)->get();
        } else {
            $neracaSaldo = KeuAkun::orderBy('kode_akun', 'asc')->get();
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
            $pdf = Pdf::loadView('generate-pdf.lapkeu-neraca-saldo', ['neracaSaldo' => $neracaSaldo, 'bulan' => $this->bulan])->setPaper('a4');
            return $pdf->stream('Laporan Neraca Saldo.pdf');
        }

        return view('pages.laporan-keuangan.neraca-saldo', [
            'neracaSaldo' => KeuAkun::get(),
            'bulan' => $this->bulan
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function hpp()
    {
        if (isset(request()->bulan) && isset(request()->tahun)) {
            $hpp_sesungguhnya = HppSesungguhnya::whereMonth('tanggal_input', request()->bulan)->whereYear('tanggal_input', request()->tahun)->get();
            $DataHarga = DataHargar::whereMonth('created_at', request()->bulan)->whereYear('created_at', request()->tahun)->get();
        } else if (isset(request()->tahun)) {
            $hpp_sesungguhnya = HppSesungguhnya::whereYear('tanggal_input', request()->tahun)->get();
            $DataHarga = DataHargar::whereYear('created_at', request()->tahun)->get();
        } else if (isset(request()->bulan)) {
            $hpp_sesungguhnya = HppSesungguhnya::whereMonth('tanggal_input', request()->bulan)->get();
            $DataHarga = DataHargar::whereMonth('created_at', request()->bulan)->get();
        } else {
            $hpp_sesungguhnya = HppSesungguhnya::get();
            $DataHarga = DataHargar::get();
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
            $pdf = Pdf::loadView('generate-pdf.lapkeu-hpp', ['hppSesungguhnya' => $hpp_sesungguhnya, 'hpp' => $DataHarga, 'bulan' => $this->bulan])->setPaper('a4');
            return $pdf->stream('Laporan HPP.pdf');
        }

        return view('pages.laporan-keuangan.hpp', [
            'hppSesungguhnya' => $hpp_sesungguhnya,
            'hpp' => $DataHarga,
            'bulan' => $this->bulan
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
            $pdf = Pdf::loadView('generate-pdf.lapkeu-laba-rugi', ['beban' => $beban, 'hpp' => $hpp, 'pendapatan' => $pendapatan, 'bulan' => $this->bulan])->setPaper('a4');
            return $pdf->stream('Laporan HPP.pdf');
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
            $labaRugi = KeuLabaRugi::where('bulan', request()->bulan)->where('tahun', request()->tahun)->get()->first();
        } else if (isset(request()->tahun)) {
            $asetLancar = KeuAkun::where('kode_akun', 'like', '11%')->whereYear('created_at', request()->tahun)->get()->all();
            $asetTetap = KeuAkun::where('kode_akun', 'like', '12%')->whereYear('created_at', request()->tahun)->get()->all();
            $kewajibanJkPdk = KeuAkun::where('kode_akun', 'like', '21%')->whereYear('created_at', request()->tahun)->get()->all();
            $kewajibanJkPjg = KeuAkun::where('kode_akun', 'like', '22%')->whereYear('created_at', request()->tahun)->get()->all();
            $ekuitas = KeuAkun::where('kode_akun', 'like', '3%')->whereYear('created_at', request()->tahun)->get()->all();
            $labaRugi = KeuLabaRugi::where('tahun', request()->tahun)->get()->first();
        } else if (isset(request()->bulan)) {
            $asetLancar = KeuAkun::where('kode_akun', 'like', '11%')->whereMonth('created_at', request()->bulan)->get()->all();
            $asetTetap = KeuAkun::where('kode_akun', 'like', '12%')->whereMonth('created_at', request()->bulan)->get()->all();
            $kewajibanJkPdk = KeuAkun::where('kode_akun', 'like', '21%')->whereMonth('created_at', request()->bulan)->get()->all();
            $kewajibanJkPjg = KeuAkun::where('kode_akun', 'like', '22%')->whereMonth('created_at', request()->bulan)->get()->all();
            $ekuitas = KeuAkun::where('kode_akun', 'like', '3%')->whereMonth('created_at', request()->bulan)->get()->all();
            $labaRugi = KeuLabaRugi::where('bulan', request()->bulan)->get()->first();
        } else {
            $asetLancar = KeuAkun::where('kode_akun', 'like', '11%')->get()->all();
            $asetTetap = KeuAkun::where('kode_akun', 'like', '12%')->get()->all();
            $kewajibanJkPdk = KeuAkun::where('kode_akun', 'like', '21%')->get()->all();
            $kewajibanJkPjg = KeuAkun::where('kode_akun', 'like', '22%')->get()->all();
            $ekuitas = KeuAkun::where('kode_akun', 'like', '3%')->get()->all();
            $labaRugi = KeuLabaRugi::get()->first();
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
            $pdf = Pdf::loadView('generate-pdf.lapkeu-posisi-keuangan', [
                'asetLancar' => $asetLancar,
                'asetTetap' => $asetTetap,
                'kewajibanJkPdk' => $kewajibanJkPdk,
                'kewajibanJkPjg' => $kewajibanJkPjg,
                'ekuitas' => $ekuitas,
                'labaRugi' => $labaRugi,
                'jumlah_aset_lancar' => 0,
                'jumlah_aset_tetap' => 0,
                'jumlah_kewajiban_jkpdk' => 0,
                'jumlah_kewajiban_jkpjg' => 0,
                'jumlah_ekuitas' => 0,
                'bulan' => $this->bulan
            ])->setPaper('a4');
            return $pdf->stream('Laporan HPP.pdf');
        }

        return view('pages.laporan-keuangan.posisi-keuangan', [
            'asetLancar' => $asetLancar,
            'asetTetap' => $asetTetap,
            'kewajibanJkPdk' => $kewajibanJkPdk,
            'kewajibanJkPjg' => $kewajibanJkPjg,
            'ekuitas' => $ekuitas,
            'labaRugi' => $labaRugi,
            'jumlah_aset_lancar' => 0,
            'jumlah_aset_tetap' => 0,
            'jumlah_kewajiban_jkpdk' => 0,
            'jumlah_kewajiban_jkpjg' => 0,
            'jumlah_ekuitas' => 0,
            'bulan' => $this->bulan
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function postingLabaRugi(Request $request)
    {
        KeuLabaRugi::create([
            'jumlah_laba_rugi' => $request->jumlah_laba_rugi,
            'bulan' => $request->bulan,
            'tahun' => $request->tahun,
            'tanggal_posting' => date('Y-m-d'),
        ]);

        return redirect()->route('Laporan Laba Rugi');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
