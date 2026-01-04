<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'product_code',
        'product_type',
        'revision',
        'manufacturing_number',
        'status'
    ];

    // get all tests for this product
    public function tests()
    {
        return $this->hasMany(Test::class, 'product_id', 'product_id');
    }

    // its cpri info
    public function cpriSubmission()
    {
        return $this->hasOne(CpriSubmission::class, 'product_id', 'product_id');
    }
}
