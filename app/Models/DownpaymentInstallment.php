<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DownpaymentInstallment extends Model
{
    protected $fillable = ['commission_request_sales_id', 'term_number', 'amount', 'is_paid', 'paid_at'];

    protected $casts = ['is_paid' => 'boolean', 'paid_at' => 'date'];
}
