<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    public $table = 'invoice';

    protected $guarded = ['id'];

    public function sertifikat()
    {
        return $this->belongsTo(Sertifikat::class, 'id_sertif', 'id');
    }

    public function dataOrder()
    {
        return $this->belongsTo(DataOrder::class, 'id_order', 'id');
    }

    public function order()
    {
        return $this->hasOne(DataOrder::class, 'id_order', 'id');
    }

    public function detailOrder()
    {
        return $this->belongsTo(DetailOrder::class, 'id_order', 'id');
    }

    public function methylRecordsheet()
    {
        return $this->belongsTo(MetilRecordsheet::class, 'id_recordsheet', 'id');
    }

    public function dataHarga()
    {
        return $this->belongsTo(DataHargar::class, 'id_data_standar', 'id');
    }

    public function buktiPembayaran()
    {
        return $this->hasOne(BuktiPembayaran::class, 'id', 'id_invoice');
    }

    public function rekapPenjualan()
    {
        return $this->hasOne(RekapPenjualan::class, 'id', 'id_invoice');
    }
}
