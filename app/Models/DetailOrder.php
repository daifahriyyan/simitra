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
        'id_data_standar',
        'stuffing_date',
        'id_data_harga',
        'container',
        'container_volume',
        'commodity',
        'vessel',
        'closing_time',
        'destination',
        'place_fumigation',
        'pic',
        'phone_pic',
    ];

    public function dataOrder(){
        return $this->belongsTo(DataOrder::class, 'id_order');
    }
}
