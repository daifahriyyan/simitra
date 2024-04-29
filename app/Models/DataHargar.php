<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function standarHPP()
    {
        return $this->BelongsTo(DataHppFeet::class, 'id_standar', 'id');
    }

    public function dataHarga()
    {
        return $this->hasOne(DataHppFeet::class, 'id_standar', 'id');
    }

    public function invoice()
    {
        return $this->hasOne(DataHppFeet::class, 'id_data_standar', 'id');
    }

    public function dataOrder()
    {
        return $this->hasOne(DataOrder::class, 'id_data_harga', 'id');
    }

    public function rekapHPP()
    {
        return $this->hasOne(RekapHpp::class, 'id_data_harga', 'id');
    }
}
