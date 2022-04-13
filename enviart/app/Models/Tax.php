<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    use HasFactory;
    protected $table='tbl_tax';
    protected $fillable = [
        'tax_name',
        'precentage',
        'arbic_precentage',
        'created_at',
        'updated_at'
    ];

}
