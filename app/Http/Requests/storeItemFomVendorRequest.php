<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeItemFomVendorRequest extends FormRequest
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
            'inventory_id' => 'required|numeric',
            'quantity' =>'required|numeric',
            'item_id' => 'required|numeric'
        ];
    }
    public function messages()
    {
        return [
            'inventory_id.numeric' => 'You have to select a valid Inventory',
            'inventory_id.required' => 'You have to select an Inventory',

            'quantity.numeric' => 'You have to enter a numeric value for quantity',
            
            'item_id.numeric' => 'You have to select a valid Item',
            'item_id.required' => 'You have to select an Item',

        ];
    }
}
