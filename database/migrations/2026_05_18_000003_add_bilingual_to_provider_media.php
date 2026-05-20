<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('provider_media', function (Blueprint $table) {
            $table->string('title_ar')->nullable()->after('title');
            $table->string('title_en')->nullable()->after('title_ar');
        });

        DB::table('provider_media')->whereNotNull('title')->update([
            'title_en' => DB::raw('title'),
        ]);
    }

    public function down(): void
    {
        Schema::table('provider_media', function (Blueprint $table) {
            $table->dropColumn(['title_ar', 'title_en']);
        });
    }
};
