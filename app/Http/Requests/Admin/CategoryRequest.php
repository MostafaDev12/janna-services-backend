<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        $id = $this->route('category')?->id;

        return [
            'name_en'        => ['required', 'string', 'max:255'],
            'name_ar'        => ['nullable', 'string', 'max:255'],
            'slug'           => ['nullable', 'string', 'max:255', Rule::unique('categories', 'slug')->ignore($id)],
            'description_en' => ['nullable', 'string'],
            'description_ar' => ['nullable', 'string'],
            'icon'           => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:2048'],
            'image'          => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'sort_order'     => ['nullable', 'integer', 'min:0'],
            'is_active'      => ['sometimes', 'boolean'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_active' => $this->boolean('is_active'),
        ]);
    }
}
