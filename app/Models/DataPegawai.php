<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPegawai extends Model
{
    use HasFactory;
    
    public $table = 'data_pegawai';

    public $fillable = [
        'id_pegawai',
        'nama_pegawai',
        'alamat_pegawai',
        'telp_pegawai',
        'posisi',
        'noreg_fumigasi',
        'gaji_pokok',
    ];
}
