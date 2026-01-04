<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('test_types', function (Blueprint $blueprint) {
            $blueprint->id();
            $blueprint->string('test_name');
            $blueprint->string('test_code')->unique();
            $blueprint->string('unit')->nullable();
            $blueprint->text('description')->nullable();
            $blueprint->string('department')->nullable();
            $blueprint->text('criteria')->nullable();
            $blueprint->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('test_types');
    }
};
