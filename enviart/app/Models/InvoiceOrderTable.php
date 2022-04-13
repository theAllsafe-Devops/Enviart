<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceOrderTable extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='tbl_invoiceordertable';
    protected $fillable = [
        'user_id',
        'customer_name',
        'customer_vat_no',
        'order_total_before_tax',
        'order_total_tax',
        'order_tax_per',
        'order_total_after_tax',
        'order_amount_paid',
        'dAmount',
        'order_total_amount_due',
        'payment_type',
        'created_at',
        'updated_at'
    ];

}
