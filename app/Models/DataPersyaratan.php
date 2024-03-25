<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPersyaratan extends Model
{
    use HasFactory;

    public $table = 'data_persyaratan';

    public $fillable = [
        'id_order',
        'id_order_container',
        'nama_driver',
        'telp_driver',
        'shipment_instruction',
        'packing_list'
    ];
}
