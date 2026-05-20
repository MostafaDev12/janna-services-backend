<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ImportantNumberRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'title_en'       => ['required', 'string', 'max:255'],
            'title_ar'       => ['nullable', 'string', 'max:255'],
            'phone'          => ['required', 'string', 'max:50'],
            'whatsapp'       => ['nullable', 'string', 'max:50'],
            'description_en' => ['nullable', 'string'],
            'description_ar' => ['nullable', 'string'],
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
