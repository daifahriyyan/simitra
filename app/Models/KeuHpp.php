<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeuHpp extends Model
{
    use HasFactory;

    public $table = 'keu_hpp';

    public $guarded = ['id'];
}
