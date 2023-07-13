<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateUserRequest extends FormRequest
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
            /***
                username must be unique and more than 4 characters long
                first_name : min 3, max 15
                last_name: min 3, max 15
                Is_admin must be 0 or 1
                Is_active must be 0 or 1
                Password must contain at least one uppercase letter, one lower case letter, one numeric value, one special character and more than 8 characters long            
         */
        'username' => 'required|min:5',
        'first_name' => 'required|min:3|max:15',
        'last_name' => 'required|min:3|max:15',
        'is_admin' => 'in:0,1',
        'is_active' => 'in:0,1',
    
    

    ];
    }
}
