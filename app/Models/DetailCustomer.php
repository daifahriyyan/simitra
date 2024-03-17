<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailCustomer extends Model
{
    use HasFactory;

    public $table = 'detail_customer';

    public $fillable = [
        'id_customer',
        'termin',
        'tanggal_input',
        'saldo_awal',
        'total_penjualan',
        'penerimaan',
        'saldo_akhir',
    ];

    public function dataCustomer(){
        return $this->belongsTo(DataCustomer::class, 'id_customer', 'id_customer');
    }
}
