<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('app_settings', function (Blueprint $table) {
            // Path on the `public` disk to an uploaded .apk. Lets users
            // download the app directly until it is live on Google Play.
            $table->string('apk')->nullable()->after('google_play_url');
        });
    }

    public function down(): void
    {
        Schema::table('app_settings', function (Blueprint $table) {
            $table->dropColumn('apk');
        });
    }
};
