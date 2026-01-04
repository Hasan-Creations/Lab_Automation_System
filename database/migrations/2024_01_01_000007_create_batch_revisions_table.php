<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('batch_revisions', function (Blueprint $blueprint) {
            $blueprint->id();
            $blueprint->foreignId('batch_id')->constrained()->onDelete('cascade');
            $blueprint->string('revision_number')->default('R01');
            $blueprint->string('status')->default('PENDING');
            $blueprint->foreignId('created_by')->constrained('users');
            $blueprint->timestamp('failed_at')->nullable();
            $blueprint->timestamp('approved_at')->nullable();
            $blueprint->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('batch_revisions');
    }
};
