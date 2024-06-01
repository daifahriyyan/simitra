<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\DataOrder;
use App\Models\DataHargar;
use App\Models\Notifikasi;
use App\Models\DetailOrder;
use App\Models\DataCustomer;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class DataOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->posisi == null) {
          return redirect()->route('Home');

        } else if (Auth::user()->posisi == 'Direktur' || Auth::user()->posisi == 'Administrasi') {
            if (isset(request()->tanggalMulai) && isset(request()->tanggalAkhir)) {
                $tanggalMulai = request()->tanggalMulai;
                $tanggalAkhir = request()->tanggalAkhir;
                $detailOrder = DetailOrder::whereHas('dataOrder', function ($query) use ($tanggalMulai, $tanggalAkhir) {
                    $query->whereBetween('tanggal_order', [$tanggalMulai, $tanggalAkhir]);
                })->get();
            } else {
                $detailOrder = DetailOrder::get();
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
                $pdf = Pdf::loadView('generate-pdf.tabel-order', ['detailOrder' => $detailOrder])->setPaper('a4');
                return $pdf->stream('Daftar Order.pdf');
            } else if (request()->get('export') == 'pdf-detail') {
                $detail = DetailOrder::where('id_detailorder', request()->id_detailorder)->get()->first();
                Pdf::setOption([
                    'enabled' => true,
                    'isRemoteEnabled' => true,
                    'chroot' => realpath(''),
                    'isPhpEnabled' => true,
                    'isFontSubsettingEnabled' => true,
                    'pdfBackend' => 'CPDF',
                    'isHtml5ParserEnabled' => true
                ]);
                $pdf = Pdf::loadView('generate-pdf.request-order', ['detail' => $detail])->setPaper('a4');
                return $pdf->stream('Request Order.pdf');
            }
    
            if (request()->get('verif') !== null) {
                DetailOrder::where('id', request()->get('verif'))->update([
                    'verifikasi' => 1
                ]);
                
                // Menambahkan Notifikasi
                Notifikasi::create([
                    'keterangan' => "Terdapat Order no.".request()->id_detailorder."untuk dicek kelayakan kontainernya",
                    'is_read' => 'N',
                    'posisi' => 'Operasional',
                ]);
        
            }
            if (request()->get('reject') !== null) {
                DetailOrder::where('id', request()->get('reject'))->update([
                    'is_reject' => '1'
                ]);
            }
    
            return view('pages.penerimaan-jasa.order', [
                'title' => 'Data Order',
                'dataCustomers' => DataCustomer::all(),
                'hargaJasa' => DataHargar::all(),
                'dataOrder' => DataOrder::with('dataCustomer')->get(),
                'detailOrder' => $detailOrder
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
        $id_customer = $_GET['id_customer'];
        $data_customer = DataCustomer::where('id_customer', $id_customer)->get();
        $data = array(
            'nama'      =>  $data_customer[0]->id_customer,
            'jeniskelamin' =>  $data_customer[0]->nama_customer,
            'jurusan'   =>  $data_customer[0]->alamat_customer,
            'notelp'      =>  $data_customer[0]->telp_customer,
            'email'      =>  $data_customer[0]->email_customer,
            'alamat'    =>  $data_customer[0]->alamat
        );

        //tampil data
        echo json_encode($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = request()->validate([
            'id_order' => 'required|unique:data_order,id_order',
            'id_order_container' => 'required|unique:data_order,id_order_container',
            'tanggal_order' => 'required',
            'id_customer' => 'required',
            'nama_customer' => 'required',
            'telp_customer' => 'required',
            'jumlah_order' => 'required',
            'treatment' => 'required',
            'stuffing_date' => 'required',
            'id_datastandar' => 'required',
            'volume' => 'required',
            'container' => 'required',
            'container_volume' => 'required',
            'commodity' => 'required',
            'vessel' => 'required',
            'place_fumigation' => 'required',
            'pic' => 'required',
            'phone_pic' => 'required',
        ]);

        DataOrder::create($validator);
        return redirect(route('Detail Customer'))->with('add', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(DataOrder $dataOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DataOrder $dataOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DataOrder $dataOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DataOrder $dataOrder, $id)
    {
        $idOrder = DetailOrder::where('id', $id)->get()->first()->id_order;
        try {
            DetailOrder::where('id', $id)->delete();
            DataOrder::where('id', $idOrder)->delete();
            // Validate the value...
        } catch (Throwable $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect(route('Data Order'));
    }

    public function ajaxOrder()
    {
        $data = DataCustomer::where('id', request()->id)->get();

        return json_encode($data);
    }
}
