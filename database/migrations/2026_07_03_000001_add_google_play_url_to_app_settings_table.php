<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('app_settings', function (Blueprint $table) {
            // Public Google Play store listing. The web footer shows the
            // "Get it on Google Play" badge linking here when set.
            $table->string('google_play_url')->nullable()->after('secondary_color');
        });
    }

    public function down(): void
    {
        Schema::table('app_settings', function (Blueprint $table) {
            $table->dropColumn('google_play_url');
        });
    }
};
