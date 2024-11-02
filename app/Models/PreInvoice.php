<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class PreInvoice extends Model
{
    use HasUuids;

    protected $fillable = [
        'client_id', 'reference', 'issue_date', 'expiry_date','status', 'total_amount'
    ];

    public function client() {
        return $this->belongsTo(Client::class);
    }

    public function itemDetails() {
        return $this->hasMany(PreInvoiceDetail::class);
    }

    public function calculateTotalItemPrice(){
        return $this->itemDetails()->sum('total_amount');
    }
}
