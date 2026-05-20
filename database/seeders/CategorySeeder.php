<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['name_en' => 'Maintenance',          'name_ar' => 'الصيانة',                  'description_en' => 'Plumbers, electricians, AC repair and handymen.',         'description_ar' => 'سباكون وكهربائيون وصيانة تكييف وعمال صيانة عامة.'],
            ['name_en' => 'Restaurants & Cafes',  'name_ar' => 'المطاعم والمقاهي',         'description_en' => 'Dine-in, takeaway and delivery options around the compound.', 'description_ar' => 'مطاعم للتناول داخل المحل أو الطلب الخارجي أو التوصيل حول الكمبوند.'],
            ['name_en' => 'Pharmacies',           'name_ar' => 'الصيدليات',                 'description_en' => '24/7 and local pharmacies.',                               'description_ar' => 'صيدليات تعمل على مدار الساعة وصيدليات محلية.'],
            ['name_en' => 'Clinics',              'name_ar' => 'العيادات',                  'description_en' => 'Medical clinics and family doctors.',                      'description_ar' => 'عيادات طبية وأطباء أسرة.'],
            ['name_en' => 'Supermarkets',         'name_ar' => 'سوبر ماركت',                'description_en' => 'Groceries and daily essentials.',                          'description_ar' => 'بقالة ومستلزمات يومية.'],
            ['name_en' => 'Cleaning Services',    'name_ar' => 'خدمات التنظيف',             'description_en' => 'Home cleaning, deep cleaning and laundry.',                'description_ar' => 'تنظيف منازل وتنظيف عميق وغسيل ملابس.'],
            ['name_en' => 'Compound Services',    'name_ar' => 'خدمات الكمبوند',            'description_en' => 'Security, gardening, pool and shared services.',           'description_ar' => 'أمن وحدائق ومسبح وخدمات مشتركة.'],
            ['name_en' => 'Emergency Numbers',    'name_ar' => 'أرقام الطوارئ',             'description_en' => 'Critical numbers for fast response.',                      'description_ar' => 'أرقام مهمة للاستجابة السريعة.'],
        ];

        foreach ($items as $i => $row) {
            Category::updateOrCreate(
                ['name' => $row['name_en']],
                [
                    // Mirror name_en into the legacy `name` column for backward
                    // compat (and because that column is NOT NULL).
                    'name'           => $row['name_en'],
                    'name_en'        => $row['name_en'],
                    'name_ar'        => $row['name_ar'],
                    'description'    => $row['description_en'],
                    'description_en' => $row['description_en'],
                    'description_ar' => $row['description_ar'],
                    'sort_order'     => $i + 1,
                    'is_active'      => true,
                ],
            );
        }
    }
}
