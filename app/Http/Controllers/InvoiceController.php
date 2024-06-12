<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\Invoice;
use App\Models\KeuAkun;
use App\Models\DataOrder;
use App\Models\KeuJurnal;
use App\Models\DataHargar;
use App\Models\Notifikasi;
use App\Models\Sertifikat;
use App\Models\DetailOrder;
use App\Models\DataCustomer;
use Illuminate\Http\Request;
use App\Models\DetailCustomer;
use App\Models\KeuDetailJurnal;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\MetilRecordsheet;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->posisi == null) {
            if (request()->get('export') == 'pdf-detail') {
                $detail = Invoice::where('id', request()->id)->get()->first();
                Pdf::setOption([
                    'enabled' => true,
                    'isRemoteEnabled' => true,
                    'chroot' => realpath(''),
                    'isPhpEnabled' => true,
                    'isFontSubsettingEnabled' => true,
                    'pdfBackend' => 'CPDF',
                    'isHtml5ParserEnabled' => true
                ]);
                $pdf = Pdf::loadView('generate-pdf.invoice', ['detail' => $detail])->setPaper('a4');
                return $pdf->stream('Invoice.pdf');
            } else {
                return redirect()->route('Home');
            }
          
        } else if (Auth::user()->posisi == 'Direktur' || Auth::user()->posisi == 'Administrasi') {
            if (isset(request()->tanggalMulai) && isset(request()->tanggalAkhir)) {
                $tanggalMulai = request()->tanggalMulai;
                $tanggalAkhir = request()->tanggalAkhir;
                $invoice = Invoice::whereBetween('tanggal_invoice', [$tanggalMulai, $tanggalAkhir])->get();
            } else {
                $invoice = Invoice::get();
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
                $pdf = Pdf::loadView('generate-pdf.tabel-invoice', ['invoice' => $invoice])->setPaper('a4', 'landscape');
                return $pdf->stream('Daftar Invoice.pdf');
            } else if (request()->get('export') == 'pdf-detail') {
                $detail = Invoice::where('id', request()->id)->get()->first();
                Pdf::setOption([
                    'enabled' => true,
                    'isRemoteEnabled' => true,
                    'chroot' => realpath(''),
                    'isPhpEnabled' => true,
                    'isFontSubsettingEnabled' => true,
                    'pdfBackend' => 'CPDF',
                    'isHtml5ParserEnabled' => true
                ]);
                $pdf = Pdf::loadView('generate-pdf.invoice', ['detail' => $detail])->setPaper('a4');
                return $pdf->stream('Invoice.pdf');
            }
            if (request()->get('verif') !== null) {
                DetailOrder::where('id', request()->get('verif'))->update([
                    'verifikasi' => 6,
                    'is_reject' => '0'
                ]);
                
                return redirect()->route('Invoice')->with('success', 'Verifikasi telah berhasil diupdate di web luar');
            }
            return view('pages.penerimaan-jasa.invoice', [
                'invoice' => $invoice,
                'id_invoice' => (isset(Invoice::latest()->get()->first()->id)) ? Invoice::latest()->get()->first()->id : 1,
                'dataSertif' => Sertifikat::get(),
                'dataOrder' => DetailOrder::latest()->get(),
                'recordsheet' => MetilRecordsheet::get(),
                'dataHarga' => DataHargar::get(),
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
        // ambil data order berdasarkan id order yang diinput
        $dataOrder = DetailOrder::where('id', $request['id_order'])->get()->first();
        // ambil data harga berdasarkan id data standar yang diinput
        $dataHarga = DataHargar::where('id', $request['id_data_standar'])->get()->first();
        // hitung total penjualan
        $totalPenjualan = intval($dataHarga->harga_jual) * $dataOrder->dataOrder->jumlah_order;
        // hitung jumlah dibayar
        $jumlah_dibayar = $totalPenjualan + ($totalPenjualan * ($request['ppn']/100));
        // merubah request ppn menjadi format rupiah
        request()->ppn = $totalPenjualan * ($request['ppn']/100);

        $termin = explode('/', $request->termin);
        $tglJatuhTempo = date("Y-m-d", strtotime("+$termin[1] days", strtotime($request['tanggal_invoice'])));

        // buat data invoice
        Invoice::create([
            'id_invoice' => $request['id_invoice'],
            'termin' => $request['termin'],
            'tanggal_invoice' => $request['tanggal_invoice'],
            'id_order' => $request['id_order'],
            'id_sertif' => $request['id_sertif'],
            'no_bl' => $request['no_bl'],
            'shipper' => $request['shipper'],
            'stuffing_date' => $request['stuffing_date'],
            'closing_time' => $request['closing_time'],
            'id_recordsheet' => $request['id_recordsheet'],
            'id_data_standar' => $request['id_data_standar'],
            'total_penjualan' => $totalPenjualan,
            'tanggal_jatuh_tempo' => $tglJatuhTempo,
            'ppn' => $request['ppn'],
            'jumlah_dibayar' => $jumlah_dibayar,
        ]);


        // ambil data Piutang Usaha dengan kode 1120 dari table keu_akun
        $piutang_usaha = KeuAkun::where('kode_akun', '1120')->get()->first();
        // ambil data PPN Keluaran dengan kode 4110 dari table keu_akun
        $ppn_keluaran = KeuAkun::where('kode_akun', '2120')->get()->first();
        // ambil data hutang gaji dengan kode 4110 dari table keu_akun
        $penjualan_jasa = KeuAkun::where('kode_akun', '4110')->get()->first();

        // cek apakah Piutang Usaha dengan kode 1120 ada?
        // jika tidak ada maka buat akun Piutang Usaha
        if (is_null($piutang_usaha)) {
            KeuAkun::create([
                'kode_akun' => '1120',
                'nama_akun' => 'Piutang Usaha',
                'jenis_akun' => 'debet',
                'kelompok_akun' => 'aset',
                'saldo_akun' => 0
            ]);
        }
        // cek apakah PPN Keluaran dengan kode 2120 ada?
        // jika tidak ada maka buat akun PPN Keluaran
        if (is_null($ppn_keluaran)) {
            KeuAkun::create([
                'kode_akun' => '2120',
                'nama_akun' => 'PPN Keluaran',
                'jenis_akun' => 'kredit',
                'kelompok_akun' => 'aset',
                'saldo_akun' => 0
            ]);
        }
        // cek apakah Penjualan Jasa dengan kode 4110 ada?
        // jika tidak ada maka buat akun Penjualan Jasa
        if (is_null($penjualan_jasa)) {
            KeuAkun::create([
                'kode_akun' => '4110',
                'nama_akun' => 'Penjualan Jasa',
                'jenis_akun' => 'kredit',
                'kelompok_akun' => 'pendapatan',
                'saldo_akun' => 0
            ]);
        }

        // Ambil nama customer 
        $nama_customer = DetailOrder::where('id', $request['id_order'])->get()->first()->dataOrder->dataCustomer->nama_customer;
        // ambil id invoice terakhir
        $no_JUINV = Invoice::latest()->first()->id + 1;
        // Buat No Jurnal JUINV
        $no_jurnal = 'JUINV' . str_pad($no_JUINV, 4, 0, STR_PAD_LEFT);

        // ambil data Akun
        $kodeAkun1120 = KeuAkun::where('kode_akun', '1120')->get()->first();
        $kodeAkun2120 = KeuAkun::where('kode_akun', '2120')->get()->first();
        $kodeAkun4110 = KeuAkun::where('kode_akun', '4110')->get()->first();

        // jika jenis akun adalah kredit maka kurangi 
        $saldo_akun1120 = $kodeAkun1120->saldo_akun + $jumlah_dibayar;
        // jika jenis akun adalah kredit maka kurangi 
        $saldo_akun2120 = $kodeAkun2120->saldo_akun + $request->ppn;
        // jika jenis akun adalah debet maka tambahi
        $saldo_akun4110 = $kodeAkun4110->saldo_akun + $totalPenjualan;

        // ubah sesuai operasi diatas
        KeuAkun::where('kode_akun', '1120')->update([
            'saldo_akun' => $saldo_akun1120,
        ]);
        // ubah sesuai operasi diatas
        KeuAkun::where('kode_akun', '2120')->update([
            'saldo_akun' => $saldo_akun2120,
        ]);
        // ubah sesuai operasi diatas
        KeuAkun::where('kode_akun', '4110')->update([
            'saldo_akun' => $saldo_akun4110,
        ]);


        // Masukkan Data invoice Ke Jurnal Umum
        KeuJurnal::create([
            'no_jurnal' => $no_jurnal,
            'tanggal_jurnal' => $request->tanggal_invoice,
            'uraian_jurnal' => 'Pendapatan Jasa dari ' . $nama_customer,
            'no_bukti' => $request->id_invoice,
        ]);

        $id_jurnal = KeuJurnal::where('no_jurnal', $no_jurnal)->get()->first()->id;
        $id_1120 = KeuAkun::where('kode_akun', '1120')->get()->first()->id;
        $id_2120 = KeuAkun::where('kode_akun', '2120')->get()->first()->id;
        $id_4110 = KeuAkun::where('kode_akun', '4110')->get()->first()->id;

        // Masukkan Data invoice Ke Detail Jurnal Umum bagian debet
        KeuDetailJurnal::create([
            'no_jurnal' => $id_jurnal,
            'kode_akun' => $id_1120,
            'debet' => $jumlah_dibayar
        ]);
        // Masukkan Data invoice Ke Detail Jurnal Umum bagian debet
        KeuDetailJurnal::create([
            'no_jurnal' => $id_jurnal,
            'kode_akun' => $id_2120,
            'kredit' => $request->ppn
        ]);
        // Masukkan Data invoice Ke Detail Jurnal Umum bagian kredit
        KeuDetailJurnal::create([
            'no_jurnal' => $id_jurnal,
            'kode_akun' => $id_4110,
            'kredit' => $totalPenjualan
        ]);

        // Buat Id Detail Customer JUINV
        $id_detail_customer = 'DCPJ' . str_pad($no_JUINV, 4, 0, STR_PAD_LEFT);
        // Ambil nama customer 
        $id_customer = DetailOrder::where('id', $request['id_order'])->get()->first()->dataOrder->dataCustomer->id;

        DetailCustomer::create([
            'id_detail_customer' => $id_detail_customer,
            'id_customer' => $id_customer,
            'tanggal_input' => $request->tanggal_invoice,
            'termin' => $request->termin,
            'total_penjualan' => $totalPenjualan,
            'saldo_awal' => 0,
            'penerimaan' => 0,
            'saldo_akhir' => $totalPenjualan,
            'tanggal_jatuh_tempo' => $tglJatuhTempo
        ]);

                // Menambahkan Notifikasi
                Notifikasi::create([
                    'keterangan' => "Telah ditambahkan invoice no.".request()->id_invoice." cek jurnal",
                    'is_read' => 'N',
                    'posisi' => 'Keuangan',
                ]);

        return redirect(route('Invoice'))->with('success', 'Data Invoice Berhasil ditambahkan');
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
        // ambil data order berdasarkan id order yang diinput
        $dataOrder = DetailOrder::where('id', $request['id_order'])->get()->first();
        // ambil data harga berdasarkan id data standar yang diinput
        $dataHarga = DataHargar::where('id', $request['id_data_standar'])->get()->first();
        // dd($request['id_order']);
        // hitung total penjualan
        $totalPenjualan = $dataHarga->harga_jual * $dataOrder->dataOrder->jumlah_order;
        // hitung jumlah dibayar
        $jumlah_dibayar = $totalPenjualan + ($totalPenjualan * ($request['ppn']/100));
        // merubah request ppn menjadi format rupiah
        request()->ppn = $totalPenjualan * ($request['ppn']/100);

        $termin = explode('/', $request->termin);
        $tglJatuhTempo = date("Y-m-d", strtotime("+$termin[1] days", strtotime($request['tanggal_invoice'])));

        // buat data invoice
        Invoice::where('id', $id)->update([
            'id_invoice' => $request['id_invoice'],
            'termin' => $request['termin'],
            'tanggal_invoice' => $request['tanggal_invoice'],
            'id_order' => $request['id_order'],
            'id_sertif' => $request['id_sertif'],
            'no_bl' => $request['no_bl'],
            'shipper' => $request['shipper'],
            'stuffing_date' => $request['stuffing_date'],
            'closing_time' => $request['closing_time'],
            'id_recordsheet' => $request['id_recordsheet'],
            'id_data_standar' => $request['id_data_standar'],
            'total_penjualan' => $totalPenjualan,
            'tanggal_jatuh_tempo' => $tglJatuhTempo,
            'ppn' => $request['ppn'],
            'jumlah_dibayar' => $jumlah_dibayar,
        ]);

        // Ambil nama customer 
        $nama_customer = DetailOrder::where('id', $request['id_order'])->get()->first()->dataOrder->dataCustomer->nama_customer;

        // Masukkan Data invoice Ke Jurnal Umum
        KeuJurnal::where('no_bukti', $request->id_invoice)->update([
            'tanggal_jurnal' => $request->tanggal_invoice,
            'uraian_jurnal' => 'Pendapatan Jasa dari ' . $nama_customer,
            'no_bukti' => $request->id_invoice,
        ]);


        // ambil data Akun
        $kodeAkun1120 = KeuAkun::where('kode_akun', '1120')->get()->first();
        $kodeAkun2120 = KeuAkun::where('kode_akun', '2120')->get()->first();
        $kodeAkun4110 = KeuAkun::where('kode_akun', '4110')->get()->first();

        // jika jenis akun adalah kredit maka kurangi 
        $saldo_akun1120 = $kodeAkun1120->saldo_akun + $jumlah_dibayar;
        // jika jenis akun adalah kredit maka kurangi 
        $saldo_akun2120 = $kodeAkun2120->saldo_akun + $request->ppn;
        // jika jenis akun adalah debet maka tambahi
        $saldo_akun4110 = $kodeAkun4110->saldo_akun + $totalPenjualan;

        // ubah sesuai operasi diatas
        KeuAkun::where('kode_akun', '1120')->update([
            'saldo_akun' => $saldo_akun1120,
        ]);
        // ubah sesuai operasi diatas
        KeuAkun::where('kode_akun', '2120')->update([
            'saldo_akun' => $saldo_akun2120,
        ]);
        // ubah sesuai operasi diatas
        KeuAkun::where('kode_akun', '4110')->update([
            'saldo_akun' => $saldo_akun4110,
        ]);

        $id_1120 = KeuAkun::where('kode_akun', '1120')->get()->first()->id;
        $id_2120 = KeuAkun::where('kode_akun', '2120')->get()->first()->id;
        $id_4110 = KeuAkun::where('kode_akun', '4110')->get()->first()->id;

        // ambil data no jurnal dimana no bukti berdasarkan data invoice yang ingin dirubah
        $no_jurnal = KeuJurnal::where('no_bukti', $request->id_invoice)->get()->first()->id;

        // Ubah Data Detail Jurnal bagian debet berdasarkan no jurnal yang dirubah dan kode akun
        KeuDetailJurnal::where('no_jurnal', $no_jurnal)->where('kode_akun', $id_1120)->update([
            'no_jurnal' => $no_jurnal,
            'kode_akun' => $id_1120,
            'debet' => $jumlah_dibayar
        ]);
        // Ubah Data Detail Jurnal bagian debet berdasarkan no jurnal yang dirubah dan kode akun
        KeuDetailJurnal::where('no_jurnal', $no_jurnal)->where('kode_akun', $id_2120)->update([
            'no_jurnal' => $no_jurnal,
            'kode_akun' => $id_2120,
            'kredit' => $request->ppn
        ]);
        // Ubah Data Detail Jurnal bagian kredit berdasarkan no jurnal yang dirubah dan kode akun
        KeuDetailJurnal::where('no_jurnal', $no_jurnal)->where('kode_akun', $id_4110)->update([
            'no_jurnal' => $no_jurnal,
            'kode_akun' => $id_4110,
            'kredit' => $totalPenjualan
        ]);

        return redirect(route('Invoice'))->with('edit', 'Data Invoice Berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Ambil id_invoice dari table Penggajian dimana id sesuai dengan id yang dikirimkan
        $id_invoice = Invoice::where('id', $id)->get()->first()->id_invoice;
        // Ambil no jurnal dari table jurnal umum dimana no bukti sesuai dengan id penggajian
        $no_jurnal = KeuJurnal::where('no_bukti', $id_invoice)->get()->first()->id ?? null;

        if (isset($no_jurnal)) {
            // ambil seluruh data detail jurnal
            $detail_jurnal = KeuDetailJurnal::where('no_jurnal', $no_jurnal)->get();

            try {
                // hapus record table detail jurnal berdasarkan no jurnal
                KeuDetailJurnal::where('no_jurnal', $no_jurnal)->delete();
                // hapus record table jurnal berdasarkan no jurnal
                KeuJurnal::where('id', $no_jurnal)->delete();

                Invoice::where('id', $id)->delete();
                // Validate the value...
            } catch (Throwable $e) {
                return back()->with('error', $e->getMessage());
            }

            // lakukan pengembalian saldo tiap tiap akun dari jurnal umum yang dihapus
            foreach ($detail_jurnal as $record) {
                // dapatkan kode akun dari tiap akun yang dihapus
                $kode_akun = $record->kode_akun;

                // dapatkan akun berdasarkan kode akun yang dihapus
                $akun = KeuAkun::where('id', $kode_akun)->get()->first();
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

        return redirect(route('Invoice'))->with('delete', 'Data Invoice Berhasil dihapus');
    }
}
