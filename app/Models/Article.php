<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasUuids;

    protected $fillable = [
        'name', 'description', 'unit_price', 'quantity'
    ];

    public function service() {
        return $this->belongsTo(Service::class);
    }
}
