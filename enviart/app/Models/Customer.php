<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table='customer';
    protected $fillable = [
        'customer_name',
        'customer_address',
        'customer_mobileno',
        'customer_emailid',
        'customer_gstno',
        'customer_panno',
        'created_at',
        'updated_at'
    ];

}
