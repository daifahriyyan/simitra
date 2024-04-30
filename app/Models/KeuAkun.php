<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeuAkun extends Model
{
    use HasFactory;

    public $table = 'keu_akun';

    protected $guarded = ['id'];


    public function akun()
    {
        return $this->hasOne(KeuDetailJurnal::class, 'kode_akun', 'kode_akun');
    }
}
