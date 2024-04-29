<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HppSesungguhnya extends Model
{
    use HasFactory;

    public $table = "hpp_sesungguhnya";

    public $guarded = ['id'];
}
