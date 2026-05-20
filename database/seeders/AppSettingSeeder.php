<?php

namespace Database\Seeders;

use App\Models\AppSetting;
use Illuminate\Database\Seeder;

class AppSettingSeeder extends Seeder
{
    public function run(): void
    {
        AppSetting::updateOrCreate(['id' => 1], [
            'app_name'        => 'Janna October Services',
            'app_name_en'     => 'Janna October Services',
            'app_name_ar'     => 'خدمات جنّة أكتوبر',
            'tagline'         => 'Your community services directory',
            'tagline_en'      => 'Your community services directory',
            'tagline_ar'      => 'دليل خدمات مجتمعك',
            // Brand swatch matches the Flutter AppColors.primary baseline.
            'primary_color'   => '#0F4C45',
            'secondary_color' => '#F2A11F',
        ]);
    }
}
