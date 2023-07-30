<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class storeInventoryRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'country' => 'required|numeric',
            'city' => 'required|numeric',
            'name' => 'required',
            'phone' => 'required|min:7|max:20',
        ];
    }
    public function messages()
    {
        return [
            'country.numeric' => 'make sure to select a Country',
            'city.numeric' => 'make sure to select a City',
        ];
    }
}
