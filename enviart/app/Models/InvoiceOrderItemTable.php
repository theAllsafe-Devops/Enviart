<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceOrderItemTable extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='tbl_invoiceorderitemtable';
    protected $fillable = [
        'order_id',
        'item_id',
        'order_item_quantity',
        'order_item_final_amount',
        'created_at',
        'updated_at'
    ];

}
