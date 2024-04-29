<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuktiPembayaran extends Model
{
    use HasFactory;

    public $table = 'bukti_pembayaran';

    public $fillable = [
        'id_order',
        'tanggal_pembayaran',
        'bukti_pembayaran',
    ];

    public function dataOrder()
    {
        return $this->belongsTo(DataOrder::class, 'id_order', 'id');
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'id_invoice', 'id');
    }
}
