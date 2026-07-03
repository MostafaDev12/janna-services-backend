<?php

namespace App\Models;

use App\Models\Concerns\HasLocalizedFields;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppSetting extends Model
{
    use HasFactory;
    use HasLocalizedFields;

    protected $fillable = [
        'app_name',
        'app_name_en',
        'app_name_ar',
        'tagline',
        'tagline_en',
        'tagline_ar',
        'logo',
        'icon',
        'primary_color',
        'secondary_color',
        'google_play_url',
        'apk',
    ];

    /**
     * The single settings row. Created on first access so the admin and the
     * API never have to handle a missing record.
     */
    public static function current(): self
    {
        return static::firstOrCreate(['id' => 1], [
            'app_name'    => config('app.name'),
            'app_name_en' => config('app.name'),
        ]);
    }

    public function getLogoUrlAttribute(): ?string
    {
        return $this->logo ? asset('storage/'.$this->logo) : null;
    }

    public function getIconUrlAttribute(): ?string
    {
        return $this->icon ? asset('storage/'.$this->icon) : null;
    }

    public function getApkUrlAttribute(): ?string
    {
        return $this->apk ? asset('storage/'.$this->apk) : null;
    }
}
