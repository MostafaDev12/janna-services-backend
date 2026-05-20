<?php

namespace Database\Seeders;

use App\Models\Banner;
use App\Models\ServiceProvider;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class BannerSeeder extends Seeder
{
    public function run(): void
    {
        $featuredProvider = ServiceProvider::where('is_featured', true)->first();

        $items = [
            [
                'title_en'    => 'Welcome to Janna Services',
                'title_ar'    => 'أهلًا بكم في خدمات جنّة',
                'subtitle_en' => 'Your community directory',
                'subtitle_ar' => 'دليل مجتمعك',
                'image'       => $this->ensurePlaceholder('banners/welcome-placeholder.png', '#0d6efd', 'Welcome'),
                'link_url'    => null,
            ],
            [
                'title_en'    => 'Featured this week',
                'title_ar'    => 'مميزون هذا الأسبوع',
                'subtitle_en' => 'Top-rated providers around the compound',
                'subtitle_ar' => 'أفضل مزودي الخدمات حول الكمبوند',
                'image'       => $this->ensurePlaceholder('banners/featured-placeholder.png', '#198754', 'Featured'),
                'provider_id' => $featuredProvider?->id,
            ],
        ];

        foreach ($items as $i => $row) {
            $existing = Banner::where('title', $row['title_en'])->first();

            // Never overwrite an image the admin has already uploaded — only
            // backfill the placeholder when no image is set yet.
            if ($existing && !empty($existing->image)) {
                unset($row['image']);
            }

            Banner::updateOrCreate(
                ['title' => $row['title_en']],
                array_merge($row, [
                    // Legacy single-language columns
                    'title'    => $row['title_en'],
                    'subtitle' => $row['subtitle_en'],
                    'sort_order' => $i + 1,
                    'is_active'  => true,
                ]),
            );
        }
    }

    /**
     * Make sure a placeholder image actually exists on the public disk so the
     * API never returns a `_url` that points at a missing file. If GD isn't
     * available, falls back to a tiny 1x1 PNG written byte-for-byte.
     */
    private function ensurePlaceholder(string $relativePath, string $hex, string $label): string
    {
        $disk = Storage::disk('public');

        if ($disk->exists($relativePath)) {
            return $relativePath;
        }

        $bytes = $this->renderPlaceholderPng($hex, $label) ?? $this->onePixelPng($hex);
        $disk->put($relativePath, $bytes);

        return $relativePath;
    }

    private function renderPlaceholderPng(string $hex, string $label): ?string
    {
        if (!function_exists('imagecreatetruecolor')) {
            return null;
        }

        [$r, $g, $b] = $this->hexToRgb($hex);
        $img = imagecreatetruecolor(800, 360);
        $bg  = imagecolorallocate($img, $r, $g, $b);
        $fg  = imagecolorallocate($img, 255, 255, 255);
        imagefilledrectangle($img, 0, 0, 800, 360, $bg);
        imagestring($img, 5, 30, 30, $label, $fg);

        ob_start();
        imagepng($img);
        $bytes = ob_get_clean();
        imagedestroy($img);

        return $bytes;
    }

    private function onePixelPng(string $hex): string
    {
        [$r, $g, $b] = $this->hexToRgb($hex);
        // Minimal valid PNG: 1x1 pixel of the given color.
        $sig = "\x89PNG\r\n\x1a\n";
        $ihdr = pack('NA4NNCCCCC', 13, 'IHDR', 1, 1, 8, 2, 0, 0, 0);
        $ihdr .= pack('N', crc32(substr($ihdr, 4)));
        $raw = "\x00".chr($r).chr($g).chr($b);
        $idatData = gzcompress($raw, 9);
        $idat = pack('NA4', strlen($idatData), 'IDAT').$idatData;
        $idat .= pack('N', crc32(substr($idat, 4)));
        $iend = pack('NA4', 0, 'IEND');
        $iend .= pack('N', crc32(substr($iend, 4)));
        return $sig.$ihdr.$idat.$iend;
    }

    private function hexToRgb(string $hex): array
    {
        $hex = ltrim($hex, '#');
        return [
            hexdec(substr($hex, 0, 2)),
            hexdec(substr($hex, 2, 2)),
            hexdec(substr($hex, 4, 2)),
        ];
    }
}
