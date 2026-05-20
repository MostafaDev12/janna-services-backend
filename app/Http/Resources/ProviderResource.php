<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProviderResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'                => $this->id,
            'name'              => $this->localized('name'),
            'slug'              => $this->slug,
            'short_description' => $this->localized('short_description'),
            'phone'             => $this->phone,
            'whatsapp'          => $this->whatsapp,
            'address'           => $this->localized('address'),
            'working_hours'     => $this->localized('working_hours'),
            'cover_image_url'   => $this->cover_image_url,
            'logo_url'          => $this->logo_url,
            'area_type'         => $this->area_type,
            'is_featured'       => $this->is_featured,
            'category'          => $this->whenLoaded('category', fn () => [
                'id'   => $this->category->id,
                'name' => $this->category->localized('name'),
                'slug' => $this->category->slug,
            ]),
        ];
    }
}
