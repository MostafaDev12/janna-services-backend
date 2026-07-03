<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'contact',
        'title',
        'body',
        'is_read',
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];

    /** Messages the admin has not opened yet. */
    public function scopeUnread(Builder $query): Builder
    {
        return $query->where('is_read', false);
    }
}
