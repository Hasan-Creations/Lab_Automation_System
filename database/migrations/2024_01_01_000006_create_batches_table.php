<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('batches', function (Blueprint $blueprint) {
            $blueprint->id();
            $blueprint->string('product_id')->unique();
            $blueprint->string('batch_code')->unique();
            $blueprint->foreignId('product_type_id')->constrained();
            $blueprint->integer('quantity');
            $blueprint->string('manufacturing_number')->nullable();
            $blueprint->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('batches');
    }
};
