<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            AppSettingSeeder::class,
            CategorySeeder::class,
            ServiceProviderSeeder::class,
            ImportantNumberSeeder::class,
            BannerSeeder::class,
        ]);
    }
}
