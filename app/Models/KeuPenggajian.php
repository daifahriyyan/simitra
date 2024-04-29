<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeuPenggajian extends Model
{
    use HasFactory;

    public $table = 'keu_penggajian';

    public $guarded = ['id'];

    public function pegawai()
    {
        return $this->belongsTo(DataPegawai::class, 'id_pegawai', 'id');
    }
}
