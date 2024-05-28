<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DraftPelayaran extends Model
{
    use HasFactory;

    public $table = 'draft_pelayaran';

    public $guarded = ['id'];

    public function dataOrder()
    {
        return $this->belongsTo(DataOrder::class, 'id_order', 'id');
    }

    public function detailOrder()
    {
        return $this->belongsTo(DetailOrder::class, 'id_order', 'id');
    }
}
