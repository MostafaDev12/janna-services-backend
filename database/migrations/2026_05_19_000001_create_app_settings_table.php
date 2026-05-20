<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('app_settings', function (Blueprint $table) {
            $table->id();

            // Bilingual brand text. Legacy single-column kept so any code
            // reading `$settings->app_name` directly keeps working.
            $table->string('app_name')->nullable();
            $table->string('app_name_en')->nullable();
            $table->string('app_name_ar')->nullable();

            $table->string('tagline')->nullable();
            $table->string('tagline_en')->nullable();
            $table->string('tagline_ar')->nullable();

            // Paths on the `public` disk. URLs are built by the model accessor.
            $table->string('logo')->nullable();
            $table->string('icon')->nullable();

            // Hex colors for optional dynamic theming in the mobile app.
            $table->string('primary_color', 16)->nullable();
            $table->string('secondary_color', 16)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('app_settings');
    }
};
