<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('banners', function (Blueprint $table) {
            $table->string('title_ar')->nullable()->after('title');
            $table->string('title_en')->nullable()->after('title_ar');
            $table->string('subtitle_ar')->nullable()->after('subtitle');
            $table->string('subtitle_en')->nullable()->after('subtitle_ar');
        });

        DB::table('banners')->whereNotNull('title')->update([
            'title_en' => DB::raw('title'),
        ]);
        DB::table('banners')->whereNotNull('subtitle')->update([
            'subtitle_en' => DB::raw('subtitle'),
        ]);
    }

    public function down(): void
    {
        Schema::table('banners', function (Blueprint $table) {
            $table->dropColumn(['title_ar', 'title_en', 'subtitle_ar', 'subtitle_en']);
        });
    }
};
