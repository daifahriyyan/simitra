<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetilRecordsheet extends Model
{
    use HasFactory;

    public $table = 'metil_recordsheet';

    protected $guarded = ['id'];

    public function dataOrder()
    {
        return $this->belongsTo(DataOrder::class, 'id_order', 'id');
    }

    public function detailOrder()
    {
        return $this->belongsTo(DetailOrder::class, 'id_order', 'id');
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class, 'id', 'id_recordsheet');
    }
}
