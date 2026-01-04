<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_test_requirements', function (Blueprint $blueprint) {
            $blueprint->id();
            $blueprint->foreignId('product_type_id')->constrained()->onDelete('cascade');
            $blueprint->foreignId('test_type_id')->constrained()->onDelete('cascade');
            $blueprint->foreignId('department_id')->nullable()->constrained()->onDelete('cascade');
            $blueprint->decimal('min_value', 10, 4)->nullable();
            $blueprint->decimal('max_value', 10, 4)->nullable();
            $blueprint->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_test_requirements');
    }
};
