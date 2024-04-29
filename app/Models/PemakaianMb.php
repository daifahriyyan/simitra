<?php

namespace App\Models;

use App\Models\DataPersediaan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PemakaianMb extends Model
{
    use HasFactory;

    public $table = 'pemakaian_mb';

    protected $guarded = ['id'];

    public function dataPersediaan()
    {
        return $this->belongsTo(DataPersediaan::class, 'id_persediaan', 'id');
    }
}
