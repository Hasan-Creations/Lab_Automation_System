<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('test_results', function (Blueprint $blueprint) {
            $blueprint->id();
            $blueprint->string('test_id')->unique();
            $blueprint->foreignId('batch_revision_id')->constrained()->onDelete('cascade');
            $blueprint->foreignId('test_type_id')->constrained();
            $blueprint->foreignId('tester_id')->constrained('users');
            $blueprint->string('product_id');
            $blueprint->string('product_code');
            $blueprint->string('revision_number');
            $blueprint->string('tester_name');
            $blueprint->string('tester_department');
            $blueprint->string('observed_value')->nullable();
            $blueprint->string('result');
            $blueprint->text('remarks')->nullable();
            $blueprint->timestamp('tested_at');
            $blueprint->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('test_results');
    }
};
