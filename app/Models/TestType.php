<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestType extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'test_code',
        'test_name',
        'description',
        'department',
        'criteria'
    ];
}
