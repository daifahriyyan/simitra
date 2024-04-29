<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratPemberitahuan extends Model
{
    use HasFactory;

    public $table = 'surat_pemberitahuan';

    protected $guarded = ['id'];

    public function dataOrder()
    {
        return $this->belongsTo(DataOrder::class, 'id_order', 'id');
    }

    public function detailOrder()
    {
        return $this->belongsTo(DetailOrder::class, 'id_order', 'id');
    }
}
