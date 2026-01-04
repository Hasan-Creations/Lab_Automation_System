<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cpri_submissions', function (Blueprint $blueprint) {
            $blueprint->id();
            $blueprint->foreignId('batch_revision_id')->constrained()->onDelete('cascade');
            $blueprint->date('submission_date');
            $blueprint->string('cpri_reference')->nullable();
            $blueprint->string('status')->default('pending');
            $blueprint->text('remarks')->nullable();
            $blueprint->foreignId('submitted_by')->constrained('users');
            $blueprint->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cpri_submissions');
    }
};
