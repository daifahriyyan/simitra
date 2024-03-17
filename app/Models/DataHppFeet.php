<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataHppFeet extends Model
{
    use HasFactory;

    public $table = 'data_hpp_feet';

    public $guard = '';

    public $fillable = [
        'id_standar',
        'bbb_feet',
        'btk_feet',
        'bop_feet',
        'jumlah_hpp_feet',
    ];
}
