<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailOrder extends Model
{
    use HasFactory;

    public $table = 'detail_order';

    public $fillable = [
        'id_order',
        'id_detailorder',
        'stuffing_date',
        'id_data_harga',
        'container',
        'container_volume',
        'commodity',
        'vessel',
        'closing_time',
        'destination',
        // 'place_fumigation',
        'pic',
        'phone_pic',
        'nama_driver',
        'telp_driver',
        'shipment_instruction',
        'packing_list',
    ];

    public function dataOrder()
    {
        return $this->belongsTo(DataOrder::class, 'id_order', 'id');
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'id_order', 'id');
    }

    public function suratPemberitahuan()
    {
        return $this->hasOne(SuratPemberitahuan::class, 'id', 'id_order');
    }

    public function spk()
    {
        return $this->hasOne(SuratPerintahKerja::class, 'id', 'id_order');
    }
}
