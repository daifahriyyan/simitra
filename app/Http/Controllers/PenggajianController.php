<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\KeuAkun;
use App\Models\KeuJurnal;
use App\Models\DataPegawai;
use Illuminate\Http\Request;
use App\Models\KeuPenggajian;
use App\Models\KeuDetailJurnal;
use Barryvdh\DomPDF\Facade\Pdf;

class PenggajianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (isset(request()->tanggalMulai) && isset(request()->tanggalAkhir)) {
            $penggajian = KeuPenggajian::whereBetween('created_at', [request()->tanggalMulai, request()->tanggalAkhir])->get();
        } else {
            $penggajian = KeuPenggajian::get();
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
            $pdf = Pdf::loadView('generate-pdf.tabel-penggajian', ['penggajian' => $penggajian])->setPaper('a4');
            return $pdf->stream('Daftar Penggajian.pdf');
        } else if (request()->get('export') == 'pdf-detail') {
            $detail = KeuPenggajian::where('id', request()->id)->get()->first();
            Pdf::setOption([
                'enabled' => true,
                'isRemoteEnabled' => true,
                'chroot' => realpath(''),
                'isPhpEnabled' => true,
                'isFontSubsettingEnabled' => true,
                'pdfBackend' => 'CPDF',
                'isHtml5ParserEnabled' => true
            ]);
            $pdf = Pdf::loadView('generate-pdf.baris-penggajian', ['detail' => $detail])->setPaper('a4');
            return $pdf->stream('Detail Penggajian.pdf');
        }
        return view('pages.akuntansi.penggajian', [
            'penggajian' => $penggajian,
            'pegawai' => DataPegawai::get()
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
        // ambil data beban gaji dengan kode 5220 dari table keu_akun
        $beban_gaji = KeuAkun::where('kode_akun', '5220')->get()->first();
        // ambil data hutang gaji dengan kode2130 dari table keu_akun
        $hutang_gaji = KeuAkun::where('kode_akun', '2130')->get()->first();

        // cek apakah beban gaji dengan kode 5220 ada?
        // jika tidak ada maka buat akun Beban Gaji
        if (is_null($beban_gaji)) {
            KeuAkun::create([
                'kode_akun' => '5220',
                'nama_akun' => 'Beban Gaji',
                'jenis_akun' => 'debet',
                'kelompok_akun' => 'beban',
                'saldo_akun' => 0
            ]);
        }
        // cek apakah hutang gaji dengan kode 2130 ada?
        // jika tidak ada maka buat akun Hutang Gaji
        if (is_null($hutang_gaji)) {
            KeuAkun::create([
                'kode_akun' => '2130',
                'nama_akun' => 'Hutang Gaji',
                'jenis_akun' => 'kredit',
                'kelompok_akun' => 'liabilitas',
                'saldo_akun' => 0
            ]);
        }

        // Ambil Data Gaji Pokok sesuai nama pegawai yang diinput sebelumnya
        $gaji_pokok = DataPegawai::where('id', $request['id_pegawai'])->get()->first()->gaji_pokok;
        // Lakukan Penjumlahan supaya menjadi Gaji Bersih
        $gaji_bersih = $gaji_pokok + $request['bonus'] + $request['tunjangan_lembur'] + $request['iuran'];

        // Buat Data Penggajian
        KeuPenggajian::create([
            'id_penggajian' => $request['id_penggajian'],
            'tanggal_input' => $request['tanggal_input'],
            'id_pegawai' => $request['id_pegawai'],
            'bonus' => $request['bonus'],
            'tunjangan_lembur' => $request['tunjangan_lembur'],
            'iuran' => $request['iuran'],
            'gaji_bersih' => $gaji_bersih
        ]);

        // jika jenis akun adalah kredit maka kurangi 
        $saldo_beban_gaji = $beban_gaji->saldo_akun + $gaji_bersih;
        // jika jenis akun adalah kredit maka kurangi 
        $saldo_hutang_gaji = $hutang_gaji->saldo_akun + $gaji_bersih;

        // ubah sesuai operasi diatas
        KeuAkun::where('kode_akun', '5220')->update([
            'saldo_akun' => $saldo_beban_gaji,
        ]);
        // ubah sesuai operasi diatas
        KeuAkun::where('kode_akun', '2130')->update([
            'saldo_akun' => $saldo_hutang_gaji,
        ]);


        // Ambil nama pegawai 
        $nama_pegawai = DataPegawai::where('id', $request['id_pegawai'])->first()->nama_pegawai;
        // ambil id penggajian terakhir
        $no_JUGAJI = KeuPenggajian::latest()->first()->id;
        // Buat No Jurnal JUGAJI
        $no_jurnal = 'JUGAJI' . str_pad($no_JUGAJI, 4, 0, STR_PAD_LEFT);

        // Masukkan Data Penggajian Ke Jurnal Umum
        KeuJurnal::create([
            'no_jurnal' => $no_jurnal,
            'tanggal_jurnal' => $request->tanggal_input,
            'uraian_jurnal' => 'Penggajian Atas ' . $nama_pegawai,
            'no_bukti' => $request->id_penggajian,
        ]);

        $id_jurnal = KeuJurnal::get()->first()->id;

        // Masukkan Data Penggajian Ke Detail Jurnal Umum bagian debet
        KeuDetailJurnal::create([
            'no_jurnal' => $id_jurnal,
            'kode_akun' => $beban_gaji->id,
            'debet' => $gaji_bersih
        ]);
        // Masukkan Data Penggajian Ke Detail Jurnal Umum bagian kredit
        KeuDetailJurnal::create([
            'no_jurnal' => $id_jurnal,
            'kode_akun' => $hutang_gaji->id,
            'kredit' => $gaji_bersih
        ]);

        return redirect()->route('Penggajian')->with('success', 'Data Berhasil Ditambahkan');
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
        $gaji_pokok = DataPegawai::where('id', $request['id_pegawai'])->get()->first()->gaji_pokok;
        $gaji_bersih = $gaji_pokok + $request['bonus'] + $request['tunjangan_lembur'] + $request['iuran'];
        // dd($gaji_bersih);
        KeuPenggajian::where('id', $id)->update([
            'id_penggajian' => $request['id_penggajian'],
            'tanggal_input' => $request['tanggal_input'],
            'id_pegawai' => $request['id_pegawai'],
            'bonus' => $request['bonus'],
            'tunjangan_lembur' => $request['tunjangan_lembur'],
            'iuran' => $request['iuran'],
            'gaji_bersih' => $gaji_bersih
        ]);

        // Ambil nama pegawai 
        $nama_pegawai = DataPegawai::where('id', $request['id_pegawai'])->first()->nama_pegawai;

        // Masukkan Data Penggajian Ke Jurnal Umum
        KeuJurnal::where('no_bukti', $request->id_penggajian)->update([
            'tanggal_jurnal' => $request->tanggal_input,
            'uraian_jurnal' => 'Penggajian Atas ' . $nama_pegawai,
            'no_bukti' => $request->id_penggajian,
        ]);

        // ambil data no jurnal dimana no bukti berdasarkan data penggajian yang ingin dirubah
        $no_jurnal = KeuJurnal::where('no_bukti', $request->id_penggajian)->get()->first()->id;

        // ambil data beban gaji dengan kode 5220 dari table keu_akun
        $beban_gaji = KeuAkun::where('kode_akun', '5220')->get()->first();
        // ambil data hutang gaji dengan kode2130 dari table keu_akun
        $hutang_gaji = KeuAkun::where('kode_akun', '2130')->get()->first();

        // Ubah Data Detail Jurnal bagian debet berdasarkan no jurnal yang dirubah dan kode akun
        KeuDetailJurnal::where('no_jurnal', $no_jurnal)->where('kode_akun', $beban_gaji->id)->update([
            'no_jurnal' => $no_jurnal,
            'kode_akun' => $beban_gaji->id,
            'debet' => $gaji_bersih
        ]);
        // Ubah Data Detail Jurnal bagian kredit berdasarkan no jurnal yang dirubah dan kode akun
        KeuDetailJurnal::where('no_jurnal', $no_jurnal)->where('kode_akun', $hutang_gaji->id)->update([
            'no_jurnal' => $no_jurnal,
            'kode_akun' => $hutang_gaji->id,
            'kredit' => $gaji_bersih
        ]);


        return redirect()->route('Penggajian')->with('edit', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Ambil id_penggajian dari table Penggajian dimana id sesuai dengan id yang dikirimkan
        $id_penggajian = KeuPenggajian::where('id', $id)->get()->first()->id_penggajian;
        // Ambil no jurnal dari table jurnal umum dimana no bukti sesuai dengan id penggajian
        $no_jurnal = KeuJurnal::where('no_bukti', $id_penggajian)->get()->first()->id ?? null;

        if (isset($no_jurnal)) {
            // ambil seluruh data detail jurnal
            $detail_jurnal = KeuDetailJurnal::where('no_jurnal', $no_jurnal)->get();

            try {
                // hapus record table detail jurnal berdasarkan no jurnal
                KeuDetailJurnal::where('no_jurnal', $no_jurnal)->delete();
                // hapus record table jurnal berdasarkan no jurnal
                KeuJurnal::where('id', $no_jurnal)->delete();

                KeuPenggajian::where('id', $id)->delete();
                // Validate the value...
            } catch (Throwable $e) {
                return back()->with('error', $e->getMessage());
            }

            // lakukan pengembalian saldo tiap tiap akun dari jurnal umum yang dihapus
            foreach ($detail_jurnal as $record) {
                // dapatkan kode akun dari tiap akun yang dihapus
                $kode_akun = $record->kode_akun;

                // dapatkan akun berdasarkan kode akun yang dihapus
                $akun = KeuAkun::where('kode_akun', $kode_akun)->get()->first();
                // ambil saldo debet tiap akun
                $saldoDebet = $record->debet;
                // ambil saldo kredit tiap akun
                $saldoKredit = $record->kredit;

                // jika jenis akun kredit dan saldo kreditnya berisi maka saldo akun dikurangi saldo kredit dari tiap akun jurnal
                if ($akun->jenis_akun == 'kredit' && !is_null($saldoKredit)) {
                    KeuAkun::where('kode_akun', $kode_akun)->update([
                        'saldo_akun' => $akun->saldo_akun - $saldoKredit
                    ]);

                    $keterangan = 'kredit berhasil dikurangi kredit';
                    // jika jenis akun debet dan saldo kredit berisi maka saldo akun ditambahi saldo kredit dari tiap akun jurnal
                } else if ($akun->jenis_akun == 'debet' && !is_null($saldoKredit)) {
                    KeuAkun::where('kode_akun', $kode_akun)->update([
                        'saldo_akun' => $akun->saldo_akun + $saldoKredit
                    ]);

                    $keterangan = 'Debet berhasil ditambah Kredit';
                    // jika jenis akun kredit dan saldo debet berisi maka saldo akun ditambahi saldo debet dari tiap akun jurnal
                } else if ($akun->jenis_akun == 'kredit' && !is_null($saldoDebet)) {
                    KeuAkun::where('kode_akun', $kode_akun)->update([
                        'saldo_akun' => $akun->saldo_akun + $saldoDebet
                    ]);

                    $keterangan = 'kredit berhasil ditambah debet';
                    // jika jenis akun debet dan saldo debet berisi maka saldo akun dikurangi saldo debet dari tiap akun jurnal
                } else if ($akun->jenis_akun == 'debet' && !is_null($saldoDebet)) {
                    KeuAkun::where('kode_akun', $kode_akun)->update([
                        'saldo_akun' => $akun->saldo_akun - $saldoDebet
                    ]);

                    $keterangan = 'Debet berhasil dikurangi debet';
                }
            }
        }


        return redirect()->route('Penggajian')->with('hapus', 'Data Berhasil Dihapus');
    }
}
