<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('provider_media', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_provider_id')->constrained('service_providers')->cascadeOnDelete();
            $table->enum('type', ['gallery', 'menu', 'product', 'cover', 'banner'])->default('gallery');
            $table->string('title')->nullable();
            $table->string('image');
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['service_provider_id', 'type', 'is_active']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('provider_media');
    }
};
