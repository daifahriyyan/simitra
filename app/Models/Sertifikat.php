<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sertifikat extends Model
{
    use HasFactory;

    public $table = 'sertifikat';

    public $guarded = ['id'];

    public function dataOrder()
    {
        return $this->belongsTo(DataOrder::class, 'id_order', 'id');
    }

    public function detailOrder()
    {
        return $this->belongsTo(DetailOrder::class, 'id_order', 'id');
    }

    public function statusOrder()
    {
        return $this->HasOne(DetailOrder::class, 'id_order', 'id');
    }

    public function order()
    {
        return $this->hasOne(DataOrder::class, 'id_order', 'id');
    }

    public function dataImporter()
    {
        return $this->belongsTo(DataImporter::class, 'id_importer', 'id');
    }

    public function dataRecordsheet()
    {
        return $this->belongsTo(MetilRecordsheet::class, 'id_recordsheet', 'id');
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class, 'id', 'id_sertif');
    }
}
