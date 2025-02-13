<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class PreInvoiceDetail extends Model
{
    use HasUuids;

    protected $fillable = [
        'pre_invoice_id',
        'article_id',
        'quantity',
        'total_amount',
        'service_id',
        'module_invoice_details'
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    public function preInvoice()
    {
        return $this->belongsTo(PreInvoice::class);
    }
}
