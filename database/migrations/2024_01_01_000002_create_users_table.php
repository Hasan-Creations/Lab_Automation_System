<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $blueprint) {
            $blueprint->id();
            $blueprint->string('name')->nullable();
            $blueprint->string('full_name');
            $blueprint->string('username')->unique()->nullable();
            $blueprint->string('email')->unique()->nullable();
            $blueprint->timestamp('email_verified_at')->nullable();
            $blueprint->string('password');
            $blueprint->string('user_type')->nullable(); // For legacy role mapping
            $blueprint->string('department')->nullable(); // For legacy department mapping
            $blueprint->foreignId('department_id')->nullable()->constrained()->onDelete('set null');
            $blueprint->string('role')->default('user');
            $blueprint->boolean('is_active')->default(true);
            $blueprint->rememberToken();
            $blueprint->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $blueprint) {
            $blueprint->string('email')->primary();
            $blueprint->string('token');
            $blueprint->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $blueprint) {
            $blueprint->string('id')->primary();
            $blueprint->foreignId('user_id')->nullable()->index();
            $blueprint->string('ip_address', 45)->nullable();
            $blueprint->text('user_agent')->nullable();
            $blueprint->longText('payload');
            $blueprint->integer('last_activity')->index();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
