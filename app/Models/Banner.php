<?php

namespace App\Models;

use App\Models\Concerns\HasLocalizedFields;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Banner extends Model
{
    use HasFactory;
    use HasLocalizedFields;

    protected $fillable = [
        'title',
        'title_ar',
        'title_en',
        'subtitle',
        'subtitle_ar',
        'subtitle_en',
        'image',
        'link_url',
        'provider_id',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active'   => 'boolean',
        'sort_order'  => 'integer',
        'provider_id' => 'integer',
    ];

    public function provider(): BelongsTo
    {
        return $this->belongsTo(ServiceProvider::class, 'provider_id');
    }

    public function getImageUrlAttribute(): ?string
    {
        // Use asset() so the URL matches the current request host. With
        // Storage::url() the URL is locked to APP_URL, which breaks when the
        // admin is opened on a different host (php artisan serve at 127.0.0.1,
        // mobile emulator at 10.0.2.2, etc.).
        return $this->image ? asset('storage/'.$this->image) : null;
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderByDesc('id');
    }
}
