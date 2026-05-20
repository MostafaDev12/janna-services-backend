<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ServiceProviderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        $id = $this->route('provider')?->id;

        return [
            'category_id'           => ['required', 'integer', 'exists:categories,id'],
            'name_en'               => ['required', 'string', 'max:255'],
            'name_ar'               => ['nullable', 'string', 'max:255'],
            'slug'                  => ['nullable', 'string', 'max:255', Rule::unique('service_providers', 'slug')->ignore($id)],
            'description_en'        => ['nullable', 'string'],
            'description_ar'        => ['nullable', 'string'],
            'short_description_en'  => ['nullable', 'string', 'max:500'],
            'short_description_ar'  => ['nullable', 'string', 'max:500'],
            'phone'                 => ['nullable', 'string', 'max:50'],
            'whatsapp'              => ['nullable', 'string', 'max:50'],
            'address_en'            => ['nullable', 'string', 'max:255'],
            'address_ar'            => ['nullable', 'string', 'max:255'],
            'location_url'          => ['nullable', 'url', 'max:255'],
            'working_hours_en'      => ['nullable', 'string', 'max:255'],
            'working_hours_ar'      => ['nullable', 'string', 'max:255'],
            'cover_image'           => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'logo'                  => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'area_type'             => ['required', Rule::in(['inside_compound', 'near_compound'])],
            'is_featured'           => ['sometimes', 'boolean'],
            'is_active'             => ['sometimes', 'boolean'],
            'sort_order'            => ['nullable', 'integer', 'min:0'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_featured' => $this->boolean('is_featured'),
            'is_active'   => $this->boolean('is_active'),
        ]);
    }
}
