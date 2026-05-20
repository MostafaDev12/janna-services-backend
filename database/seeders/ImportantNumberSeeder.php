<?php

namespace Database\Seeders;

use App\Models\ImportantNumber;
use Illuminate\Database\Seeder;

class ImportantNumberSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['title_en' => 'Police',                       'title_ar' => 'الشرطة',                       'phone' => '122', 'description_en' => 'Emergency police line.',                  'description_ar' => 'خط طوارئ الشرطة.'],
            ['title_en' => 'Ambulance',                    'title_ar' => 'الإسعاف',                      'phone' => '123', 'description_en' => 'Medical emergencies.',                    'description_ar' => 'حالات الطوارئ الطبية.'],
            ['title_en' => 'Fire Brigade',                 'title_ar' => 'الإطفاء',                      'phone' => '180', 'description_en' => 'Fire emergencies.',                       'description_ar' => 'حالات طوارئ الحرائق.'],
            ['title_en' => 'Tourism & Antiquities Police', 'title_ar' => 'شرطة السياحة والآثار',         'phone' => '126'],
            ['title_en' => 'Compound Security',            'title_ar' => 'أمن الكمبوند',                 'phone' => '+20238001000', 'whatsapp' => '+20238001000', 'description_en' => 'Reachable 24/7 at any gate.', 'description_ar' => 'متاح على مدار الساعة عند أي بوابة.'],
            ['title_en' => 'Compound Maintenance',         'title_ar' => 'صيانة الكمبوند',               'phone' => '+201500001111', 'whatsapp' => '+201500001111', 'description_en' => 'Plumbing, electricity, AC.', 'description_ar' => 'سباكة وكهرباء وتكييف.'],
            ['title_en' => 'Electricity Outage',           'title_ar' => 'انقطاع الكهرباء',              'phone' => '121',  'description_en' => 'Report power outages.', 'description_ar' => 'للإبلاغ عن انقطاع الكهرباء.'],
            ['title_en' => 'Gas Emergency',                'title_ar' => 'طوارئ الغاز',                  'phone' => '129'],
            ['title_en' => 'Water Emergency',              'title_ar' => 'طوارئ المياه',                 'phone' => '125'],
        ];

        foreach ($items as $i => $row) {
            ImportantNumber::updateOrCreate(
                ['title' => $row['title_en']],
                array_merge($row, [
                    // Legacy single-language columns
                    'title'       => $row['title_en'],
                    'description' => $row['description_en'] ?? null,
                    'sort_order'  => $i + 1,
                    'is_active'   => true,
                ]),
            );
        }
    }
}
