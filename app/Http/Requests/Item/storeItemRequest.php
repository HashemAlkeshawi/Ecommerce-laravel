<?php

namespace App\Http\Requests\Item;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class storeItemRequest extends FormRequest
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
            'brand_id' => 'required|numeric',
            'image' => 'required|mimes:jpg,jpeg,png',
            'name' => [
                'required',
                Rule::unique('items')->where(function ($query) {
                    return $query->where('brand_id', $this->input('brand_id'));
                }),
            ],
        ];
    }
    public function messages()
    {
        return [
            'brand_id.numeric' => 'You have to select a brand',
            'name.unique' => 'This name is taken for the selected brand',
        ];
    }
}
