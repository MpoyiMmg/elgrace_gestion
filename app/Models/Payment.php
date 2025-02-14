<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasUuids;

    protected $fillable = [
        'payment_date',
        'payment_amount',
        'invoice_id',
        'payment_method',
        'remaining_amount',
        'surplus_amount'
    ];
}
