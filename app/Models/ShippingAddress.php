<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingAddress extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','purchase_id','first_name','last_name','email','mobile','address_1','address_2','country','state','city','postcode'];
}
