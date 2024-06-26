<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPersediaan extends Model
{
    use HasFactory;

    public $table = 'data_persediaan';

    public $fillable = [
        'id_persediaan',
        'nama_persediaan',
        'quantity',
        'saldo',
    ];

    public function pemakaianMethyl()
    {
        return $this->hasOne(PemakaianMb::class, 'id', 'id_persediaan');
    }

    public function kartuPersediaan()
    {
        return $this->hasOne(KartuPersediaan::class, 'id', 'id_persediaan');
    }
}
