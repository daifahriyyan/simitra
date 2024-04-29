<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KartuPersediaan extends Model
{
    use HasFactory;

    public $table = 'kartu_persediaan';

    protected $guarded = ['id'];

    public function dataPersediaan()
    {
        return $this->belongsTo(DataPersediaan::class, 'id_persediaan', 'id');
    }
}
