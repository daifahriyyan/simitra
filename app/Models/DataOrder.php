<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataOrder extends Model
{
    use HasFactory;

    public $table = 'data_order';

    public $fillable = [
        'id_order',
        'id_order_container',
        'tanggal_order',
        'id_customer',
        'nama_customer',
        'telp_customer',
        'jumlah_order',
        'treatment',
        'stuffing_date',
        'id_datastandar',
        'volume',
        'container',
        'container_volume',
        'commodity',
        'vessel',
        'place_fumigation',
        'pic',
        'phone_pic',
    ];

    public function detailOrder(){
        return $this->hasOne(DetailOrder::class, 'id_order');
    }
}
