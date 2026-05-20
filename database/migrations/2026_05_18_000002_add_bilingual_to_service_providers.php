<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('service_providers', function (Blueprint $table) {
            $table->string('name_ar')->nullable()->after('name');
            $table->string('name_en')->nullable()->after('name_ar');
            $table->text('description_ar')->nullable()->after('description');
            $table->text('description_en')->nullable()->after('description_ar');
            $table->string('short_description_ar', 500)->nullable()->after('short_description');
            $table->string('short_description_en', 500)->nullable()->after('short_description_ar');
            $table->string('address_ar')->nullable()->after('address');
            $table->string('address_en')->nullable()->after('address_ar');
            $table->string('working_hours_ar')->nullable()->after('working_hours');
            $table->string('working_hours_en')->nullable()->after('working_hours_ar');
        });

        DB::table('service_providers')->whereNotNull('name')->update([
            'name_en' => DB::raw('name'),
        ]);
        DB::table('service_providers')->whereNotNull('description')->update([
            'description_en' => DB::raw('description'),
        ]);
        DB::table('service_providers')->whereNotNull('short_description')->update([
            'short_description_en' => DB::raw('short_description'),
        ]);
        DB::table('service_providers')->whereNotNull('address')->update([
            'address_en' => DB::raw('address'),
        ]);
        DB::table('service_providers')->whereNotNull('working_hours')->update([
            'working_hours_en' => DB::raw('working_hours'),
        ]);
    }

    public function down(): void
    {
        Schema::table('service_providers', function (Blueprint $table) {
            $table->dropColumn([
                'name_ar', 'name_en',
                'description_ar', 'description_en',
                'short_description_ar', 'short_description_en',
                'address_ar', 'address_en',
                'working_hours_ar', 'working_hours_en',
            ]);
        });
    }
};
