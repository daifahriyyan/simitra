<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataImporter extends Model
{
    use HasFactory;

    public $table = 'data_importer';

    public $fillable = [
        'id_importer',
        'nama_importer',
        'alamat_importer',
        'telp_importer',
        'fax',
        'usci',
        'pic',
    ];
}
