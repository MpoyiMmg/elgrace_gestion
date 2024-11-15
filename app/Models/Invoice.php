<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasUuids;

    protected $fillable = [
        'reference', 'pre_invoice_id', 'status', 'payment_date', 'completed_payment_date', 'paid_amount', 'remaining_amount'
    ];

    public function preInvoice() {
        return $this->belongsTo(PreInvoice::class);
    }
}
