<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeuLabaRugi extends Model
{
    use HasFactory;

    public $table = 'keu_laba_rugi';

    protected $guarded = ['id'];
}
