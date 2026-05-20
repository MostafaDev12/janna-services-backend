<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProviderDetailsResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'                => $this->id,
            'name'              => $this->localized('name'),
            'slug'              => $this->slug,
            'description'       => $this->localized('description'),
            'short_description' => $this->localized('short_description'),
            'phone'             => $this->phone,
            'whatsapp'          => $this->whatsapp,
            'address'           => $this->localized('address'),
            'location_url'      => $this->location_url,
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
            'gallery' => ProviderMediaResource::collection(
                $this->whenLoaded('media', fn () => $this->media->where('type', 'gallery')->values())
            ),
            'menu' => ProviderMediaResource::collection(
                $this->whenLoaded('media', fn () => $this->media->where('type', 'menu')->values())
            ),
            'products' => ProviderMediaResource::collection(
                $this->whenLoaded('media', fn () => $this->media->where('type', 'product')->values())
            ),
            'banners' => ProviderMediaResource::collection(
                $this->whenLoaded('media', fn () => $this->media->where('type', 'banner')->values())
            ),
        ];
    }
}
