<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeuSupplier extends Model
{
    use HasFactory;

    public $table = 'keu_supplier';

    protected $guarded = ['id'];

    public function detailSupplier()
    {
        return $this->hasOne((DetailSupplier::class), 'id', 'id_supplier');
    }
}
