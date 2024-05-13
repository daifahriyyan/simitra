<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataOrder extends Model
{
    use HasFactory;

    public $table = 'data_order';

    public $guarded = ['id'];

    public function dataHarga()
    {
        return $this->belongsTo(DataHargar::class, 'id_data_harga', 'id');
    }

    public function dataCustomer()
    {
        return $this->belongsTo(DataCustomer::class, 'id_customer', 'id');
    }

    public function detailOrder()
    {
        return $this->hasMany(DetailOrder::class, 'id', 'id_order');
    }

    public function verifikasiOrder()
    {
        return $this->hasOne(VerifikasiOrder::class, 'id', 'id_order');
    }

    public function spk()
    {
        return $this->hasOne(SuratPerintahKerja::class, 'id', 'id_order');
    }

    public function sp()
    {
        return $this->hasOne(SuratPemberitahuan::class, 'id', 'id_order');
    }

    public function ceklist()
    {
        return $this->hasOne(CeklistFumigasi::class, 'id', 'id_order');
    }

    public function metilRecordsheet()
    {
        return $this->hasOne(MetilRecordsheet::class, 'id', 'id_order');
    }

    public function pemberitahuan()
    {
        return $this->hasOne(Pemberitahuan::class, 'id', 'id_order');
    }

    public function draftPelayaran()
    {
        return $this->hasOne(DraftPelayaran::class, 'id', 'id_order');
    }

    public function sertifikat()
    {
        return $this->hasOne(Sertifikat::class, 'id', 'id_order');
    }

    public function sertif()
    {
        return $this->belongsTo(Sertifikat::class, 'id', 'id_order');
    }

    public function invoicee()
    {
        return $this->belongsTo(Invoice::class, 'id', 'id_order');
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class, 'id', 'id_order');
    }

    public function buktiPembayaran()
    {
        return $this->hasOne(BuktiPembayaran::class, 'id', 'id_order');
    }

    public function rekapPenjualan()
    {
        return $this->hasOne(RekapPenjualan::class, 'id', 'id_order');
    }
}
