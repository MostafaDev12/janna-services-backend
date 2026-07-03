<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AppSettingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'app_name'        => $this->localized('app_name'),
            'tagline'         => $this->localized('tagline'),
            'logo_url'        => $this->logo_url,
            'icon_url'        => $this->icon_url,
            'primary_color'   => $this->primary_color,
            'secondary_color' => $this->secondary_color,
            'google_play_url' => $this->google_play_url,
            'apk_url'         => $this->apk_url,
        ];
    }
}
