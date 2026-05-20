<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BannerResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'title'      => $this->localized('title'),
            'subtitle'   => $this->localized('subtitle'),
            'image_url'  => $this->image_url,
            'link_url'   => $this->link_url,
            'provider'   => $this->whenLoaded('provider', fn () => $this->provider ? [
                'id'   => $this->provider->id,
                'name' => $this->provider->localized('name'),
                'slug' => $this->provider->slug,
            ] : null),
            'sort_order' => $this->sort_order,
        ];
    }
}
