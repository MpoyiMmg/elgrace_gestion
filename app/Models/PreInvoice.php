<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class PreInvoice extends Model
{
    use HasUuids;

    protected $fillable = [
        'client_id', 'reference', 'issue_date', 'expiry_date','status', 'total_amount', 'total_ht', 'tva', 'total_ttc', 'reduction_rate', 'reduction_ht'
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

    public function generateReference() {
        $date = date('dmY');
        if ($this->number >= 0 && $this->number < 10) {
            $str = "000";
        } elseif ($this->number >= 10 && $this->number < 100) {
            $str = "00";
        } elseif ($this->number >= 100 && $this->number < 1000) {
            $str = "0";
        } else {
            $str = "";
        }
        $reference = "ELGS$date".str_pad($this->number, 5, '#'.$str, STR_PAD_LEFT)."/".date('Y');
        return $reference;
    }

    public static function boot() {
        parent::boot();
        static::creating(function ($preInvoice) {
            $preInvoice->number = self::max('number') + 1;
        });

        static::creating(function ($preInvoice) {
            $preInvoice->reference = $preInvoice->generateReference();
        });
    }

    public function invoice() {
        return $this->hasOne(Invoice::class);
    }
}
