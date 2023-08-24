<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class storeUserRequest extends FormRequest
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
            'email' => 'required|unique:users',
            'username' => 'required|unique:users|min:5',
            'first_name' => 'required|min:3|max:15',
            'last_name' => 'required|min:3|max:15',
            'is_admin' => 'in:0,1',
            'is_active' => 'in:0,1',
            'password' => 'required|min:8',
            'check_password' => 'required|same:password'
        ];
    }
}
