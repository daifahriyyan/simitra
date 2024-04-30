<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeuDetailJurnal extends Model
{
    use HasFactory;

    public $table = 'keu_detail_jurnal';

    protected $guarded = ['id'];

    public function jurnal()
    {
        return $this->belongsTo(KeuJurnal::class, 'no_jurnal', 'no_jurnal');
    }

    public function akun()
    {
        return $this->belongsTo(Keuakun::class, 'kode_akun', 'kode_akun');
    }
}
