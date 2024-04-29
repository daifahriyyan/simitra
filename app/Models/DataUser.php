<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataUser extends Model
{
    use HasFactory;

    public $table = 'data_user';

    public $fillable = [
        'username',
        'nama_lengkap',
        'posisi',
        'email',
        'password',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];
}
