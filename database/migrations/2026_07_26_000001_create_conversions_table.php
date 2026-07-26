<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('conversions', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('source_filename');
            $table->string('source_mime_type');
            $table->string('source_extension', 10);
            $table->bigInteger('source_size');
            $table->string('target_extension', 10);
            $table->string('category', 20);
            $table->string('status', 20)->default('pending');
            $table->text('error_message')->nullable();
            $table->string('output_path')->nullable();
            $table->bigInteger('output_size')->nullable();
            $table->unsignedInteger('duration_ms')->nullable();
            $table->json('options')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['status', 'created_at']);
            $table->index('category');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('conversions');
    }
};
