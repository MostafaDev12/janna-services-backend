<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ImportantNumberResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'title'       => $this->localized('title'),
            'phone'       => $this->phone,
            'whatsapp'    => $this->whatsapp,
            'description' => $this->localized('description'),
            'sort_order'  => $this->sort_order,
        ];
    }
}
