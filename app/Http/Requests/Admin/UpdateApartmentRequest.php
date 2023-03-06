<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateApartmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'exists:users,id',

            'title' => 'string|max:255',
            'address' => 'string|max:255',
            'latitude' => '',
            'longitude' => '',
            'cover_img' => 'file|image',
            'description' => 'string|max:1000',
            'rooms_qty' => 'integer',
            'beds_qty' => 'integer',
            'bathrooms_qty' => 'integer',
            'mq' => 'integer',
            'daily_price' => 'numeric',
            'visible' => 'nullable|boolean',
            'services' => 'nullable|array',
        ];
    }
}
