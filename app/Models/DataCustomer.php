<?php

namespace App\Models;

use App\Models\User;
use App\Models\DetailCustomer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataCustomer extends Model
{
  use HasFactory;

  public $table = 'data_customer';

  public $fillable = [
    'id_customer',
    'nama_customer',
    'alamat_customer',
    'telepon_customer',
    'email_customer',
    'pic',
    'phone_pic',
    'id_user'
  ];

  public function detailCustomer(){
    return $this->hasOne(DetailCustomer::class, 'id', 'id');
  }

  public function user(){
    return $this->hasOne(User::class, 'id_customer', 'id_customer');
  }

  public function dataOrder(){
    return $this->hasMany(DataOrder::class, 'id', 'id_customer');
  }
}
