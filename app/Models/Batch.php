<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Batch extends Model
{
    protected $fillable = [
        'product_id',
        'batch_code',
        'product_type_id',
        'quantity',
        'manufacturing_number'
    ];

    // what type of product is this
    public function productType(): BelongsTo
    {
        return $this->belongsTo(ProductType::class);
    }

    // get all the testing tries (revs)
    public function revisions(): HasMany
    {
        return $this->hasMany(BatchRevision::class);
    }

    // the latest status
    public function currentRevision(): HasOne
    {
        return $this->hasOne(BatchRevision::class)->latest();
    }
}
