<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeAddressRequest extends FormRequest
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
            'district' => 'required|min:3|max:25',
            'street' => 'required|min:3|max:25',
            'phone' => 'required|regex:/[0-9]{10}/',
       
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
