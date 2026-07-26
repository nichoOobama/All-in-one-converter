<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('versions', function (Blueprint $table) {
            $table->id();
            $table->string('version_number', 20);
            $table->enum('platform', ['windows', 'android']);
            $table->unique(['version_number', 'platform']);
            $table->string('download_url');
            $table->text('changelog')->nullable();
            $table->boolean('is_critical')->default(false);
            $table->boolean('force_update')->default(false);
            $table->string('min_supported_version', 20)->nullable();
            $table->bigInteger('file_size')->nullable();
            $table->string('file_hash', 64)->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['platform', 'is_active']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('versions');
    }
};
