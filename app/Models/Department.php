<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'description'];

    // people in this dept
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    // what tests they handle
    public function requirements(): HasMany
    {
        return $this->hasMany(ProductTestRequirement::class);
    }
}
