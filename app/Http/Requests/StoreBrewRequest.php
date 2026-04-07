<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreBrewRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'bean_id' => [
                'required',
                Rule::exists('beans', 'id')->where('user_id', $this->user()->id),
            ],
            'method' => ['required', 'in:v60,aeropress,espresso,french_press,chemex'],
            'dose_grams' => ['required', 'numeric', 'min:0.1', 'max:9999.99'],
            'yield_grams' => ['required', 'numeric', 'min:0.1', 'max:9999.99'],
            'brew_time_seconds' => ['required', 'integer', 'min:1', 'max:86400'],
            'grind_setting' => ['nullable', 'string', 'max:255'],
            'water_temp_c' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'taste_notes' => ['nullable', 'string'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'brewed_at' => ['required', 'date'],
        ];
    }
}
