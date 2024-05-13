<?php

namespace App\Http\Controllers;

use App\Models\KeuAsetTetap;
use Illuminate\Http\Request;
use App\Models\KeuPenyusutanAt;
use Barryvdh\DomPDF\Facade\Pdf;

class PenyusutanAsetTetapController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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
            $pdf = Pdf::loadView('generate-pdf.tabel-penyusutan-aset', ['penyusutanAt' => KeuPenyusutanAt::get()])->setPaper('a4');
            return $pdf->stream('Daftar Penyusutan Aset Tetap.pdf');
        } else if (request()->get('export') == 'pdf-detail') {
            $detail = KeuPenyusutanAt::where('id', request()->id)->get()->first();
            Pdf::setOption([
                'enabled' => true,
                'isRemoteEnabled' => true,
                'chroot' => realpath(''),
                'isPhpEnabled' => true,
                'isFontSubsettingEnabled' => true,
                'pdfBackend' => 'CPDF',
                'isHtml5ParserEnabled' => true
            ]);
            $pdf = Pdf::loadView('generate-pdf.baris-penyusutan-aset', ['detail' => $detail])->setPaper('a4');
            return $pdf->stream('Penyusutan Aset Tetap.pdf');
        }
        return view("pages.akuntansi.penyusutan-aset-tetap", [
            'penyusutanAt' => KeuPenyusutanAt::get(),
            'id_PAT' => KeuPenyusutanAt::latest()->get()->first()->id ?? 1,
            'asetTetap' => KeuAsetTetap::get()
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
        // setting timezone
        date_default_timezone_set('Asia/Jakarta');

        // pisahkan timezone set 
        $tgl = explode("-", date('Y-m-d H:i:s'));

        // ambil tahunnya
        $tahun_sekarang = intval($tgl[0]);
        // ambil data aset tetap berdasarkan idnya
        $data_at = KeuAsetTetap::where('id', $request->kode_at)->get()->first();
        // mendapatkan input tahun ke 
        $tahun_ke = $tahun_sekarang - $data_at->tahun_perolehan;

        // mendapatkan total perolehan
        $total_perolehan = intval($data_at->harga_perolehan) * $data_at->jumlah_at;
        // Pengkondisian sesuai dengan jenis aset tetap
        if ($data_at->jenis_at == 'Tanah') {
            $beban_penyusutan = $total_perolehan * (0 / 100);
        } else if ($data_at->jenis_at == 'Bangunan') {
            $beban_penyusutan = $total_perolehan * (5 / 100);
        } else if ($data_at->jenis_at == 'Kendaraan Bermotor') {
            $beban_penyusutan = $total_perolehan * (12.5 / 100);
        } else if ($data_at->jenis_at == 'Inventaris Kantor') {
            $beban_penyusutan = $total_perolehan * (25 / 100);
        } else if ($data_at->jenis_at == 'Peralatan dan Mesin') {
            $beban_penyusutan = $total_perolehan * (6.25 / 100);
        }

        // Mendapatkan Akumulasi Penyusutan
        $akumulasi_penyusutan = $beban_penyusutan * $tahun_ke;
        // Mendapatkan Nilai Bukunya
        $nilai_buku = $total_perolehan - $akumulasi_penyusutan;

        KeuPenyusutanAt::create([
            'kode_penyusutan_at' => $request['kode_penyusutan_at'],
            'kode_at' => $request['kode_at'],
            'tanggal_penyusutan' => $request['tanggal_penyusutan'],
            'tahun_ke' => $tahun_ke,
            'beban_penyusutan' => $beban_penyusutan,
            'akumulasi_penyusutan' => $akumulasi_penyusutan,
            'nilai_buku' => $nilai_buku,
        ]);

        return redirect()->route('Penyusutan Aset Tetap')->with('success', 'Data Berhasil Ditambahkan');
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
        // setting timezone
        date_default_timezone_set('Asia/Jakarta');

        // pisahkan timezone set 
        $tgl = explode("-", date('Y-m-d H:i:s'));

        // ambil tahunnya
        $tahun_sekarang = intval($tgl[0]);
        // ambil data aset tetap berdasarkan idnya
        $data_at = KeuAsetTetap::where('id', $request->kode_at)->get()->first();
        // mendapatkan input tahun ke 
        $tahun_ke = $tahun_sekarang - $data_at->tahun_perolehan;

        // mendapatkan total perolehan
        $total_perolehan = intval($data_at->harga_perolehan) * $data_at->jumlah_at;
        // Pengkondisian sesuai dengan jenis aset tetap
        if ($data_at->jenis_at == 'Tanah') {
            $beban_penyusutan = $total_perolehan * (0 / 100);
        } else if ($data_at->jenis_at == 'Bangunan') {
            $beban_penyusutan = $total_perolehan * (5 / 100);
        } else if ($data_at->jenis_at == 'Kendaraan Bermotor') {
            $beban_penyusutan = $total_perolehan * (12.5 / 100);
        } else if ($data_at->jenis_at == 'Inventaris Kantor') {
            $beban_penyusutan = $total_perolehan * (25 / 100);
        } else if ($data_at->jenis_at == 'Peralatan dan Mesin') {
            $beban_penyusutan = $total_perolehan * (6.25 / 100);
        }

        // Mendapatkan Akumulasi Penyusutan
        $akumulasi_penyusutan = $beban_penyusutan * $tahun_ke;
        // Mendapatkan Nilai Bukunya
        $nilai_buku = $total_perolehan - $akumulasi_penyusutan;

        KeuPenyusutanAt::where('id', $id)->update([
            'kode_penyusutan_at' => $request['kode_penyusutan_at'],
            'kode_at' => $request['kode_at'],
            'tanggal_penyusutan' => $request['tanggal_penyusutan'],
            'tahun_ke' => $tahun_ke,
            'beban_penyusutan' => $beban_penyusutan,
            'akumulasi_penyusutan' => $akumulasi_penyusutan,
            'nilai_buku' => $nilai_buku,
        ]);

        return redirect()->route('Penyusutan Aset Tetap')->with('edit', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        KeuPenyusutanAt::where('id', $id)->delete();

        return redirect()->route('Penyusutan Aset Tetap')->with('hapus', 'Data Berhasil Dihapus');
    }
}
