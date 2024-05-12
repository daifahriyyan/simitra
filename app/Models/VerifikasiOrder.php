<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerifikasiOrder extends Model
{
    use HasFactory;

    public $table = 'verifikasi_order';

    public $guarded = 'id';

    public $fillable = [
        'id_verifikasi',
        'id_order',
        'waktu',
        'tujuan',
        'destination',
        'packing',
        'kondisi_status',
        'place_fumigation',
        'kesimpulan',
    ];

    public function dataOrder()
    {
        return $this->belongsTo(DataOrder::class, 'id_order', 'id');
    }

    public function detailOrder()
    {
        return $this->belongsTo(DetailOrder::class, 'id_order', 'id');
    }
}
