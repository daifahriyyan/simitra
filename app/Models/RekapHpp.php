<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekapHpp extends Model
{
    use HasFactory;

    public $table = 'rekap_hpp';

    protected $guarded = ['id'];

    public function dataHarga()
    {
        return $this->belongsTo(DataHargar::class, 'id_data_harga', 'id');
    }

    public function rekapPenjualan()
    {
        return $this->belongsTo(RekapPenjualan::class, 'id_rekap_penjualan', 'id');
    }
}
