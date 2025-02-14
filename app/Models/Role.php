<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany; 
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    use HasUuids, HasFactory;
    
    protected $primaryKey = 'id';
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}

