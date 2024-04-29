<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeuPenyusutanAt extends Model
{
    use HasFactory;

    public $table = 'keu_penyusutan_at';

    protected $guarded = ['id'];

    public function asetTetap()
    {
        return $this->belongsTo(KeuAsetTetap::class, 'kode_at', 'id');
    }
}
