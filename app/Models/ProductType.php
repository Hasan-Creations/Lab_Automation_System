<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductType extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'prefix', 'description'];

    public function requirements(): HasMany
    {
        return $this->hasMany(ProductTestRequirement::class);
    }

    public function batches(): HasMany
    {
        return $this->hasMany(Batch::class);
    }
}
