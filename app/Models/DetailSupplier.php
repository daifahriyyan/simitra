<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailSupplier extends Model
{
    use HasFactory;

    public $table = "keu_detail_supplier";

    protected $guarded = ['id'];

    public function supplier()
    {
        return $this->belongsTo(KeuSupplier::class, 'id_supplier', 'id');
    }
}
