<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeuAsetTetap extends Model
{
    use HasFactory;

    public $table = 'keu_aset_tetap';

    public $guarded = ['id'];

    public function penyusutanAt()
    {
        return $this->hasOne(KeuPenyusutanAt::class, 'id', 'kode_at');
    }
}
