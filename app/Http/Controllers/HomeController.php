<?php

namespace App\Http\Controllers;

use App\Models\DataOrder;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //

    public function index(){
        return view('customer-side.index');
    }
    
    public function formOrder(){
        return view('customer-side.form', [
            'jumlah_order' => request()->jumlah_order,
        ]);
    }

    public function order(){
    }
    
    public function contact(){
        return view('customer-side.contact');
    }
    
    public function daftarOrder(){
        return view('customer-side.order');
    }
    
    public function statusOrder(){
        return view('customer-side.status-order');
    }
}
