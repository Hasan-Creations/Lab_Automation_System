<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    protected $fillable = [
        'test_id',
        'product_id',
        'test_code',
        'department',
        'tester_name',
        'testing_criteria',
        'expected_output',
        'output_observed',
        'final_result_explanation',
        'status',
        'test_date'
    ];

    protected $casts = [
        'test_date' => 'datetime',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    public function testType()
    {
        return $this->belongsTo(TestType::class, 'test_code', 'test_code');
    }
}
