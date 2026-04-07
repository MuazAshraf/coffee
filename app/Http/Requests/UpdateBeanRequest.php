<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBeanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->id === $this->route('bean')?->user_id;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'roaster' => ['nullable', 'string', 'max:255'],
            'origin' => ['nullable', 'string', 'max:255'],
            'roast_level' => ['required', 'in:light,medium,dark'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
