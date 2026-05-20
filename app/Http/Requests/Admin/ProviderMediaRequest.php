<?php

namespace App\Http\Requests\Admin;

use App\Models\ProviderMedia;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProviderMediaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        $isUpdate = $this->isMethod('PUT') || $this->isMethod('PATCH');

        if ($isUpdate) {
            // Edit form replaces a single image.
            return [
                'type'       => ['required', Rule::in(ProviderMedia::TYPES)],
                'title_en'   => ['nullable', 'string', 'max:255'],
                'title_ar'   => ['nullable', 'string', 'max:255'],
                'image'      => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
                'sort_order' => ['nullable', 'integer', 'min:0'],
                'is_active'  => ['sometimes', 'boolean'],
            ];
        }

        // Upload form posts `image[]` so several files can be saved at once.
        return [
            'type'       => ['required', Rule::in(ProviderMedia::TYPES)],
            'title_en'   => ['nullable', 'string', 'max:255'],
            'title_ar'   => ['nullable', 'string', 'max:255'],
            'image'      => ['required', 'array', 'min:1'],
            'image.*'    => ['image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active'  => ['sometimes', 'boolean'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_active' => $this->boolean('is_active', true),
        ]);
    }
}
