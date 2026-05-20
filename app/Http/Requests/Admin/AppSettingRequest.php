<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AppSettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'app_name_en'     => ['nullable', 'string', 'max:255'],
            'app_name_ar'     => ['nullable', 'string', 'max:255'],
            'tagline_en'      => ['nullable', 'string', 'max:255'],
            'tagline_ar'      => ['nullable', 'string', 'max:255'],
            'logo'            => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:2048'],
            'icon'            => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:1024'],
            // `#RRGGBB` or `#RGB`. Empty = clear the color.
            'primary_color'   => ['nullable', 'string', 'regex:/^#([0-9a-fA-F]{3}|[0-9a-fA-F]{6})$/'],
            'secondary_color' => ['nullable', 'string', 'regex:/^#([0-9a-fA-F]{3}|[0-9a-fA-F]{6})$/'],
        ];
    }
}
