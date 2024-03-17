<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataHargar extends Model
{
    use HasFactory;

    public $table = 'data_harga';

    public $fillable = [
        'id_datastandar',
        'id_standar',
        'volume',
        'treatment',
        'bbb_standar',
        'btk_standar',
        'bop_standar',
        'hpp',
        'markup',
        'harga_jual',
    ];
}
