<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataCustomer extends Model
{
  use HasFactory;

  public $table = 'data_customer';

  public $fillable = [
    'id_customer',
    'nama_customer',
    'alamat_customer',
    'telp_customer',
    'email_customer',
    'pic',
    'phone_pic',
  ];
}
