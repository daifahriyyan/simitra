<?php

namespace App\Http\Controllers;

use App\Models\KeuAkun;
use App\Models\KeuJurnal;
use App\Models\KeuSupplier;
use Illuminate\Http\Request;
use App\Models\DetailSupplier;
use App\Models\KeuDetailJurnal;

class DetailSupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->get('status') == 'Lunas') {
            DetailSupplier::where('id', request()->get('id'))->update([
                'status' => request()->get('status')
            ]);

            return redirect()->route('Detail Supplier');
        }
        $tgl = date("Y-m-d");
        // dd(date('Y-m-d', strtotime('+6 days', strtotime($tgl))));
        return view('pages.akuntansi.detail-supplier', [
            'detailSupplier' => DetailSupplier::get(),
            'id_DS' => DetailSupplier::latest()->get()->first()->id ?? 1,
            'keuSupplier' => KeuSupplier::get()
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
        // ambil data Hutang Usaha dengan kode 2110 dari table keu_akun
        $hutang_usaha = KeuAkun::where('kode_akun', '2110')->get()->first();
        // ambil data hutang gaji dengan kode 1110 dari table keu_akun
        $kas = KeuAkun::where('kode_akun', '1110')->get()->first();


        // cek apakah hutang gaji dengan kode 1110 ada?
        // jika tidak ada maka buat akun Hutang Gaji
        if (is_null($kas)) {
            KeuAkun::create([
                'kode_akun' => '1110',
                'nama_akun' => 'Kas',
                'jenis_akun' => 'debet',
                'kelompok_akun' => 'aset',
                'saldo_akun' => 0
            ]);
        }
        // cek apakah Hutang Usaha dengan kode 2110 ada?
        // jika tidak ada maka buat akun Hutang Usaha
        if (is_null($hutang_usaha)) {
            KeuAkun::create([
                'kode_akun' => '2110',
                'nama_akun' => 'Hutang Usaha',
                'jenis_akun' => 'kredit',
                'kelompok_akun' => 'liabilitas',
                'saldo_akun' => 0
            ]);
        }

        // Ambil nama pegawai 
        $nama_pegawai = KeuSupplier::where('id', $request['id_supplier'])->first()->nama_supplier;
        // ambil id penggajian terakhir
        $no_JUBYR = DetailSupplier::latest()->first()->id;
        // Buat No Jurnal JUBYR
        $no_jurnal = 'JUBYR' . str_pad($no_JUBYR, 4, 0, STR_PAD_LEFT);

        // Masukkan Data Penggajian Ke Jurnal Umum
        KeuJurnal::create([
            'no_jurnal' => $no_jurnal,
            'tanggal_jurnal' => $request->tanggal_input,
            'uraian_jurnal' => 'Penggajian Atas ' . $nama_pegawai,
            'no_bukti' => $request->id_detail_supplier,
        ]);


        // Masukkan Data Penggajian Ke Detail Jurnal Umum bagian debet
        KeuDetailJurnal::create([
            'no_jurnal' => $no_jurnal,
            'kode_akun' => '5220',
            'debet' => $request->pembayaran
        ]);
        // Masukkan Data Penggajian Ke Detail Jurnal Umum bagian kredit
        KeuDetailJurnal::create([
            'no_jurnal' => $no_jurnal,
            'kode_akun' => '2130',
            'kredit' => $request->pembayaran
        ]);

        // Buat Variabel Saldo Akhir Supplier
        $saldoAkhirSupplier = $request['pembayaran'];
        // ambil data Detail Supplier Berdasarkan id supplier yang dimasukkan
        $DetailSupplier = DetailSupplier::where('id_supplier', $request['id_supplier'])->latest()->get()->first();
        // Pecah Input Termin Pembayaran
        $termin = explode('/', $request['termin_pembayaran']);
        // Buat Tanggal Jatuh Tempo hasil dari penambahan termin pembayaran
        $tglJatuhTempo = date("Y-m-d", strtotime("+$termin[1] days", strtotime($request['tanggal_input'])));
        // Jika Detail Supplier dengan id supplier yang dimasukkan sudah ada
        if (isset($DetailSupplier)) {
            $saldoAkhirSupplier = $DetailSupplier->saldo_akhir_supplier - $saldoAkhirSupplier;
            DetailSupplier::create([
                'id_detail_supplier' => $request['id_detail_supplier'],
                'id_supplier' => $request['id_supplier'],
                'termin_pembayaran' => $request['termin_pembayaran'],
                'tanggal_input' => $request['tanggal_input'],
                'pembelian' => 0,
                'pembayaran' => $request['pembayaran'],
                'tanggal_jatuh_tempo' => $tglJatuhTempo,
                'saldo_akhir_supplier' => $saldoAkhirSupplier,
            ]);
            // Jika Detail Supplier dengan id supplier yang dimasukkan Belum ada
        } else {
            DetailSupplier::create([
                'id_detail_supplier' => $request['id_detail_supplier'],
                'id_supplier' => $request['id_supplier'],
                'termin_pembayaran' => $request['termin_pembayaran'],
                'tanggal_input' => $request['tanggal_input'],
                'pembelian' => 0,
                'pembayaran' => $request['pembayaran'],
                'tanggal_jatuh_tempo' => $tglJatuhTempo,
                'saldo_akhir_supplier' => $saldoAkhirSupplier,
            ]);
        }

        return redirect()->route('Detail Supplier')->with('success', 'Data Berhasil Ditambahkan');
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

        // Buat Variabel Saldo Akhir Supplier
        $saldoAkhirSupplier = $request['pembayaran'];
        // ambil data Detail Supplier Berdasarkan id supplier yang dimasukkan
        $DetailSupplier = DetailSupplier::where('id_supplier', $request['id_supplier'])->latest()->get()->first();
        // Pecah Input Termin Pembayaran
        $termin = explode('/', $request['termin_pembayaran']);
        // Buat Tanggal Jatuh Tempo hasil dari penambahan termin pembayaran
        $tglJatuhTempo = date("Y-m-d", strtotime("+$termin[1] days", strtotime($request['tanggal_input'])));
        // Jika Detail Supplier dengan id supplier yang dimasukkan sudah ada
        if (isset($DetailSupplier)) {
            $saldoAkhirSupplier = $DetailSupplier->saldo_akhir_supplier - $saldoAkhirSupplier;
            DetailSupplier::where('id', $id)->update([
                'id_detail_supplier' => $request['id_detail_supplier'],
                'id_supplier' => $request['id_supplier'],
                'termin_pembayaran' => $request['termin_pembayaran'],
                'tanggal_input' => $request['tanggal_input'],
                'pembelian' => 0,
                'pembayaran' => $request['pembayaran'],
                'tanggal_jatuh_tempo' => $tglJatuhTempo,
                'saldo_akhir_supplier' => $saldoAkhirSupplier,
            ]);
            // Jika Detail Supplier dengan id supplier yang dimasukkan Belum ada
        } else {
            DetailSupplier::where('id', $id)->update([
                'id_detail_supplier' => $request['id_detail_supplier'],
                'id_supplier' => $request['id_supplier'],
                'termin_pembayaran' => $request['termin_pembayaran'],
                'tanggal_input' => $request['tanggal_input'],
                'pembelian' => 0,
                'pembayaran' => $request['pembayaran'],
                'tanggal_jatuh_tempo' => $tglJatuhTempo,
                'saldo_akhir_supplier' => $saldoAkhirSupplier,
            ]);
        }

        // Ambil nama pegawai 
        $nama_pegawai = KeuSupplier::where('id', $request['id_supplier'])->first()->nama_supplier;

        // ambil data no jurnal dimana no bukti berdasarkan data penggajian yang ingin dirubah
        $no_jurnal = KeuJurnal::where('no_bukti', $request->id_detail_supplier)->get()->first()->no_jurnal;

        // Masukkan Data Penggajian Ke Jurnal Umum
        KeuJurnal::create([
            'no_jurnal' => $no_jurnal,
            'tanggal_jurnal' => $request->tanggal_input,
            'uraian_jurnal' => 'Penggajian Atas ' . $nama_pegawai,
            'no_bukti' => $request->id_detail_supplier,
        ]);


        // Masukkan Data Penggajian Ke Detail Jurnal Umum bagian debet
        KeuDetailJurnal::where('no_jurnal', $no_jurnal)->where('kode_akun', '5220')->create([
            'no_jurnal' => $no_jurnal,
            'kode_akun' => '5220',
            'debet' => $request->pembayaran
        ]);
        // Masukkan Data Penggajian Ke Detail Jurnal Umum bagian kredit
        KeuDetailJurnal::where('no_jurnal', $no_jurnal)->where('kode_akun', '2130')->create([
            'no_jurnal' => $no_jurnal,
            'kode_akun' => '2130',
            'kredit' => $request->pembayaran
        ]);

        return redirect()->route('Detail Supplier')->with('edit', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Ambil id_detail_supplier dari table Penggajian dimana id sesuai dengan id yang dikirimkan
        $id_detail_supplier = DetailSupplier::where('id', $id)->get()->first()->id_detail_supplier;
        // Ambil no jurnal dari table jurnal umum dimana no bukti sesuai dengan id penggajian
        $no_jurnal = KeuJurnal::where('no_bukti', $id_detail_supplier)->get()->first()->no_jurnal ?? null;
        if (isset($no_jurnal)) {
            // ambil seluruh data detail jurnal
            $detail_jurnal = KeuDetailJurnal::where('no_jurnal', $no_jurnal)->get();

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

            // hapus record table detail jurnal berdasarkan no jurnal
            KeuDetailJurnal::where('no_jurnal', $no_jurnal)->delete();
            // hapus record table jurnal berdasarkan no jurnal
            KeuJurnal::where('no_jurnal', $no_jurnal)->delete();
        }

        DetailSupplier::where('id', $id)->delete();

        return redirect()->route('Detail Supplier')->with('hapus', 'Data Berhasil Dihapus');
    }
}
