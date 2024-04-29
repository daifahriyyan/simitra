<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekapPenjualan extends Model
{
    use HasFactory;

    public $table = "rekap_penjualan";

    protected $guarded = ['id'];

    public function dataOrder()
    {
        return $this->belongsTo(DataOrder::class, 'id_order', 'id');
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'id_invoice', 'id');
    }

    public function rekapHPP()
    {
        return $this->hasOne(RekapHpp::class, 'id', 'id_rekap_hpp');
    }
}
