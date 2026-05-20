<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('important_numbers', function (Blueprint $table) {
            $table->string('title_ar')->nullable()->after('title');
            $table->string('title_en')->nullable()->after('title_ar');
            $table->text('description_ar')->nullable()->after('description');
            $table->text('description_en')->nullable()->after('description_ar');
        });

        DB::table('important_numbers')->whereNotNull('title')->update([
            'title_en' => DB::raw('title'),
        ]);
        DB::table('important_numbers')->whereNotNull('description')->update([
            'description_en' => DB::raw('description'),
        ]);
    }

    public function down(): void
    {
        Schema::table('important_numbers', function (Blueprint $table) {
            $table->dropColumn(['title_ar', 'title_en', 'description_ar', 'description_en']);
        });
    }
};
