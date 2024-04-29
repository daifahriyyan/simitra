<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeuJurnal extends Model
{
    use HasFactory;

    public $table = "keu_jurnal";

    protected $guarded = ['id'];
}
