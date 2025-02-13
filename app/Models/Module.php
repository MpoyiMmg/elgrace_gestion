<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasUuids;
    use HasFactory;
    
    protected $fillable = [
        'name', 'code'
    ];

    // protected static function booted()
    // {
    //     static::creating(function ($model) {
    //         do {
    //             $code = Str::upper(Str::random(5));
    //         } while (self::where('code', $code)->exists());

    //         $model->code = $code;
    //     });
    // }
}
