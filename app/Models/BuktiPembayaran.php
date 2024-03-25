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
}
